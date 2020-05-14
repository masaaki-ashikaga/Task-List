<?php
require_once('config.php');
require_once('./helpers/db_helper.php');
require_once('./helpers/common_helper.php');

$dbh = get_db_connect();
$account_id = $_GET['id'];
$account_name = $_GET['name'];
$account_comment = $_GET['comment'];
$tasks = select_task_all($dbh);
$main_user = select_task_main_id($dbh);
$sub_user = select_task_sub_id($dbh);


foreach($tasks as $key => $value){
    
}


// foreach($account_task as $key => $task){
//     foreach($mains as $main){
//         foreach($subs as $sub){
//             if($task['main_user_id'] === $main['main_user_id'] & $task['sub_user_id'] === $sub['sub_user_id']){
//                 var_dump($task);
//             }
//         }
//     }
// }


include_once('./views/account_view.php');

?>
