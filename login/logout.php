<?php
//セッション生成
session_start();

//HTTPヘッダを明示的に設定
header("Content-type: text/html; charset=utf-8");

//アカウント名が入っていない場合の処理
if (!isset($_SESSION["account"])) {
    //ログイン画面に戻る
    header("Location: ../index.php");
    exit();
}

//セッション破棄
session_destroy();

echo "<p>ログアウトしました</p>";
?>

<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="../js/script_btn.js"></script>
        <title>ログアウト画面</title>
        <meta charset="utf-8">
    </head>

    <body>
        <div>
            <h1>タイトル</h1>
        </div>
        <form method="post">
            <input type="button" onClick="backPage(2)" value="ログイン画面に戻る">
        </form>
    </body>
</html>
