<!DOCTYPEhtml>
<html>
<head>
    <script type="text/javascript" src="../js/script_btn.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1">
    <link rel="stylesheet"href="../css/stylesheet.css"/>
    <title>送信確認フォーム</title>
<!--PHP-->
<?php
    session_start();
    $_SESSION['name']=$_POST['name'];
    $_SESSION['email']=$_POST['email'];
    if(empty($_POST['phone'])) {
        $_SESSION['phone']="記入無し";
    } else {
        $_SESSION['phone']=$_POST['phone'];
    }

    $value=$_POST['subjectR'];
    if($value=="checkboxA")
    {
        $_SESSION['subject']="〇〇について";
    } elseif($value=="checkboxB") {
        $_SESSION['subject']="△△について";
    } else {
        $_SESSION['subject']=$_POST['subject'];
    }
    $_SESSION['main']=$_POST['main'];
?>
</head>

<body>
    <div id="header_redbar" data-referrer="header_redbar">
        <div class="_Test6">
            <div class="_Test10">
                <div class="_Test5">
                    <h1>
                        <a class="_Test7" href="../index.html" title="メインページへ移動">
                            <u>タイトル</u>
                        </a>
                    <h1>
                </div>
            </div>
        </div>
    </div>
    <div id="style">入力確認画面</div>
        <div class="container">
            <div class="row">
                <div class="conrtainerleft">
                    <div class="col-xs-10col-xs-offset-1"style="margin-top:30px;margin-bottom:30px;">
                    お問い合わせありがとうございます。<br>
                    この内容で送信いたします。<br>
                        <table class="table"style="table-layout:fixed;">
                            <thead><th style="width:200px;"></th><th></th></thead>
                            <tbody>
                                <tr>
                                    <td>[お名前]:</td>
                                    <td>
                                    <?php echo$_SESSION['name'] ;?>
                                </td>
                                </tr>
                                <tr>
                                    <td>[メールアドレス]:</td>
                                    <td>
                                    <?php echo$_SESSION['email']; ?>
                                </td>
                                </tr>
                                <tr>
                                    <td>[電話番号]:</td>
                                <td>
                                    <?php echo$_SESSION['phone']; ?>
                                </td>
                                </tr>
                                <tr>
                                    <td>[件名]:</td>
                                <td>
                                    <?php echo$_SESSION['subject']; ?>
                                </td>
                                </tr>
                                <tr>
                                    <td>[お問い合わせ内容]:</td>
                                <td>
                                    <?php echo$_SESSION['main']; ?>
                                </td>
                                </tr>
                                </tbody>
                        </table>
                        <form action="sendMail.php"method="Post">
                            <button type="submit"class="btnbtn-successbtn-lgbtn-block">送信</button>
                        </form><br>
                        <input type="button" value="前画面に戻る" onClick="history.back()">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>