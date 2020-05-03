<?php
  // メッセージを保存するファイルのパス設定
  define( 'FILENAME', 'message.txt');
  // タイムゾーン設定
  date_default_timezone_set('Asia/Tokyo');
  // 変数の初期化
  $now_date = null;
  $data = null;
  $file_handle = null;
  $split_data = null;
  $message = array();
  $message_array = array();
  $success_message = null;
  $error_message = array();
  $clean = array();

  if( !empty($_POST['btn_submit']) ) {
      // 表示名の入力チェック
      if( empty($_POST['view_name']) ) {
          $error_message[] = '表示名を入力してください。';
      } else {
          $clean['view_name'] = htmlspecialchars( $_POST['view_name'], ENT_QUOTES);
          $clean['view_name'] = preg_replace( '/\\r\\n|\\n|\\r/', '', $clean['view_name']);
      }
      // メッセージの入力チェック
      if( empty($_POST['message']) ) {
          $error_message[] = 'ひと言メッセージを入力してください。';
      } else {
          $clean['message'] = htmlspecialchars( $_POST['message'], ENT_QUOTES);
          $clean['message'] = preg_replace( '/\\r\\n|\\n|\\r/', '<br>', $clean['message']);
      }

      if( empty($error_message) ) {    
          if( $file_handle = fopen( FILENAME, "a") ) {
              // 書き込み日時を取得
              $now_date = date("Y-m-d H:i:s");
              // 書き込むデータを作成
              $data = "'".$clean['view_name']."','".$clean['message']."','".$now_date."'\n";
              //$data = "'".$_POST['view_name']."','".$_POST['message']."','".$now_date."'\n";
              // 書き込み
              fwrite( $file_handle, $data);
              // ファイルを閉じる
              fclose( $file_handle);
              
              $success_message = 'メッセージを書き込みました。';
          }
      }
  }
  if( $file_handle = fopen( FILENAME,'r') ) {
      while( $data = fgets($file_handle) ){
          $split_data = preg_split( '/\'/', $data);
          $message = array(
              'view_name' => $split_data[1],
              'message' => $split_data[3],
              'post_date' => $split_data[5]
          );
          array_unshift( $message_array, $message);
      }
      // ファイルを閉じる
      fclose( $file_handle);
  }
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>日報画面</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../js/script_btn.js"></script>
    <link rel="stylesheet" href="../css/stylesheet.css">
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
    <h1>日報</h1>
    <h4>作業内容を入力後、報告ボタンを押下することで完了です。</h4>
      <?php if( !empty($success_message) ): ?>
      <p class="success_message"><?php echo $success_message; ?></p>
      <?php endif; ?>
      <?php if( !empty($error_message) ): ?>
    <ul class="error_message">
      <?php foreach( $error_message as $value ): ?>
        <li>・<?php echo $value; ?></li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <form method="post">
      <div>
        <label for="view_name">■アカウント名</label><br>
        <input id="view_name" type="text" name="view_name" value="">
      </div>
      <div>
        <label for="message">■報告内容</label><br>
        <textarea id="message" name="message"></textarea>
      </div>
      <button type="submit" name="btn_submit" class="back_button">報告</button>
      <button class="back_button" onclick="backPage(1); return false;">メインメニューへ</button>
      <input type="submit" name="btn_submit" value="報告">
    </form>
    <hr>
    <section>
      <?php if( !empty($message_array) ): ?>
      <?php foreach( $message_array as $value ): ?>
    <article>
      <div class="info">
        <h2><?php echo $value['view_name']; ?></h2>
        <time><?php echo date('Y年m月d日 H:i', strtotime($value['post_date'])); ?></time>
      </div>
      <p><?php echo $value['message']; ?></p>
    </article>
    <?php endforeach; ?>
    <?php endif; ?>
    </section>
    </main>

    <!-- footer -->
    <div class="border"></div>
    <footer class="footer">
      <p class="copyright">growsengneer © 2020</p>
    </footer>
  </body>
</html>