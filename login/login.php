<?php
//セッション生成
session_start();

//クリックジャッキング対策
//クリック・ボタンなど偽装してクリックを誘い、意図しない動作をさせる
//X-FRAME-OPTIONSは外部から埋め込まれたほかのウェブページを表示を除外する
//フレーム内のページ表示を同一ドメイン内のみ許可
header('X-FRAME-OPTIONS: SAMEORIGIN');

//HTTPヘッダを明示的に設定
header("Content-type: text/html; charset=utf-8");

//CSRF（クロスサイトリクエストフォージェリ）対策
//ログインした状態で悪意ある第三者のURLを強制的にリクエストさせて情報を盗み出す
//openssl_random_pseudo_bytesでランダムなバイト文字列を生成
//base64形式（英数字64種）でエンコード（データ形式の変更）
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];
?>


<!DOCTYPE html>
<html>
    <head>
        <title>ログイン画面 | ようこそgrowsengneerへ</title>
        <meta charset="utf-8">
    </head>

    <body>
        <!-- ヘッダー部 -->
        <h1>
            <a href="../index.html" title="メインページへ移動">
                <u>タイトル</u>
            </a>
            <a href="../user/createUser.php">
                <u>新規アカウント作成はこちら</u>
            </a>
        <h1>

        <!-- メイン部 -->
        <div>
            <span>〇〇にログイン</span>
        </div>

        <form action="loginCheck.php" method="post">
            <div>
                <input type="text" name="account" tabindex="0" placeholder="アカウント名を入力してください" autofocus="1" autocomplete="username" area-label="アカウント名を入力してください">
            </div>
            <div>
                <input type="password" name="password" tabindex="0" placeholder="パスワードを入力してください" autofocus="current-password" area-label="パスワードを入力してください">
            </div>
            <div>
                <!-- PHPで生成したトークンを配置 -->
                <input type="hidden" name="token" value="<?=$token?>">
                <button value="1" name="login" tabindex="0" type="submit">
                    ログイン
                </button>
            </div>
        </form>
        <div>
            <a href="../user/passForget.html" id="forgot-password" target="">
                アカウントを忘れた場合はこちら
            </a>
        </div>

        <!-- ヘッダー部 -->
        <div>
            <li>
                <a href="../footer/test.html">項目</a>
            </li>
            <li>
                <a href="../footer/test.html">項目</a>
            </li>
            <li>
                <a href="../footer/test.html">項目</a>
            </li>
            <div>
                <div>
                    <span>growsengneer © 2020</span>
                </div>
            </div>
        </div>
    </body>
</html>