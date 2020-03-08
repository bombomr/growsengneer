<?php
session_start();

header("Content-type; text/html; charse=utf-8");

if (!isset($_SESSION["account"])) {
    header("Location: ../index.php");
    exit();
}

$_SESSION = array();

if (isset($_COOKIE["PHPSESSID"])) {
    setcookie("PHPSESSID", '', time() - 1800, '/');
}

session_destroy();

echo "<p>ログアウトしました</p>";
?>

<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="../js/script_btn.js"></script>
        <title>ログアウト画面</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/stylesheet.css">
    </head>

    <body>
        <div id="header_redbar" data-referrer="header_redbar">
            <div id="redBar">
                <div class="_Test6">
                    <div class="_Test5">
                        <h1>タイトル</h1>
                    </div>
                </div>
            </div>
        </div>
        <form method="post">
            <input type="button" onClick="backPage(2)" value="ログイン画面に戻る">
        </form>
    </body>
</html>
