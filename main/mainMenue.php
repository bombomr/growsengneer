<?php
session_start();

header("Content-type; text/html; charset=utf-8");

if (!isset($_SESSION["account"])) {
    header("Location: ../index.php");
    exit();
}

$account = $_SESSION['account'];

echo "<p>ようこそ、".htmlspecialchars($account, ENT_QUOTES)."さん</p>";

?>

<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="js/script_btn.js"></script>
        <meta http-equiv="content-type" content="text/html"; charset=utf8">
        <title>メインメニュー</title>
        <link rel="stylesheet" href="../css/stylesheet.css">
    </head>

    <body>
        <div id="header_redbar" data-referrer="header_redbar">
            <div id="redBar">
                <div class="_Test6">
                    <div class="_Test10">
                        <div class="_Test5">
                            <h1>
                                <a class="_Test7">
                                    <u>タイトル</u>
                                </a>
                            <h1>
                        </div>
                    </div>
                        <div class="signupBanner">
                            <div class="signup_bar_container">
                                <div class="signup_box _Test10">
                                    <a role="button" class="_Test3 _Test8 signup_btn _Test9" href="../header/overView.html">
                                        本サイトについて
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="signupBanner">
                            <div class="signup_bar_container">
                                <div class="signup_box _Test10">
                                    <a role="button" class="_Test3 _Test8 _Test9" href="../header/inquiry.html">
                                        お問い合わせはこちら
                                    </a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="contents">
            <h3 class="section-title">表題</h3>
                テスト用Webサイト
            <ol>
                <li><a href="../contents/fileUpload.html">資料のアップロード</a><br>
                <li><a href="../contents/fileDownload.php">資料のダウンロード</a><br>
                <li><a href="../contents/comment.php">作業報告</a><br>
            </ol>
        </div>

        <div class="fudder">
            <ul>
                <li><a href='../login/logout.php'>ログアウト</a></li>
            </ul>
        </div>
    </body>
</html>
