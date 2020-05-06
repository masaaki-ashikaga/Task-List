<?php
require_once('config.php');
require_once('./helpers/db_helper.php');
require_once('./helpers/common_helper.php');

$dbh = get_db_connect();
$data = select_users_data($dbh);
var_dump($data);

if(!empty($_GET)){
    $id = $_GET['id'];
    $pj_name = $_GET['pj_name'];
    $pj_explain = $_GET['pj_explain'];
}


include_once('./views/project_task_view.php');

?>
