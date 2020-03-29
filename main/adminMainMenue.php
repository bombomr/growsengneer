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

//アカウント名を変数に格納
$account = $_SESSION['account'];

//特殊文字をHTMLエンティティにする
echo "<p>ようこそ、".htmlspecialchars($account, ENT_QUOTES)."さん</p>";

?>

<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="js/script_btn.js"></script>
        <meta http-equiv="content-type" content="text/html"; charset=utf8">
        <title>メインメニュー</title>
    </head>

    <body>
        <!-- ヘッダー部 -->
        <h1>
            <a class="_Test7">
                <u>タイトル</u>
            </a>
        <h1>

        <div>
            <a role="button" href="../header/overView.html">
                本サイトについて
            </a>
        </div>

        <div>
            <a role="button" href="../header/inquiry.html">
                お問い合わせはこちら
            </a>
        </div>

        <!-- メイン部 -->
        <div>
            管理者サイト
            <h3>
                コンテンツ一覧
            </h3>
            <ol>
                <li><a href="../contents/fileUpload.html">資料アップロード</a><br>
                <li><a href="../contents/fileDownload.php">資料ダウンロード</a><br>
                <li><a href="../contents/comment.php">日報確認</a><br>
            </ol>
        </div>

        <!-- フッダー部 -->
        <div>
            <a href='../login/logout.php'>ログアウト</a>
        </div>
    </body>
</html>
