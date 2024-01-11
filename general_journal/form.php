<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />
</head>

<?php
include "../asset_default/side_bar.php";
include "api.php";
?>

<body class="nav-md">
  <input type="hidden" name="penguna" id="jq_pengguna" value=<?php echo $pengguna; ?> readonly="true">
  <div class="container body">
    <!-- page content -->
    <div class="right_col" role="main">
      <div class="content">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2>General Journal</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up justify-content-end"></i></a>
                  </li>
                </ul>
                <div align="right">
                  <button type="button" name="pay" id="jq_pay" class="btn btn-success save_transaction">Save</button>
                  <button type="button" name="cancel" id="jq_cancel" class="btn btn-primary cancel" onclick="act_cancel()">Cancel</button>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br />
                <?php foreach (get_transaction_number($pengguna) as $parent) : ?>
                  <input type="hidden" name="transaction_id" id="jq_transaction_id" value=<?php echo $parent["transaction_id"]; ?> class="form-control" readonly="true">
                  <div class="row">
                    <div class="col-md-6 col-sm-12  form-group">
                      <label class="control-label col-md-3">Trx Number</label>
                      <div class="col-md-9">
                        <input type="text" name="transaction_number" id="jq_transaction_number" value=<?php echo $parent["transaction_number"]; ?> class="form-control" readonly="true" style="margin-bottom: 10px;">
                      </div>
                    <?php endforeach; ?>
                    <label class="control-label col-md-3">Trx Date</label>
                    <div class="col-md-9">
                      <input type="date" name="transaction_date" id="jq_transaction_date" value="" class="form-control" style="margin-bottom: 10px;">
                    </div>
                    <label class="control-label col-md-3">Ref Number</label>
                    <div class="col-md-9">
                      <input type="text" name="reference_number" id="jq_reference_number" value="" class="form-control" style="margin-bottom: 10px;">
                    </div>
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                      <label class="control-label col-md-3">Description</label>
                      <div class="col-md-9">
                        <textarea class="form-control" rows="3" name="description_parent" id="jq_description_parent" value=""></textarea>
                      </div>
                    </div>
                  </div>

                  <div class=" x_panel">
                    <div class="x_title">
                      <h2>Account Detail </h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      </ul>
                      <div align="right">
                        <button type="button" name="add_data" id="jq_add_data" class="btn btn-warning add_data"><i class="fa fa-plus-circle"></i></button>
                        <button type="button" name="refresh" id="jq_refresh" class="btn btn-success refresh_data"><i class="fa fa-refresh"></i></button>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="card-box table-responsive" id="data_detail">
                        <!-- Import From Form File -->
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!--page content -->
      </div>
    </div>
  </div>
</body>

</html>

<!-- Popup Edit Item  -->
<div id="edit_data" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Account</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="card-box table-responsive" id="form_edit">
          <!-- Import From Form File -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Pop up Selected -->
