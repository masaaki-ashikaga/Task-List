<?php

    //DB接続
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

    //メール重複チェック
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

    //ログイン情報チェック
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

    //users tabel関連
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
        } catch(PDOException $e){
            echo 'アカウント情報の変更に失敗しました。';
            echo ($e->getMessage());
            die();
        }
    }

    function select_users_data($dbh){
        $sql = "SELECT id, name FROM users";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        return $data;

    }

    //projects table関連
    function insert_pj_data($dbh, $pj_name, $pj_explain){
            $sql = "INSERT INTO projects(pj_name, pj_explain) VALUE(:pj_name, :pj_explain)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':pj_name', $pj_name, PDO::PARAM_STR);
            $stmt->bindValue(':pj_explain', $pj_explain, PDO::PARAM_STR);
            $stmt->execute();
    }

    function select_project_data($dbh){
            $sql = "SELECT id, pj_name, pj_explain FROM projects";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
            return $data;
    }
 
    //tasks table関連
    function insert_task_data($dbh, $title, $deadline, $user_id, $project_id){
        try{
            $date = date('Y-m-d');
            $sql = "INSERT INTO tasks(title, user_id, project_id, deadline, timestamp) VALUE(:title, :user_id, :project_id, :deadline, '{$date}')";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':project_id', $project_id, PDO::PARAM_INT);
            $stmt->execute();
            } catch(PDOException $e){
                echo ($e->getMessage());
                die();
            }
    }

    function select_task_data($dbh){
        $sql = "SELECT title, deadline, user_id, project_id, name FROM tasks, users WHERE tasks.user_id = users.id";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
            $tasks[] = $row;
        }
        return $tasks;
    }
    




?>