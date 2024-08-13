<?php
include 'db.php';

$log_file = 'ipn_errors.log';

function log_error($message) {
    global $log_file;
    $current_time = date('Y-m-d H:i:s');
    file_put_contents($log_file, "[$current_time] $message" . PHP_EOL, FILE_APPEND);
}

function log_full_url($url, $data) {
    global $log_file;
    $current_time = date('Y-m-d H:i:s');
    $full_url = $url . '?' . http_build_query($data);
    file_put_contents($log_file, "[$current_time] FULL URL: $full_url" . PHP_EOL, FILE_APPEND);
}

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$current_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
    $keyval = explode('=', $keyval);
    if (count($keyval) == 2) {
        $myPost[$keyval[0]] = urldecode($keyval[1]);
    }
}

$req = 'cmd=_notify-validate';
foreach ($myPost as $key => $value) {
    $value = urlencode($value);
    $req .= "&$key=$value";
}

log_full_url($current_url, $myPost);

$ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
$res = curl_exec($ch);

if (curl_errno($ch)) {
    log_error('CURL error: ' . curl_error($ch));
    curl_close($ch);
    exit;
}

curl_close($ch);

if (strcmp($res, "VERIFIED") == 0) {
    $payment_status = $_POST['payment_status'];
    $txn_id = $_POST['txn_id'];
    $amount = $_POST['mc_gross'];
    $currency = $_POST['mc_currency'];
    $custom = $_POST['custom'];

    log_error("Payment Status: $payment_status, Transaction ID: $txn_id, Amount: $amount, Custom: $custom");

    if ($payment_status == "Completed") {
        $stmt = $conn->prepare("UPDATE payments SET status = 1 WHERE txn_id = ?");
        if ($stmt === false) {
            log_error('Statement preparation error: ' . $conn->error);
            exit;
        }

        $stmt->bind_param('s', $txn_id);
        if (!$stmt->execute()) {
            log_error('Statement execution error: ' . $stmt->error);
        } else {
            log_error('Payment status updated successfully for txn_id: ' . $txn_id);
        }

        $stmt->close();
    } else {
        log_error('Payment status not completed: ' . $payment_status);
    }

    $conn->close();
} else if (strcmp($res, "INVALID") == 0) {
    log_error('Invalid IPN: ' . $req);
} else {
    log_error('Unknown response from PayPal: ' . $res);
}
?>
