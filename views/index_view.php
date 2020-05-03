<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Login Page | タスク管理アプリ</title>
</head>

<body>
    <main>
        <h1 class="page-title">タスク共有アプリ</h1>
        <p class="form-title">ログインフォーム</p>
        <div class="login-form">
            <form action="index.php" method="POST">
                <p><label for="mail">mail</label></p>
                <p><input type="text" name="mail" class="mail"></p>
                <p><label for="pass">password</label></p>
                <p><input type="password" name="pass" class="pass"></p>
                <p class="btn"><input type="submit" class="login-btn" value="ログイン"></p>
            </form>
        </div>
        <div class="register">
            <a href="./register.php" class="register-link">新規登録はこちら</a>
        </div>
    </main>
</body>
</html>