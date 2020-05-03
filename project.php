<?php
require_once('./helper/common.php');
require_once('./helper/db_helper.php');
require_once('./login/config.php');

//データベース接続
$dbh = get_db_connect();
$errs = [];
$members = select_members($dbh);
$data = select_data($dbh);

include_once('./views/read_only.php');

?>
