<?php
require_once('config.php');
require_once('./helpers/db_helper.php');
require_once('./helpers/common_helper.php');

$dbh = get_db_connect();
$data = select_users_data($dbh);



if(!empty($_GET)){
    $get_id = $_GET['id'];
    $get_pj_name = $_GET['pj_name'];
    $get_pj_explain = $_GET['pj_explain'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //var_dump($_POST);
    $id[] = $_POST['user_id'];
    foreach($id as $key => $value){
        $title = get_trim_post('title');
        $limit = get_trim_post('limit');
        $project_id = $_GET['id'];
        $user_id = $value[0];
        insert_task_data($dbh, $title, $limit, $user_id, $project_id);
        // for($i=0; $i<2; $i++){
        //     $user_id = $value[$i];  //$user_id一つずつ抽出
        //     var_dump($user_id);
            // $sql = "INSERT INTO tasks(title, limit, user_id) VALUE(:title, :limit, '{$value[$i]}')";
            // $stmt = $dbh->prepare($sql);
            // $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            // $stmt->bindParam(':limit', $limit, PDO::PARAM_STR);
            // $stmt->execute();
        $user_id = $value[1];
        var_dump($user_id);
        }
    }
    // echo '<br>';
    // var_dump($id);
    // echo '<br>';
    // echo '<br>';
    // var_dump($title);
    // echo '<br>';
     var_dump($limit);



include_once('./views/project_task_view.php');

?>
