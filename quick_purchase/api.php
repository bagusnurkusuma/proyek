<?php
//Mengambil Transaction Number
function get_transaction_number($input_function)
{
    include "../asset_default/koneksi.php";
    $input = array("body" => array("table_name" => "purchasing.quick_purchase", "transaction_name" => "quick_purchase", "created_by" => $input_function));
    $input = json_encode($input);
    $query = "SELECT settings.get_new_transaction_number_and_primary_key('" . $input . "') as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}

//Mengambil Default
function get_default($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT purchasing.get_default_for_quick_purchase('" . $input . "') as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}

//Mengambil Detail Transaction Detail
function get_transaction_detail($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT purchasing.list_quick_purchase_detail('" . $input . "') as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}

//Mengambil Inventory List
function get_inventory_for_transaction($input_function)
{
    include "../asset_default/koneksi.php";
    $input = array("body" => array("quick_purchase_id" => $input_function));
    $input = json_encode($input);
    $query = "SELECT purchasing.list_inventory_for_quick_purchase_detail('" . $input . "') as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}

//Insert Transaction Detail
function insert_transaction_detail($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT purchasing.insert_inventory_for_quick_purchase_detail('" . $input . "') as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}

//Update Transaction Detail
function update_transaction_detail($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT purchasing.set_new_quick_purchase_detail('" . $input . "') as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}

//Remove Transaction Detail
function remove_transaction_detail($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT settings.remove_permanent_data('" . $input . "') as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}

//Validate Quick Purchase
function validate_data($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT purchasing.validate_quick_purchase_completed('" . $input . "') as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row['result'], true);
    $hasil = $hasil['body'];
    return $hasil;
}

//Pay Transaction
function pay_transaction($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT purchasing.set_new_quick_purchase('" . $input . "') as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}

// Get Data Supplier
function get_data_supplier($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_supplier('" . $input . "') as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}

// Get Data Warehouse
function get_data_warehouse($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_warehouse('" . $input . "') as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}

//Mengambil Summary Transaction
function get_summary_transaction_detail($input_function)
{
    $hasil = 0;
    $input = array("body" => array("quick_purchase_id" => $input_function));
    $result = get_transaction_detail($input);
    if (is_array($result) && count($result)) {
        foreach ($result as $baris) :
            $hasil = $hasil + $baris["grand_total"];
        endforeach;
    }
    return $hasil;
}
