<?php

$babyid=$_GET['babyid'];
$dbid = "appmd";
$dbpw = "appmd2013";
$dbname = "fever";

$connect = mysqli_connect('fever-test.ckpvcour59fy.ap-northeast-2.rds.amazonaws.com:3306', $dbid , $dbpw) or die("<root><result>1000</result><data>Unable to connect to SQL Server</data></root>");
mysqli_select_db($connect,$dbname) or die("<root><result>1001</result><data>Unable to select DataBase</data></root>");
mysqli_query($connect,"set names utf8");
mysqli_query($connect,"set session character_set_connection=utf8;");
mysqli_query($connect,"set session character_set_results=utf8;");
mysqli_query($connect,"set session character_set_client=utf8;");

$sql= sprintf( "select data_1,data_2,memo, md_data.date from fever.md_data where md_data.type = 4 and md_data.baby_id='%s'",$babyid);
$result2 = mysqli_query($connect, $sql);
$num_col = mysqli_num_fields($result2);
$s3=array();
static $j=0;
while ($row = mysqli_fetch_array($result2)){
    FOR($i = 0; $i < $num_col; $i++){
        $s3[$j][$i]=$row[$i];
    }
    $j++;
}?>
<html>
<body>
<br>
<center><h1>메모 history</h1></center>
<table border width="1500" cellpadding="5" align="center">
    <tr>
        <td align ="center">Type</td>
        <td align ="center">내용</td>
        <td align ="center">메모</td>
        <td align ="center">날짜</td>
    </tr>
    <?php
    for($i=0;$i<$j;$i++) {
        echo"<tr>";
        if($s3[$i][0]==1){
            echo"<td align = 'center'>증상</td>";
            echo "<td align = 'center'>";
            for ($k = 0; $k < strlen($s3[$i][1]) / 2; $k++) {
                if ($s3[$i][1][2 * $k] == "1") {
                    if ($k == 0) {echo "기침<br> ";}
                    if ($k == 1) {echo "콧물<br> ";}
                    if ($k == 2) {echo "가래<br> ";}
                    if ($k == 3) {echo "재채기<br> ";}
                    if ($k == 4) {echo "빠른 호흡/숨 차함<br> ";}
                    if ($k == 5) {echo "컹컹대는 기침<br> "; }
                    if ($k == 6) {echo "쌕쌕거림<br> ";}
                    if ($k == 7) {echo "목 부음 <br> ";}
                    if ($k == 8) {echo "심하게 처짐, 늘어짐 <br> ";}
                    if ($k == 9) {echo "심하게 보챔 <br>";}
                    if ($k == 10) {echo "먹는양 20% 감소<br> ";}
                    if ($k == 11) {echo "먹는양 40% 감소<br> ";}
                    if ($k == 12) {echo "먹는양 60% 이상 감소<br> ";}
                    if ($k == 13) {echo "구토<br> ";}
                    if ($k == 14) {echo "설사<br> ";}
                    if ($k == 15) {echo "변비<br> "; }
                    if ($k == 16) {echo "복통<br> ";}
                    if ($k == 17) {echo "몸통발진<br> ";}
                    if ($k == 18) {echo "손발수포<br> ";}
                    if ($k == 19) {echo "구강수포<br> ";}
                    if ($k == 20) {echo "두통<br> ";}
                    if ($k == 21) {echo "황달<br> ";}
                    if ($k == 22) {echo "BCG 발적(붉어짐)<br> ";}
                    if ($k == 23) {echo "눈/결막 충혈<br> ";}
                    if ($k == 24) {echo "딸기 혀<br> ";}
                    if ($k == 25) {echo "경련<br> ";}
                    if ($k == 26) {echo "기타<br> ";}

                }
            }
            echo "</td>";
            echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
            echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
            echo "</tr>";

        }
        elseif($s3[$i][0]==2) {
            echo"<tr>";
            echo"<td align = 'center'>항생제 먹임</td>";
            echo "<td align = 'center'>항생제 먹임 ㅎㅎ</td>";
            echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
            echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
            echo "</tr>";
        }
        elseif ($s3[$i][0]==3) {
            echo"<td align = 'center'>진단명</td>";
            if($s3[$i][1]==0){
                echo "<td align='center'>기관지염</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==1) {

                echo "<td align='center'>모세기관지염</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==2) {

                echo "<td align='center'>폐렴</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==3) {

                echo "<td align='center'>아데노 바이러스 감염</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==4) {

                echo "<td align='center'>후두염/크롬</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==5) {

                echo "<td align='center'>인두염/편도염</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==6) {

                echo "<td align='center'>열감기</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==7) {

                echo "<td align='center'>독감</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==8) {

                echo "<td align='center'>구내염(단순포진)</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==9) {

                echo "<td align='center'>기관지염(헤르페안지나)</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==10) {

                echo "<td align='center'>구협염</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==11) {

                echo "<td align='center'>수족구</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==12) {

                echo "<td align='center'>장염/식중독</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==13) {

                echo "<td align='center'>뇌수막염</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==14) {

                echo "<td align='center'>중이염</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==15) {

                echo "<td align='center'>요로감염</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==16) {

                echo "<td align='center'>볼거리</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==17) {

                echo "<td align='center'>성홍열</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==18) {

                echo "<td align='center'>수두</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==19) {

                echo "<td align='center'>홍역</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==20) {

                echo "<td align='center'>돌발진</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif ($s3[$i][1]==21) {

                echo "<td align='center'>진단명 미확정</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            else {
                echo "<td align='center'>기타</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
        }
        elseif($s3[$i][0]==4) {
            echo"<tr>";
            echo"<td align = 'center'>육아기록</td>";
            if($s3[$i][1]==0){
                echo "<td align = 'center'>모유수유</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif($s3[$i][1]==1){
                echo "<td align = 'center'>분유수유</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif($s3[$i][1]==2){
                echo "<td align = 'center'>잠</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif($s3[$i][1]==3){
                echo "<td align = 'center'>수분섭취</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif($s3[$i][1]==4){
                echo "<td align = 'center'>소변양</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            elseif($s3[$i][1]==5){
                echo "<td align = 'center'>미온수마사지</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
            else{
                echo "<td align = 'center'>기타</td>";
                echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
                echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
                echo "</tr>";
            }
        }
        else{
            echo"<tr>";
            echo"<td align = 'center'>예방 접종</td>";
            echo "<td align = 'center'>bcg__b형간염__Dtap__MMR__일본뇌염__폐렴구균_Hib_소아마비__로타__A간염__수두__독감<br>".$s3[$i][1]."</td>";
            echo "<td align = 'center'>" . $s3[$i][2] . "</td>";
            echo "<td align = 'center'>" . $s3[$i][3] . "</td>";
            echo "</tr>";
        }
    }
    ?>
</table>
</body>
</html>