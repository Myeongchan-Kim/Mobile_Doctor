<?php
/**
 * Created by PhpStorm.
 * User: MobileDoctor
 * Date: 2017-06-23
 * Time: 오후 4:02
 */
$dbid = "appmd";
$dbpw = "appmd2013";
$dbname = "fever";

$connect = mysqli_connect('fever-test.ckpvcour59fy.ap-northeast-2.rds.amazonaws.com:3306', $dbid , $dbpw) or die("<root><result>1000</result><data>Unable to connect to SQL Server</data></root>");
mysqli_select_db($connect,$dbname) or die("<root><result>1001</result><data>Unable to select DataBase</data></root>");
mysqli_query($connect,"set names utf8");
mysqli_query($connect,"set session character_set_connection=utf8;");
mysqli_query($connect,"set session character_set_results=utf8;");
mysqli_query($connect,"set session character_set_client=utf8;");

echo "<center><h1>진단명 Data</h1></center>";
$query ="select Aid, baby_id, kind from fever.Memo where type=3 Order by kind";
$result4 = mysqli_query($connect,$query);
$num_col = mysqli_num_fields($result4);
echo "<table border width=\"600\" cellpadding=\"5\" align=\"center\">";
echo "<th width = \"600\">Aid</th>";
echo "<th width = \"600\">baby_id</th>";
echo "<th width = \"600\">진단명</th>";
static $sum1=0;
static $sum2=0;
static $sum3=0;
static $sum4=0;
static $sum5=0;
static $sum6=0;
static $sum7=0;
static $sum8=0;
static $sum9=0;
static $sum10=0;
static $sum11=0;
static $sum12=0;
static $sum13=0;
static $sum14=0;
static $sum15=0;
static $sum16=0;
static $sum17=0;
static $sum18=0;
static $sum19=0;
static $sum20=0;
static $sum21=0;
static $sum22=0;
static $sum23=0;
static $totalsum=0;
while($data3 = mysqli_fetch_array($result4)) {
    echo "<table border width=\"700\" cellpadding=\"5\" align=\"center\">";

    if ($data3[$num_col - 1] == 0) {
        $sum1 += 1;
    } elseif ($data3[$num_col - 1] == 1) {
        $sum2 += 1;
    } elseif ($data3[$num_col - 1] == 2) {
        $sum3 += 1;
    } elseif ($data3[$num_col - 1] == 3) {
        $sum4 += 1;
    } elseif ($data3[$num_col - 1] == 4) {
        $sum5 += 1;
    } elseif ($data3[$num_col - 1] == 5) {
        $sum6 += 1;
    } elseif ($data3[$num_col - 1] == 6) {
        $sum7 += 1;
    } elseif ($data3[$num_col - 1] == 7) {
        $sum8 += 1;
    } elseif ($data3[$num_col - 1] == 8) {
        $sum9 += 1;
    } elseif ($data3[$num_col - 1] == 9) {
        $sum10 += 1;
    } elseif ($data3[$num_col - 1] == 10) {
        $sum11+= 1;
    } elseif ($data3[$num_col - 1] == 11) {
        $sum12 += 1;
    } elseif ($data3[$num_col - 1] == 12) {
        $sum13 += 1;
    } elseif ($data3[$num_col - 1] == 13) {
        $sum14 += 1;
    } elseif ($data3[$num_col - 1] == 14) {
        $sum15 += 1;
    } elseif ($data3[$num_col - 1] == 15) {
        $sum16 += 1;
    } elseif ($data3[$num_col - 1] == 16) {
        $sum17 += 1;
    } elseif ($data3[$num_col - 1] == 16) {
        $sum18 += 1;
    } elseif ($data3[$num_col - 1] == 17) {
        $sum19 += 1;
    } elseif ($data3[$num_col - 1] == 18) {
        $sum20 += 1;
    } elseif ($data3[$num_col - 1] == 19) {
        $sum21 += 1;
    } elseif ($data3[$num_col - 1] == 20) {
        $sum22 += 1;
    } elseif ($data3[$num_col - 1] == 21) {
        $sum23 += 1;
    } else
        $sum24 += 1;

    $totalsum=$sum1+$sum2+$sum3+$sum4+ $sum5+ $sum6+ $sum7+ $sum8+ $sum9+ $sum10+ $sum11+ $sum12+ $sum13+ $sum14+ $sum15+ $sum16+ $sum17+ $sum18+ $sum19+ $sum20+ $sum21+ $sum22+ $sum23;

    echo"<tr><td>기관지염</td><td>$sum1, $sum1*100/$totalsum</td></tr>";
    echo"<tr><td>모세기관지염</td><td>$sum2, $sum2*100/$totalsum</td></tr>";
    echo"<tr><td>폐렴</td><td>$sum3, $sum3*100/$totalsum</td></tr>";
    echo"<tr><td>아데노 바이러스 감염</td><td>$sum4*100/$totalsum</td></tr>";
    echo"<tr><td>후두염/크롬</td><td>$sum5*100/$totalsum</td></tr>";
    echo"<tr><td>인두염/편도염</td><td>$sum6*100/$totalsum</td></tr>";
    echo"<tr><td>열감기</td><td>*100/$totalsum</td></tr>";
    echo"<tr><td>독감</td><td>$sum8*100/$totalsum</td></tr>";
    echo"<tr><td>구내염(단순포진)</td><td>$sum9*100/$totalsum</td></tr>";
    echo"<tr><td>기관지염(헤르페안지나)</td><td>$sum10*100/$totalsum</td></tr>";
    echo"<tr><td>구협염</td><td>$sum11*100/$totalsum</td></tr>";
    echo"<tr><td>수족구</td><td>$sum12*100/$totalsum</td></tr>";
    echo"<tr><td>장염/식중독</td><td>$sum13*100/$totalsum</td></tr>";
    echo"<tr><td>뇌수막염</td><td>*100/$totalsum</td></tr>";
    echo"<tr><td>중이염</td><td>$sum15*100/$totalsum</td></tr>";
    echo"<tr><td>요로감염</td><td>$sum16*100/$totalsum</td></tr>";
    echo"<tr><td>볼거리</td><td>$sum17*100/$totalsum</td></tr>";
    echo"<tr><td>성홍열</td><td>$sum18*100/$totalsum</td></tr>";
    echo"<tr><td>수두</td><td>$sum19*100/$totalsum</td></tr>";
    echo"<tr><td>홍역</td><td>$sum20*100/$totalsum</td></tr>";
    echo"<tr><td>돌발진</td><td>$sum21*100/$totalsum</td></tr>";
    echo"<tr><td>진단명 미확정</td><td>$sum22*100/$totalsum</td></tr>";
    echo"<tr><td>기타</td><td>$sum23*100/$totalsum</td></tr>";

}
echo "</table>";

mysqli_close($connect);
?>