<?php
if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$dbid = "appmd";
$dbpw = "appmd2013";
$dbname = "fever";

$connect = mysqli_connect('fever-test.ckpvcour59fy.ap-northeast-2.rds.amazonaws.com:3306', $dbid , $dbpw) or die("<root><result>1000</result><data>Unable to connect to SQL Server</data></root>");
mysqli_select_db($connect,$dbname) or die("<root><result>1001</result><data>Unable to select DataBase</data></root>");
mysqli_query($connect,"set names utf8");
mysqli_query($connect,"set session character_set_connection=utf8;");
mysqli_query($connect,"set session character_set_results=utf8;");
mysqli_query($connect,"set session character_set_client=utf8;");


$sql = 'select count(*) as cnt from md_user';
$result = mysqli_query($connect,$sql);
$row = mysqli_fetch_array($result);
$allPost = $row['cnt'];
$onePage = 10;
$allPage = ceil($allPost / $onePage);

if($page < 1 || ($allPage && $page > $allPage)) {
    ?>
    <script>
        alert("존재하지 않는 페이지입니다.");
        history.back();
    </script>
    <?php
    exit;
}

$oneSection = 10;
$currentSection = ceil($page / $oneSection);
$allSection = ceil($allPage / $oneSection);

$firstPage = ($currentSection * $oneSection) - ($oneSection - 1);

if($currentSection == $allSection) {
    $lastPage = $allPage;
} else {
    $lastPage = $currentSection * $oneSection;
}

$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

$paging = '<ul>'; // 페이징을 저장할 변수

//첫 페이지가 아니라면 처음 버튼을 생성
if($page != 1) {
    $paging .= '<li class="page page_start"><a href="./paging.php?page=1">처음</a></li>';
}
//첫 섹션이 아니라면 이전 버튼을 생성
if($currentSection != 1) {
    $paging .= '<li class="page page_prev"><a href="./paging.php?page=' . $prevPage . '">이전</a></li>';
}

for($i = $firstPage; $i <= $lastPage; $i++) {
    if($i == $page) {
        $paging .= '<li class="page current">' . $i . '</li>';
    } else {
        $paging .= '<li class="page"><a href="./paging.php?page=' . $i . '">' . $i . '</a></li>';
    }
}

//마지막 섹션이 아니라면 다음 버튼을 생성
if($currentSection != $allSection) {
    $paging .= '<li class="page page_next"><a href="./paging.php?page=' . $nextPage . '">다음</a></li>';
}

//마지막 페이지가 아니라면 끝 버튼을 생성
if($page != $allPage) {
    $paging .= '<li class="page page_end"><a href="./paging.php?page=' . $allPage . '">끝</a></li>';
}
$paging .= '</ul>';

/* 페이징 끝 */
$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
$sqlLimit = "LIMIT".$onePage."OFFSET".$currentLimit; //limit sql 구문

$sql2 = "select (*) from md_user "."$sqlLimit"; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
$result2 = mysqli_query($connect,$sql2);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>자유게시판 </title>
</head>
<body>
<article class="boardArticle">
    <h3>자유게시판</h3>
    <div id="boardList">
        <table>
            <caption class="readHide">자유게시판</caption>
            <thead>
            <tr>
                <th scope="col" class="no">번호</th>
                <th scope="col" class="id">어플리케이션 User id </th>
            </tr>
            </thead>
            <tbody>
            <?php
            while($row=mysqli_fetch_array($result2))
            {
                ?>
                <tr>
                    <td class="no"><?php echo $row['b_no']?></td>
                    <td class="id">
                        <a href="view.php?bno=<?php echo $row['b_no']?>"><?php echo $row['b_title']?></a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="btnSet">
            <a href="./write.php" class="btnWrite btn">글쓰기</a>
        </div>
        <div class="paging">
            <?php echo $paging ?>
        </div>
    </div>
</article>
</body>
</html>