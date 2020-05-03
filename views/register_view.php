<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Sign up| タスク管理アプリ</title>
</head>

<body>
    <main>
        <h1 class="page-title">タスク共有アプリ</h1>
        <p class="form-title">新規登録</p>
        <div class="register-form">
            <form action="./register.php" method="POST">
                <p><label for="mail">Name</label></p>
                    <p style='color: red'><?php if(!empty($errs)){ echo $errs['name']; } ?></p>
                    <p><input type="text" name="name" class="name"></p>
                <p><label for="mail">mail</label></p>
                    <p style='color: red'><?php if(!empty($errs)){ echo $errs['mail']; } ?></p>
                    <p><input type="text" name="mail" class="mail"></p>
                <p><label for="mail_check">mail（確認）</label></p>
                    <p style='color: red'><?php if(!empty($errs)){ echo $errs['mail_check']; } ?></p>
                    <p><input type="text" name="mail_check" class="mail_check"></p>
                <p><label for="pass">password</label></p>
                    <p style='color: red'><?php if(!empty($errs)){ echo $errs['pass']; } ?></p>
                    <p><input type="password" name="pass" class="pass"></p>
                <p class="btn"><input type="submit" class="register-btn" value="会員登録"></p>
            </form>
        </div>
        <div class="login">
            <a href="./index.php" class="login-link">ログインはこちら</a>
        </div>
    </main>
</body>
</html>