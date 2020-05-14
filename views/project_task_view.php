<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>タスク管理アプリ</title>
</head>

<body>
    <main>
        <h1 class="page-title">プロジェクトタスク</h1>
        <div class='error-display'>
            <?php if(!empty($errs['post'])){
                echo "<p class='error-info' style='color: red; font-size: 13px'>" . $errs['post'] . "</p>";
            } ?>
            <?php if(!empty($errs['run'])){
                echo "<p class='run-info' style='color: #8a8a8a; font-size: 13px'>" . $errs['run'] . "</p>";
            } ?>
        </div>
        <p class="form-title"><?php echo $get_pj_name; ?></p>

        <div class="my-project">
            <div class="task-label">
                <p class="label">タスク名</p>
                <p class="label">完了チェック</p>
            </div>

            <?php if(isset($tasks)):
                  foreach($tasks as $key => $value):
                  foreach($value as $task):
                  if($task['project_id'] === $_GET['id']):
                  foreach($main_user as $main_user_name => $main_name):
                  foreach($sub_user as $sub_user_name => $sub_name):
                  if($task['id'] === $main_name['id'] & $task['id'] === $sub_name['id']):

                   ?>

                <div class="task-list">
                    <div class="task-info">
                        <p class="task-name"><?php echo $task['title'] ?></p>
                        <p class="task-deadline">期限：<?php echo $task['deadline']; ?></p>
                    </div>
                    <p class="task-member">
                        <a href="<?php echo SITE_URL.'account.php?id='.$main_name['main_user_id'].'&name='.$main_name['name'].'&comment='.$main_name['comment'] ;?>" class="account-link">
                            <?php echo $main_name['name'] ?>
                        </a>
                        ｜
                        <a href="<?php echo SITE_URL.'account.php?id='.$sub_name['main_user_id'].'&name='.$sub_name['name'].'&comment='.$sub_name['comment'] ;?>" class="account-link">
                            <?php echo $sub_name['name']; ?>
                        </a>
                    </p>
                    <label class="task-checkbox">
                        <input type="checkbox" name="done_flag" class="task-complete" value="1">
                        <input type="hidden" name="done_flag" class="task-complete" value="0">
                        <span class="checkbox">
                    </label>
                </div>
                <form action="./project_task.php" method="POST">
                    <p><input type="hidden" name="eventid" value="delete"></p>
                    <p><input type="hidden" name="id" value="<?php echo $task['id'] ?>"></p>
                    <div class="delete-btn"><p class="task-delete"><input type="submit" class="task-delete" name="delete" value="削除"></p></div>
                </form>
            <?php endif;
                  endforeach;
                  endforeach;
                  endif;
                  endforeach;
                  endforeach;
                  endif; ?>
        </div>



        <div class="task-add">
            <p class="form-title">タスクを追加</p>
            <div class="account-info">
                <form class="account-info-form" action="<?php echo 'project_task.php?pj_id=' . $_GET['id'] . '&pj_name=' . $_GET['pj_name'] . '&pj_explain=' . $_GET['pj_explain'] ?>" method="POST">
                    <div class="select-member">
                        <p><label for="name">担当者①</label></p>
                        <p style='color: red; font-size: 13px'><?php if(!empty($errs['main_user'])){ echo $errs['main_user']; } ?></p>
                        <p class="member-select">
                            <select name="main_user_id">
                                <?php if(!empty($data)):
                                      foreach($data as $key):
                                      foreach($key as $value):
                                ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name'] ?></option>
                                <?php endforeach;
                                      endforeach;
                                      endif;
                                ?>
                            </select>
                        </p>
                    </div>
                    <div class="select-member">
                        <p><label for="name">担当者②</label></p>
                        <p style='color: red; font-size: 13px'><?php if(!empty($errs['name'])){ echo $errs['name']; } ?></p>
                        <p class="member-select">
                            <select name="sub_user_id">
                                <?php if(!empty($data)):
                                      foreach($data as $key):
                                      foreach($key as $value):
                                ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name'] ?></option>
                                <?php endforeach;
                                      endforeach;
                                      endif;
                                ?>
                            </select>
                        </p>
                    </div>

                    <p><label for="title">タスク名</label></p>
                    <p style='color: red; font-size: 13px'><?php if(!empty($errs['title'])){ echo $errs['title']; } ?></p>
                    <p><input type="text" name="title" class="task"></p>
                    <p><label for="deadline">期限</label></p>
                    <p style='color: red; font-size: 13px'><?php if(!empty($errs['deadline'])){ echo $errs['deadline']; } ?></p>
                    <p><input type="date" name="deadline" class="deadline"></p>
                    <input type="hidden" name="project_id" value="<?php echo $_GET['id']; ?>">
                    <p class="btn"><input type="submit" name="task" class="login-btn" value="追加する"></p>
                </form>
            </div>
        </div>

        <div class="new-project">
            <p class="form-title">このプロジェクトにメンバーを招待する</p>
            <div class="project-make">
                <form class="project-make-form" action="./dashboard.php" method="POST">
                    <p class="form-title">以下のURLを共有してください。</p>
                    <p class="pj-url">
                    <?php echo SITE_URL.'project_task.php?id='.$get_id.'&pj_name='.$get_pj_name.'&pj_explain='.$get_pj_explain ;?>
                    </p>
                </form>
            </div>
        </div>
        <p class="page-link">
            <a href="./dashboard.php" class="dashboard-link">ダッシュボードに戻る</a>
        </p>
    </main>
</body>
</html>