<div id="selectModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Select Data</h4>
        <div align="right">
          <button type="button" name="refresh_account_data" id="jq_refresh_account_data" class="btn btn-success refresh_account_data"><i class="fa fa-refresh"></i></button>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
      </div>
      <div class=" modal-body">
        <div class="card-box table-responsive" id="form_select">
          <!-- Import From Form File -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
  function act_refresh_table_general_journal() {
    var transaction_id = $("#jq_transaction_id").val();
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        action_status: "refresh_list_general_journal_detail",
        transaction_id: transaction_id
      },
      success: function(data) {
        $("#data_detail").html(data);
        $("table#data_general_journal_table").pretty_format_table();
        $("table#data_general_journal_table").DataTable({
          pageLength: 100
        })
      }
    });
  }

  function act_refresh_table_list_account() {
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        action_status: "choose_account_data"
      },
      success: function(data) {
        $("#form_select").html(data);
        $("table#select_table").DataTable();
      }
    });
  }

  function act_cancel() {
    var text = "Are you sure cancel this transaction";
    if (confirm(text) == true) {
      $(document).ready(function() {
        var transaction_id = $("#jq_transaction_id").val();

        $.ajax({
          url: "action.php",
          method: "POST",
          data: {
            action_status: "cancel_transaction",
            transaction_id: transaction_id
          },
          success: function(data) {
            go_to_home_pages();
          }
        });

      });
    } else {}
  }

  function get_data_detail_edit(arg_data_id, arg_action_status) {
    var transaction_id = $("#jq_transaction_id").val();
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        data_id: arg_data_id,
        action_status: arg_action_status,
        transaction_id: transaction_id,
        created_by: $("input#jq_pengguna").val()
      },
      success: function(data) {
        $("#form_edit").html(data);
        $("#edit_data").modal("show");
      }
    });
  }

  //FormLoad langsung Refresh Table
  $(document).ready(function() {
    $("input#jq_transaction_date").val(get_current_date());
    act_refresh_table_general_journal();

  });

  $(document).ready(function() {
    //Refresh Table
    $(document).on("click", ".refresh_data", function() {
      act_refresh_table_general_journal();
    });

    //Add Product
    $(document).on("click", ".add_data", function() {
      get_data_detail_edit(null, "add_data");
    });

    //Edit Detail
    $(document).on("click", ".edit_data", function() {
      var data_id = $(this).attr("id");
      get_data_detail_edit(data_id, "edit_data");
    });

    //Show Transaction Detail
    $(document).on("click", ".view_data", function() {
      var data_id = $(this).attr("id");
      get_data_detail_edit(data_id, "view_data");
    });

    //Remove Transaction Detail
    $(document).on("click", ".delete_data", function() {
      var data_id = $(this).attr("id");

      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          data_id: data_id,
          action_status: "remove_data"
        },
        success: function(data) {
          act_refresh_table_quick_purchase();
        }
      });
    });

    //Choose Account Data
    $(document).on("click", ".choose_account_data", function() {
      act_refresh_table_list_account();
      $("#selectModal").modal("show");
    });

    //Refresh Account Data
    $(document).on("click", ".refresh_account_data", function() {
      act_refresh_table_list_account();
    });

    //Select Account Data
    $(document).on("click", ".select_account_data", function() {
      var data_id = $(this).attr("id");
      var action_status = "select_account_data";
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          data_id: data_id,
          action_status: action_status
        },
        success: function(data) {
          var parsedData = $.parseJSON(data);
          $("#jq_account_id").val(parsedData[0].id);
          $("#jq_account_name").val(parsedData[0].account_concat);
          $("#selectModal").modal("hide");
        }
      });
    });

    //Btn edit dan validasi
    $(document).on("click", ".update_detail", function() {
      event.preventDefault();
      if ($("input#jq_debet").val() < 0) {
        alert("Debet tidak boleh di isi minus");
      } else if ($("input#jq_credit").val() < 0) {
        alert("Credit tidak boleh di isi minus");
      } else if ($("input#jq_account_id").val() == "") {
        alert("Account Harus di pilih");
      } else {
        $.ajax({
          url: "action.php",
          method: "POST",
          data: $("#update_form").serialize(),
          beforeSend: function() {
            $("#update").val("Updating");
          },
          success: function(data) {
            $("#update_form")[0].reset();
            $("#edit_data").modal("hide");
            act_refresh_table_general_journal();
          }
        });
      }
    });

    //Save Transaction
    $(document).on("click", ".save_transaction", function() {
      if ($("#transaction_number").val() == "") {
        alert("Inventory harus diisi");
      } else {
        var transaction_id = $("#jq_transaction_id").val();
        var transaction_date = $("#jq_transaction_date").val();
        var reference_number = $("#jq_reference_number").val();
        var description = $("#jq_description_parent").val();
        if (confirm("Are You Sure To Save This Transaction ?") == true) {
          $.ajax({
            url: "action.php",
            method: "POST",
            data: {
              action_status: "validate_detail",
              transaction_id: transaction_id,
              transaction_date: transaction_date,
              reference_number: reference_number,
              description: description
            },
            success: function(data) {
              var parsedData = $.parseJSON(data);
              var result = parsedData[0].msg;
              if (result == "") {
                window.location = "../general_journal/form.php";
              } else {
                alert(result);
              }
            }
          });
        } else {}
      }
    });
  });
</script>