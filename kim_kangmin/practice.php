<?php
/**
 * Created by PhpStorm.
 * User: MobileDoctor
 * Date: 2017-06-26
 * Time: 오후 2:17
 */
date_default_timezone_set('UTC');
$time=time();
$dbid = "appmd";
$dbpw = "appmd2013";
$dbname = "fever";
$connect = mysqli_connect('fever-test.ckpvcour59fy.ap-northeast-2.rds.amazonaws.com:3306', $dbid , $dbpw) or die("<root><result>1000</result><data>Unable to connect to SQL Server</data></root>");
mysqli_select_db($connect,$dbname) or die("<root><result>1001</result><data>Unable to select DataBase</data></root>");
mysqli_query($connect,"set names utf8");
mysqli_query($connect,"set session character_set_connection=utf8;");
mysqli_query($connect,"set session character_set_results=utf8;");
mysqli_query($connect,"set session character_set_client=utf8;");

$idlist= array();
$query1 = "select count(*) as cnt from fever.md_user";
$resul1t = mysqli_query($connect,$query1);
$total = @mysqli_result($resul1t, 0, 0);
echo "$total";

/*$query =  "Insert into test
select Distinct Aid 
from fever.baby 
order by Aid 
limit 1000";*/
// md_user 테이블 만드는 작업!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
/*static $distaid = array();
$query =sprintf("Select gender, weight from shortbaby ");
$resultt=mysqli_query($connect, $query);

static $j=0;
while($row = mysqli_fetch_array($resultt)){
    for ($i=0;$i<2;$i++){
        $distaid[$j][$i]=$row[$i];
    }

    $j++;
};*/
/*$query2 = sprintf("delete from md_user where fever.md_user._id<10000");
mysqli_query($connect, $query2);*/
/*
for ($i=0;$i<500;$i++) {
    $query2 = sprintf("update fever_baby set gender = '%s',weight='%s' where fever_baby._id = 501+'%s'", $distaid[$i][0], $distaid[$i][1],$i);
    mysqli_query($connect, $query2);
}*/
/*
for ($i=0;$i<500;$i++) {
    $query2 = sprintf("insert into fever.md_user(user_id,email,pass,phone_num,country) values ('Userid_%s','%s@naver.com','비번이요','휴대폰 번호요','i like 부싼')", $distaid[$i],$distaid[$i]);
    mysqli_query($connect, $query2);
}*/
//여기까지가 md_user 테이블 만드는 작업!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

/*for ($i=0;$i<500;$i++) {
    $query1=sprintf("insert into fever.md_user(user_id,email,pass,phone_num,country) values ('%s','%s@daum.net','1234','010-1111-1111','부산')",$distaid[$i],$distaid[$i]);
    mysqli_query($connect, $query1);
};*/
//$query1=sprintf("Select md_user._id, shortbaby.weight, shortbaby.gender, shortbaby.born_to_baby from fever.shortbaby Join fever.md_user where md_user.user_id = shortbaby.Aid order by md_user._id") ;
////////////////////////////////////////////////////////

/*
$query1=sprintf("Select md_user._id , shortbaby.born_to_baby from fever.shortbaby Join fever.md_user where md_user.user_id = shortbaby.Aid order by md_user._id") ;
//$query1=sprintf("insert into Test2(user_id, born_date) values ()");
$result23=mysqli_query($connect, $query1);

//full outer join shortbaby on md_user.user_id like CONCAT('%',shortbaby.Aid ,'%') limit 100 ");
$useridbornbaby = array();
static $rr = 0;
while($data = mysqli_fetch_array($result23)) {
    FOR ($j = 0; $j < 2; $j++) {
        if ($j==1){
            $useridbornbaby[$rr][$j]= date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- $data[$j] ,date("Y", $time)));

        }
        else{
            $useridbornbaby[$rr][$j]= $data[$j];
        };
    };
    $rr++;
};
for ($iii=0;$iii<500;$iii++) {
    $query2 = sprintf("insert into Test2 (user_id, born_date) values('%s','%s')", $useridbornbaby[$iii][0], $useridbornbaby[$iii][1]);
    $result222 = mysqli_query($connect, $query2);
};*/
//////////////////////////////////////////////////////여기까지

//$query = "Create table test1 (aid varchar(255), number INT )";

/*echo "<table border width=\"600\" cellpadding=\"5\" align=\"center\">";
static $i=0;
while($row = mysqli_fetch_array($result7)) {

    echo"<tr>";
    echo "<td align='center'>".$row["Aid"]."</td>";
    echo"</tr>";
    $i++;
}
echo $i;*/
/*if (!$result8) {
    echo (mysqli_error($connect));
    exit();
}
echo "</table>";*/

mysqli_close($connect);

?>