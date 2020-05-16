<?php
require_once('config.php');
require_once('./helpers/db_helper.php');
require_once('./helpers/common_helper.php');

session_start();
// var_dump($_SESSION['pass_bill']);
// $project_id = $_SESSION['pass_bill'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $mail = get_trim_post('mail');
    $pass = get_trim_post('pass');
    $dbh = get_db_connect();
    $errs = array();

    if(mb_strlen($mail) === 0 | mb_strlen($mail) > 100){
        $errs['mail'] = 'メールアドレスは必須、100文字以内です。';
    } elseif(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
        $errs['mail'] = 'メールアドレスの形式が正しくないです。';
    } elseif(!email_exists($dbh, $mail)){
        $errs['mail'] = 'このメールアドレスは登録されていません。';
    }

    if(mb_strlen($pass) === 0 | mb_strlen($pass) > 100){
        $errs['pass'] = 'パスワードは必須、100文字以内です。';
    } elseif(! $data = login_check($dbh, $mail, $pass)){
        $errs['pass'] = 'メールアドレスかパスワードが正しくありません。';
    }

    if(empty($errs)){
        session_regenerate_id(true);
        $user_id = $data['id'];
        $project_id = $_SESSION['pass_bill'];
        var_dump($user_id);
        var_dump($project_id);
        $_SESSION['user_id'] = $user_id;
        $_SESSION['project_id'] = $project_id;
        $_SESSION['data'] = $data;
        invitation_member($dbh, $user_id, $project_id);
        header('Location:' . SITE_URL . 'dashboard.php');
        exit();  
    }
    
}

include_once('./views/invitation_view.php');

?>
