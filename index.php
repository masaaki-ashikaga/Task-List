<?php
require_once('config.php');
require_once('./helpers/db_helper.php');
require_once('./helpers/common_helper.php');

if(function_exists('insert_register')){
    var_dump('関数あります。');
} else{
    var_dump('関数未定義');
}

session_start();
if(!empty($_SESSION['member'])){
    header('Location:' . SITE_URL .'dashboard.php');
    exit();
}

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
        $_SESSION['data'] = $data;
        header('Location:' . SITE_URL . 'dashboard.php');
        exit();  
    }
    
}

include_once('./views/index_view.php');

?>
