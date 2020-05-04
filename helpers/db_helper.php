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

function email_exists($dbh, $mail){
    try{
        $sql = "SELECT COUNT(id) FROM users where mail = :mail";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
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
}

    function login_check($dbh, $mail, $pass){
        $sql = 'SELECT * FROM users WHERE mail = :mail LIMIT 1';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($pass, $data['pass'])){
                return $data;
            } else{
                return FALSE;
            }
        }
    }

    function insert_register($dbh, $name, $mail, $pass){  
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users(name, mail, pass) VALUE(:name, :mail, :pass)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
        $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
        $stmt->execute();
    }

    function update_user_data($dbh, $id, $name, $mail, $comment){
        try{
            $sql = "UPDATE users SET name = :name, mail = :mail, comment = :comment WHERE id = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
            $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
            $stmt->execute();
            echo 'アカウント情報を変更しました。';
        } catch(PDOException $e){
            echo 'アカウント情報の変更に失敗しました。';
            echo ($e->getMessage());
            die();
        }

     
        
    }




?>