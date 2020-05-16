<?php
require_once('./helpers/common_helper.php');
require_once('./helpers/db_helper.php');
require_once('./config.php');

session_start();
$data = $_SESSION['data'];
$id = $data['id'];
$user_name = $data['name'];
$user_mail = $data['mail'];
$user_comment = $data['comment'];
$dbh = get_db_connect();
$errs = array();
$projects_id = select_member_project($dbh, $id);
//var_dump($projects_id);
foreach($projects_id as $key){
    foreach($key as $project_id){
        $project_id = $project_id['project_id'];
        //var_dump($project_id);
        $projects[] = select_project_content($dbh, $project_id);
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    if(isset($_POST['account'])){
        $name = get_trim_post('name');
        $mail = get_trim_post('mail');
        $comment = get_trim_post('comment');

        if(mb_strlen($name) === 0 | mb_strlen($name) > 100){
            $errs['name'] = '名前は必須、100文字以内です。';
        }

        if(mb_strlen($mail) === 0 | mb_strlen($mail) > 100){
            $errs['mail'] = 'メールアドレスは必須、100文字以内です。';
        } elseif(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
            $errs['mail'] = 'メールアドレスの形式が正しくないです。';
        }

        if(mb_strlen($comment) > 100){
            $errs['comment'] = 'コメントは100文字以内です。';
        }

        if(!empty($errs)){
            $errs['post'] = 'アカウント情報の変更に失敗しました';
        }

        if(empty($errs)){
            update_user_data($dbh, $id, $name, $mail, $comment);
            $errs['run'] = 'アカウント情報を変更しました';
            $user_name = $name;
        }
    }
    
    if(isset($_POST['project'])){
        $pj_name = get_trim_post('pj_name');
        $pj_explain = get_trim_post('pj_explain');

        if(mb_strlen($pj_name) === 0 | mb_strlen($pj_name) > 100){
            $errs['pj_name'] = 'プロジェクト名は必須、100文字以内です。';
        }

        if(mb_strlen($pj_explain) === 0 | mb_strlen($pj_explain) > 100){
            $errs['pj_explain'] = '説明は必須、100文字以内です。';
        }

        if(!empty($errs)){
            $errs['post'] = 'プロジェクトの作成に失敗しました';
        }

        if(empty($errs)){
            insert_pj_data($dbh, $pj_name, $pj_explain);
            $errs['run'] = 'プロジェクトを作成しました';
        }
    }

}

$data = select_project_data($dbh);

include_once('./views/dashboard_view.php');

?>
