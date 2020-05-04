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


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $dbh = get_db_connect();
    $errs = array();
    
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
            $errs['post'] = 'アカウント情報の変更に失敗しました。入力エラーがあります。';
        }

        if(empty($errs)){
            update_user_data($dbh, $id, $name, $mail, $comment);
        }
    }

}






include_once('./views/dashboard_view.php');

?>
