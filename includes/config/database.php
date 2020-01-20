<?php
function getConnection() {
    $dbhost=Properties::DBHOST;
    $dbuser=Properties::DBUSER;
    $dbpass=Properties::DBPASS;
    $dbname=Properties::DBNAME;
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}
?>
