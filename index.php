<?php
//セッション生成
session_start();

//クリックジャッキング対策
//偽装ボタンなどによる意図しない動作を防ぐ。
//外部埋め込み表示を除外し、ページ表示は同一ドメイン内のみ許可。
header('X-FRAME-OPTIONS: SAMEORIGIN');

//HTTPヘッダを明示的に設定
header("Content-type: text/html; charset=utf-8");

//クロスサイトリクエストフォージェリ対策
//偽装URLに強制的リクエストさせ情報を盗み出すことを防ぐ。
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];
?>

<!DOCTYPE HTML>
<html>
  <head>
    <title>GSE | ログイン画面</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- IEを最新状態にする -->
    <meta http-equiv="X-UA-Compatible" content="IE-edge"/>
    <!-- 文書の著書名 -->
    <meta name="author" content=""/>
    <!-- スニペット設定（検索結果の一部に表示） -->
    <meta name="description" content="growsengneerは、知識の習得のみではなく知識を”活かし”、どうお客様に技術を提供するかを追求します。"/>
    <!-- SEO対策 -->
    <meta name="keywords" content="IT人材育成,転職,業界未経験,プログラミング学習,無料">
    <style>
      /*=======================================================
      全体のスタイル
      =======================================================*/
      * {
        margin:0; padding:0; /* 全要素のmargin(要素の内側)・padding(要素の外側)をリセット */
        line-height:1.5; /* 全要素の行の高さを1.5倍にする */
        color:#333333;  /* 文字色 */
      }
      body {
        font-family: 'Corbel';
        background-color:#fafafa;  /* ページ全体の背景色 */
        text-align:center;  /* IE6以下でセンタリングするための対策 */
      }
      /*=======================================================
      ヘッダー部
      =======================================================*/
      /*  */
      /* ヘッダーバー */
      .header_bar{
        position: fixed; /* 固定 */
        width: 100%; /* 横幅 */
        height: 60px; /* 高さ */
        background-color: #545454; /* グレー */
      }
      /* ロゴ */
      .gse_logo {
        font-size: 30px; /* 文字の大きさ */
        padding-top: 5px; /* 高さ */
        padding-right: 950px; /* 右側の幅 */
      }
      /* ロゴの文字 */
      .gse_logo p {
        color:#fafafa;
        font-family: 'Segoe Print';
      }
      /*=======================================================
      コンテンツ部
      =======================================================*/
      .login_contents {
        padding: 100px;
        height: 350px;
        background-color: #ffffff;
      }
      .login_form {
        padding: 90px;
        width: 30%;
        height: 110px;
        border: 2px solid #cccccc;
        margin: 0 auto;
      }
      .login_form_header {
        margin-top: -0.5em;
        font-size: 25px; /* 文字の大きさ */
      }
      .login_frame {
        width: 325px; /* 入力欄の位置（幅） */
      }
      .login_frame_ap {
        width: 200px; /* 入力欄のサイズ */
      }
      .input_line {
        line-height: 35px; /* 入力欄の行間 */
      }
      .login_button {
        line-height: 80px; /* ボタンの位置 */
      }
      button.login_button {
        font-size: 1.0em; /* 文字サイズを1.4emに指定 */
        font-weight: bold; /* 文字の太さをboldに指定 */
        background-color: #545454; /* ボタン色をグレーに指定 */
        color: #fff; /* 文字色を白に指定 */
        border-style: none; /* ボーダーをなくす */
        line-height: 50px; /* ボタンの位置 */
        width: 130px; /* ボタン幅 */
        height: 45px; /* ボタン高さ */
      }
      /*======================================================
      フッター部
      =======================================================*/
      .border {
        border: 1.5px solid #cccccc;
      }
      .footer {
        margin-top: 10px;
        color: #ffffff;
        padding-top: 20px;
        padding-bottom: 20px;
      }
      .copyright {
        text-align: center;
      }
    </style>
  </head>

  <body>
    <!-- header -->
    <header class="header_bar">
      <div class="gse_logo">
        <p>growsengneer</p>
      </div>
    </header>

    <!-- contents -->
    <main class="login_contents">
      <div class="login_form">
        <div class="login_form_header">GESにログイン</div>
        <form action="login/loginCheck.php" method="post">
          <div class="login_frame">
            <span class="input_line"></span>
            <input type="text" class="login_frame_ap" name="account" tabindex="0" placeholder=" input account" autofocus="1" autocomplete="username" area-label="アカウント名を入力してください">
          </div>
          <div class="login_frame">
            <span class="input_line"></span>
            <input type="password" class="login_frame_ap" name="password" tabindex="0" placeholder=" input password" autofocus="current-password" area-label="パスワードを入力してください">
          </div>
          <div class="login_button">
            <button value="1" class="login_button" name="login" tabindex="0" type="submit">ログイン</button>
            <input type="hidden" name="token" value="<?=$token?>">
          </div>
        </form>
      </div>
    </main>

    <!-- footer -->
    <div class="border"></div>
    <footer class="footer">
      <p class="copyright">growsengneer © 2020</p>
    </footer>
  </body>
</html>