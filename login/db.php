<?php
function db_connect() {
    //DB名とユーザー名、パスワードは任意。
    $dsn = 'mysql:host=localhost;dbname=xxx;charset=utf8';
    $user = 'xxx';
    $password = 'xxx';

    //PHPとDBサーバーの接続。
    try {
        $dbh = new PDO($dsn, $user, $password);
        return $dbh;
    } catch (PDOException $e) {
        print('Error: '.$e->getMessage());
        die();
    }
}
