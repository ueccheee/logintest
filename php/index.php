<?php

session_start();

try {
    $option = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false
    );
    $pdo = new PDO('mysql:charset=UTF8;dbname=logintest;host=localhost', 'ueccheee', 'Salmon80!', $option);
} catch (PDOException $e) {
    $error_message[] = $e->getMessage();
}

if (!empty($_POST['btn1'])) {

    $userName = $_POST['userName'];
    $pass = $_POST['pass'];

    if (empty($error_message)) {

        $stmt = $pdo->prepare('SELECT * FROM userdata where userName = :userName');
        $stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($res && password_verify($pass, $res['pass'])) {
            $_SESSION['userName'] = $userName;
            setcookie('userName', $userName, time() + 3600);
            header("Location: ./mypage.php");
            exit;
        } else {
            echo "IDかパスワードがちがいまーす";
        }
    }
}
$pdo = null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <section>
        <h1>ログインしてください</h1>
        <form method="post">
            <label>
                <p>ユーザー名</p>
                <input type="text" name="userName">
            </label>
            <label>
                <p>パスワード</p>
                <input type="password" name="pass">
            </label>
            <button type="submit" value="登 録" name="btn1">ログイン</button>
        </form>

        <a href="./userAdd.php">会員登録</a>
    </section>
</body>

</html>