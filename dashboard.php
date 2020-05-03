<?php
require_once('./helpers/common_helper.php');
require_once('./helpers/db_helper.php');
require_once('./config.php');

//データベース接続
$dbh = get_db_connect();


include_once('./views/dashboard_view.php');

?>
