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
        <h1 class="page-title">アカウント画面</h1>
        <p class="form-title"><?php echo $account_name; ?></p>
        <p class="account-comment">一言：<?php echo $account_comment; ?></p>
        <p class="possession-task">現在の所有タスク</p>

        <div class="my-project">
            <div class="task-label">
                <p class="label">タスク名</p>
                <p class="label">完了チェック</p>
            </div>

            <?php if(isset($tasks)):
                  foreach($tasks as $key => $value):
                  foreach($value as $task):
                  if($task['main_user_id'] === $_GET['id'] | $task['sub_user_id'] === $_GET['id']):
                  foreach($main_user as $main_user_name => $main_name):
                  foreach($sub_user as $sub_user_name => $sub_name):
                  if($task['id'] === $main_name['id'] & $task['id'] === $sub_name['id']): ?>
                <div class="task-list">
                    <div class="task-info">
                        <p class="task-name"><?php echo $task['title']; ?></p>
                        <p class="task-deadline">期限：<?php echo $task['deadline']; ?></p>
                    </div>
                    <p class="task-member"><?php echo $main_name['name'] ?>｜<?php echo $sub_name['name'] ?></p>
                    <label class="task-checkbox"><input type="checkbox" name="checkbox" class="task-complete"><span class="checkbox"></label>
                </div>
                <div class="delete-btn"><p class="task-delete">削除</p></div>
            <?php endif;
                  endforeach;
                  endforeach;
                  endif;
                  endforeach;
                  endforeach;
                  endif; ?>

        <p class="page-task-link">
        <a href="<?php echo SITE_URL.'project_task.php?id='.$pj_id.'&pj_name='.$pj_name.'&pj_explain='.$pj_explain . '&user_id='. $user_id ;?>" class="pj_task-link">プロジェクトタスクに戻る</a>
        </p>
    </main>
</body>
</html>