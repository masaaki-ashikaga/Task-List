<?php
require_once('config.php');
require_once('./helpers/db_helper.php');
require_once('./helpers/common_helper.php');

$dbh = get_db_connect();
$data = select_users_data($dbh);



if(!empty($_GET)){
    $get_id = $_GET['id'];
    $get_pj_name = $_GET['pj_name'];
    $get_pj_explain = $_GET['pj_explain'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = get_trim_post('title');
    $limit = date($_POST['limit']);
    $project_id = $_GET['id'];
    $id[] = $_POST['user_id'];
    var_dump($limit);
    foreach($id as $key){
        foreach($key as $user_id){
            insert_task_data($dbh, $title, $limit, $user_id, $project_id);
        }
        exit();
        }
    }





include_once('./views/project_task_view.php');

?>
