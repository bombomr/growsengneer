<?php
session_start();

//セッションが無い場合
if(!isset($_SESSION['register'])) {
    //HTTPヘッダ送信
    header('Location: createUser.php');
    //終了
    exit();
}

try {
    require('../db/db.php');
    $dbh = db_connect();
    //トランザクション開始
    $dbh->beginTransaction();

    if(!empty($_POST)) {
        $statement = $dbh->prepare('INSERT INTO GE_D_CUSTOMER SET account_name=?, mail=?, password=?;');
        $statement->execute(array(
            $_SESSION['register']['account'],
            $_SESSION['register']['email'],
            //パスワードのハッシュ化
                password_hash($_SESSION['register']['password'],PASSWORD_DEFAULT)
        ));
        //コミット
        $dbh->commit();

        //セッションの要素削除
        unset($_SESSION['register']);

        //HTTPヘッダの送信
        header('Location: registerUser.html');
        //終了
        exit();
    } 
} catch(PDOException $e) {
    //エラーの場合、ロールバック
    $dbh->rollBack();
    //メッセージ内容の出力
    echo $e->getMessage();
    //終了
    die();
}
//DBオブジェクト破棄
$dbh = null;
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>確認画面</title>
</head>
<body>
<form action="" method="post">
<input type="hidden" name="submit" value="">
<p>下記の内容を確認してください。</p>
<dl>
<dt>名前</dt>
<dd>
<?php echo htmlspecialchars($_SESSION['register']['account'], ENT_QUOTES); ?>
</dd>
</dl>

<dl>
<dt>メールアドレス</dt>
<dd>
<?php echo htmlspecialchars($_SESSION['register']['email'], ENT_QUOTES); ?>
</dd>
</dl>

<dl>
<dt>パスワード</dt>
<dd>
<p><strong>【表示されません】</strong></p>
</dd>
</dl>

<a href="createUser.php?action=rewrite">&laquo;&nbsp;修正する</a>
<input type="submit" value="登録する" id="submit">
</form>
</body>
</html>
