<?php
session_start();
$_SESSION = array();
if (isset($_COOKIE["userName"])) {
    setcookie("userName", '', time() - 3600);
}
session_destroy();
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
    <h1>
        ログアウトしました
    </h1>
    <p><a href='./index.php'>ログインページに戻る</a></p>
</body>

</html>