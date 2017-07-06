<?php
$babyid=$_GET['babyid'];
?>
<html>
<body>
<br>
<center><h1> Select data </h1></center>
<br><br><br><br><br><br><br>
<?php
    echo "<center><h1><a href='view_fever.php?babyid= ".$babyid."'>열</a></h1></center>";
    echo "<center><h1><a href='view_reducer.php?babyid= ".$babyid."'>해열제</a></h1></center>";
    echo "<center><h1><a href='view_type3.php?babyid= ".$babyid."'>결과리포트</a></h1></center>";
    echo "<center><h1><a href='view_type4.php?babyid= ".$babyid."'>메모</a></h1></center>";
    echo "<center><h1><a href='view_type5.php?babyid= ".$babyid."'>종합레포트 날짜</a></h1></center>";

?>


</body>
</html>