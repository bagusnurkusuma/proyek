<?php

$host = '127.0.0.1';
$port = '5432';
$db = 'toko_baru';
$user = 'd_team';
$password = '123456'; // change to your password

$link = pg_connect("host=$host port=$port dbname=$db user=$user password=$password") or die(pg_close());
