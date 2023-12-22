<?php
try {
    $option = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false
    );
    $user = 'ueccheee';
    $pass = 'Salmon80!';
    $pdo = new PDO('mysql:charset=UTF8;dbname=logintest;host=localhost', $user, $pass, $option);
} catch (PDOException $e) {
    $error_message[] = $e->getMessage();
}
if (!empty($_POST['btn1'])) {

    $userName = $_POST['userName'];
    $pass = $_POST['pass'];

    if (empty($error_message)) {

        $pdo->beginTransaction();

        try {
            $stmt = $pdo->prepare("INSERT INTO userdata (userName, pass) 
            VALUES (:userName, :pass)");
            $stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
            $stmt->bindParam(':pass', password_hash($pass, PASSWORD_DEFAULT));
            $res = $stmt->execute();
            $res = $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
        }

        if ($res) {
            header("Location: ./index.php");
            exit;
        }
        $stmt = null;
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
        <h1>会員登録画面</h1>
        <form method="post">
            <label>
                <p>ユーザー名</p>
                <input type="text" name="userName">
            </label>
            <label>
                <p>パスワード</p>
                <input type="text" name="pass">
            </label>
            <button type="submit" value="登 録" name="btn1">新規登録</button>
        </form>
    </section>
</body>

</html>