<?php
ini_set('max_execution_time', 3000); // no limit

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

//md_data 테이블 생성 작업
//1. type (1) 의 경우 - 1) Test3 table 만들기
/*$Test3val=array();
$query1=sprintf("Select md_user._id , Fever.Aid, Fever.fever, Fever.date, Fever.baby_id from fever.md_user right Join fever.Fever on md_user.user_id = Fever.Aid where md_user._id < 101028") ;
$result2 = mysqli_query($connect,$query1);
$num_col = mysqli_num_fields($result2);
static $j=0;
while($row = mysqli_fetch_array($result2)){
    for ($i=0;$i<$num_col;$i++){
        $Test3val[$j][$i]=$row[$i];
    }
    $j++;

}

for($i=0;$i<$j;$i++){
    $query2=sprintf("insert into Test3 (column_1, column_2, fever, Test3.date, babyid) values (%d,'%s',%f,'%s',%d)",$Test3val[$i][0],$Test3val[$i][1],$Test3val[$i][2],$Test3val[$i][3],$Test3val[$i][4]);
    $result3 = mysqli_query($connect,$query2);
}
*/
/*
$query1=sprintf("delete from Test3 where fever<0 ") ;
$result2 = mysqli_query($connect,$query1);
*/

////Test 3 이랑 fever_baby랑 합쳐서 md_data에 집어넣기
/*$Test3val1=array();
$Test3val2=array();
$query1=sprintf("Select fever_baby._id, Test3.column_1, Test3.column_2, Test3.fever, Test3.date, Test3.babyid from Test3 Join fever_baby on Test3.column_1 = fever_baby.user_id and Test3.babyid=fever_baby.baby_id ") ;
$result2 = mysqli_query($connect,$query1);
$num_col = mysqli_num_fields($result2);
static $j=0;
while($row = mysqli_fetch_array($result2)){
    for ($i=0;$i<$num_col;$i++){
        $Test3val1[$j][$i]=$row[$i];
        if($i==4){
            $Test3val2[$j]=date('Y-m-d H:i:s',strtotime($row[$i]));
        }
        echo $Test3val1[$j][$i]."||";
    }
    $j++;
    echo"<br>";
}

for($i=0;$i<$j;$i++){
    $query2=sprintf("insert into md_data (baby_id, app_code, type, data_1, date) values (%d,100,1, %2.2f,'%s')",$Test3val1[$i][0],$Test3val1[$i][3],$Test3val2[$i]);
    $result3 = mysqli_query($connect,$query2);
}*/
//////////////////////////////////////////////////////////////////////type 1 완료
///2. type (2) 의 경우 - Test4 table 만들기(._id 때문에)
/*$a1='liquid';
$a2='powdered';
$a3='pill';
$a4='suppository';
$b1='acetaminophen';
$b2='ibuprofen';
$b3='dexibuprofen';
$c='tyrenol';
$Test4val=array();
$query1=sprintf("Select fever_baby._id, fever.fever_baby.user_id, Reducer.Aid, Reducer.baby_id, Reducer.kind, Reducer.volume, Reducer.eat_date from fever.fever_baby Join fever.Reducer where  fever_baby.AID= Reducer.Aid and fever_baby.baby_id = Reducer.baby_id ") ;
$result2 = mysqli_query($connect,$query1);
$num_col = mysqli_num_fields($result2);
static $j=0;
while($row = mysqli_fetch_array($result2)){
    for ($i=0;$i<$num_col;$i++){
        $Test4val[$j][$i]=$row[$i];
    }
    $j++;
};
for($i=0;$i<$j;$i++){
    if($Test4val[$i][4]==1){
        $query2 = sprintf("insert into Test4 (_id, mduserid, Aid, babyid, volume, eatdate, jaehyung, sungboon, reducername) 
                  values (%d,%d,'%s',%d, %2.2f,'%s','%s','%s','%s')", $Test4val[$i][0], $Test4val[$i][1], $Test4val[$i][2], $Test4val[$i][3], $Test4val[$i][5], $Test4val[$i][6],$a1,$b1,$c);
        mysqli_query($connect, $query2);
    }
    elseif($Test4val[$i][4]==2) {
        $query2 = sprintf("insert into Test4 (_id, mduserid, Aid, babyid, volume, eatdate, jaehyung, sungboon, reducername) 
                  values (%d,%d,'%s',%d, %2.2f,'%s','%s','%s','%s')", $Test4val[$i][0], $Test4val[$i][1], $Test4val[$i][2], $Test4val[$i][3], $Test4val[$i][5], $Test4val[$i][6],$a1,$b2,$c);
        $result3 = mysqli_query($connect, $query2);
    }
    elseif($Test4val[$i][4]==3) {
        $query2 = sprintf("insert into Test4 (_id, mduserid, Aid, babyid, volume, eatdate, jaehyung, sungboon, reducername) 
                  values (%d,%d,'%s',%d, %2.2f,'%s','%s','%s','%s')", $Test4val[$i][0], $Test4val[$i][1], $Test4val[$i][2], $Test4val[$i][3], $Test4val[$i][5], $Test4val[$i][6],$a2,$b1,$c);
        $result3 = mysqli_query($connect, $query2);
    }
    elseif($Test4val[$i][4]==4) {
        $query2 = sprintf("insert into Test4 (_id, mduserid, Aid, babyid, volume, eatdate, jaehyung, sungboon, reducername) 
                  values (%d,%d,'%s',%d, %2.2f,'%s','%s','%s','%s')", $Test4val[$i][0], $Test4val[$i][1], $Test4val[$i][2], $Test4val[$i][3], $Test4val[$i][5], $Test4val[$i][6],$a3,$b1,$c);
        $result3 = mysqli_query($connect, $query2);
    }
    elseif($Test4val[$i][4]==5) {
        $query2 = sprintf("insert into Test4 (_id, mduserid, Aid, babyid, volume, eatdate, jaehyung, sungboon, reducername) 
                  values (%d,%d,'%s',%d, %2.2f,'%s','%s','%s','%s')", $Test4val[$i][0], $Test4val[$i][1], $Test4val[$i][2], $Test4val[$i][3], $Test4val[$i][5], $Test4val[$i][6],$a4,$b1,$c);
        $result3 = mysqli_query($connect, $query2);
    }
    elseif($Test4val[$i][4]==6) {
        $query2 = sprintf("insert into Test4 (_id, mduserid, Aid, babyid, volume, eatdate, jaehyung, sungboon, reducername) 
                  values (%d,%d,'%s',%d, %2.2f,'%s','%s','%s','%s')", $Test4val[$i][0], $Test4val[$i][1], $Test4val[$i][2], $Test4val[$i][3], $Test4val[$i][5], $Test4val[$i][6],$a1,$b3,$c);
        $result3 = mysqli_query($connect, $query2);
    }
    elseif($Test4val[$i][4]==7) {
        $query2 = sprintf("insert into Test4 (_id, mduserid, Aid, babyid, volume, eatdate, jaehyung, sungboon, reducername) 
                  values (%d,%d,'%s',%d, %2.2f,'%s','%s','%s','%s')", $Test4val[$i][0], $Test4val[$i][1], $Test4val[$i][2], $Test4val[$i][3], $Test4val[$i][5], $Test4val[$i][6],$a2,$b2,$c);
        $result3 = mysqli_query($connect, $query2);
    }
    elseif($Test4val[$i][4]==8) {
        $query2 = sprintf("insert into Test4 (_id, mduserid, Aid, babyid, volume, eatdate, jaehyung, sungboon, reducername) 
                  values (%d,%d,'%s',%d, %2.2f,'%s','%s','%s','%s')", $Test4val[$i][0], $Test4val[$i][1], $Test4val[$i][2], $Test4val[$i][3], $Test4val[$i][5], $Test4val[$i][6],$a2,$b2,$c);
        $result3 = mysqli_query($connect, $query2);
    }
    elseif($Test4val[$i][4]==9) {
        $query2 = sprintf("insert into Test4 (_id, mduserid, Aid, babyid, volume, eatdate, jaehyung, sungboon, reducername) 
                  values (%d,%d,'%s',%d, %2.2f,'%s','%s','%s','%s')", $Test4val[$i][0], $Test4val[$i][1], $Test4val[$i][2], $Test4val[$i][3], $Test4val[$i][5], $Test4val[$i][6],$a3,$b2,$c);
        $result3 = mysqli_query($connect, $query2);
    }
    elseif($Test4val[$i][4]==10) {
        $query2 = sprintf("insert into Test4 (_id, mduserid, Aid, babyid, volume, eatdate, jaehyung, sungboon, reducername) 
                  values (%d,%d,'%s',%d, %2.2f,'%s','%s','%s','%s')", $Test4val[$i][0], $Test4val[$i][1], $Test4val[$i][2], $Test4val[$i][3], $Test4val[$i][5], $Test4val[$i][6],$a3,$b3,$c);
        $result3 = mysqli_query($connect, $query2);
    }
    elseif($Test4val[$i][4]==11) {
        $query2 = sprintf("insert into Test4 (_id, mduserid, Aid, babyid, volume, eatdate, jaehyung, sungboon, reducername) 
                  values (%d,%d,'%s',%d, %2.2f,'%s','%s','%s','%s')", $Test4val[$i][0], $Test4val[$i][1], $Test4val[$i][2], $Test4val[$i][3], $Test4val[$i][5], $Test4val[$i][6],$a4,$b2,$c);
        $result3 = mysqli_query($connect, $query2);
    }
    else{
        $query2 = sprintf("insert into Test4 (_id, mduserid, Aid, babyid, volume, eatdate, jaehyung, sungboon, reducername) 
                  values (%d,%d,'%s',%d, %2.2f,'%s','%s','%s','%s')", $Test4val[$i][0], $Test4val[$i][1], $Test4val[$i][2], $Test4val[$i][3], $Test4val[$i][5], $Test4val[$i][6],$a4,$b3,$c);
        $result3 = mysqli_query($connect, $query2);
    }
};*/
//$query1=sprintf("delete from Test4");
//$result2 = mysqli_query($connect,$query1);

