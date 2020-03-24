<?php
function db_connect() {
    //DB名とユーザー名、パスワードは任意。
    $dsn = 'mysql:us-cdbr-iron-east-04.cleardb.net;dbname=heroku_1fde2782f9ecf81;charset=utf8;unix_socket=/tmp/mysql.sock';
    $user = 'b16ffc7ca81c3c';
    $password = 'd38db1c4';

    //PHPとDBサーバーの接続。
    try {
        $dbh = new PDO($dsn, $user, $password);
        return $dbh;
    } catch (PDOException $e) {
        print('Error: '.$e->getMessage());
        die();
    }
}
