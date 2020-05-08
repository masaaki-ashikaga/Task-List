<?php
require_once('config.php');
require_once('./helpers/db_helper.php');
require_once('./helpers/common_helper.php');

$dbh = get_db_connect();
$data = select_users_data($dbh);



if(!empty($_GET)){
    $id = $_GET['id'];
    $pj_name = $_GET['pj_name'];
    $pj_explain = $_GET['pj_explain'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //var_dump($_POST);
    $id[] = $_POST['user_id'];
    $title = $_POST['title'];
    $limit = $_POST['limit'];
    foreach($id as $key => $value){
        $user_id = $value;
        for($i=0; $i<2; $i++){
            $user_id = $users_id[$i];
        }
    }
    // echo '<br>';
    // var_dump($id);
    // echo '<br>';
    // echo '<br>';
    // var_dump($title);
    // echo '<br>';
    // var_dump($limit);
}


include_once('./views/project_task_view.php');

?>
