<?php
function db_connect() {
    //DB名とユーザー名、パスワードは任意。
    $dsn = 'mysql:us-cdbr-iron-east-04.cleardb.net;dbname=heroku_1fde2782f9ecf81;charset=utf8';
    $db['host'] = "us-cdbr-iron-east-04.cleardb.net";
    $db['user'] = "b16ffc7ca81c3c";
    $db['password'] = "d38db1c4";
    $db['dbname'] = "heroku_1fde2782f9ecf81";

    $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8;', $db['host'], $db['dbname']);
    //PHPとDBサーバーの接続。
    try {
        $dbh = new PDO($dsn, $db['user'], $db['password']);
        return $dbh;
    } catch (PDOException $e) {
        print('Error: '.$e->getMessage());
        die();
    }
}
