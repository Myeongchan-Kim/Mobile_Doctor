<html>
<head>
    <title>
        Test output
    </title>
</head>
<body>
<br>
<form action ="inputfile.php"  align ="center">
     <h1><input type="submit" value="Return to first page" align ="center"></h1>
</form>

<?php

$Aid_number=$_POST["passdata"];
$startday=$_POST["timerange"];
$endday=$_POST["timerange2"];

echo "<h1>Time range : ".$startday."-31 초과   ~   ".$endday."-01 미만 </h1>";

$dbid = "appmd";
$dbpw = "appmd2013";
$dbname = "fever";

$connect = mysqli_connect('fever-test.ckpvcour59fy.ap-northeast-2.rds.amazonaws.com:3306', $dbid , $dbpw) or die("<root><result>1000</result><data>Unable to connect to SQL Server</data></root>");
mysqli_select_db($connect,$dbname) or die("<root><result>1001</result><data>Unable to select DataBase</data></root>");
mysqli_query($connect,"set names utf8");
mysqli_query($connect,"set session character_set_connection=utf8;");
mysqli_query($connect,"set session character_set_results=utf8;");
mysqli_query($connect,"set session character_set_client=utf8;");

/*$result = mysqli_query($connect,"select * from fever.Fever where fever > 0 and Aid = 'd4b6bc5264e11eb0';");
while($data = mysqli_fetch_array($result)) {

    echo $data["Aid"]." | ".$data["baby_id"]." | ".$data["fever"]." | ".$data["date"]."<br>";

}*/
$query =sprintf("select Aid,baby_id,fever,fever.Fever.date from fever.Fever where fever > 0 and Aid = '%s' and fever.Fever.date 
between '%s' AND '%s' /*order by fever.Fever.date DESC*/;", $Aid_number, $startday, $endday);
$list=10;
$block=3;
$result2 = mysqli_query($connect,$query);
/*$num=mysqli_num_rows($result2);
$pagenum=ceil($num/$list);
$blocknum=ceil($pagenum/$block);
$nowblock=ceil($page);*/

$num_col = mysqli_num_fields($result2);
echo "<center><h1>Fever Data</h1></center>";
echo "<table border width=\"700\" cellpadding=\"5\" align=\"center\">";
echo "<th width = \"200\">Aid</th>";
echo "<th width = \"80\">baby_id</th>";
echo "<th width = \"80\">Fever</th>";
echo "<th width = \"200\">Date</th>";

while($data = mysqli_fetch_array($result2)) {
    echo"<tr>";
    FOR($i = 0; $i < $num_col; $i++)
        echo "<td align='center'>".$data[$i]."</td>";
    echo"</tr>";
}
echo "</table>";
echo"<br>";echo"<br>";echo"<br>";
echo "<center><h1>Reducer Data</h1></center>";
$query =sprintf("select Aid,baby_id, kind,eat_date from fever.Reducer where Aid = '%s' and fever.Reducer.eat_date between '%s' AND '%s';", $Aid_number, $startday, $endday);
$result3 = mysqli_query($connect,$query);
$num_col = mysqli_num_fields($result3);
echo "<table border width=\"600\" cellpadding=\"5\" align=\"center\">";
echo "<th width = \"600\">Aid</th>";
echo "<th width = \"600\">baby_id</th>";
echo "<th width = \"600\">해 열 제</th>";
echo "<th width = \"600\">먹은 날짜</th>";

while($data2 = mysqli_fetch_array($result3)) {
    echo"<tr>";
    FOR($i = 0; $i < $num_col; $i++)
        echo "<td align='center'>".$data2[$i]."</td>";
    echo"</tr>";
}
echo "</table>";
echo"<br>";echo"<br>";echo"<br>";
echo "<center><h1>진단명 Data</h1></center>";
$query =sprintf("select Aid,baby_id,kind from fever.Memo where type=3 and Aid = '%s';", $Aid_number);
$result4 = mysqli_query($connect,$query);
$num_col = mysqli_num_fields($result4);
echo "<table border width=\"600\" cellpadding=\"5\" align=\"center\">";
echo "<th width = \"600\">Aid</th>";
echo "<th width = \"600\">baby_id</th>";
echo "<th width = \"600\">진단명</th>";

while($data3 = mysqli_fetch_array($result4)) {
    echo"<tr>";
    FOR($i = 0; $i < $num_col-1; $i++)
        echo "<td align='center'>".$data3[$i]."</td>";

    if ($data3[$num_col-1]==0)
        echo "<td align='center'>기관지염</td>";
    elseif ($data3[$num_col-1]==1)
        echo "<td align='center'>모세기관지염</td>";
    elseif ($data3[$num_col-1]==2)
        echo "<td align='center'>폐렴</td>";
    elseif ($data3[$num_col-1]==3)
        echo "<td align='center'>아데노 바이러스 감염</td>";
    elseif ($data3[$num_col-1]==4)
        echo "<td align='center'>후두염/크롬</td>";
    elseif($data3[$num_col-1]==5)
        echo "<td align='center'>인두염/편도염</td>";
    elseif ($data3[$num_col-1]==6)
        echo "<td align='center'>열감기</td>";
    elseif ($data3[$num_col-1]==7)
        echo "<td align='center'>독감</td>";
    elseif ($data3[$num_col-1]==8)
        echo "<td align='center'>구내염(단순포진)</td>";
    elseif ($data3[$num_col-1]==9)
        echo "<td align='center'>기관지염(헤르페안지나)</td>";
    elseif ($data3[$num_col-1]==10)
        echo "<td align='center'>구협염</td>";
    elseif ($data3[$num_col-1]==11)
        echo "<td align='center'>수족구</td>";
    elseif ($data3[$num_col-1]==12)
        echo "<td align='center'>장염/식중독</td>";
    elseif ($data3[$num_col-1]==13)
        echo "<td align='center'>뇌수막염</td>";
    elseif ($data3[$num_col-1]==14)
        echo "<td align='center'>중이염</td>";
    elseif ($data3[$num_col-1]==15)
        echo "<td align='center'>요로감염</td>";
    elseif ($data3[$num_col-1]==16)
        echo "<td align='center'>볼거리</td>";
    elseif ($data3[$num_col-1]==17)
        echo "<td align='center'>성홍열</td>";
    elseif ($data3[$num_col-1]==18)
        echo "<td align='center'>수두</td>";
    elseif ($data3[$num_col-1]==19)
        echo "<td align='center'>홍역</td>";
    elseif ($data3[$num_col-1]==20)
        echo "<td align='center'>돌발진</td>";
    elseif ($data3[$num_col-1]==21)
        echo "<td align='center'>진단명 미확정</td>";
    else
        echo "<td align='center'>기타</td>";

    echo"</tr>";
}
echo "</table>";

echo"<br>";echo"<br>";echo"<br>";
echo "<center><h1>증상 Data</h1></center>";
$query =sprintf("select Aid,baby_id,kind,memo,fever.Memo.date from fever.Memo where type=1 and Aid = '%s';", $Aid_number);
$result5 = mysqli_query($connect,$query);
$num_col = mysqli_num_fields($result5);
echo "<table border width=\"1200\" cellpadding=\"5\" align=\"center\">";
echo "<th width = \"200\">Aid</th>";
echo "<th width = \"80\">baby_id</th>";
echo "<th width = \"600\">증상</th>";
echo "<th width = \"600\">메모</th>";
echo "<th width = \"600\">날짜</th>";
while($data4 = mysqli_fetch_array($result5)) {
    echo"<tr>";
    FOR($i = 0; $i < $num_col; $i++)
    {

        if ($i == 2) {
            echo "<td align = 'center'>";
            for ($k = 0; $k < strlen($data4[$i]) / 2; $k++) {

                if ($data4[$i][2 * $k] == "1") {

                    if ($k == 0) {
                        echo "기침<br> ";
                    }
                    if ($k == 1) {
                        echo "콧물<br> ";
                    }
                    if ($k == 2) {
                        echo "가래<br> ";
                    }
                    if ($k == 3) {
                        echo "재채기<br> ";
                    }
                    if ($k == 4) {
                        echo "빠른 호흡/숨 차함<br> ";
                    }
                    if ($k == 5) {
                        echo "컹컹대는 기침<br> ";
                    }
                    if ($k == 6) {
                        echo "쌕쌕거림<br> ";
                    }
                    if ($k == 7) {
                        echo "목 부음 <br> ";
                    }
                    if ($k == 8) {
                        echo "심하게 처짐, 늘어짐 <br> ";
                    }
                    if ($k == 9) {
                        echo "심하게 보챔 <br>";
                    }
                    if ($k == 10) {
                        echo "먹는양 20% 감소<br> ";
                    }
                    if ($k == 11) {
                        echo "먹는양 40% 감소<br> ";
                    }
                    if ($k == 12) {
                        echo "먹는양 60% 이상 감소<br> ";
                    }
                    if ($k == 13) {
                        echo "구토<br> ";
                    }
                    if ($k == 14) {
                        echo "설사<br> ";
                    }
                    if ($k == 15) {
                        echo "변비<br> ";
                    }
                    if ($k == 16) {
                        echo "복통<br> ";
                    }
                    if ($k == 17) {
                        echo "몸통발진<br> ";
                    }
                    if ($k == 18) {
                        echo "손발수포<br> ";
                    }
                    if ($k == 19) {
                        echo "구강수포<br> ";
                    }
                    if ($k == 20) {
                        echo "두통<br> ";
                    }
                    if ($k == 21) {
                        echo "황달<br> ";
                    }
                    if ($k == 22) {
                        echo "BCG 발적(붉어짐)<br> ";
                    }
                    if ($k == 23) {
                        echo "눈/결막 충혈<br> ";
                    }
                    if ($k == 24) {
                        echo "딸기 혀<br> ";
                    }
                    if ($k == 25) {
                        echo "경련<br> ";
                    }
                    if ($k == 26) {
                        echo "기타<br> ";
                    }

                }

            }
            echo "</td>";
        }
        else
            echo "<td align='center'>".$data4[$i]."</td>";
    }
    echo"</tr>";
}

mysqli_close($connect);
?>
</body>
</html>
