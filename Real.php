<html>
<head>
    <title>
        "Test output"
    </title>
</head>

<?php

function IOS_babyUpdate($connect){
    $json = $_REQUEST['data'];
    $data = json_decode($json);

    $query = sprintf("select COUNT(*) cnt from baby where Aid = '%s' and baby_id = '%d';", $data->Aid, $data->baby_id);

    $queryResult = mysqli_query($connect,$query);
    $row = mysqli_fetch_array($queryResult);

    if($row["cnt"] == 0){
        $query = sprintf("insert into baby(Aid, baby_id, weight, gender, born_to_day) values('%s', '%d', '%s', '%d','%d');", $data->Aid, $data->baby_id, $data->weight , $data->gender, $data->born_to_day);
    }else{
        $query = sprintf("update baby set weight = '%s', gender = '%d', born_to_day = '%d' where Aid='%s' and baby_id = '%d';", $data->weight , $data->gender, $data->born_to_day, $data->Aid, $data->baby_id);
    }
    mysqli_query($connect,$query);
}

function getDiagnosisList($connect){
    $date = $_REQUEST['date'];

    $arr = array();
    $i = 0;

    $query = sprintf("CALL show_sum_for_1weeks_since_4weeks('%s');", $date);
    $queryResult = mysqli_query($connect,$query);
    while($resultObject = mysqli_fetch_object($queryResult))
    {
        $diagnosis = array("dzNum" => $resultObject->dzNum, "dzName" => $resultObject->dzName, "weekago_1" => $resultObject->weekago_1, "weekago_2" => $resultObject->weekago_2, "weekago_3" => $resultObject->weekago_3, "weekago_4" => $resultObject->weekago_4);
        $arr['data'][$i] = $diagnosis;
        $i++;
    }

    $output = json_encode($arr,JSON_UNESCAPED_UNICODE);

    echo urldecode($output);
}

function lastNotice($connect)
{
    $num = $_REQUEST['last_notice'];

    $queryResult = mysqli_query($connect,"select * from appdata where name='last_notice';");

    $resultObject = mysqli_fetch_object($queryResult);

    if ($num < $resultObject->data){

        $query = sprintf("select _id, contents, CONVERT_TZ(`date`, @@session.time_zone, '+09:00') AS `date`, CONVERT_TZ(`end_date`, @@session.time_zone, '+09:00') AS `end_date`  from Notice where _id = '%d';", $resultObject->data);
        $queryResult = mysqli_query($connect,$query);
        $resultObject = mysqli_fetch_object($queryResult);

        $arr = array();
        $arr['_id'] = $resultObject->_id;
        $arr['contents'] = $resultObject->contents;
        $arr['date'] = $resultObject->date;
        $arr['end_date'] = $resultObject->end_date;

        $output = json_encode($arr,JSON_UNESCAPED_UNICODE);

        echo $output;
    }else{
        echo 0;
    }
}
?>


<?php
$dbid = "appmd";
$dbpw = "appmd2013";
$dbname = "fever";

$connect = mysqli_connect('fever-test.ckpvcour59fy.ap-northeast-2.rds.amazonaws.com:3306', $dbid , $dbpw) or die("<root><result>1000</result><data>Unable to connect to SQL Server</data></root>");
mysqli_select_db($connect,$dbname) or die("<root><result>1001</result><data>Unable to select DataBase</data></root>");
mysqli_query($connect,"set names utf8");
mysqli_query($connect,"set session character_set_connection=utf8;");
mysqli_query($connect,"set session character_set_results=utf8;");
mysqli_query($connect,"set session character_set_client=utf8;");

$userfunc = $_REQUEST['func'];
$userfunc($connect);

mysqli_close($connect);
?>