////////Test4 table을 md_data에 넣기
/*$Test4val1=array();
$Test4val2=array();
$query1=sprintf("Select Test4._id, Test4.volume, Test4.jaehyung, Test4.sungboon, Test4.reducername, Test4.eatdate from Test4 ") ;
$result2 = mysqli_query($connect,$query1);
$num_col = mysqli_num_fields($result2);
static $j=0;
while($row = mysqli_fetch_array($result2)){
    for ($i=0;$i<$num_col;$i++){
        $Test4val1[$j][$i]=$row[$i];
        if($i==5){
            $Test4val2[$j]=date('Y-m-d H:i:s',strtotime($row[$i]));
        }
        echo $Test4val1[$j][$i]."||";
    }
    $j++;
    echo"<br>";
}

for($i=0;$i<$j;$i++){
    $query2=sprintf("insert into md_data (baby_id, app_code, type, data_1, data_2, data_3, data_4, date) 
                    values (%d,100,2, %2.2f,'%s','%s','%s','%s')",$Test4val1[$i][0],$Test4val1[$i][1],$Test4val1[$i][2],$Test4val1[$i][3], $Test4val1[$i][4],$Test4val2[$i]);
    $result3 = mysqli_query($connect,$query2);
}
*/
///////////////////////////////////////////////////////
///2. type (3) 의 경우 - Test5 table 만들기
/*$typ3val=array();
$query1=sprintf("Select fever_baby._id, fever_baby.baby_id, fever_baby.user_id,Fever.event_case, Fever.date, Fever.baby_id from fever.fever_baby Join fever.Fever on fever_baby.AID = Fever.Aid ") ;
$result2 = mysqli_query($connect,$query1);
$num_col = mysqli_num_fields($result2);
static $j=0;
while($row = mysqli_fetch_array($result2)){
    for ($i=0;$i<$num_col;$i++){
        $typ3val[$j][$i]=$row[$i];
        echo $typ3val[$j][$i]."||";
    }
    $j++;
    echo "<br>";

}


for($i=0;$i<$j;$i++){
    $query2=sprintf("insert into Test5 (feverbabyid, feverbabybabyid, feverbabyuserid, Fevereventcase, Feverdate, babyid) values (%d,%d,%d,'%s','%s',%d)",$typ3val[$i][0],$typ3val[$i][1],$typ3val[$i][2],$typ3val[$i][3],$typ3val[$i][4],$typ3val[$i][5]);
    $result3 = mysqli_query($connect,$query2);
}*/
/*$query2=sprintf("delete feverbabybabyid from Test5 where Fevereventcase = '<br /><b>Notice</b>'");
$result3 = mysqli_query($connect,$query2);*/
/////////////////////Test5를 md_data에 넣는 과정
/*
$Test5val1=array();
$Test5val2=array();
$query1=sprintf("Select Test5.feverbabyid, Test5.Fevereventcase, Test5.Feverdate from Test5 ") ;
$result2 = mysqli_query($connect,$query1);
$num_col = mysqli_num_fields($result2);
static $j=0;
while($row = mysqli_fetch_array($result2)){
    for ($i=0;$i<$num_col;$i++){
        $Test5val1[$j][$i]=$row[$i];
        if($i==2){
            $Test5val2[$j]=date('Y-m-d H:i:s',strtotime($row[$i]));
        }
    }
    $j++;

}

for($i=0;$i<$j;$i++) {
    $query2 = sprintf("insert into md_data (baby_id, app_code, type, data_1, date) values (%d,100,3,'%s','%s')", $Test5val1[$i][0], $Test5val1[$i][1], $Test5val2[$i]);
    $result3 = mysqli_query($connect, $query2);
}
*/
////////////////////////////////////////////type(3) 완료!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
////////////////type (4) 의 경우 - 구민이가 함
////////////////type (5) 의 경우 - Test6 만들기
/*$typ3val=array();
$query1=sprintf("Select fever_baby._id, fever_baby.baby_id, fever_baby.AID, Report.start_date, Report.end_date, Report.baby_id from fever.fever_baby Join fever.Report on fever_baby.AID = Report.Aid ") ;
$result2 = mysqli_query($connect,$query1);
$num_col = mysqli_num_fields($result2);
static $j=0;
while($row = mysqli_fetch_array($result2)){
    for ($i=0;$i<$num_col;$i++){
        $typ3val[$j][$i]=$row[$i];
    }
    $j++;

}

for($i=0;$i<$j;$i++){
    $query2=sprintf("insert into Test6 (id, baby_id, Aid, startday, endday, Reportbabyid) values (%d,%d,'%s','%s','%s',%d)",$typ3val[$i][0],$typ3val[$i][1],$typ3val[$i][2],$typ3val[$i][3],$typ3val[$i][4],$typ3val[$i][5]);
    $result3 = mysqli_query($connect,$query2);
}*/

