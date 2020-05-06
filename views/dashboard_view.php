<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Dash Board | タスク管理アプリ</title>
</head>

<body>
    <main>
        <h1 class="page-title">ダッシュボード</h1>
            <div class='error-display'>
        <?php if(!empty($errs['post'])){
            echo "<p class='error-info' style='color: red; font-size: 13px'>" . $errs['post'] . "</p>";
        } ?>
        <?php if(!empty($errs['run'])){
            echo "<p class='run-info' style='color: #8a8a8a; font-size: 13px'>" . $errs['run'] . "</p>";
        } ?>
        </div>
        <p class="form-title">XXXさんが参加しているプロジェクト</p>

        <div class="my-project">
            <div class="project-list">
                <p class="project-name">XXX会社WEBシステム</p>
                <p class="project-link"><a href="" class="project-link">タスクへ</a></p>
            </div>
            <div class="project-list">
                <p class="project-name">XXX会社WEBシステム</p>
                <p class="project-link"><a href="" class="project-link">タスクへ</a></p>
            </div>
            <div class="project-list">
                <p class="project-name">XXX会社WEBシステム</p>
                <p class="project-link"><a href="" class="project-link">タスクへ</a></p>
            </div>
        </div>

        <div class="account">
            <p class="form-title">アカウント情報</p>
            <div class="account-info">
                <form class="account-info-form" action="./dashboard.php" method="POST">
                    <p><label for="name">名前</label></p>
                    <p style='color: red; font-size: 13px'><?php if(!empty($errs['name'])){ echo $errs['name']; } ?></p>
                    <p><input type="text" name="name" class="name"></p>
                    <p><label for="mail">メール</label></p>
                    <p style='color: red; font-size: 13px'><?php if(!empty($errs['mail'])){ echo $errs['mail']; } ?></p>
                    <p><input type="text" name="mail" class="mail"></p>
                    <p><label for="comment">一言</label></p>
                    <p style='color: red; font-size: 13px'><?php if(!empty($errs['comment'])){ echo $errs['comment']; } ?></p>
                    <p><input type="text" name="comment" class="comment"></p>
                    <p class="btn"><input type="submit" name="account" class="login-btn" value="変更する"></p>
                </form>
            </div>
        </div>

        <div class="new-project">
            <p class="form-title">プロジェクトを作る</p>
            <div class="project-make">
                <form class="project-make-form" action="./dashboard.php" method="POST">
                    <p><label for="pj_name">プロジェクト名</label></p>
                    <p style='color: red; font-size: 13px'><?php if(!empty($errs['pj_name'])){ echo $errs['pj_name']; } ?></p>
                    <p><input type="text" name="pj_name" class="name"></p>
                    <p><label for="explain">説明</label></p>
                    <p style='color: red; font-size: 13px'><?php if(!empty($errs['pj_explain'])){ echo $errs['pj_explain']; } ?></p>
                    <p><textarea name="pj_explain" class="explain" cols="42" rows="5"></textarea></p>
                    <p class="btn"><input type="submit" name="project" class="login-btn" value="作成する"></p>
                </form>
            </div>
        </div>
    </main>
</body>
</html>