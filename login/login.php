<?php
//セッション用意
session_start();

//HTTPヘッダー情報送信
header("Content-type: text/html; charset=utf-8");

//CSRF対策
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');
?>


<!DOCTYPE html>
<html>
    <head>
        <title>ログイン画面 | ようこそ○○へ</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/stylesheet.css">
    </head>

    <body>
        <div id="header_redbar" data-referrer="header_redbar">
            <div id="redBar">
                <div class="_Test6">
                    <div class="_Test5">
                        <h1>
                            <a class="_Test7" href="../index.html" title="メインページへ移動">
                                <u>タイトル</u>
                            </a>
                        <h1>
                    </div>
                    <div class="signupBanner">
                        <div class="signup_bar">
                            <div class="signup_box clearfix">
                                <a role="button" class="_Test3 _Test8 signup_btn _Test9" href="../user/createAccount.php">
                                    新規アカウント作成はこちら
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="globalContainer">
            <div class="_content _Test10" id="content" role="main">
                <div class="_Test11 _Test12">
                    <div class="_Test15 _Test16 _Test20">
                        <div class="_Test14">
                            <span class="_Test21">〇〇にログイン</span>
                        </div>

                        <form action="loginCheck.php" method="post">
                        <div class="_Test2 _Test1">
                            <input type="text" class="inputtext _Test13" name="account" tabindex="0" placeholder="アカウント名を入力してください" value="" autofocus="1" autocomplete="username" area-label="アカウント名を入力してください">
                        </div>
                        <div class="_Test2 _Test1">
                            <input type="password" class="inputtext _Test13" name="password" tabindex="0" placeholder="パスワードを入力してください" autofocus="current-password" area-label="パスワードを入力してください">
                        </div>
                            <div class="_Test4">
                                <input type="hidden" name="token" value="<?=$token?>">
                                <button value="1" class="_Test3 _Test8 _Test17 _Test19 _Test7" name="login" tabindex="0" type="submit">
                                    ログイン
                                </button>
                            </div>
                        </form>
                        <div class="_Test4">
                            <a href="../user/passForget.html" id="forgot-password" target="">
                                アカウントを忘れた場合
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div>
                <div id="pageFooter" data-referrer="page_footer" data-testid="page_footer">
                    <div id="contentCurve"></div>
                    <li>
                        <a href="../footer/test.html" title="テスト1"></a>
                    </li>
                    <li>
                        <a href="../footer/test.html" title="テスト2"></a>
                    </li>
                    <li>
                        <a href="../footer/test.html" title="テスト3"></a>
                    </li>
                    <div class="copyright">
                        <div>
                            <span>test © 2020</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>