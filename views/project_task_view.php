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
        <p class="form-title"><?php echo $get_pj_name; ?></p>

        <div class="my-project">
            <div class="task-label">
                <p class="label">タスク名</p>
                <p class="label">完了チェック</p>
            </div>
            <div class="task-list">
                <div class="task-info">
                    <p class="task-name">デザインコーディング</p>
                    <p class="task-limit">期限：2019/3/31</p>
                </div>
                <p class="task-member">糸島｜高橋</p>
                <label class="task-checkbox"><input type="checkbox" name="checkbox" class="task-complete"><span class="checkbox"></label>
            </div>
            <div class="delete-btn"><p class="task-delete">削除</p></div>

            <div class="task-list">
                <div class="task-info">
                    <p class="task-name">デザインコーディング</p>
                    <p class="task-limit">期限：2019/3/31</p>
                </div>
                <p class="task-member">糸島｜高橋</p>
                <label class="task-checkbox"><input type="checkbox" name="checkbox" class="task-complete"><span class="checkbox"></label>
            </div>
            <div class="delete-btn"><p class="task-delete">削除</p></div>

            <div class="task-list">
                <div class="task-info">
                    <p class="task-name">デザインコーディング</p>
                    <p class="task-limit">期限：2019/3/31</p>
                </div>
                <p class="task-member">糸島｜高橋</p>
                <label class="task-checkbox"><input type="checkbox" name="checkbox" class="task-complete"><span class="checkbox"></label>
            </div>
            <div class="delete-btn"><p class="task-delete">削除</p></div>
        </div>

        <div class="task-add">
            <p class="form-title">タスクを追加</p>
            <div class="account-info">
                <form class="account-info-form" action="" method="POST">
                    <div class="select-member">
                        <p><label for="name">担当者①</label></p>
                        <p style='color: red; font-size: 13px'><?php if(!empty($errs['name'])){ echo $errs['name']; } ?></p>
                        <p class="member-select">
                            <select name="user_id[]">
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
                            <select name="user_id[]">
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
                    <p><label for="limit">期限</label></p>
                    <p style='color: red; font-size: 13px'><?php if(!empty($errs['limit'])){ echo $errs['limit']; } ?></p>
                    <p><input type="date" name="limit" class="limit"></p>
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