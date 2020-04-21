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


<!DOCTYPE HTML>
<html>
    <head>
        <title>GSEへようこそ | ログイン画面</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
        <!-- 互換モード変更（IEを最新の状態で表示させる） -->
        <meta http-equiv="X-UA-Compatible" content="IE-edge"/>
        <!-- 文書の著者名の設定 -->
        <meta name="author" content=""/>
        <!-- スニペットの設定（検索結果の一部に表示されるもの） -->
        <meta name="description" content="growsengneerは、知識の習得のみではなく知識を”活かし”、どうお客様に技術を提供するかを追求します。"/>
        <!-- SEO対策（検索エンジン最適化） -->
        <meta name="keywords" content="IT人材育成,転職,業界未経験,プログラミング学習,無料">
    </head>

    <body>
        <!-- ヘッダー部 -->
        <div class="header">
            <!-- head_gse_logoは「.png」にする際、利用 -->
            <div class="head_gse_logo">
                <p>growsengneer</p>
            </div>
            <div class="serch_box">
                <div id="searchbox">
                    <div id="searchbox" class="hoge" style="display: none">
                        <label>クイック検索</label>
                        <form class="search" action="../../../../search.html" method="get">
                            <input type="text" name="q" placeholder="クイック検索" />
                            <input type="submit" value="検索" />
                            <input type="hidden" name="check_keywords" value="yes" />
                            <input type="hidden" name="area" value="default" />
                        </form>
                    </div>
                    <script type="text/javascript">$('#searchbox').show(0);</script>
                </div>
            </div>
        </div>
        
        <div class="middleheader login_middle">
            <a>　ログイン画面</a>
        </div>
        <div class="middleheader"></div>

        <!-- メイン部 -->
        <div class="contents">
            <!-- ログインフォーム -->
            <div class="login_form">
                <h2>GSEにログイン</h2>
                <form action="login/loginCheck.php" method="post">
                    <div class="login_frame">
                        <span class="input_line"></span>
                        <input type="text" name="account" tabindex="0" placeholder="account" autofocus="1" autocomplete="username" area-label="アカウント名を入力してください">
                    </div>

                    <div class="login_frame">
                        <span class="input_line"></span>
                        <input type="password" name="password" tabindex="0" placeholder="password" autofocus="current-password" area-label="パスワードを入力してください">
                    </div>

                    <div class="login_button">
                        <!-- PHPで生成したトークンを配置 -->
                        <input type="hidden" name="token" value="<?=$token?>">
                        <button value="1" name="login" tabindex="0" type="submit">ログイン</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- フッター部 -->
        <div class="middlefooter"></div>
        <div class="footer>
            <p class="copyright">
                growsengneer © 2020
            </p>
        </div>
    </body>
</html>