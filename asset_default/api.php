<?php

function get_company_profile()
{
    include "koneksi.php";
    $query = "SELECT company.get_company_profile() as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}

function get_watermark()
{
    include "koneksi.php";
    $query = "SELECT company.get_watermark() as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}

function get_menu_proces($input_function)
{
    include "koneksi.php";
    $input = array("body" => array("created_by" => $input_function));
    $input = json_encode($input);
    $query = "SELECT user_role.get_user_menu_proces_by_user('" . $input . "') as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}