//$query4=sprintf("delete from Test6 where baby_id != Reportbabyid ");
//$result5 = mysqli_query($connect,$query4);
//$query4=sprintf("delete from Test6");
//$result5 = mysqli_query($connect,$query4);


/////////////////////Test6를 md_data에 넣는 과정
/*
$Test5val1=array();
$query1=sprintf("Select Test6.id, Test6.startday, Test6.endday from Test6 ") ;
$result2 = mysqli_query($connect,$query1);
$num_col = mysqli_num_fields($result2);
static $j=0;
while($row = mysqli_fetch_array($result2)){
    for ($i=0;$i<$num_col;$i++){
        $Test5val1[$j][$i]=$row[$i];
    }
    $j++;
}
for($i=0;$i<$j;$i++) {
    $query2 = sprintf("insert into md_data (baby_id, app_code, type, data_1, data_2, data_3) values (%d,100,5,'%s','%s','sdfsdf')", $Test5val1[$i][0], $Test5val1[$i][1], $Test5val1[$i][2]);
    $result3 = mysqli_query($connect, $query2);
}*/


/*
$query1=sprintf("delete from Test3 where fever<0 ") ;
$result2 = mysqli_query($connect,$query1);
*/

////Test 3 이랑 fever_baby랑 합쳐서 md_data에 집어넣기
/*$Test3val1=array();
$Test3val2=array();
$query1=sprintf("Select fever_baby._id, Test3.column_1, Test3.column_2, Test3.fever, Test3.date, Test3.babyid from Test3 Join fever_baby on Test3.column_1 = fever_baby.user_id and Test3.babyid=fever_baby.baby_id ") ;
$result2 = mysqli_query($connect,$query1);
$num_col = mysqli_num_fields($result2);
static $j=0;
while($row = mysqli_fetch_array($result2)){
    for ($i=0;$i<$num_col;$i++){
        $Test3val1[$j][$i]=$row[$i];
        if($i==4){
            $Test3val2[$j]=date('Y-m-d H:i:s',strtotime($row[$i]));
        }
        echo $Test3val1[$j][$i]."||";
    }
    $j++;
    echo"<br>";
}

for($i=0;$i<$j;$i++){
    $query2=sprintf("insert into md_data (baby_id, app_code, type, data_1, date) values (%d,100,1, %2.2f,'%s')",$Test3val1[$i][0],$Test3val1[$i][3],$Test3val2[$i]);
    $result3 = mysqli_query($connect,$query2);
}*/











