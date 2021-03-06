<?php
    session_start();
    include "includes/config.php";

    //error_reporting(E_ALL);
    //ini_set("display_errors", 1);

    if( ! $DB_NAME ) {
        die('please create config.php, define $DB_NAME, $DB_USER, $DB_PASS there');
    }

    try {
        $dbh = new PDO($DSN, $DB_USER, $DB_PASS);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,            PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }
    catch (Exception $e) {
        die("Problem connecting to database $DB_NAME as $DB_USER: " . $e->getMessage() );
    }
    

?>
