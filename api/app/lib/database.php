<?php
namespace App\Lib;

use PDO;

class Database
{
    public static function StartUp()
    {
        // $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
        // $pdo = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
        try {
            $dbhost="VAIO";
            $dbuser="sa";
            $dbpass="123456";
            $dbname="K_MLF_2";
            // $dbh = new PDO("odbc:Driver={SQL Server Native Client 11.0};Server=$dbhost;Database=$dbname; Uid=$dbuser;Pwd=$dbpass;");
            $options = array("CharacterSet" => "UTF-8");
            $dbh = new PDO("odbc:Driver={SQL Server Native Client 11.0};Server=$dbhost;Database=$dbname; Uid=$dbuser;Pwd=$dbpass;charset=UTF8");
            // $dbh -> exec("set names utf8 COLLATE 'utf8_general_ci'");
            // mb_internal_encoding('UTF-8');
            // mb_http_output('UTF-8');
            $dbh -> exec("SET NAMES 'utf8';");
            $dbh -> exec("SET CHARACTER SET utf8");

            $pdo = $dbh;
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        // $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAME'utf8'");
        $pdo->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
        return $pdo;
    }


}
