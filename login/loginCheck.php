<?php
//セッション生成
session_start();

//クリックジャッキング対策
//偽装ボタンなどによる意図しない動作を防ぐ。
//外部埋め込み表示を除外し、ページ表示は同一ドメイン内のみ許可。
header('X-FRAME-OPTIONS: SAMEORIGIN');

//HTTPヘッダを明示的に設定
header("Content-type: text/html; charset=utf-8");

//セッショントークンと、POST送信時のトークンが一致しない場合
if ($_POST['token'] != $_SESSION['token']) {
    echo "アクセスエラー：管理者にお問い合わせください";
    exit();
}

//入力値のスペースを削除
function spaceTrim($str) {
    $str = preg_replace('/^[ 　]+/u', '', $str);
    $str = preg_replace('/[ 　]+$/u', '', $str);
    return $str;
}

//エラーを格納する変数
$errors = array();

//POST送信が空の場合
if (empty($_POST)) {
    //ログイン画面に戻る
    header("Location: index.php");
    exit();
} else {
    //変数がセットされていて、NULLでないこと
    $input_account = isset($_POST['account']) ? $_POST['account'] : NULL;
    $input_password = isset($_POST['password']) ? $_POST['password'] : NULL;

    $account = spaceTrim($input_account);
    $password = spaceTrim($input_password);

    //入力チェック
    if ($account == ''):
        $errors['account'] = "アカウントが入力されていません。";
    elseif(mb_strlen($account)>10):
        $errors['account_length'] = "アカウントは10文字以内で入力して下さい。";
    endif;
    if ($password == ''):
        $errors['password'] = "パスワードが入力されていません。";
    elseif(!preg_match('/^[0-9a-zA-Z]{8,15}$/', $_POST["password"])):
        $errors['password_length'] = "パスワードは半角英数字の8文字以上15文字以下で入力して下さい。";
    else:
        //文字列の反復
        $password_hide = str_repeat('*', strlen($password));
    endif;
}

//エラーがない場合
if (count($errors) === 0) {
    try {
        //外部ファイルの読み込み
        require_once("../db/db.php");

        //DB接続情報
        $dbh = db_connect();

        $statement = $dbh->prepare("SELECT account_name, password FROM GE_D_CUSTOMER WHERE account_name = (:account) AND del_flg = 0");
        $statement->bindValue(':account', $account, PDO::PARAM_STR);
        $statement->execute();

        //クエリ実行結果の取得
        if ($row = $statement->fetch()) {
            //ハッシュ化されているDBの値を取得
            $password_hash = $row[password];

            //入力パスワードとハッシュ化パスワードが一致するか
            if (password_verify($password, $password_hash)) {
                //外部ファイルの読み込み
                require_once('../private/ge_conf.php');

                //現在のセッションIDを新しいものに置き換える
                session_regenerate_id(true);

                //入力されたアカウント名をセッションに格納
                $_SESSION['account'] = $account;

                // 権限による画面遷移先の指定
                if ($_SESSION['account'] === ROOT_USER) {
                    //管理者ユーザー
                    header("Location: ../main/adminMainMenue.php");
                    exit();
                } else {
                    //一般ユーザー
                    header("Location: ../main/mainMenue.php");
                    exit();
                }
            } else {
                $errors['password'] = "アカウント及びパスワードが一致しません。";
            }
        } else {
            $errors['account'] = "アカウント及びパスワードが一致しません。";
        }
        //接続オブジェクト破棄
        $dbh = null;
    } catch(PDOException $e) {
        print('Error:'.$e->getMessage());
        die();
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>ログインエラー</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
      .main_contents {
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
    <main class="main_contents">
      <h1 class="login_err">ログインに失敗しました。</h1><br><br>
      <!-- エラーの内容を出力 -->
      <?php if(count($errors) > 0): ?>
      <?php
        foreach($errors as $value) {
            echo "<p>".$value."<p>";
        }
      ?><br>
      <button class="login_button" onclick="history.back()">戻る</button>
      <?php endif; ?>
    </main>

    <!-- footer -->
    <div class="border"></div>
    <footer class="footer">
      <p class="copyright">growsengneer © 2020</p>
    </footer>
  </body>
</html>
