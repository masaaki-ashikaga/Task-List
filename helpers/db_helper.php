<?php

function get_db_connect(){
    $dsn = 'mysql:dbname=task_list;host=localhost;charset=utf8';
    $user='root';
    $password='root';
    try{
        $dbh=new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'データベースの接続に成功しました。';
    }catch (PDOException $e){
        echo 'データベースの接続に失敗しました。';
        echo($e->getMessage());
        die();
    }
    return $dbh;
}

function email_exists($dbh, $email){
    try{
        $sql = "SELECT COUNT(id) FROM users where email = :email";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        if($count['COUNT(id)'] > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    } catch(PDOException $e){
        echo 'メールアドレスのチェックに失敗しました。';
        echo ($e->getMessage());
        die();
    }

    function insert_register_data($dbh, $name, $mail, $pass){
        try{
             $sql = "INSERT INTO users(name, mail, pass) VALUE(:name, :mail, :pass)";
             $stmt = $dbh->prepare($sql);
             $stmt->bindValue(':name', $name, PDO::PARAM_STR);
             $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
             $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
             $stmt->execute();
        } catch(PDOException $e){
            echo 'データの登録に失敗しました。';
        }
    }
}

?>