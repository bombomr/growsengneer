<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//アカウント名が入っていない場合の処理
if (!isset($_SESSION["account"])) {
    //ログイン画面へ遷移する。
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="js/script_btn.js"></script>
    <meta http-equiv="content-type" content="text/html"; charset=utf8">
    <title>メインメニュー</title>
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
      .mid_bar {
        position: fixed; /* 固定 */
        width: 100%; /* 横幅 */
        height: 30px; /* 高さ */
        background-color: #faa2a2; /* 赤 */
      }
      .mid_bar_contents {
        font-size: 15px; /* 文字の大きさ */
        padding-right: 30px; /* 右側の幅 */
      }
      /*=======================================================
      コンテンツ部
      =======================================================*/
      .main_contents {
        padding: 100px;
        height: 350px;
        background-color: #ffffff;
      }
      .login_form {
        padding: 90px;
        width: 30%;
        height: 100px;
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
      .gse_maincontents {
        margin: 0 auto;
        padding: 90px;
        width: 30%;
        height: 100px;
        font-size: 30px; /* 文字の大きさ */
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
      <div class="mid_bar">
        <a class="mid_bar_contents" role="button" href="../header/overView.html">
          本サイトについて
        </a>
        <a class="mid_bar_contents" role="button" href="../header/inquiry.html">
          問い合わせ 
        </a>
        <a class="mid_bar_contents" href='../index.php'>
          ログアウト
        </a>
      </div>
    </header>

    <!-- contents -->
    <main class="main_contents">
      管理者サイト
    <?php
      //アカウント名を変数に格納
      $account = $_SESSION['account'];

      //特殊文字をHTMLエンティティにする
      echo "<p>ようこそ、".htmlspecialchars($account, ENT_QUOTES)."さん</p>";
    ?>
      <h3>
        コンテンツ一覧
      </h3>
      <ol class="gse_maincontents">
        <li><a href="../contents/fileUpload.html">資料アップロード</a><br>
        <li><a href="../contents/fileDownload.php">資料ダウンロード</a><br>
        <li><a href="../contents/comment.php">日報確認</a><br>
        <li><a href="../user/createUser.php">アカウント作成</a><br>
      </ol>
    </main>

    <!-- footer -->
    <div class="border"></div>
    <footer class="footer">
      <p class="copyright">growsengneer © 2020</p>
    </footer>
  </body>
</html>
