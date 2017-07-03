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

$sql= sprintf( "select email,phone_num,country from fever.md_user where user_id='%s'",$userid); //
$result2 = mysqli_query($connect, $sql);
$num_col = mysqli_num_fields($result2);
$s=array();
while ($row = mysqli_fetch_array($result2)){
    FOR($i = 0; $i < $num_col; $i++){
        $s[$i]=$row[$i];
    }
}


?>
<table border width="600" cellpadding="5" align="center">
    <caption class="readHide">user_id</caption>
    <thead>
    <tr>
        <th scope="row" class="id">User id</th>
        <td align = "center"><?php echo $userid ?></td>
    </tr>
    <tr>
        <th scope="row" class="id">email</th>
        <td align = "center"><?php echo $s[0] ?></td>
    </tr>
    <tr>
        <th scope="row" class="id">Phone number</th>
        <td align = "center"><?php echo $s[1] ?></td>
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

