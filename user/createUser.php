<?php
//セッション生成
session_start();

//外部ファイルの読み込み
require('../db/db.php');

//POST送信された場合の処理
if(!empty($_POST)) {
    //入力項目のNULLチェック
    if($_POST['account'] === '') {
        $error['account'] = 'blank';
    }
    if($_POST['email'] === '') {
        $error['email'] = 'blank';
    }
    if($_POST['password'] === '') {
        $error['password'] = 'blank';
    }

    //入力項目の文字数チェック
    //10文字以下
    //文字列の長さを取得
    if(mb_strlen($_POST['account']) > 10) {
        $error['account'] = 'over';
    }
    //半角英数字8文字以上15文字以下
    //正規表現によるマッチング
    if (!preg_match('/^[0-9a-zA-Z]{8,15}$/', $_POST["password"])) {
        $error['password'] = 'maxmin';
    }

    //入力エラーが無かった場合の処理
    //エラー変数に値が入っていないか
    if(!isset($error)){
    //DB接続オブジェクトの呼び出し
    $dbh = db_connect();

    //入力したアドレスが既に登録済みでないか確認
    //prepare利用し、SQLインジェクション対策
    //クエリ発行
    $user_email = $dbh->prepare('SELECT customer_id FROM GE_D_CUSTOMER WHERE mail=?');

    //クエリ実行
    $user_email->execute(array(
    $_POST['email']
    ));

    //結果の取得
    $user = $user_email->fetch();

    //取得した結果があった場合（メアドがDBにあった）の処理
    if(!empty($user)){
        $error['email'] = 'registered';
    }
}

    //すべてのチェックでエラーがなかった場合の処理
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
<?php elseif($error['account'] === 'over'): ?>
<p class="error">アカウント名は10文字以内で入力してください。</p>
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
<?php elseif($error['password'] === 'maxmin'): ?>
<p class="error">パスワードは8文字以上15文字以内で入力してください。</p>
<?php endif ?>
</dd>
</dl>

<input type="submit" value="確認画面へ" id="submit">
</form>
</body>
</html>
