<?php
require_once('config.php');
require_once('./helpers/db_helper.php');
require_once('./helpers/common_helper.php');

$dbh = get_db_connect();
session_start();

if(empty($_SESSION['data'])){
        header('Location:' .SITE_URL. 'index.php');
    }
    
$user_id = $_SESSION['data']['id'];
$account_id = $_GET['id'];
$account_name = $_GET['name'];
$account_comment = $_GET['comment'];
$pj_id =$_GET['pj_id'];
$pj_name = $_GET['pj_name'];
$pj_explain = $_GET['pj_explain'];

$tasks = select_task_all($dbh);
//var_dump($tasks);
$main_user = select_task_main_id($dbh);
$sub_user = select_task_sub_id($dbh);



include_once('./views/account_view.php');

?>