////////////////////////////////////////////////////////////Test2 만드는 작업
/*$query1=sprintf("Select md_user._id , shortbaby.born_to_baby, shortbaby.baby_id, shortbaby.Aid from fever.shortbaby left Join fever.md_user on md_user.user_id = shortbaby.Aid ") ;
//$query1=sprintf("insert into Test2(user_id, born_date) values ()");
$result23=mysqli_query($connect, $query1);

//full outer join shortbaby on md_user.user_id like CONCAT('%',shortbaby.Aid ,'%') limit 100 ");
$useridbornbaby = array();
static $rr = 0;
while($data = mysqli_fetch_array($result23)) {
    FOR ($j = 0; $j < 4; $j++) {
        if ($j==1){
            $useridbornbaby[$rr][$j]= date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- $data[$j] ,date("Y", $time)));

        }
        else{
            $useridbornbaby[$rr][$j]= $data[$j];
        };
    };
    $rr++;
};
for ($iii=0;$iii<$rr;$iii++) {
    $query2 = sprintf("insert into Test2 (user_id, born_date, baby_id, AID) values('%s','%s','%s','%s')", $useridbornbaby[$iii][0], $useridbornbaby[$iii][1], $useridbornbaby[$iii][2],$useridbornbaby[$iii][3]);
    $result222 = mysqli_query($connect, $query2);
};*/

