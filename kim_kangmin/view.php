<?php $userid=$_GET['user_id'];

$dbid = "appmd";
$dbpw = "appmd2013";
$dbname = "fever";

$connect = mysqli_connect('fever-test.ckpvcour59fy.ap-northeast-2.rds.amazonaws.com:3306', $dbid , $dbpw) or die("<root><result>1000</result><data>Unable to connect to SQL Server</data></root>");
mysqli_select_db($connect,$dbname) or die("<root><result>1001</result><data>Unable to select DataBase</data></root>");
mysqli_query($connect,"set names utf8");
mysqli_query($connect,"set session character_set_connection=utf8;");
mysqli_query($connect,"set session character_set_results=utf8;");
mysqli_query($connect,"set session character_set_client=utf8;");

$sql= sprintf( "select email, phone_num, country, fever.md_user._id from fever.md_user where md_user.user_id='%s'",$userid); //
$result2 = mysqli_query($connect, $sql);
$num_col = mysqli_num_fields($result2);
$s=array();
while ($row = mysqli_fetch_array($result2)){
    FOR($i = 0; $i < $num_col; $i++){
        $s[$i]=$row[$i];
    }
}

$sql2= sprintf( "select name, birthday, gender, weight, sensing_gaps, fever_baby._id from fever.fever_baby where fever.fever_baby.user_id = %d",$s[3]); //
$result3 = mysqli_query($connect, $sql2);
$num_col2 = mysqli_num_fields($result3);
$s2=array();
static $j=0;
while ($row2 = mysqli_fetch_array($result3)){
    FOR($i = 0; $i < $num_col2; $i++){
        $s2[$j][$i]=$row2[$i];
    }
    $j++;
}
$t=$j+1;
?>
<br><br><br>
<form action ="paging.php"  align ="center">
    <h1><center><input type="submit" value="Back" align ="right"></center></h1>
</form>
<table border width="600" cellpadding="5" align="center">
    <caption class="readHide"></caption>
    <thead>
    <tr>
        <th scope="row" class="id">User id</th>
        <td colspan="<?php echo $t; ?>" align = "center"><?php echo $userid ?></td>
    </tr>
    <tr>
        <th scope="row" class="id">이름</th>
        <?php for($i=0;$i<$j;$i++){
            echo "<td align = 'center'><a href='view2.php?babyid= ".$s2[$i][5]."'>".$s2[$i][0]."</a></td>";
         }?>
    </tr>
    <tr>
        <th scope="row" class="id">생일</th>
        <?php for($i=0;$i<$j;$i++){
            echo "<td align = 'center'>".$s2[$i][1]."</td>";
        }?>
    </tr>
    <tr>
        <th scope="row" class="id">성별</th>
        <?php
            for($i=0;$i<$j;$i++) {
                if ($s2[$i][2] == 0) {
                    echo "<td align = 'center'>남자</td>";
                } else {
                    echo "<td align = 'center'>여자</td>";
                }
            }
            ?>

    </tr>
    <tr>
        <th scope="row" class="id">몸무게</th>
        <?php for($i=0;$i<$j;$i++){
            echo "<td align = 'center'>".$s2[$i][3]."</td>";
        }?>
    </tr>
    <tr>
        <th scope="row" class="id">열성경련 유무</th>
        <?php for($i=0;$i<$j;$i++){
            echo "<td align = 'center'>".$s2[$i][4]."</td>";
        }?>
    </tr>
    <tr>
        <th scope="row" class="id">email</th>
        <td colspan="<?php echo $t; ?>" align = "center"><?php echo $s[0] ?></td>
    </tr>
    <tr>
        <th scope="row" class="id">Phone number</th>
        <td colspan="<?php echo $t; ?>" align = "center"><?php echo $s[1] ?></td>
    </tr>
    <tr>
        <th scope="row" class="id">Country</th>
        <td colspan="<?php echo $t; ?>" align = "center"><?php echo $s[2] ?></td>
    </tr>
    </thead>
    <tbody>
</tbody>
</table>
<?php /*<div class="btnSet">
            <a href="./write.php" class="btnWrite btn">글쓰기</a>
        </div>
        <div class="paging">*/
?>

