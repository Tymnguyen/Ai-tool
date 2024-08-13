<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: dangnhap.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT name FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_name = $row['name'];
} else {
    $user_name = "Người dùng";
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VNS - AI TOOL</title>
    <link rel="shortcut icon" href="../pic/link.png" type="image/x-icon" id="pageTitle">
    <style>
        /* Ẩn nút lật qua trái và phải ban đầu */
        #prev-card,
        #next-card,
        #layout-toggle {
            display: none;
        }

        body {
            flex: auto;
            margin: 0%;
            background-image: linear-gradient(to right, #333333, #4d88ff, #ccffdd, #4d88ff, #404040);
        }

        .wrapper {
            width: 100%;
            height: 100%;
            background-image: linear-gradient(to right, #333333, #4d88ff, #ccffdd, #4d88ff, #404040);
        }

        .header {
            background-image: linear-gradient(to right, #333333, #4d88ff, #ccffdd, #4d88ff, #404040);
        }

        .logohead {
            text-align: center;
            padding: 10px;
            margin: 10px;
            float: left;
        }

        .logohead1 {
            text-align: center;
            padding: 20px;
            margin-top: -100px;
            float: right;
            position: absolute;
            top: 10;
            left: 80%;
            transform: translateX(-50%);
            z-index: 2;
            width: 300px;
            margin-left: 130px;
        }

        .logohead1 summary::-webkit-details-marker {
            display: none;
        }

        .logohead1 summary {
            padding: 10;
            cursor: pointer;
        }

        .logohead1 ul {
            margin-top: 10px;
            list-style: none;
        }

        .logohead1 ul li::before {
            content: "•";
            margin-right: 5px;
        }

        .tk {
            font-size: 35px;
            font-weight: bold;
            text-decoration: none;
            color: #fff2cc;
            width: 300px;
            margin-right: 15px;
            white-space: nowrap;
        }

        .logohead1 ul a.tk:hover {
            font-size: 35px;
            background-color: #809fff;
            display: inline-block;
            padding: 5px;
            border-radius: 10px;
            width: 200px;
            color: #333;
            font-weight: bold;
        }

        .main {
            text-align: center;
            font-family: Tahoma;
            font-weight: 500;
            font-size: 30px;
            margin-top: -40px;
            text-align: center;
            padding-bottom: 30px;

        }

        .main button {
            margin-top: 10px;
        }

        h2 {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        button {
            border-radius: 20px;
            background-color: #809fff;
            border: 3px solid #0088cc;
            text-align: center;
            font-size: 30px;
            height: 50px;
            align-items: center;
            transition-duration: 0.4s;
            text-decoration: none;
            overflow: hidden;
            cursor: pointer;
            color: #ffffff;
        }

        button:hover {
            background-color: #4d79ff;
            color: #000000;
            font-weight: bold;
            height: 70px;
            border: 3px solid black;
        }

        .stars-container {
            height: 100%;
            width: 100%;
            overflow: hidden;
            margin: 0%;
            padding: 0%;
        }

        #stars,
        #stars2,
        #stars3 {
            margin-left: -300px;
        }

        #stars {
            width: 2px;
            height: 2px;
            background: transparent;
            box-shadow: 309px 853px #FFF, 1697px 1383px #FFF, 1751px 1860px #FFF, 1003px 89px #FFF, 604px 781px #FFF, 1400px 924px #FFF, 777px 1194px #FFF, 91px 1421px #FFF, 712px 1819px #FFF, 982px 1308px #FFF, 846px 163px #FFF, 899px 519px #FFF, 356px 1089px #FFF, 1642px 1256px #FFF, 264px 1730px #FFF, 1026px 366px #FFF, 1250px 672px #FFF, 1998px 1749px #FFF, 1237px 1572px #FFF, 1688px 247px #FFF, 948px 637px #FFF, 149px 805px #FFF, 306px 696px #FFF, 1688px 263px #FFF, 649px 698px #FFF, 1860px 1741px #FFF, 1553px 384px #FFF, 719px 972px #FFF, 1346px 1702px #FFF, 1958px 1119px #FFF, 1549px 1740px #FFF, 1772px 1432px #FFF, 254px 113px #FFF, 837px 1876px #FFF, 1658px 21px #FFF, 413px 1283px #FFF, 955px 1392px #FFF, 1293px 678px #FFF, 841px 156px #FFF, 201px 737px #FFF, 988px 376px #FFF, 942px 439px #FFF, 1068px 871px #FFF, 1818px 598px #FFF, 1662px 916px #FFF, 349px 691px #FFF, 350px 1599px #FFF, 833px 1802px #FFF, 1914px 1834px #FFF, 1881px 745px #FFF, 1373px 958px #FFF, 509px 1848px #FFF, 1771px 119px #FFF, 818px 277px #FFF, 385px 1433px #FFF, 1495px 567px #FFF, 1754px 1741px #FFF, 1801px 1706px #FFF, 501px 1650px #FFF, 1588px 806px #FFF, 505px 608px #FFF, 1056px 776px #FFF, 118px 1758px #FFF, 1249px 1947px #FFF, 523px 1655px #FFF, 128px 369px #FFF, 848px 1046px #FFF, 1757px 1598px #FFF, 1192px 828px #FFF, 1616px 351px #FFF, 16px 241px #FFF, 601px 825px #FFF, 1227px 85px #FFF, 1173px 1444px #FFF, 216px 469px #FFF, 1715px 1370px #FFF, 312px 589px #FFF, 1678px 1699px #FFF, 1269px 789px #FFF, 1076px 1191px #FFF, 1067px 6px #FFF, 930px 42px #FFF, 189px 1629px #FFF, 1264px 1065px #FFF, 1234px 1493px #FFF, 602px 189px #FFF, 328px 1782px #FFF, 1743px 105px #FFF, 1980px 881px #FFF, 511px 1767px #FFF, 1121px 614px #FFF, 1558px 1088px #FFF, 384px 686px #FFF, 1558px 1113px #FFF, 1517px 1141px #FFF, 236px 523px #FFF, 173px 1068px #FFF, 1062px 1593px #FFF, 1329px 1459px #FFF, 865px 1686px #FFF, 1035px 1217px #FFF, 1348px 932px #FFF, 1339px 1944px #FFF, 414px 1847px #FFF, 1938px 1630px #FFF, 1424px 342px #FFF, 1853px 1405px #FFF, 1178px 1481px #FFF, 1261px 1234px #FFF, 255px 1035px #FFF, 1766px 1806px #FFF, 429px 983px #FFF, 59px 1133px #FFF, 1347px 831px #FFF, 1831px 1801px #FFF, 1007px 254px #FFF, 1507px 701px #FFF, 723px 1796px #FFF, 1891px 1901px #FFF, 735px 99px #FFF, 1981px 1593px #FFF, 743px 74px #FFF, 1470px 860px #FFF, 429px 994px #FFF, 687px 50px #FFF, 668px 368px #FFF, 927px 101px #FFF, 981px 23px #FFF, 853px 650px #FFF, 544px 305px #FFF, 1967px 362px #FFF, 947px 1254px #FFF, 1765px 652px #FFF, 1068px 491px #FFF, 936px 595px #FFF, 881px 462px #FFF, 1814px 63px #FFF, 1988px 692px #FFF, 1388px 916px #FFF, 1958px 759px #FFF, 1887px 652px #FFF, 745px 913px #FFF, 1640px 283px #FFF, 1132px 1550px #FFF, 1312px 229px #FFF, 400px 754px #FFF, 14px 719px #FFF, 426px 425px #FFF, 1741px 149px #FFF, 1051px 216px #FFF, 1253px 52px #FFF, 173px 1046px #FFF, 1348px 1309px #FFF, 1541px 516px #FFF, 1105px 108px #FFF, 65px 1604px #FFF, 1923px 1200px #FFF, 1571px 1281px #FFF, 93px 1425px #FFF, 1761px 918px #FFF, 525px 80px #FFF, 998px 1982px #FFF, 230px 917px #FFF, 1269px 1585px #FFF, 1769px 1806px #FFF, 1102px 795px #FFF, 169px 1459px #FFF, 1859px 56px #FFF, 948px 168px #FFF, 1660px 1860px #FFF, 96px 777px #FFF, 352px 1930px #FFF, 1158px 1926px #FFF, 1716px 1166px #FFF, 285px 399px #FFF, 1820px 687px #FFF, 954px 396px #FFF, 534px 358px #FFF, 979px 1128px #FFF, 1047px 1331px #FFF, 1756px 1918px #FFF, 1542px 242px #FFF, 1982px 1547px #FFF, 1456px 262px #FFF, 1081px 636px #FFF, 597px 1903px #FFF, 1035px 1044px #FFF, 765px 956px #FFF, 1255px 97px #FFF, 646px 1085px #FFF, 1140px 1061px #FFF, 270px 1476px #FFF, 1390px 1214px #FFF, 169px 795px #FFF, 696px 1326px #FFF, 1595px 1582px #FFF, 911px 249px #FFF, 1951px 1112px #FFF, 636px 1724px #FFF, 1014px 1593px #FFF, 1134px 378px #FFF, 312px 862px #FFF, 1980px 1550px #FFF, 909px 114px #FFF, 1193px 355px #FFF, 723px 1931px #FFF, 676px 31px #FFF, 1740px 964px #FFF, 1852px 1395px #FFF, 1198px 590px #FFF, 1291px 1625px #FFF, 374px 666px #FFF, 4px 350px #FFF, 1424px 413px #FFF, 1745px 1717px #FFF, 1818px 114px #FFF, 1888px 1546px #FFF, 859px 1333px #FFF, 258px 1532px #FFF, 130px 945px #FFF, 1321px 191px #FFF, 409px 410px #FFF, 1532px 980px #FFF, 1183px 147px #FFF, 1508px 646px #FFF, 1427px 816px #FFF, 279px 941px #FFF, 1075px 352px #FFF, 1296px 1854px #FFF, 469px 773px #FFF, 980px 1785px #FFF, 613px 1128px #FFF, 1663px 1880px #FFF, 999px 1635px #FFF, 546px 1813px #FFF, 131px 557px #FFF, 50px 869px #FFF, 1571px 1354px #FFF, 278px 345px #FFF, 1086px 1776px #FFF, 1873px 537px #FFF, 1128px 979px #FFF, 320px 278px #FFF, 1828px 416px #FFF, 181px 250px #FFF, 678px 1569px #FFF, 578px 1247px #FFF, 1624px 1629px #FFF, 1323px 279px #FFF, 337px 1495px #FFF, 555px 919px #FFF, 878px 371px #FFF, 103px 1356px #FFF, 1162px 1061px #FFF, 1105px 451px #FFF, 1763px 1784px #FFF, 427px 800px #FFF, 587px 643px #FFF, 641px 1222px #FFF, 262px 254px #FFF, 1066px 899px #FFF, 1921px 302px #FFF, 796px 1460px #FFF, 615px 1670px #FFF, 1901px 148px #FFF, 509px 1541px #FFF, 1724px 914px #FFF, 855px 1470px #FFF, 1324px 1376px #FFF, 632px 520px #FFF, 809px 1842px #FFF, 1177px 1647px #FFF, 1371px 199px #FFF, 366px 421px #FFF, 1502px 1037px #FFF, 1971px 1657px #FFF, 131px 890px #FFF, 1231px 786px #FFF, 1759px 1126px #FFF, 604px 311px #FFF, 575px 1748px #FFF, 42px 1668px #FFF, 107px 417px #FFF, 1885px 442px #FFF, 1056px 719px #FFF, 154px 908px #FFF, 136px 284px #FFF, 330px 1691px #FFF, 568px 139px #FFF, 762px 774px #FFF, 1509px 888px #FFF, 316px 1610px #FFF, 1911px 1408px #FFF, 1186px 903px #FFF, 827px 296px #FFF, 1025px 791px #FFF, 391px 1772px #FFF, 153px 496px #FFF, 1390px 1266px #FFF, 561px 1870px #FFF, 546px 1781px #FFF, 1477px 1492px #FFF, 1461px 610px #FFF, 101px 877px #FFF, 474px 315px #FFF, 1507px 1822px #FFF, 580px 125px #FFF, 1379px 1271px #FFF, 1595px 105px #FFF, 833px 1161px #FFF, 1907px 1797px #FFF, 600px 77px #FFF, 1518px 1037px #FFF, 564px 382px #FFF, 1729px 213px #FFF, 187px 562px #FFF, 1563px 1794px #FFF, 1668px 630px #FFF, 1873px 1750px #FFF, 711px 948px #FFF, 398px 1434px #FFF, 1708px 856px #FFF, 1236px 1240px #FFF, 616px 1284px #FFF, 1108px 1829px #FFF, 679px 1824px #FFF, 1116px 635px #FFF, 969px 1511px #FFF, 1872px 1948px #FFF, 713px 1445px #FFF, 1939px 1890px #FFF, 1233px 976px #FFF, 1574px 177px #FFF, 1754px 1434px #FFF, 1273px 785px #FFF, 599px 1152px #FFF, 982px 644px #FFF, 1570px 1997px #FFF, 409px 584px #FFF, 416px 1881px #FFF, 547px 730px #FFF, 68px 1396px #FFF, 543px 842px #FFF, 731px 441px #FFF, 1763px 530px #FFF, 1059px 1031px #FFF, 702px 278px #FFF, 336px 1230px #FFF, 313px 550px #FFF, 537px 1670px #FFF, 1889px 1088px #FFF, 565px 785px #FFF, 1402px 1682px #FFF, 937px 1061px #FFF, 1960px 1762px #FFF, 536px 1043px #FFF, 546px 494px #FFF, 974px 1178px #FFF, 1831px 1045px #FFF, 1664px 458px #FFF, 903px 1101px #FFF, 1436px 1675px #FFF, 1917px 1753px #FFF, 304px 718px #FFF, 541px 1758px #FFF, 715px 112px #FFF, 1724px 133px #FFF, 229px 207px #FFF, 876px 970px #FFF, 159px 1155px #FFF, 1219px 605px #FFF, 455px 877px #FFF, 191px 551px #FFF, 473px 434px #FFF, 1185px 1316px #FFF, 424px 963px #FFF, 45px 30px #FFF, 1404px 796px #FFF, 686px 519px #FFF, 759px 1462px #FFF, 1975px 1831px #FFF, 1801px 601px #FFF, 1346px 313px #FFF, 486px 561px #FFF, 668px 34px #FFF, 514px 826px #FFF, 1437px 383px #FFF, 1517px 1662px #FFF, 1267px 1843px #FFF, 427px 1009px #FFF, 327px 731px #FFF, 533px 1001px #FFF, 1021px 1342px #FFF, 1811px 1615px #FFF, 179px 3px #FFF, 103px 952px #FFF, 1555px 1969px #FFF, 485px 1924px #FFF, 635px 1396px #FFF, 313px 1169px #FFF, 1962px 1979px #FFF, 104px 1197px #FFF, 1952px 1259px #FFF, 501px 1679px #FFF, 1041px 1317px #FFF, 1883px 218px #FFF, 45px 1198px #FFF, 439px 1252px #FFF, 1841px 182px #FFF, 696px 658px #FFF, 1531px 487px #FFF, 1253px 90px #FFF, 109px 492px #FFF, 682px 777px #FFF, 1934px 1016px #FFF, 1853px 1488px #FFF, 879px 1102px #FFF, 446px 75px #FFF, 993px 702px #FFF, 1632px 755px #FFF, 1461px 636px #FFF, 1920px 16px #FFF, 1742px 1453px #FFF, 1091px 592px #FFF, 958px 798px #FFF, 1020px 652px #FFF, 1898px 116px #FFF, 579px 184px #FFF, 1292px 14px #FFF, 304px 1732px #FFF, 553px 1134px #FFF, 984px 508px #FFF, 110px 997px #FFF, 1685px 1687px #FFF, 697px 1390px #FFF, 1080px 950px #FFF, 1111px 1670px #FFF, 167px 1148px #FFF, 855px 305px #FFF, 813px 178px #FFF, 1189px 961px #FFF, 611px 1966px #FFF, 1469px 1892px #FFF, 622px 552px #FFF, 199px 1303px #FFF, 114px 756px #FFF, 808px 863px #FFF, 1746px 1781px #FFF, 742px 1184px #FFF, 1453px 1392px #FFF, 350px 1078px #FFF, 98px 1416px #FFF, 1159px 1718px #FFF, 1457px 1145px #FFF, 198px 170px #FFF, 1066px 1608px #FFF, 1867px 923px #FFF, 1058px 823px #FFF, 1578px 994px #FFF, 1996px 1866px #FFF, 627px 78px #FFF, 1569px 1883px #FFF, 494px 393px #FFF, 1617px 1744px #FFF, 249px 1954px #FFF, 1060px 87px #FFF, 922px 1035px #FFF, 1224px 103px #FFF, 1769px 908px #FFF, 1988px 70px #FFF, 156px 469px #FFF, 249px 553px #FFF, 1342px 1015px #FFF, 919px 877px #FFF, 429px 1720px #FFF, 33px 591px #FFF, 472px 1813px #FFF, 1739px 1561px #FFF, 1780px 804px #FFF, 1349px 996px #FFF, 1613px 1503px #FFF, 1091px 1550px #FFF, 109px 31px #FFF, 1985px 38px #FFF, 786px 1570px #FFF, 18px 952px #FFF, 505px 758px #FFF, 992px 797px #FFF, 1799px 1907px #FFF, 408px 945px #FFF, 45px 1374px #FFF, 753px 1670px #FFF, 911px 675px #FFF, 1969px 1356px #FFF, 1881px 1267px #FFF, 1290px 1997px #FFF, 1003px 577px #FFF, 1489px 209px #FFF, 708px 633px #FFF, 1454px 572px #FFF, 292px 494px #FFF, 1430px 1911px #FFF, 1353px 813px #FFF, 1542px 610px #FFF, 665px 346px #FFF, 87px 1872px #FFF, 207px 371px #FFF, 842px 1228px #FFF, 1390px 1239px #FFF, 76px 996px #FFF, 1648px 1173px #FFF, 699px 1149px #FFF, 83px 1823px #FFF, 786px 779px #FFF, 455px 712px #FFF, 548px 445px #FFF, 535px 818px #FFF, 694px 689px #FFF, 758px 1443px #FFF, 115px 1747px #FFF, 626px 190px #FFF, 1096px 1312px #FFF, 910px 1493px #FFF, 1529px 1294px #FFF, 565px 1053px #FFF, 450px 51px #FFF, 887px 1102px #FFF, 1423px 1759px #FFF, 832px 665px #FFF, 530px 155px #FFF, 1601px 1334px #FFF, 1163px 902px #FFF, 1832px 804px #FFF, 400px 1181px #FFF, 1442px 1530px #FFF, 823px 1537px #FFF, 849px 1176px #FFF, 1126px 226px #FFF, 1461px 1919px #FFF, 145px 655px #FFF, 1464px 198px #FFF, 456px 1001px #FFF, 781px 1107px #FFF, 996px 1636px #FFF, 924px 1094px #FFF, 446px 1233px #FFF, 1640px 1347px #FFF, 1758px 1877px #FFF, 285px 1818px #FFF, 543px 883px #FFF, 526px 1457px #FFF, 861px 864px #FFF, 439px 47px #FFF, 1691px 407px #FFF, 148px 61px #FFF, 809px 749px #FFF, 1211px 358px #FFF, 1056px 1323px #FFF, 1943px 869px #FFF, 924px 579px #FFF, 304px 57px #FFF, 379px 1906px #FFF, 806px 1224px #FFF, 1144px 349px #FFF, 1441px 1716px #FFF, 240px 1066px #FFF, 1706px 733px #FFF, 1724px 976px #FFF, 1871px 96px #FFF, 1230px 113px #FFF, 817px 560px #FFF, 1347px 75px #FFF, 1937px 1597px #FFF, 155px 1313px #FFF, 378px 1462px #FFF, 1492px 1535px #FFF, 1479px 275px #FFF, 1378px 1959px #FFF, 1440px 592px #FFF, 1681px 1742px #FFF, 1288px 340px #FFF, 486px 1859px #FFF, 955px 1366px #FFF, 1716px 601px #FFF, 404px 317px #FFF, 299px 1719px #FFF, 795px 1533px #FFF, 609px 681px #FFF, 1232px 1635px #FFF, 654px 215px #FFF, 672px 1739px #FFF, 1624px 1331px #FFF, 13px 1125px #FFF, 1263px 1092px #FFF, 1867px 1548px #FFF, 558px 325px #FFF, 517px 1227px #FFF, 1626px 726px #FFF, 1133px 348px #FFF, 252px 1324px #FFF, 1924px 1729px #FFF, 1782px 1374px #FFF, 482px 627px #FFF, 943px 976px #FFF, 1377px 396px #FFF, 476px 1062px #FFF, 1467px 1993px #FFF, 1751px 113px #FFF, 282px 346px #FFF, 1889px 1293px #FFF, 268px 187px #FFF, 406px 1200px #FFF, 1788px 1627px #FFF, 337px 476px #FFF, 1070px 1172px #FFF, 1428px 285px #FFF, 296px 1233px #FFF, 882px 367px #FFF, 679px 893px #FFF, 1967px 1880px #FFF, 1244px 1317px #FFF, 20px 986px #FFF, 208px 1135px #FFF, 1577px 191px #FFF, 1253px 859px #FFF, 567px 1423px #FFF, 1274px 296px #FFF, 125px 1651px #FFF, 622px 1833px #FFF, 1323px 1535px #FFF, 1606px 1160px #FFF, 1272px 1429px #FFF, 1647px 1307px #FFF, 1601px 1105px #FFF, 650px 1644px #FFF, 680px 1797px #FFF, 1109px 1924px #FFF, 1447px 1930px #FFF, 1568px 321px #FFF, 1330px 580px #FFF, 1845px 558px #FFF, 1558px 1286px #FFF, 585px 99px #FFF, 839px 1034px #FFF, 754px 1654px #FFF, 1500px 232px #FFF, 632px 1767px #FFF, 1991px 964px #FFF, 611px 12px #FFF, 1658px 657px #FFF, 1162px 305px #FFF, 1154px 1462px #FFF, 396px 461px #FFF, 1152px 943px #FFF, 1449px 1820px #FFF, 1990px 407px #FFF, 1420px 561px #FFF, 903px 624px #FFF, 1454px 69px #FFF, 1150px 744px #FFF, 883px 21px #FFF, 783px 132px #FFF, 512px 288px #FFF, 596px 88px #FFF, 349px 816px #FFF, 591px 720px #FFF, 831px 752px #FFF, 1039px 785px #FFF, 149px 1795px #FFF, 1435px 981px #FFF, 646px 554px #FFF, 786px 1988px #FFF, 870px 727px #FFF, 1779px 514px #FFF, 456px 822px #FFF, 1302px 1697px #FFF, 1443px 29px #FFF, 566px 1634px #FFF, 139px 1116px #FFF, 113px 635px #FFF, 1648px 1391px #FFF, 1622px 304px #FFF, 578px 1222px #FFF, 581px 1330px #FFF, 1253px 1974px #FFF, 1467px 369px #FFF, 1066px 631px #FFF, 128px 261px #FFF, 313px 289px #FFF, 691px 1265px #FFF, 1458px 217px #FFF, 1624px 331px #FFF, 624px 1688px #FFF, 129px 167px #FFF, 1935px 139px #FFF, 156px 368px #FFF, 1818px 631px #FFF, 1594px 1449px #FFF, 963px 857px #FFF, 1767px 86px #FFF;
            animation: animStar 50s linear infinite;
        }

        #stars:after {
            content: " ";
            position: absolute;
            top: 2000px;
            width: 2px;
            height: 2px;
            background: transparent;
            box-shadow: 309px 853px #FFF, 1697px 1383px #FFF, 1751px 1860px #FFF, 1003px 89px #FFF, 604px 781px #FFF, 1400px 924px #FFF, 777px 1194px #FFF, 91px 1421px #FFF, 712px 1819px #FFF, 982px 1308px #FFF, 846px 163px #FFF, 899px 519px #FFF, 356px 1089px #FFF, 1642px 1256px #FFF, 264px 1730px #FFF, 1026px 366px #FFF, 1250px 672px #FFF, 1998px 1749px #FFF, 1237px 1572px #FFF, 1688px 247px #FFF, 948px 637px #FFF, 149px 805px #FFF, 306px 696px #FFF, 1688px 263px #FFF, 649px 698px #FFF, 1860px 1741px #FFF, 1553px 384px #FFF, 719px 972px #FFF, 1346px 1702px #FFF, 1958px 1119px #FFF, 1549px 1740px #FFF, 1772px 1432px #FFF, 254px 113px #FFF, 837px 1876px #FFF, 1658px 21px #FFF, 413px 1283px #FFF, 955px 1392px #FFF, 1293px 678px #FFF, 841px 156px #FFF, 201px 737px #FFF, 988px 376px #FFF, 942px 439px #FFF, 1068px 871px #FFF, 1818px 598px #FFF, 1662px 916px #FFF, 349px 691px #FFF, 350px 1599px #FFF, 833px 1802px #FFF, 1914px 1834px #FFF, 1881px 745px #FFF, 1373px 958px #FFF, 509px 1848px #FFF, 1771px 119px #FFF, 818px 277px #FFF, 385px 1433px #FFF, 1495px 567px #FFF, 1754px 1741px #FFF, 1801px 1706px #FFF, 501px 1650px #FFF, 1588px 806px #FFF, 505px 608px #FFF, 1056px 776px #FFF, 118px 1758px #FFF, 1249px 1947px #FFF, 523px 1655px #FFF, 128px 369px #FFF, 848px 1046px #FFF, 1757px 1598px #FFF, 1192px 828px #FFF, 1616px 351px #FFF, 16px 241px #FFF, 601px 825px #FFF, 1227px 85px #FFF, 1173px 1444px #FFF, 216px 469px #FFF, 1715px 1370px #FFF, 312px 589px #FFF, 1678px 1699px #FFF, 1269px 789px #FFF, 1076px 1191px #FFF, 1067px 6px #FFF, 930px 42px #FFF, 189px 1629px #FFF, 1264px 1065px #FFF, 1234px 1493px #FFF, 602px 189px #FFF, 328px 1782px #FFF, 1743px 105px #FFF, 1980px 881px #FFF, 511px 1767px #FFF, 1121px 614px #FFF, 1558px 1088px #FFF, 384px 686px #FFF, 1558px 1113px #FFF, 1517px 1141px #FFF, 236px 523px #FFF, 173px 1068px #FFF, 1062px 1593px #FFF, 1329px 1459px #FFF, 865px 1686px #FFF, 1035px 1217px #FFF, 1348px 932px #FFF, 1339px 1944px #FFF, 414px 1847px #FFF, 1938px 1630px #FFF, 1424px 342px #FFF, 1853px 1405px #FFF, 1178px 1481px #FFF, 1261px 1234px #FFF, 255px 1035px #FFF, 1766px 1806px #FFF, 429px 983px #FFF, 59px 1133px #FFF, 1347px 831px #FFF, 1831px 1801px #FFF, 1007px 254px #FFF, 1507px 701px #FFF, 723px 1796px #FFF, 1891px 1901px #FFF, 735px 99px #FFF, 1981px 1593px #FFF, 743px 74px #FFF, 1470px 860px #FFF, 429px 994px #FFF, 687px 50px #FFF, 668px 368px #FFF, 927px 101px #FFF, 981px 23px #FFF, 853px 650px #FFF, 544px 305px #FFF, 1967px 362px #FFF, 947px 1254px #FFF, 1765px 652px #FFF, 1068px 491px #FFF, 936px 595px #FFF, 881px 462px #FFF, 1814px 63px #FFF, 1988px 692px #FFF, 1388px 916px #FFF, 1958px 759px #FFF, 1887px 652px #FFF, 745px 913px #FFF, 1640px 283px #FFF, 1132px 1550px #FFF, 1312px 229px #FFF, 400px 754px #FFF, 14px 719px #FFF, 426px 425px #FFF, 1741px 149px #FFF, 1051px 216px #FFF, 1253px 52px #FFF, 173px 1046px #FFF, 1348px 1309px #FFF, 1541px 516px #FFF, 1105px 108px #FFF, 65px 1604px #FFF, 1923px 1200px #FFF, 1571px 1281px #FFF, 93px 1425px #FFF, 1761px 918px #FFF, 525px 80px #FFF, 998px 1982px #FFF, 230px 917px #FFF, 1269px 1585px #FFF, 1769px 1806px #FFF, 1102px 795px #FFF, 169px 1459px #FFF, 1859px 56px #FFF, 948px 168px #FFF, 1660px 1860px #FFF, 96px 777px #FFF, 352px 1930px #FFF, 1158px 1926px #FFF, 1716px 1166px #FFF, 285px 399px #FFF, 1820px 687px #FFF, 954px 396px #FFF, 534px 358px #FFF, 979px 1128px #FFF, 1047px 1331px #FFF, 1756px 1918px #FFF, 1542px 242px #FFF, 1982px 1547px #FFF, 1456px 262px #FFF, 1081px 636px #FFF, 597px 1903px #FFF, 1035px 1044px #FFF, 765px 956px #FFF, 1255px 97px #FFF, 646px 1085px #FFF, 1140px 1061px #FFF, 270px 1476px #FFF, 1390px 1214px #FFF, 169px 795px #FFF, 696px 1326px #FFF, 1595px 1582px #FFF, 911px 249px #FFF, 1951px 1112px #FFF, 636px 1724px #FFF, 1014px 1593px #FFF, 1134px 378px #FFF, 312px 862px #FFF, 1980px 1550px #FFF, 909px 114px #FFF, 1193px 355px #FFF, 723px 1931px #FFF, 676px 31px #FFF, 1740px 964px #FFF, 1852px 1395px #FFF, 1198px 590px #FFF, 1291px 1625px #FFF, 374px 666px #FFF, 4px 350px #FFF, 1424px 413px #FFF, 1745px 1717px #FFF, 1818px 114px #FFF, 1888px 1546px #FFF, 859px 1333px #FFF, 258px 1532px #FFF, 130px 945px #FFF, 1321px 191px #FFF, 409px 410px #FFF, 1532px 980px #FFF, 1183px 147px #FFF, 1508px 646px #FFF, 1427px 816px #FFF, 279px 941px #FFF, 1075px 352px #FFF, 1296px 1854px #FFF, 469px 773px #FFF, 980px 1785px #FFF, 613px 1128px #FFF, 1663px 1880px #FFF, 999px 1635px #FFF, 546px 1813px #FFF, 131px 557px #FFF, 50px 869px #FFF, 1571px 1354px #FFF, 278px 345px #FFF, 1086px 1776px #FFF, 1873px 537px #FFF, 1128px 979px #FFF, 320px 278px #FFF, 1828px 416px #FFF, 181px 250px #FFF, 678px 1569px #FFF, 578px 1247px #FFF, 1624px 1629px #FFF, 1323px 279px #FFF, 337px 1495px #FFF, 555px 919px #FFF, 878px 371px #FFF, 103px 1356px #FFF, 1162px 1061px #FFF, 1105px 451px #FFF, 1763px 1784px #FFF, 427px 800px #FFF, 587px 643px #FFF, 641px 1222px #FFF, 262px 254px #FFF, 1066px 899px #FFF, 1921px 302px #FFF, 796px 1460px #FFF, 615px 1670px #FFF, 1901px 148px #FFF, 509px 1541px #FFF, 1724px 914px #FFF, 855px 1470px #FFF, 1324px 1376px #FFF, 632px 520px #FFF, 809px 1842px #FFF, 1177px 1647px #FFF, 1371px 199px #FFF, 366px 421px #FFF, 1502px 1037px #FFF, 1971px 1657px #FFF, 131px 890px #FFF, 1231px 786px #FFF, 1759px 1126px #FFF, 604px 311px #FFF, 575px 1748px #FFF, 42px 1668px #FFF, 107px 417px #FFF, 1885px 442px #FFF, 1056px 719px #FFF, 154px 908px #FFF, 136px 284px #FFF, 330px 1691px #FFF, 568px 139px #FFF, 762px 774px #FFF, 1509px 888px #FFF, 316px 1610px #FFF, 1911px 1408px #FFF, 1186px 903px #FFF, 827px 296px #FFF, 1025px 791px #FFF, 391px 1772px #FFF, 153px 496px #FFF, 1390px 1266px #FFF, 561px 1870px #FFF, 546px 1781px #FFF, 1477px 1492px #FFF, 1461px 610px #FFF, 101px 877px #FFF, 474px 315px #FFF, 1507px 1822px #FFF, 580px 125px #FFF, 1379px 1271px #FFF, 1595px 105px #FFF, 833px 1161px #FFF, 1907px 1797px #FFF, 600px 77px #FFF, 1518px 1037px #FFF, 564px 382px #FFF, 1729px 213px #FFF, 187px 562px #FFF, 1563px 1794px #FFF, 1668px 630px #FFF, 1873px 1750px #FFF, 711px 948px #FFF, 398px 1434px #FFF, 1708px 856px #FFF, 1236px 1240px #FFF, 616px 1284px #FFF, 1108px 1829px #FFF, 679px 1824px #FFF, 1116px 635px #FFF, 969px 1511px #FFF, 1872px 1948px #FFF, 713px 1445px #FFF, 1939px 1890px #FFF, 1233px 976px #FFF, 1574px 177px #FFF, 1754px 1434px #FFF, 1273px 785px #FFF, 599px 1152px #FFF, 982px 644px #FFF, 1570px 1997px #FFF, 409px 584px #FFF, 416px 1881px #FFF, 547px 730px #FFF, 68px 1396px #FFF, 543px 842px #FFF, 731px 441px #FFF, 1763px 530px #FFF, 1059px 1031px #FFF, 702px 278px #FFF, 336px 1230px #FFF, 313px 550px #FFF, 537px 1670px #FFF, 1889px 1088px #FFF, 565px 785px #FFF, 1402px 1682px #FFF, 937px 1061px #FFF, 1960px 1762px #FFF, 536px 1043px #FFF, 546px 494px #FFF, 974px 1178px #FFF, 1831px 1045px #FFF, 1664px 458px #FFF, 903px 1101px #FFF, 1436px 1675px #FFF, 1917px 1753px #FFF, 304px 718px #FFF, 541px 1758px #FFF, 715px 112px #FFF, 1724px 133px #FFF, 229px 207px #FFF, 876px 970px #FFF, 159px 1155px #FFF, 1219px 605px #FFF, 455px 877px #FFF, 191px 551px #FFF, 473px 434px #FFF, 1185px 1316px #FFF, 424px 963px #FFF, 45px 30px #FFF, 1404px 796px #FFF, 686px 519px #FFF, 759px 1462px #FFF, 1975px 1831px #FFF, 1801px 601px #FFF, 1346px 313px #FFF, 486px 561px #FFF, 668px 34px #FFF, 514px 826px #FFF, 1437px 383px #FFF, 1517px 1662px #FFF, 1267px 1843px #FFF, 427px 1009px #FFF, 327px 731px #FFF, 533px 1001px #FFF, 1021px 1342px #FFF, 1811px 1615px #FFF, 179px 3px #FFF, 103px 952px #FFF, 1555px 1969px #FFF, 485px 1924px #FFF, 635px 1396px #FFF, 313px 1169px #FFF, 1962px 1979px #FFF, 104px 1197px #FFF, 1952px 1259px #FFF, 501px 1679px #FFF, 1041px 1317px #FFF, 1883px 218px #FFF, 45px 1198px #FFF, 439px 1252px #FFF, 1841px 182px #FFF, 696px 658px #FFF, 1531px 487px #FFF, 1253px 90px #FFF, 109px 492px #FFF, 682px 777px #FFF, 1934px 1016px #FFF, 1853px 1488px #FFF, 879px 1102px #FFF, 446px 75px #FFF, 993px 702px #FFF, 1632px 755px #FFF, 1461px 636px #FFF, 1920px 16px #FFF, 1742px 1453px #FFF, 1091px 592px #FFF, 958px 798px #FFF, 1020px 652px #FFF, 1898px 116px #FFF, 579px 184px #FFF, 1292px 14px #FFF, 304px 1732px #FFF, 553px 1134px #FFF, 984px 508px #FFF, 110px 997px #FFF, 1685px 1687px #FFF, 697px 1390px #FFF, 1080px 950px #FFF, 1111px 1670px #FFF, 167px 1148px #FFF, 855px 305px #FFF, 813px 178px #FFF, 1189px 961px #FFF, 611px 1966px #FFF, 1469px 1892px #FFF, 622px 552px #FFF, 199px 1303px #FFF, 114px 756px #FFF, 808px 863px #FFF, 1746px 1781px #FFF, 742px 1184px #FFF, 1453px 1392px #FFF, 350px 1078px #FFF, 98px 1416px #FFF, 1159px 1718px #FFF, 1457px 1145px #FFF, 198px 170px #FFF, 1066px 1608px #FFF, 1867px 923px #FFF, 1058px 823px #FFF, 1578px 994px #FFF, 1996px 1866px #FFF, 627px 78px #FFF, 1569px 1883px #FFF, 494px 393px #FFF, 1617px 1744px #FFF, 249px 1954px #FFF, 1060px 87px #FFF, 922px 1035px #FFF, 1224px 103px #FFF, 1769px 908px #FFF, 1988px 70px #FFF, 156px 469px #FFF, 249px 553px #FFF, 1342px 1015px #FFF, 919px 877px #FFF, 429px 1720px #FFF, 33px 591px #FFF, 472px 1813px #FFF, 1739px 1561px #FFF, 1780px 804px #FFF, 1349px 996px #FFF, 1613px 1503px #FFF, 1091px 1550px #FFF, 109px 31px #FFF, 1985px 38px #FFF, 786px 1570px #FFF, 18px 952px #FFF, 505px 758px #FFF, 992px 797px #FFF, 1799px 1907px #FFF, 408px 945px #FFF, 45px 1374px #FFF, 753px 1670px #FFF, 911px 675px #FFF, 1969px 1356px #FFF, 1881px 1267px #FFF, 1290px 1997px #FFF, 1003px 577px #FFF, 1489px 209px #FFF, 708px 633px #FFF, 1454px 572px #FFF, 292px 494px #FFF, 1430px 1911px #FFF, 1353px 813px #FFF, 1542px 610px #FFF, 665px 346px #FFF, 87px 1872px #FFF, 207px 371px #FFF, 842px 1228px #FFF, 1390px 1239px #FFF, 76px 996px #FFF, 1648px 1173px #FFF, 699px 1149px #FFF, 83px 1823px #FFF, 786px 779px #FFF, 455px 712px #FFF, 548px 445px #FFF, 535px 818px #FFF, 694px 689px #FFF, 758px 1443px #FFF, 115px 1747px #FFF, 626px 190px #FFF, 1096px 1312px #FFF, 910px 1493px #FFF, 1529px 1294px #FFF, 565px 1053px #FFF, 450px 51px #FFF, 887px 1102px #FFF, 1423px 1759px #FFF, 832px 665px #FFF, 530px 155px #FFF, 1601px 1334px #FFF, 1163px 902px #FFF, 1832px 804px #FFF, 400px 1181px #FFF, 1442px 1530px #FFF, 823px 1537px #FFF, 849px 1176px #FFF, 1126px 226px #FFF, 1461px 1919px #FFF, 145px 655px #FFF, 1464px 198px #FFF, 456px 1001px #FFF, 781px 1107px #FFF, 996px 1636px #FFF, 924px 1094px #FFF, 446px 1233px #FFF, 1640px 1347px #FFF, 1758px 1877px #FFF, 285px 1818px #FFF, 543px 883px #FFF, 526px 1457px #FFF, 861px 864px #FFF, 439px 47px #FFF, 1691px 407px #FFF, 148px 61px #FFF, 809px 749px #FFF, 1211px 358px #FFF, 1056px 1323px #FFF, 1943px 869px #FFF, 924px 579px #FFF, 304px 57px #FFF, 379px 1906px #FFF, 806px 1224px #FFF, 1144px 349px #FFF, 1441px 1716px #FFF, 240px 1066px #FFF, 1706px 733px #FFF, 1724px 976px #FFF, 1871px 96px #FFF, 1230px 113px #FFF, 817px 560px #FFF, 1347px 75px #FFF, 1937px 1597px #FFF, 155px 1313px #FFF, 378px 1462px #FFF, 1492px 1535px #FFF, 1479px 275px #FFF, 1378px 1959px #FFF, 1440px 592px #FFF, 1681px 1742px #FFF, 1288px 340px #FFF, 486px 1859px #FFF, 955px 1366px #FFF, 1716px 601px #FFF, 404px 317px #FFF, 299px 1719px #FFF, 795px 1533px #FFF, 609px 681px #FFF, 1232px 1635px #FFF, 654px 215px #FFF, 672px 1739px #FFF, 1624px 1331px #FFF, 13px 1125px #FFF, 1263px 1092px #FFF, 1867px 1548px #FFF, 558px 325px #FFF, 517px 1227px #FFF, 1626px 726px #FFF, 1133px 348px #FFF, 252px 1324px #FFF, 1924px 1729px #FFF, 1782px 1374px #FFF, 482px 627px #FFF, 943px 976px #FFF, 1377px 396px #FFF, 476px 1062px #FFF, 1467px 1993px #FFF, 1751px 113px #FFF, 282px 346px #FFF, 1889px 1293px #FFF, 268px 187px #FFF, 406px 1200px #FFF, 1788px 1627px #FFF, 337px 476px #FFF, 1070px 1172px #FFF, 1428px 285px #FFF, 296px 1233px #FFF, 882px 367px #FFF, 679px 893px #FFF, 1967px 1880px #FFF, 1244px 1317px #FFF, 20px 986px #FFF, 208px 1135px #FFF, 1577px 191px #FFF, 1253px 859px #FFF, 567px 1423px #FFF, 1274px 296px #FFF, 125px 1651px #FFF, 622px 1833px #FFF, 1323px 1535px #FFF, 1606px 1160px #FFF, 1272px 1429px #FFF, 1647px 1307px #FFF, 1601px 1105px #FFF, 650px 1644px #FFF, 680px 1797px #FFF, 1109px 1924px #FFF, 1447px 1930px #FFF, 1568px 321px #FFF, 1330px 580px #FFF, 1845px 558px #FFF, 1558px 1286px #FFF, 585px 99px #FFF, 839px 1034px #FFF, 754px 1654px #FFF, 1500px 232px #FFF, 632px 1767px #FFF, 1991px 964px #FFF, 611px 12px #FFF, 1658px 657px #FFF, 1162px 305px #FFF, 1154px 1462px #FFF, 396px 461px #FFF, 1152px 943px #FFF, 1449px 1820px #FFF, 1990px 407px #FFF, 1420px 561px #FFF, 903px 624px #FFF, 1454px 69px #FFF, 1150px 744px #FFF, 883px 21px #FFF, 783px 132px #FFF, 512px 288px #FFF, 596px 88px #FFF, 349px 816px #FFF, 591px 720px #FFF, 831px 752px #FFF, 1039px 785px #FFF, 149px 1795px #FFF, 1435px 981px #FFF, 646px 554px #FFF, 786px 1988px #FFF, 870px 727px #FFF, 1779px 514px #FFF, 456px 822px #FFF, 1302px 1697px #FFF, 1443px 29px #FFF, 566px 1634px #FFF, 139px 1116px #FFF, 113px 635px #FFF, 1648px 1391px #FFF, 1622px 304px #FFF, 578px 1222px #FFF, 581px 1330px #FFF, 1253px 1974px #FFF, 1467px 369px #FFF, 1066px 631px #FFF, 128px 261px #FFF, 313px 289px #FFF, 691px 1265px #FFF, 1458px 217px #FFF, 1624px 331px #FFF, 624px 1688px #FFF, 129px 167px #FFF, 1935px 139px #FFF, 156px 368px #FFF, 1818px 631px #FFF, 1594px 1449px #FFF, 963px 857px #FFF, 1767px 86px #FFF;
        }

        #stars2 {
            width: 2px;
            height: 2px;
            background: transparent;
            box-shadow: 1744px 1197px #FFF, 1950px 392px #FFF, 527px 1258px #FFF, 413px 395px #FFF, 322px 418px #FFF, 974px 1599px #FFF, 800px 987px #FFF, 1557px 959px #FFF, 896px 997px #FFF, 1839px 220px #FFF, 1734px 1189px #FFF, 496px 840px #FFF, 973px 1549px #FFF, 1554px 990px #FFF, 24px 621px #FFF, 1960px 1752px #FFF, 472px 408px #FFF, 774px 920px #FFF, 853px 207px #FFF, 164px 1159px #FFF, 1150px 19px #FFF, 1837px 50px #FFF, 1472px 445px #FFF, 921px 487px #FFF, 1170px 1749px #FFF, 554px 8px #FFF, 538px 1587px #FFF, 1046px 1711px #FFF, 1962px 485px #FFF, 1119px 1155px #FFF, 949px 1288px #FFF, 1480px 1564px #FFF, 107px 693px #FFF, 38px 428px #FFF, 1337px 1557px #FFF, 1309px 1835px #FFF, 1313px 1971px #FFF, 837px 425px #FFF, 1550px 1236px #FFF, 1496px 379px #FFF, 922px 951px #FFF, 1945px 1764px #FFF, 937px 1206px #FFF, 820px 646px #FFF, 1200px 1068px #FFF, 51px 857px #FFF, 695px 1753px #FFF, 415px 1424px #FFF, 1391px 1129px #FFF, 165px 368px #FFF, 401px 1756px #FFF, 981px 101px #FFF, 409px 846px #FFF, 160px 156px #FFF, 369px 1559px #FFF, 247px 717px #FFF, 200px 224px #FFF, 1682px 1199px #FFF, 230px 1099px #FFF, 1529px 1097px #FFF, 1456px 1537px #FFF, 678px 216px #FFF, 1015px 560px #FFF, 1832px 90px #FFF, 1768px 1445px #FFF, 1049px 1899px #FFF, 667px 1867px #FFF, 46px 591px #FFF, 1887px 651px #FFF, 1378px 33px #FFF, 1660px 26px #FFF, 141px 1429px #FFF, 678px 1808px #FFF, 757px 1051px #FFF, 1135px 800px #FFF, 233px 587px #FFF, 1724px 325px #FFF, 820px 294px #FFF, 1400px 668px #FFF, 772px 596px #FFF, 1411px 842px #FFF, 580px 1547px #FFF, 1470px 1487px #FFF, 1664px 1297px #FFF, 976px 1871px #FFF, 124px 285px #FFF, 1011px 1346px #FFF, 150px 298px #FFF, 344px 1956px #FFF, 197px 1036px #FFF, 240px 708px #FFF, 1035px 848px #FFF, 195px 1800px #FFF, 1860px 1703px #FFF, 809px 1770px #FFF, 1866px 825px #FFF, 1013px 750px #FFF, 953px 1167px #FFF, 515px 456px #FFF, 1908px 1086px #FFF, 345px 230px #FFF, 1988px 842px #FFF, 909px 1236px #FFF, 1219px 783px #FFF, 104px 1524px #FFF, 1321px 151px #FFF, 216px 890px #FFF, 961px 178px #FFF, 1745px 275px #FFF, 1771px 1013px #FFF, 1391px 599px #FFF, 282px 1720px #FFF, 60px 1096px #FFF, 1179px 1259px #FFF, 178px 1213px #FFF, 346px 719px #FFF, 751px 1609px #FFF, 301px 591px #FFF, 799px 1564px #FFF, 142px 377px #FFF, 1227px 1667px #FFF, 1968px 1590px #FFF, 803px 1327px #FFF, 1358px 364px #FFF, 506px 1896px #FFF, 1374px 526px #FFF, 1792px 311px #FFF, 1672px 453px #FFF, 1654px 610px #FFF, 593px 1107px #FFF, 1713px 850px #FFF, 940px 1472px #FFF, 987px 1124px #FFF, 1630px 1563px #FFF, 1050px 1796px #FFF, 527px 882px #FFF, 209px 1247px #FFF, 1112px 189px #FFF, 569px 347px #FFF, 1288px 466px #FFF, 950px 1936px #FFF, 1255px 1932px #FFF, 972px 1402px #FFF, 1274px 1193px #FFF, 847px 883px #FFF, 649px 1669px #FFF, 944px 719px #FFF, 848px 1950px #FFF, 777px 1400px #FFF, 1111px 794px #FFF, 1327px 927px #FFF, 728px 228px #FFF, 73px 888px #FFF, 1092px 1444px #FFF, 1335px 753px #FFF, 546px 1555px #FFF, 1011px 467px #FFF, 1182px 209px #FFF, 151px 716px #FFF, 1544px 370px #FFF, 1287px 1519px #FFF, 435px 1025px #FFF, 586px 1906px #FFF, 1298px 524px #FFF, 436px 932px #FFF, 1660px 1699px #FFF, 960px 12px #FFF, 784px 1407px #FFF, 1483px 1668px #FFF, 1529px 284px #FFF, 980px 901px #FFF, 837px 1107px #FFF, 2000px 374px #FFF, 28px 557px #FFF, 45px 420px #FFF, 889px 738px #FFF, 1504px 1718px #FFF, 174px 561px #FFF, 1085px 1208px #FFF, 1602px 514px #FFF, 645px 159px #FFF, 957px 10px #FFF, 1622px 1036px #FFF, 1108px 1888px #FFF, 1568px 1923px #FFF, 75px 916px #FFF, 448px 1520px #FFF, 538px 1595px #FFF, 1714px 332px #FFF, 1321px 99px #FFF, 310px 1230px #FFF, 18px 331px #FFF, 652px 1249px #FFF, 206px 1007px #FFF, 450px 1226px #FFF, 392px 1777px #FFF, 27px 1375px #FFF, 901px 1005px #FFF, 1571px 702px #FFF, 1122px 1603px #FFF;
            animation: animStar 100s linear infinite;
        }

        #stars2:after {
            content: " ";
            position: absolute;
            top: 2000px;
            width: 2px;
            height: 2px;
            background: transparent;
            box-shadow: 1744px 1197px #FFF, 1950px 392px #FFF, 527px 1258px #FFF, 413px 395px #FFF, 322px 418px #FFF, 974px 1599px #FFF, 800px 987px #FFF, 1557px 959px #FFF, 896px 997px #FFF, 1839px 220px #FFF, 1734px 1189px #FFF, 496px 840px #FFF, 973px 1549px #FFF, 1554px 990px #FFF, 24px 621px #FFF, 1960px 1752px #FFF, 472px 408px #FFF, 774px 920px #FFF, 853px 207px #FFF, 164px 1159px #FFF, 1150px 19px #FFF, 1837px 50px #FFF, 1472px 445px #FFF, 921px 487px #FFF, 1170px 1749px #FFF, 554px 8px #FFF, 538px 1587px #FFF, 1046px 1711px #FFF, 1962px 485px #FFF, 1119px 1155px #FFF, 949px 1288px #FFF, 1480px 1564px #FFF, 107px 693px #FFF, 38px 428px #FFF, 1337px 1557px #FFF, 1309px 1835px #FFF, 1313px 1971px #FFF, 837px 425px #FFF, 1550px 1236px #FFF, 1496px 379px #FFF, 922px 951px #FFF, 1945px 1764px #FFF, 937px 1206px #FFF, 820px 646px #FFF, 1200px 1068px #FFF, 51px 857px #FFF, 695px 1753px #FFF, 415px 1424px #FFF, 1391px 1129px #FFF, 165px 368px #FFF, 401px 1756px #FFF, 981px 101px #FFF, 409px 846px #FFF, 160px 156px #FFF, 369px 1559px #FFF, 247px 717px #FFF, 200px 224px #FFF, 1682px 1199px #FFF, 230px 1099px #FFF, 1529px 1097px #FFF, 1456px 1537px #FFF, 678px 216px #FFF, 1015px 560px #FFF, 1832px 90px #FFF, 1768px 1445px #FFF, 1049px 1899px #FFF, 667px 1867px #FFF, 46px 591px #FFF, 1887px 651px #FFF, 1378px 33px #FFF, 1660px 26px #FFF, 141px 1429px #FFF, 678px 1808px #FFF, 757px 1051px #FFF, 1135px 800px #FFF, 233px 587px #FFF, 1724px 325px #FFF, 820px 294px #FFF, 1400px 668px #FFF, 772px 596px #FFF, 1411px 842px #FFF, 580px 1547px #FFF, 1470px 1487px #FFF, 1664px 1297px #FFF, 976px 1871px #FFF, 124px 285px #FFF, 1011px 1346px #FFF, 150px 298px #FFF, 344px 1956px #FFF, 197px 1036px #FFF, 240px 708px #FFF, 1035px 848px #FFF, 195px 1800px #FFF, 1860px 1703px #FFF, 809px 1770px #FFF, 1866px 825px #FFF, 1013px 750px #FFF, 953px 1167px #FFF, 515px 456px #FFF, 1908px 1086px #FFF, 345px 230px #FFF, 1988px 842px #FFF, 909px 1236px #FFF, 1219px 783px #FFF, 104px 1524px #FFF, 1321px 151px #FFF, 216px 890px #FFF, 961px 178px #FFF, 1745px 275px #FFF, 1771px 1013px #FFF, 1391px 599px #FFF, 282px 1720px #FFF, 60px 1096px #FFF, 1179px 1259px #FFF, 178px 1213px #FFF, 346px 719px #FFF, 751px 1609px #FFF, 301px 591px #FFF, 799px 1564px #FFF, 142px 377px #FFF, 1227px 1667px #FFF, 1968px 1590px #FFF, 803px 1327px #FFF, 1358px 364px #FFF, 506px 1896px #FFF, 1374px 526px #FFF, 1792px 311px #FFF, 1672px 453px #FFF, 1654px 610px #FFF, 593px 1107px #FFF, 1713px 850px #FFF, 940px 1472px #FFF, 987px 1124px #FFF, 1630px 1563px #FFF, 1050px 1796px #FFF, 527px 882px #FFF, 209px 1247px #FFF, 1112px 189px #FFF, 569px 347px #FFF, 1288px 466px #FFF, 950px 1936px #FFF, 1255px 1932px #FFF, 972px 1402px #FFF, 1274px 1193px #FFF, 847px 883px #FFF, 649px 1669px #FFF, 944px 719px #FFF, 848px 1950px #FFF, 777px 1400px #FFF, 1111px 794px #FFF, 1327px 927px #FFF, 728px 228px #FFF, 73px 888px #FFF, 1092px 1444px #FFF, 1335px 753px #FFF, 546px 1555px #FFF, 1011px 467px #FFF, 1182px 209px #FFF, 151px 716px #FFF, 1544px 370px #FFF, 1287px 1519px #FFF, 435px 1025px #FFF, 586px 1906px #FFF, 1298px 524px #FFF, 436px 932px #FFF, 1660px 1699px #FFF, 960px 12px #FFF, 784px 1407px #FFF, 1483px 1668px #FFF, 1529px 284px #FFF, 980px 901px #FFF, 837px 1107px #FFF, 2000px 374px #FFF, 28px 557px #FFF, 45px 420px #FFF, 889px 738px #FFF, 1504px 1718px #FFF, 174px 561px #FFF, 1085px 1208px #FFF, 1602px 514px #FFF, 645px 159px #FFF, 957px 10px #FFF, 1622px 1036px #FFF, 1108px 1888px #FFF, 1568px 1923px #FFF, 75px 916px #FFF, 448px 1520px #FFF, 538px 1595px #FFF, 1714px 332px #FFF, 1321px 99px #FFF, 310px 1230px #FFF, 18px 331px #FFF, 652px 1249px #FFF, 206px 1007px #FFF, 450px 1226px #FFF, 392px 1777px #FFF, 27px 1375px #FFF, 901px 1005px #FFF, 1571px 702px #FFF, 1122px 1603px #FFF;
        }

        #stars3 {
            width: 3px;
            height: 3px;
            background: transparent;
            box-shadow: 470px 1564px #FFF, 724px 705px #FFF, 256px 1222px #FFF, 979px 819px #FFF, 477px 1222px #FFF, 1893px 1724px #FFF, 1793px 1955px #FFF, 809px 1886px #FFF, 984px 1739px #FFF, 176px 1279px #FFF, 1758px 1749px #FFF, 1844px 374px #FFF, 565px 518px #FFF, 1104px 529px #FFF, 1796px 198px #FFF, 1918px 595px #FFF, 1736px 1972px #FFF, 228px 1210px #FFF, 656px 1484px #FFF, 163px 184px #FFF, 548px 239px #FFF, 1808px 1725px #FFF, 832px 1367px #FFF, 228px 768px #FFF, 1889px 909px #FFF, 893px 654px #FFF, 1561px 1938px #FFF, 1507px 329px #FFF, 1933px 1091px #FFF, 660px 600px #FFF, 284px 66px #FFF, 330px 1741px #FFF, 688px 653px #FFF, 1490px 114px #FFF, 266px 1042px #FFF, 425px 1618px #FFF, 1668px 175px #FFF, 1528px 1943px #FFF, 805px 165px #FFF, 1395px 528px #FFF, 10px 540px #FFF, 731px 557px #FFF, 55px 336px #FFF, 352px 122px #FFF, 1576px 1835px #FFF, 728px 1105px #FFF, 1859px 1340px #FFF, 21px 622px #FFF, 1894px 1379px #FFF, 1207px 1748px #FFF, 916px 817px #FFF, 1092px 1291px #FFF, 1090px 498px #FFF, 250px 9px #FFF, 1590px 532px #FFF, 68px 1813px #FFF, 947px 1230px #FFF, 1705px 810px #FFF, 1022px 152px #FFF, 559px 1810px #FFF, 1212px 2px #FFF, 1652px 489px #FFF, 1827px 526px #FFF, 1729px 1212px #FFF, 1357px 37px #FFF, 1559px 161px #FFF, 1014px 343px #FFF, 183px 966px #FFF, 1158px 1198px #FFF, 1719px 329px #FFF, 1586px 856px #FFF, 304px 1069px #FFF, 1319px 10px #FFF, 874px 1337px #FFF, 796px 1438px #FFF, 1314px 1598px #FFF, 858px 959px #FFF, 1943px 1202px #FFF, 1247px 548px #FFF, 331px 1433px #FFF, 1492px 1608px #FFF, 916px 1660px #FFF, 1459px 345px #FFF, 935px 1436px #FFF, 913px 1220px #FFF, 1938px 899px #FFF, 877px 362px #FFF, 793px 500px #FFF, 918px 1922px #FFF, 1448px 1489px #FFF, 1862px 1041px #FFF, 1306px 197px #FFF, 1064px 521px #FFF, 46px 740px #FFF, 251px 1404px #FFF, 1902px 1395px #FFF, 492px 1082px #FFF, 394px 365px #FFF, 77px 1588px #FFF, 633px 263px #FFF;
            animation: animStar 110s linear infinite;
        }

        #stars3:after {
            content: " ";
            position: absolute;
            top: 2000px;
            width: 3px;
            height: 3px;
            background: transparent;
            box-shadow: 470px 564px #FFF, 724px 705px #FFF, 256px 1222px #FFF, 979px 819px #FFF, 477px 1222px #FFF, 1893px 1724px #FFF, 1793px 1955px #FFF, 809px 1886px #FFF, 984px 1739px #FFF, 176px 1279px #FFF, 1758px 1749px #FFF, 1844px 374px #FFF, 565px 518px #FFF, 1104px 529px #FFF, 1796px 198px #FFF, 1918px 595px #FFF, 1736px 1972px #FFF, 228px 1210px #FFF, 656px 1484px #FFF, 163px 184px #FFF, 548px 239px #FFF, 1808px 1725px #FFF, 832px 1367px #FFF, 228px 768px #FFF, 1889px 909px #FFF, 893px 654px #FFF, 1561px 1938px #FFF, 1507px 329px #FFF, 1933px 1091px #FFF, 660px 600px #FFF, 284px 66px #FFF, 330px 1741px #FFF, 688px 653px #FFF, 1490px 114px #FFF, 266px 1042px #FFF, 425px 1618px #FFF, 1668px 175px #FFF, 1528px 1943px #FFF, 805px 165px #FFF, 1395px 528px #FFF, 10px 540px #FFF, 731px 557px #FFF, 55px 336px #FFF, 352px 122px #FFF, 1576px 1835px #FFF, 728px 1105px #FFF, 1859px 1340px #FFF, 21px 622px #FFF, 1894px 1379px #FFF, 1207px 1748px #FFF, 916px 817px #FFF, 1092px 1291px #FFF, 1090px 498px #FFF, 250px 9px #FFF, 1590px 532px #FFF, 68px 1813px #FFF, 947px 1230px #FFF, 1705px 810px #FFF, 1022px 152px #FFF, 559px 1810px #FFF, 1212px 2px #FFF, 1652px 489px #FFF, 1827px 526px #FFF, 1729px 1212px #FFF, 1357px 37px #FFF, 1559px 161px #FFF, 1014px 343px #FFF, 183px 966px #FFF, 1158px 1198px #FFF, 1719px 329px #FFF, 1586px 856px #FFF, 304px 1069px #FFF, 1319px 10px #FFF, 874px 1337px #FFF, 796px 1438px #FFF, 1314px 1598px #FFF, 858px 959px #FFF, 1943px 1202px #FFF, 1247px 548px #FFF, 331px 1433px #FFF, 1492px 1608px #FFF, 916px 1660px #FFF, 1459px 345px #FFF, 935px 1436px #FFF, 913px 1220px #FFF, 1938px 899px #FFF, 877px 362px #FFF, 793px 500px #FFF, 918px 1922px #FFF, 1448px 1489px #FFF, 1862px 1041px #FFF, 1306px 197px #FFF, 1064px 521px #FFF, 46px 740px #FFF, 251px 1404px #FFF, 1902px 1395px #FFF, 492px 1082px #FFF, 394px 365px #FFF, 77px 1588px #FFF, 633px 263px #FFF;
        }

        @-webkit-keyframes shake-icon {
            0% {
                transform: rotate(0deg);
            }

            30% {
                transform: rotate(10deg);
            }

            60% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(-10deg);
            }
        }

        @keyframes shake-icon {
            0% {
                transform: rotate(0deg);
            }

            30% {
                transform: rotate(10deg);
            }

            60% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(-10deg);
            }
        }

        @keyframes animStar {
            from {
                transform: translateY(0px);
            }

            to {
                transform: translateY(-2000px);
            }
        }

        /* Chỉnh CSS cho card-container */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 40 -10px;
            /* Thêm margin âm để tạo khoảng cách giữa các card */
        }

        /* Chỉnh CSS cho card */
        .card {
            flex: 0 0 calc(25.33% - 20px);
            /* 33.33% - 20px để tạo khoảng cách giữa các card */
            padding: 20px;
            background-image: linear-gradient(#809fff, #70dbdb, #bfbfbf);
            text-align: center;
            border-radius: 30px;
            margin-top: 30px;
            margin-bottom: 30px;
            margin-left: 50px;
            margin-right: 50px;
            box-sizing: border-box;
            border: 1px solid black;
            /* Để giữ cho các card vừa vặn trong khoảng cách */
        }

        .card:hover {
            background-image: linear-gradient(#70dbdb, #809fff, #bfbfbf);
            color: #FFF;
            border: 3px solid black;
        }


        .card-img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            margin-bottom: 10px;
            border-radius: 20px;
            border: 3px solid black;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .card h3 {
            margin-bottom: 10px;
            font-size: 25px;
        }

        .card p {
            color: #888;
            font-size: 20px;
        }

        .card p:hover {
            color: #000000;
            font-weight: bold;
        }

        .tk {
            font-size: 40px;
            font-weight: bold;
            text-decoration: none;
            color: #fff2cc;
            margin-right: 30px;
        }

        details {
            align-items: flex-end;
            text-decoration: none;
        }

        .logohead1 ul a.tk:hover {
            font-size: 30px;
            background-color: #809fff;
            display: inline-block;
            padding: 5px;
            border-radius: 10px;
            width: 200px;
            color: #000000;
            font-weight: bold;
        }

        /* Ẩn mũi tên đổ xuống của thẻ <details> */
        summary::-webkit-details-marker {
            display: none;
        }

        /* Thiết lập kiểu hiển thị của thẻ <summary> */
        summary {
            list-style-type: none;
            /* Loại bỏ dấu chấm của thẻ <summary> */
            cursor: pointer;
            /* Biến con trỏ thành mũi tên chỉ vào */
        }

        .footer p {
            /* text-align: center; */
            float: left;
            /* font-size: 10px; */
            color: black;
            /* margin-top: -20px; */
        }

        /* CSS responsive cho nút chuyển đổi chế độ */
        @media (max-width: 768px) {
            #layout-toggle {
                display: inline-block;
            }

            /* Thêm các quy tắc CSS cho chế độ ngang */
            .card-container.horizontal-layout {
                display: flex;
                overflow-x: auto;
                scroll-behavior: smooth;
            }

            .card {
                flex: 0 0 auto;
                width: 100%;
                max-width: 300px;
                margin-right: 10px;
                /* Khoảng cách giữa các card khi chế độ ngang */
            }

            /* Ẩn nút lật qua trái và phải ban đầu */
            #prev-card,
            #next-card {
                display: none;
            }
        }

        /* Ẩn nút menu khi màn hình nhỏ hơn 768px */
        @media (max-width: 768px) {
            body {
                /* overflow-x: hidden; */
                /* Ẩn thanh ngang */
                margin: 0%;
            }

            .main {
                font-size: 20px;
            }

            .card-container {
                display: grid;
                /* grid-template-columns: repeat(2, 1fr); */
                /* Thay đổi số cột thành 2 */
                gap: 2px;
                margin-right: 30px;
            }

            .card {
                width: calc(80%);
                height: calc(85%);
                /* width: 70px;
                height:80px; */
                /* Điều chỉnh chiều rộng của card để tạo 2 cột */
            }

            .card:hover {
                height: 88%;
            }

            .card-img {
                width: 70%;
                height: auto;
                margin-bottom: 2px;
            }

            .card-content {
                display: flex;
                /* Sử dụng flexbox để căn giữa nội dung */
                flex-direction: column;
                align-items: center;
                /* Căn giữa theo chiều ngang */
                justify-content: center;
                /* Căn giữa theo chiều dọc */
                height: 40px;
                width: 300px;
                text-align: center;
            }

            .card h3 {
                margin-bottom: 2px;
                font-size: 20px;
                font-weight: bold;
            }

            .card p {
                color: #888;
                font-size: 10px;
            }

            .card p:hover {
                color: black;
                font-weight: bold;
                font-size: 15px;
            }

            .card button {
                width: 200px;
                height: 60px;
                font-size: 20px;
                text-align: center;
                margin-bottom: 30px;
            }

            .card button:hover {
                color: #FFF;
                font-weight: bold;
                font-size: 25px;
                padding: 10px;
                width: 200px;
                height: 60px;
                margin-bottom: 30px;
            }

            /* Thiết lập một class để ẩn các card dọc */
            .horizontal-layout .card {
                display: none;
            }

            /* Thiết lập một class để hiển thị các card ngang */
            .vertical-layout .card {
                display: block;
            }

            /*             
            /* Thiết lập các card ẩn ban đầu */
            .card {
                display: none;
            }

            */

            /* Hiển thị card đầu tiên */
            .card:first-child {
                display: block;
            }

            #layout-toggle {
                width: 60px;
                height: 60px;
                font-size: 20px;
                margin-top: 30px;
                margin-bottom: -20px;
            }

            #prev-card {
                width: 48px;
                height: 48px;
                position: absolute;
                left: 0;
                top: 85%;
                transform: translateY(-50%);
            }

            #next-card {
                width: 50px;
                height: 50px;
                position: absolute;
                right: 0;
                top: 85%;
                transform: translateY(-50%);
            }

        }


        /* Chỉnh responsive cho header */
        @media (max-width: 768px) {
            h2 {
                font-size: 20px;
                margin-top: 50px;
            }

            .logohead img {
                margin-bottom: 20px;
                top: 0;
                left: 20%;
                /* Chỉnh vị trí bên trái */
                transform: translateX(-50%);
                z-index: 2;
                margin-left: 110px;
                width: 230px;
                height: 100px;
            }

            .logohead img,
            .logohead1 img {
                top: 0;
                left: 0;
                z-index: 2;
            }

            .logohead1 img {
                width: 40px;
                height: 30px;
                margin-left:80px;
                margin-top: 30px;
            }

            .logohead1 {
                text-align: center;
                padding: 10px;
                margin-top: 10px;
                float: left;
                position: absolute;
                top: 30px;
                left: 70%;
                transform: translateX(-50%);
                z-index: 2;
                width: 10px;
                margin-left: -50px;
                /* Để thu gọn các phần tử bên phải */
            }

            .logohead1 summary {
                padding-right:15px;
                cursor: pointer;
            }

            .tk {
                font-size: 18px;
                font-weight: bold;
                text-decoration: none;
                color: #fff2cc;
                width: 100px;
                float:left;
            }

            .logohead1 ul a.tk:hover {
                font-size: 19px;
                font-weight: bold;
                text-decoration: none;
                color: #333;
                width: 100px;
                background-color: #809fff;
            }


            img[src='./pic/BannerAITools.png'] {
                width: 100%;
                height: 100px;
                margin-bottom: 10px;
                margin-top: 10px;
                z-index: 1;
            }

            .footer p {
                float: left;
                font-size: 5px;
                color: black;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <section class="stars-container">
            <div class="container">
                <div id="stars"></div>
                <div id="stars2"></div>
                <div id="stars3"></div>
                <div class="header">
                    <div class="logohead">
                        <img src="../pic/VNS logo ngang xóa nền.png" height="120px" , width="300px">
                    </div>

                    <div class="logohead1">
                        <details>
                            <summary>
                                <img src="../pic/menu1.png" height="40px" , width="50px" , margin-bottom="50px">
                            </summary>
                            <ul>
                                <a href="../customer.php?oringin=video" class="tk"><?php echo $user_name; ?></a>
                                <a href="../trangchudetail.php" class="tk">Thoát</a>
                                <a href="../trangchutaikhoan.php" class="tk">Đăng Xuất</a>
                            </ul>
                        </details>
                    </div>

                    <img src="../pic/BannerAITools.png" width="100%" , height="100%" , margin-bottom="3px">

                    <div class="main">
                        <h2>Video</h2>
                        <img src="./img/swap.png" id="layout-toggle" class="layout-toggle-button" alt="Chuyển đổi Chế Độ">
                        <img src="./img/left.png" id="prev-card" alt="Trái">
                        <div class="card-container vertical-layout">
                            <div class="card">
                                <img src="./img/deep.png" class="card-img">
                                <h3>Video & AI-character</h3>
                                <p>Tạo ngay các video được tạo bởi trí tuệ nhân tạo với việc viết đơn giản bằng cách sử dụng 99% Reality AI Avatar. Tạo ra các video AI có vẻ thực tế một cách dễ dàng. Để có video AI đầu tiên của bạn trong vòng không quá năm phút, chỉ cần chuẩn bị kịch bản của bạn và sử dụng công cụ Chuyển văn bản thành giọng nói tự nhiên.</p>
                                <a href="https://www.deepbrain.io/" target="_blank"><button class="truycap">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/munch.png" class="card-img">
                                <h3>Video editing</h3>
                                <p>Biến các video dài thành các đoạn ngắn dựa trên dữ liệu phục vụ cho mạng xã hội. Munch tạo ra sự phổ biến và tương tác bằng cách khai thác các hứng thú hàng đầu từ người dùng TikTok, IG, YT và FB và áp dụng chúng vào các đoạn video được tạo bởi trí tuệ nhân tạo.</p>
                                <a href="https://www.getmunch.com/" target="_blank"><button class="truycap">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/dli.png" class="card-img">
                                <h3>Video</h3>
                                <p>Tạo ra video từ kịch bản hoặc bài viết blog trong 2 phút bằng cách sử dụng các giọng nói thực tế! Biến các bài viết blog thành video. Giọng nói giống thật. Thư viện phương tiện chất lượng cao. Được tin dùng bởi hơn 30.000 người tạo nội dung từ các công ty như Google, Meta, Bytedance và Upwork.</p>
                                <a href="https://fliki.ai/" target="_blank"><button class="truycap">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/pic.png" class="card-img">
                                <h3>Longform to shortform</h3>
                                <p>Sản xuất video dễ dàng. Sử dụng tài liệu dài để tự động tạo ra các video thương hiệu ngắn, dễ chia sẻ. Nhanh chóng, đơn giản và tiết kiệm chi phí. Không cần kiến thức kỹ thuật hoặc phần mềm tải về.</p>
                                <a href="https://pictory.ai/" target="_blank"><button class="truycap">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/syn.jpg" class="card-img">
                                <h3>Video & AI character</h3>
                                <p>Synthesia.io cho phép bạn chuyển đổi văn bản đơn giản thành video trong vài giây. Hiện đang là một trong những nền tảng tốt nhất để tạo ra video AI. Nó được hàng nghìn doanh nghiệp sử dụng để sản xuất video trong 120 ngôn ngữ và tiết kiệm đến 80% thời gian và tiền bạc của họ. Synthesia cung cấp một giải pháp hiệu quả về thời gian và chi phí thay thế cho việc tạo video truyền thống.</p>
                                <a href="https://www.synthesia.io/" target="_blank"><button class="truycap">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/vidi.png" class="card-img">
                                <h3>Video planner</h3>
                                <p>Tăng lượt xem trên YouTube của bạn với trí tuệ nhân tạo. Nhận thông tin và hướng dẫn để giữ cho kênh của bạn tiếp tục phát triển.</p>
                                <a href="https://vidiq.com/insidrai/" target="_blank"><button class="truycap">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/sub.png" class="card-img">
                                <h3>Automatic video textting</h3>
                                <p>Biến video của bạn thành các video phụ đề được tạo bởi trí tuệ nhân tạo. Tự động tạo phụ đề với các biểu tượng cảm xúc lý tưởng và các cụm từ được nhấn mạnh một cách thông minh. Tạo ra các đoạn văn bản nổi bật hấp dẫn cho video trên mạng xã hội một cách tự động.</p>
                                <a href="https://submagic.co/" target="_blank"><button class="truycap">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/flex.png" class="card-img">
                                <h3>Video generator</h3>
                                <p>FlexClip là phần mềm đơn giản, hữu ích để tạo ra các video ngắn hấp dẫn. Tạo ra các video đẹp trong vài phút với giao diện người dùng dễ sử dụng. Có hàng ngàn mẫu để tạo và chỉnh sửa video cho thương hiệu, trang web, tiếp thị, mạng xã hội, gia đình hoặc bất cứ điều gì khác.</p>
                                <a href="https://www.flexclip.com/" target="_blank"><button class="truycap">Truy Cập Ngay</button></a>
                            </div>
                        </div>
                        <img src="./img/next.png" id="next-card" alt="Phải">
                    </div>
                </div>

            </div>
        </section>

        <div class="footer">
            <p>Tổng hợp và sưu tập @aitoolsvietnamstartup</p>
        </div>
    </div>
    <script>
        //Disable text selection and right-click context menu
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        document.addEventListener('selectstart', function(e) {
            e.preventDefault();
        });
        //Lấy tên đăng nhập từ Local Storage và hiển thị trên trang
        const loggedInUserName = localStorage.getItem('loggedInUserName');
        if (loggedInUserName) {
            const userElement = document.querySelector('.tk');
            userElement.textContent = loggedInUserName;
        }

        const layoutToggle = document.getElementById('layout-toggle');
        const prevCardButton = document.getElementById('prev-card');
        const nextCardButton = document.getElementById('next-card');
        const cardContainer = document.querySelector('.card-container');
        const cards = document.querySelectorAll('.card');
        let currentCardIndex = 0;

        // Hàm hiển thị thẻ card tại vị trí được chỉ định
        function showCard(index) {

            // Hiển thị tất cả các card theo chiều dọc
            cards.forEach((card) => {
                card.style.display = 'none';
            });

            // Hiển thị thẻ card tại vị trí được chỉ định
            cards[index].style.display = 'block';
            currentCardIndex = index;
        }

        layoutToggle.addEventListener('click', function() {
            // Kiểm tra trạng thái hiện tại và đảo ngược nó
            if (cardContainer.classList.contains('horizontal-layout')) {
                cardContainer.classList.remove('horizontal-layout');
                cardContainer.classList.add('vertical-layout');

                // Ẩn các nút lật qua trái và phải khi chuyển sang chế độ dọc
                prevCardButton.style.display = 'none';
                nextCardButton.style.display = 'none';

                // Hiển thị tất cả các card theo chiều dọc
                cards.forEach((card) => {
                    card.style.display = 'block';
                });
            } else {
                cardContainer.classList.remove('vertical-layout');
                cardContainer.classList.add('horizontal-layout');

                // Ẩn tất cả các thẻ card
                cards.forEach((card) => {
                    card.style.display = 'none';
                });

                // Hiển thị lại nút lật qua trái và phải khi chuyển đổi chế độ
                prevCardButton.style.display = 'inline-block';
                nextCardButton.style.display = 'inline-block';

                // Hiển thị duy nhất card đầu tiên khi chuyển đổi chế độ ngang
                showCard(1);

            }
        });

        // Hàm để lật qua trái
        function slideLeft() {
            currentCardIndex = (currentCardIndex - 1 + cards.length) % cards.length;
            showCard(currentCardIndex);
        }

        // Hàm để lật qua phải
        function slideRight() {
            currentCardIndex = (currentCardIndex + 1) % cards.length;
            showCard(currentCardIndex);
        }

        prevCardButton.addEventListener('click', slideLeft);
        nextCardButton.addEventListener('click', slideRight);
    </script>
</body>

</html>