<?php
require_once('./helpers/common_helper.php');
require_once('./helpers/db_helper.php');

//データベース接続

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $name = get_trim_post('name');
    $mail = get_trim_post('mail');
    $mail_check = get_trim_post('mail_check');
    $pass = get_trim_post('pass');
    var_dump($name);
    var_dump($mail);
    var_dump($mail_check);
    var_dump($pass);
    
    $dbh = get_db_connect();
    $errs = array();

    if(strlen($name) === 0 | strlen($name) > 100){
        $errs['name'] = 'お名前は必須、100文字以内です。';
    }

    if(!check_words($mail, 100)){
        $errs['mail'] = 'メールアドレスは必須、100文字以内です。';
    } elseif(email_exists($dbh, $email)){
        $errs['mail'] = '入力されたメールアドレスは登録済みです。';
    }  elseif($mail !== $mail_check){
        $errs['mail'] = '２つのメールアドレスと異なります。同じアドレスをご入力ください。';
    } elseif(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
        $errs['mail'] = 'メールアドレスの形式が正しくないです。';
    }

    if(!check_words($mail_check, 100)){
        $errs['mail_check'] = '確認用メールアドレスは必須、100文字以内です。';
    } elseif($mail !== $mail_check){
        $errs['mail_check'] = '２つのメールアドレスと異なります。同じアドレスをご入力ください。';
    }

    if(!check_words($pass, 100)){
        $errs['pass'] = 'パスワードは必須、100文字以内です。';
    }

    if($mail !== $mail_check){
        $err[] =  'メールアドレスが異なります。2つとも同じメールアドレスをご入力下さい。';
    }

    if(empty($errs)){
        insert_register_data($dbh, $name, $mail, $pass);
    }

    }


include_once('./views/register_view.php');

?>
