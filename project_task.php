<?php
require_once('config.php');
require_once('./helpers/db_helper.php');
require_once('./helpers/common_helper.php');

$dbh = get_db_connect();
$data = select_users_data($dbh);
$tasks = select_task_data($dbh);

$id = $_GET['user_id'];
$pj_id = $_GET['id'];

//URLを知っていて直接入力した場合（user_idのみNULLの場合）Member Talbeへ登録できる画面に飛ぶ。**ログイン画面と同じレイアウト
if(!empty($pj_id) & $id === NULL){
    session_start();
    $_SESSION['pass_bill'] = $pj_id;
    header('Location:' .SITE_URL. 'invitation.php');
}

//セッションなければ
// if(!empty($id) & !empty($pj_id) & !empty($_SESSION['pass_bill'])){
     //header('Location:' .SITE_URL. 'dashboard.php');
// }

if(!empty($id) & !empty($pj_id)){  //ID入っていればMembers Tableからデータ取得する。
    $members_data = match_member_data($dbh);
    foreach($members_data as $member_data){ //データを展開する
        foreach($member_data as $member){ //Member Tableのデータを展開
            if($member['user_id'] === $id){ //user_idと一致するMember Tableのデータを抽出
                $project_id[] = $member['project_id']; //抽出されたproject_idを新しく配列に入れる。
            }
        }
        $pass_bill = in_array($pj_id, $project_id); //project_id配列の中に飛ぼうとしているPJページのpj_idが入っているか確認する。
        if($pass_bill === false){
            header('Location:' .SITE_URL. 'dashboard.php'); //project_idに必要なidが入っていなければダッシュボードへリダイレクトする。
        }
    }
}

$main_user = select_task_main_id($dbh);
$sub_user = select_task_sub_id($dbh);

$get_id = $_GET['id'];
$get_pj_name = $_GET['pj_name'];
$get_pj_explain = $_GET['pj_explain'];



if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = get_trim_post('title');
    $deadline = date($_POST['deadline']);
    $today = date("Y-m-d");
    $project_id = $_GET['id'];
    $main_user_id = $_POST['main_user_id'];
    $sub_user_id = $_POST['sub_user_id'];
    var_dump($main_user_id);
    var_dump($sub_user_id);
    $sub_user_name = $_POST['sub_user_name'];
    $errs = array();

    if(isset($_POST['task'])){
        if(mb_strlen($title) === 0 | mb_strlen($title) > 100){
            $errs['title'] = 'タイトルは必須、100文字以内です。';
            var_dump($errs['title']);
        }
    
        if($main_user_id === $sub_user_id){
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
            insert_task_data($dbh, $title, $deadline, $main_user_id, $sub_user_id, $project_id);
            $errs['run'] = 'タスクを追加しました';
        }
    }

    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        delete_task_data($dbh, $id);
        $errs['run'] = 'タスクを削除しました。';
    }
}

include_once('./views/project_task_view.php');

?>
