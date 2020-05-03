<html>
  <head>
    <title>ファイルアップロード画面</title>
    <script type="text/javascript" src="../js/script_btn.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
      /*=======================================================
      コンテンツ部
      =======================================================*/
      .up_contents {
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
      button.back_button {
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
    <main class="up_contents">
    <p>
      <?php
        if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
          if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "../files/" . $_FILES["upfile"]["name"])) {
            chmod("../files/" . $_FILES["upfile"]["name"], 0644);
            echo $_FILES["upfile"]["name"] . "をアップロードしました。";
          } else {
            echo "ファイルをアップロードできません。";
          }
        } else {
          echo "ファイルが選択されていません。";
        }
      ?>
    </p>
    <br>
    <form method="post">
      <button class="back_button" onclick="history.back(); return false;">前画面に戻る</button>
      <button class="back_button" onclick="backPage(1); return false;">メインメニューへ</button>
    </form>
    </main>

    <!-- footer -->
    <div class="border"></div>
    <footer class="footer">
      <p class="copyright">growsengneer © 2020</p>
    </footer>
  </body>
</html>
