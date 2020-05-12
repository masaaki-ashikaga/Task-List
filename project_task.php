<?php
require_once('config.php');
require_once('./helpers/db_helper.php');
require_once('./helpers/common_helper.php');

$dbh = get_db_connect();
$data = select_users_data($dbh);
$tasks = select_task_data($dbh);

$main_user = select_task_main_id($dbh);

$sub_user = select_task_sub_id($dbh);
var_dump($sub_user);



$get_id = $_GET['id'];
$get_pj_name = $_GET['pj_name'];
$get_pj_explain = $_GET['pj_explain'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = get_trim_post('title');
    $deadline = date($_POST['deadline']);
    $today = date("Y-m-d");
    $project_id = $_GET['id'];
    $main_user_name = $_POST['main_user_name'];
    $sub_user_name = $_POST['sub_user_name'];
    $errs = array();


    if(isset($_POST['task'])){
        if(mb_strlen($title) === 0 | mb_strlen($title) > 100){
            $errs['title'] = 'タイトルは必須、100文字以内です。';
            var_dump($errs['title']);
        }
    
        if($main_user_name === $sub_user_name){
            $errs['main_user'] = '担当者は2名選択してください。';
        }
    
        if(empty($deadline)){
            $errs['deadline'] = '期限を入力してください。';
            var_dump($errs['deadline']);
        } elseif(strtotime($today) > strtotime($deadline)){
            $errs['deadline'] = '期限の日付が過去の日付です。';
            var_dump($errs['deadline']);
        }
    
        if(!empty($errs)){
            $errs['post'] = 'タスクの追加に失敗しました';
        }
    
        if(empty($errs)){
            $project_id = $_GET['id'];
            insert_task_data($dbh, $title, $deadline, $main_user_name, $sub_user_name, $project_id);
            $errs['run'] = 'タスクを追加しました';
           
        }
    }

    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        var_dump($id);
        delete_task_data($dbh, $id);
        $errs['run'] = 'タスクを削除しました。';
    }
}

include_once('./views/project_task_view.php');

?>
