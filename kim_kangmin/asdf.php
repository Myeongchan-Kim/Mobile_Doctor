<?php
mysql_connect('localhost', 'root', '111111');
mysql_select_db('opentutorials');
switch($_GET['mode']){
    case 'insert':
        $result = mysql_query("INSERT INTO topic (title, description, created) VALUES ('".mysql_real_escape_string($_POST['title'])."', '".mysql_real_escape_string($_POST['description'])."', now())");
        header("Location: list.php");
        break;
    case 'delete':
        mysql_query('DELETE FROM topic WHERE id = '.mysql_real_escape_string($_POST['id']));
        header("Location: list.php");
        break;
    case 'modify':
        mysql_query('UPDATE topic SET title = "'.mysql_real_escape_string($_POST['title']).'", description = "'.mysql_real_escape_string($_POST['description']).'" WHERE id = '.mysql_real_escape_string($_POST['id']));
        header("Location: list.php?id={$_POST['id']}");
        break;
}
?>