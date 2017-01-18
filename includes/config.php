<?php

if ($_SERVER['HTTP_HOST'] == 'users.multimediatechnology.at') {
    $DB_NAME = "fhs38707_mmp1";
    $DB_USER = "fhs38707";
    $DB_PASS = "l7Ow0d";  // fill in password here!!
    $DSN     = "pgsql:dbname=$DB_NAME;host=localhost";
} else {
    $DB_NAME = "fhs38707_mmp1";
    $DB_USER = "fhs38707"; // fill in your local db-username here!!
    $DB_PASS = "l7Ow0d"; // fill in password here!!
    $DSN     = "pgsql:dbname=$DB_NAME;host=users.multimediatechnology.at";
}

?>
