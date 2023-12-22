<?php
session_start();

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

//メモデータ追加
if (isset($_POST['btn1'])) {
    $memo = $_POST['memo'];

    if (empty($error_message)) {
        $pdo->beginTransaction();

        try {
            $stmt = $pdo->prepare("INSERT INTO memodata (userName, memo) 
            VALUES (:userName, :memo)");
            $stmt->bindParam(':userName', $_COOKIE['userName'], PDO::PARAM_STR);
            $stmt->bindParam(':memo', $memo, PDO::PARAM_STR);
            $res = $stmt->execute();
            $res = $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
        }
        if ($res) {
            header("Location: ./myPage.php");
            exit;
        }
        $stmt = null;
    }
}
//メモデータ表示
if (!empty($pdo)) {
    $sql = "SELECT * FROM memodata ORDER BY id desc";
    $memoArray = $pdo->query($sql);
}

//メモデータ削除
if (isset($_POST['delbtn'])) {
    $pdo->beginTransaction();

    if (isset($_POST['chk']) && is_array($_POST['chk'])) {
        $delvalue = $_POST['chk'];
        try {
            foreach ($delvalue as $value) {
                $stmt = $pdo->prepare("DELETE FROM memodata WHERE memo = :memo");
                $stmt->bindValue(':memo', $value, PDO::PARAM_STR);
                $stmt->execute();
            }
            $res = $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
        }
        if ($res) {
            header("Location: ./mypage.php");
            exit;
        }
    }
}

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
    <?php
    if (isset($_COOKIE['userName'])) { ?>
        <h1>ようこそ<?= $_COOKIE['userName']; ?> さん</h1>
        <div class="del-area">
            <form method="post" id="del">
                <button type="submit" name="delbtn" value="delete" class="delbtn">一括削除～～</button>
            </form>
        </div>

        <?php foreach ($memoArray as $memovalue) { ?>
            <?php if ($memovalue['userName'] === $_COOKIE['userName']) { ?>
                <div><?= htmlspecialchars($memovalue['memo'], ENT_QUOTES, 'UTF-8'); ?></div>
                <div class="delcheck">
                    <input type="checkbox" name="chk[]" form="del" value="<?= $memovalue['memo'] ?>" class="checkbtn">
                </div>
            <?php } ?>
        <?php } ?>



        <form method="post">
            <input class="add-memoarea" type="text" name="memo" placeholder="めもを入力" required>
            <label class="add-label">
                <button type="submit" name="btn1" value="add" class="addbtn">めも登録</button>
            </label>
        </form>

        <a href="./logout.php">ログアウト</a>
    <?php } else { ?>
        <p>ログインしてこい。</p>
        <a href="./index.php">ログインしますぅ～～</a>
    <?php } ?>

</body>

</html>