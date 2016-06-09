<?php
$host="127.0.0.1";
$port="5433";
$dbname="portal";
$usr="travis";
$pwd="Fsck311!";
// Connecting, selecting database
$dbconn = pg_connect("host=".$host." port=".$port." user=".$usr." password=".$pwd." dbname=".$dbname)
    or die('Could not connect:: ' . pg_last_error());
?>