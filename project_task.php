<?php
require_once('config.php');
require_once('./helpers/db_helper.php');
require_once('./helpers/common_helper.php');

$dbh = get_db_connect();
$data = select_users_data($dbh);
$tasks = select_task_data($dbh);


$get_id = $_GET['id'];
$get_pj_name = $_GET['pj_name'];
$get_pj_explain = $_GET['pj_explain'];


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = get_trim_post('title');
    $deadline = date($_POST['deadline']);
    $today = date("Y-m-d");
    $project_id = $_GET['id'];
    $id[] = $_POST['user_id'];
    $errs = array();
    var_dump($deadline);

    if(mb_strlen($title) === 0 | mb_strlen($title) > 100){
        $errs['title'] = 'タイトルは必須、100文字以内です。';
        var_dump($errs['title']);
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
        foreach($id as $key){
            if($key[0] !== $key[1]){
                foreach($key as $user_id){
                    insert_task_data($dbh, $title, $deadline, $user_id, $project_id);
                } 
                $errs['run'] = 'タスクを追加しました';
                 header('Location:' . SITE_URL . 'project_task.php/?pj_id=' . $get_id . '&pj_name=' . $get_pj_name . '&get_explain=' . $get_pj_explain);
             } elseif($key[0] === $key[1]){
                $user_id = $key[0];
                insert_task_data($dbh, $title, $deadline, $user_id, $project_id);
                $errs['run'] = 'タスクを追加しました';
            }
        }
    }
}

include_once('./views/project_task_view.php');

?>
