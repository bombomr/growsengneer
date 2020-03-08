<?php
session_start();

header("Content-type: text/html; charset=utf-8");

if ($_POST['token'] != $_SESSION['token']) {
    echo "不正アクセスの可能性あり";
    exit();
}

header('X-FRAME-OPTIONS: SAMEORIGIN');

require_once("db.php");
$dbh = db_connect();

function spaceTrim($str) {
    $str = preg_replace('/^[ 　]+/u', '', $str);
    $str = preg_replace('/[ 　]+$/u', '', $str);
    return $str;
}

$errors = array();

if (empty($_POST)) {
    header("Location: login.php");
    exit();
} else {
    $account = isset($_POST['account']) ? $_POST['account'] : NULL;
    $password = isset($_POST['password']) ? $_POST['password'] : NULL;

    $account = spaceTrim($account);
    $password = spaceTrim($password);

    if ($account == ''):
        $errors['account'] = "アカウントが入力されていません。";
    elseif(mb_strlen($account)>10):
        $errors['account_length'] = "アカウントは10文字以内で入力して下さい。";
    endif;

    if ($password == ''):
        $errors['password'] = "パスワードが入力されていません。";
    elseif(!preg_match('/^[0-9a-zA-Z]{5,30}$/', $_POST["password"])):
        $errors['password_length'] = "パスワードは半角英数字の5文字以上30文字以下で入力して下さい。";
        else:
        $password_hide = str_repeat('*', strlen($password));
    endif;
}

if (count($errors) === 0) {
    try {
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $statement = $dbh->prepare("SELECT * FROM member WHERE account = (:account) AND flag = 1");
        $statement->bindValue(':account', $account, PDO::PARAM_STR);
        $statement->execute();

        if ($row = $statement->fetch()) {
            $password_hash = $row[password];

            if (password_verify($password, $password_hash)) {
                session_regenerate_id(true);
                $_SESSION['account'] = $account;
                header("Location: ../main/mainMenue.php");
                exit();
            } else {
                $errors['password'] = "アカウント及びパスワードが一致しません。";
            }
        } else {
            $errors['account'] = "アカウント及びパスワードが一致しません。";
        }
        $dbh = null;
    } catch(PDOException $e) {
        print('Error:'.$e->getMessage());
        die();
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>ログイン確認画面</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/stylesheet.css">
    </head>

    <body>
        <div class="_Test6">
            <div class="_ohe">
                <h1>
                    <a class="_Test7">
                        <u>ログイン</u>
                    </a>
                </h1>
            </div>
        </div>
        <h1>ログインエラー</h1>
        <?php if(count($errors) > 0): ?>
        <?php
            foreach($errors as $value) {
                echo "<p>".$value."<p>";
            }
        ?>
        <input type="button" value="戻る" onClick="history.back()">
        <?php endif; ?>
    </body>
</html>
