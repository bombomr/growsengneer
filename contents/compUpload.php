<html>
    <head>
        <script type="text/javascript" src="../js/script_btn.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>アップロード画面</title>
        <link rel="stylesheet" href="../css/stylesheet.css">
    </head>

    <body>
        <div id="header_redbar" data-referrer="header_redbar">
            <div id="redBar">
                <div class="_Test6">
                    <div class="_Test10">
                        <div class="_Test5">
                            <h1>〇〇</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p><?php
            if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
                if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "../files/" . $_FILES["upfile"]["name"])) {
                    chmod("files/" . $_FILES["upfile"]["name"], 0644);
                        echo $_FILES["upfile"]["name"] . "をアップロードしました。";
                } else {
                    echo "ファイルをアップロードできません。";
                }
            } else {
                echo "ファイルが選択されていません。";
            }
            ?></p>
        <form method="post">
            <input type="button" onClick="history.back()" value="アップロード画面に戻る">
            <input type="button" onClick="backPage(1)" value="メインメニューに戻る">
        </form>
    </body>
</html>
