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

$sql= sprintf( "select data_1,md_data.date from fever.md_data where md_data.type = 3 and md_data.baby_id='%s'",$babyid);
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
<center><h1> 이벤트 케이스 history</h1></center>
<table border width="600" cellpadding="5" align="center">
    <tr>
        <td align ="center">이벤트 케이스</td>
        <td align ="center">날짜</td>
    </tr>
    <?php
    for($i=0;$i<$j;$i++) {
        echo "<tr><td align = 'center'>" . $s3[$i][0] . "</td><td align ='center'>" . $s3[$i][1] . "</td></tr>";
    }
    ?>
</table>
</body>
</html>