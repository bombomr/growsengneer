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
        $rep = 1;
        $sze = 1;
        $lst = "../files/";
        $f=$_GET["f"];
        if(file_exists($f)){
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename='.basename($f));
          $fp = fopen($f,"r");
          while (feof($fp) === false){
            print fread($fp,1024);
          }
          exit;
        }
        $drc=dir($lst);
        print("<OL>");
        print("<h1>ダウンロード画面</h1><br>");
        print("<p>下記ファイルをクリックすると、ダウンロードを開始します。<br>※ファイル名(アップ日付 ファイルサイズ)</p>");
        while($fl=$drc->read()) {
          $lfl = $lst."/".$fl;
          $din = pathinfo($lfl);
          if(is_dir($lfl) && ($fl!=".." && $fl!=".")){
            print("<LI>".$din["basename"]."<FONT size='-1'> (ディレクトリ)</FONT></LI>");
          } else if($fl!=".." && $fl!=".") {
            print("<LI>");
            print("<a href=fileDownload.php?f=".urlencode($lst."/".$fl).">".$fl."</a>");
            if($rep == 1 || $sze == 1) print("<FONT size='-1'> (");
            if($rep == 1) echo date("m/d",filemtime($lfl));
            if($rep == 1 && $sze == 1) print(", ");
            if($sze == 1) echo round(filesize($lfl)/1024)."KB";
            if($rep == 1 || $sze == 1) print(")</FONT> ");
            print("</LI>");
          }
        }
        print("</OL>");
        $drc->close();
      ?>
    </p>
    <br><br>
    <form method="post">
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