//$query1=sprintf("delete from Test2 where Test2.user_id= 0");
//$result23=mysqli_query($connect, $query1);

//////////////////////////////////////////////////////여기까지 Test2 작업 완료




/////////////////////////////////////////////////// fever_baby 만드는 작업
////fever_baby에 들어있는 baby_id와 AID를 이용해서 적절한 gender & weight 찾고 fever_baby에 넣는 과정
/*static $distaid = array();
static $distaid2 = array();
$query =sprintf("Select baby_id, AID from fever_baby ");
$resultt=mysqli_query($connect, $query);
static $j=0;
static $t=0;

while($row = mysqli_fetch_array($resultt)){
    for ($i=0;$i<2;$i++){
        $distaid[$j][$i]=$row[$i];
    }
    $j++;
};
for ($i=0;$i<$j;$i++) {
    $query3 = sprintf("Select weight, gender from shortbaby where Aid= '%s' and baby_id= '%s'", $distaid[$i][1], $distaid[$i][0]);
    $resultt2 = mysqli_query($connect, $query3);

    while($row = mysqli_fetch_array($resultt2)){
        for ($ii=0;$ii<2;$ii++){
            $distaid2[$t][$ii]=$row[$ii];

        }
        $t++;

    };
}

for ($i=0;$i<$t;$i++) {
    $query4 = sprintf("update fever_baby set gender = '%s' where fever_baby._id = 5001+ %d",$distaid2[$i][1], $i);
    mysqli_query($connect, $query4);
};
for ($i=0;$i<$t;$i++) {
    $query4 = sprintf("update fever_baby set weight ='%s' where fever_baby._id = 5001+ %d", $distaid2[$i][0], $i);
    mysqli_query($connect, $query4);
};*/
/*
for ($i=0;$i<698;$i++) {
    $query4 = sprintf("update fever_baby set name ='여자아기' where fever_baby._id = 5001+ %d and fever_baby.gender = 1", $i);
    mysqli_query($connect, $query4);
};*/
/////////////////////////////여기까지가 weight & gender + name 넣는 과정
////////////////////////////fever_baby에 user_id, birthday, baby_id, AID 넣는 과정
/*
static $test2= array();
static $j=0;
$query2 = sprintf("select * from Test2");
$result = mysqli_query($connect, $query2);
while ($row = mysqli_fetch_array($result)){
    for ($i=0;$i<4;$i++){
        $test2[$j][$i]=$row[$i];
    }
    $j++;
};

for ($i=0;$i<$j;$i++) {
    $query3 = sprintf("insert into fever_baby (user_id, birthday, baby_id, AID) values ('%s','%s','%s','%s')", $test2[$i][0],$test2[$i][1],$test2[$i][2],$test2[$i][3]);
    mysqli_query($connect, $query3);
}*/

//$query3 = sprintf("delete from fever_baby");
//mysqli_query($connect, $query3);
////////////////////////////여기까지가 user_id, birthday, baby_id, AID 넣는 과정



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