<?php
//セッション生成
session_start();
//外部ファイルの読み込み
require('../db/db.php');

//POST送信された場合の処理
if(!empty($_POST)) {
    //入力項目NULLチェック
    if($_POST['account'] === '') {
        $error['account'] = 'blank';
    }
    if($_POST['email'] === '') {
        $error['email'] = 'blank';
    }
    if($_POST['password'] === '') {
        $error['password'] = 'blank';
    }

    //入力項目文字数チェック
    if(strlen($_POST['account']) > 10) {
        $error['account'] = 'over';
    }
    if(strlen($_POST['password']) > 15) {
        $error['password'] = 'over';
    }
    if(strlen($_POST['password']) < 8) {
        $error['password'] = 'min';
    }

    //エラーが無かった場合
    if(!isset($error)){
    //DB接続
    $dbh = db_connect();
    //既に登録されたメールアドレスがないか
    //SQLをセット
    $user_email = $dbh->prepare('SELECT customer_id FROM GE_D_CUSTOMER WHERE mail=?');
    //SQLを実行
    $user_email->execute(array(
    $_POST['email']
    ));
    //結果の取得
    $user = $user_email->fetch();

    //結果があった場合
    if(!empty($user)){
    //エラーメッセージ格納
        $error['email'] = 'registered';
    }
}
    //エラーない場合
    if (!isset($error)) {
        //セッションにPOST送信された値を格納
        $_SESSION['register'] = $_POST;
        //HTTPヘッダを送信
        header("Location: registerCheck.php");
        //終了
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<html>
<head>
<meta charset="utf-8">
<title>新規登録画面</title>
</head>

<body>
<form action="" method="post">
<h1>会員登録</h1>
<p>フォームの空欄を埋めてください</p>
<dl>
<dt>アカウント：</dt>
<dd>
<input type="text" name="account" value="<?php echo htmlspecialchars($_POST['account'], ENT_QUOTES); ?>">
<?php if($error['account'] == 'blank'): ?>
<p class="error">アカウント名を入力してください。</p>
<?php endif ?>
</dd>
</dl>

<dl>
<dt>メールアドレス</dt>
<dd>
<input type="text" name="email" value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES); ?>">
<?php if($error['email'] == 'blank'): ?>
<p class="error">メールアドレスを入力してください。</p>
<?php elseif($error['email'] === 'registered'): ?>
<p class="error">既に登録されているメールアドレスです</p>
<?php endif ?>
</dd>
</dl>

<dl>
<dt>パスワード</dt>
<dd>
<input type="password" name="password" value="">
<?php if($error['password'] == 'blank'): ?>
<p class="error">パスワードを入力してください。</p>
<?php elseif($error['password'] === 'over'): ?>
<p class="error">パスワードは15文字以内で入力してください。</p>
<?php elseif($error['password'] === 'min'): ?>
<p class="error">パスワードは8文字以上で入力してください。</p>
<?php endif ?>
</dd>
</dl>

<input type="submit" value="確認画面へ" id="submit">
</form>
</body>
</html>
