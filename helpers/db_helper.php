<?php

    //DB接続
    function get_db_connect(){
        $dsn = 'mysql:dbname=task_list;host=localhost;charset=utf8';
        $user='root';
        $password='root';
        try{
            $dbh=new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

    //dashboardで使用
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
    function insert_task_data($dbh, $title, $deadline, $main_user_id, $sub_user_id, $project_id){
        try{
            $date = date('Y-m-d');
            $project_id = $_GET['pj_id'];
            $sql = "INSERT INTO tasks(title, main_user_id, sub_user_id, project_id, deadline, timestamp) VALUE(:title, :main_user_id, :sub_user_id, :project_id, :deadline, '{$date}')";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
            $stmt->bindValue(':main_user_id', $main_user_id, PDO::PARAM_INT);
            $stmt->bindValue(':sub_user_id', $sub_user_id, PDO::PARAM_INT);
            $stmt->bindValue(':project_id', $project_id, PDO::PARAM_INT);
            $stmt->execute();
            } catch(PDOException $e){
                echo ($e->getMessage());
                die();
            }
    }

    //titleとdeadlineとPJ_idはtasks tableから取得する。
    function select_task_data($dbh){
        $sql = "SELECT id, title, deadline, done_flag, project_id FROM tasks";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetchALL(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        return $data;
    }

    //main_user_idとsub_user_idを別々に取得する（tasks tableのuser_id = users tableのuser_idで取得）。
    function select_task_main_id($dbh){
        $sql = "SELECT * FROM users RIGHT JOIN tasks ON users.id = tasks.main_user_id";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetchALL(PDO::FETCH_ASSOC)){
            $data = $row;
        }
        return $data;
    }

    function select_task_sub_id($dbh){
        $sql = "SELECT * FROM users RIGHT JOIN tasks ON users.id = tasks.sub_user_id";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetchALL(PDO::FETCH_ASSOC)){
            $data = $row;
        }
        return $data;
    }

    function delete_task_data($dbh, $id){
        $sql = "DELETE FROM tasks WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $params = array(':id' => $id);
        $stmt->execute($params);
    }
    
    function select_task_all($dbh){
        $sql = "SELECT id, title, deadline, done_flag, main_user_id, sub_user_id, project_id FROM tasks";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetchALL(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        return $data;
    }

    function match_member_data($dbh){
        $sql = "SELECT user_id, project_id FROM members";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetchALL(PDO::FETCH_ASSOC)){
            $member_data[] = $row;
        }
        return $member_data;
    }

    function invitation_member($dbh, $user_id, $project_id){
        $sql = "INSERT INTO members(user_id, project_id) VALUE(:user_id, :project_id)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->bindValue(':project_id', $project_id, PDO::PARAM_STR);
        $stmt->execute();
    }

    function select_member_project($dbh, $id){
        $sql = "SELECT project_id FROM members WHERE user_id = :user_id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':user_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        while($row = $stmt->fetchALL(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        return $data;
    }

    function select_project_content($dbh, $project_id){
        $sql = "SELECT * FROM projects WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $project_id, PDO::PARAM_INT);
        $stmt->execute();
        while($row = $stmt->fetchALL(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        return $data;
    }

    function members_data($dbh, $pj_id){
        $sql = "SELECT * FROM members WHERE project_id = :project_id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':project_id', $pj_id, PDO::PARAM_INT);
        $stmt->execute();
        while($row = $stmt->fetchALL(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        return $data;
    }

    function select_user_name($dbh, $user_id){
        $sql = "SELECT id, name FROM users WHERE id = :user_id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        while($row = $stmt->fetchALL(PDO::FETCH_ASSOC)){
            $data = $row;
        }
        return $data;
    }

    function update_task($dbh, $id, $done_flag){
        $sql = "UPDATE tasks SET done_flag = :done_flag WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':done_flag', $done_flag, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }


?>