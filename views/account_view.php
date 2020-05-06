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
        <p class="form-title">糸島</p>
        <p class="account-comment">一言：無闇にposition使ってすいません</p>
        <p class="possession-task">現在の所有タスク</p>

        <div class="my-project">
            <div class="task-label">
                <p class="label">タスク名</p>
                <p class="label">完了チェック</p>
            </div>
            <div class="task-list">
                <div class="task-info">
                    <p class="task-name">デザインコーディング</p>
                    <p class="task-deadline">期限：2019/3/31</p>
                </div>
                <p class="task-member">糸島｜高橋</p>
                <label class="task-checkbox"><input type="checkbox" name="checkbox" class="task-complete"><span class="checkbox"></label>
            </div>
            <div class="delete-btn"><p class="task-delete">削除</p></div>

            <div class="task-list">
                <div class="task-info">
                    <p class="task-name">デザインコーディング</p>
                    <p class="task-deadline">期限：2019/3/31</p>
                </div>
                <p class="task-member">糸島｜高橋</p>
                <label class="task-checkbox"><input type="checkbox" name="checkbox" class="task-complete"><span class="checkbox"></label>
            </div>
            <div class="delete-btn"><p class="task-delete">削除</p></div>

            <div class="task-list">
                <div class="task-info">
                    <p class="task-name">デザインコーディング</p>
                    <p class="task-deadline">期限：2019/3/31</p>
                </div>
                <p class="task-member">糸島｜高橋</p>
                <label class="task-checkbox"><input type="checkbox" name="checkbox" class="task-complete"><span class="checkbox"></label>
            </div>
            <div class="delete-btn"><p class="task-delete">削除</p></div>
        </div>

        <p class="page-link">
            <a href="./project_task.php" class="pj_task-link">プロジェクトタスクに戻る</a>
        </p>
    </main>
</body>
</html>