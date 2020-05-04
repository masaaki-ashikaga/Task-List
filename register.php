<?php
require_once('./helpers/common_helper.php');
require_once('./helpers/db_helper.php');

//データベース接続

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    //POSTの受け取りとデータベース接続
    $name = get_trim_post('name');
    $mail = get_trim_post('mail');
    $mail_check = get_trim_post('mail_check');
    $pass = get_trim_post('pass');
    $dbh = get_db_connect();
    $errs = array();

    //$nameの文字数Validation
    if(mb_strlen($name) === 0 | mb_strlen($name) > 100){
        $errs['name'] = 'お名前は必須、100文字以内です。';
    }

    //$mailの文字数と形式Validation
    if(mb_strlen($mail) === 0 | mb_strlen($mail) > 100){
        $errs['mail'] = 'メールアドレスは必須、100文字以内です。';
    } elseif(email_exists($dbh, $mail)){
        $errs['mail'] = '入力されたメールアドレスは登録済みです。';
    }  elseif($mail !== $mail_check){
        $errs['mail'] = '確認用とメールアドレスと異なります。';
    } elseif(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
        $errs['mail'] = 'メールアドレスの形式が正しくないです。';
    }

    //$mail_checkの文字数Validation
    if(mb_strlen($mail_check) === 0 | mb_strlen($mail_check) > 100){
        $errs['mail_check'] = '確認用メールアドレスは必須、100文字以内です。';
    } elseif($mail !== $mail_check){
        $errs['mail_check'] = '上記メールアドレスと異なります';
    }

    //$passの文字数Validation
    if(mb_strlen($pass) === 0 | mb_strlen($pass) > 100){
        $errs['pass'] = 'パスワードは必須、100文字以内です。';
    }

    if(empty($errs)){
        insert_register($dbh, $name, $mail, $pass);
        header('Location: http://localhost/task_list/index.php');
        exit;
    }
    }

include_once('./views/register_view.php');

?>
