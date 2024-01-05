<?php
include "api.php";
if (!empty($_POST)) {
   $output = '';
   if ($_POST['action_status'] == 'view_detail' | $_POST['action_status'] == 'edit_detail' | $_POST['action_status'] == 'insert_detail') {
      if ($_POST['action_status'] == 'view_detail') {
         $is_readonly = 'readonly = true';
         $is_disable_button = 'type = "hidden"';
         $input = ['body' => ['data_id' => $_POST['data_id']]];
      } elseif ($_POST['action_status'] == 'edit_detail') {
         $is_readonly = '';
         $is_disable_button = 'type = "button"';
         $input = ['body' => ['data_id' => $_POST['data_id']]];
      } elseif ($_POST['action_status'] == 'insert_detail') {
         $is_readonly = '';
         $is_disable_button = 'type = "button"';
         $input = ['body' => ['data_id' => '']];
      }

      $hasil = get_data_detail($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $v_id = $_POST['data_id'];
            $v_account_code = $row['account_code'];
            $v_account_name = $row['account_name'];
            $v_sub_account = $row['sub_account'];
            $v_decription = $row['description'];
         endforeach;
      } else {
         $v_id = '';
         $v_account_code = '';
         $v_account_name = '';
         $v_sub_account = '';
         $v_decription = '';
      }

      $output .= '
      <form method="POST" id="update_form">
         <input type="hidden" name="id" id="jq_id" value="' . $v_id . '" class="form-control" />
         <input type="hidden" name="action_status" id="jq_action_status" value="' . $_POST['action_status'] . '" class="form-control" />
         <input type="hidden" name="created_by" id="jq_created_by" value="' . $_POST['created_by'] . '" class="form-control" />
      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
         <tr>
            <td><label>Account Code :</label></td>
            <td><input type="text" name="code" id="jq_account_code" value="' . $v_account_code . '" class="form-control" ' . $is_readonly . '/></td>
         <tr>
            <td><label>Account Name :</label></td>
            <td><input type="text" name="name" id="jq_account_name" value="' . $v_account_name . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
          <tr>
            <td><label>Sub Account :</label></td>
            <td><input type="text" name="sub_account" id="jq_sub_account" value="' . $v_sub_account . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
         <tr>
            <td><label>Description</label></td>
            <td><textarea name="desc" id="jq_desc" class="form-control" ' . $is_readonly . '>' . $v_decription . '</textarea></td>
         </tr>
      </table>
           <input ' . $is_disable_button . ' name="update" id="update" value="Update" class="btn btn-success update" />
      </form>
      ';
   } elseif ($_POST['action_status'] == 'refresh_data_detail') {
      $output .= '
      <table id="master_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th>Account Code</th>
            <th>Account Name</th>
            <th>Sub Account</th>
            <th>Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $input = ['body' => ['id' => '']];
      $hasil = get_data_detail($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $output .= '
            <tr>  
               <td>' . $row['account_code'] . '</td>
               <td>' . $row['account_name'] . '</td>
               <td>' . $row['sub_account'] . '</td>
               <td><button type="button" name="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data"><i class="fa fa-eye"></i></button>
                   <button type="button" name="edit" id="' . $row["id"] . '" class="btn btn-warning btn-xs edit_data"><i class="fa fa-pencil-square"></i></button>                                  
                   <button type="button" name="archive" id="' . $row["id"] . '" class="btn btn-danger btn-xs archive_data"><i class="fa fa-archive"></i></button></td>
            </tr>
         ';
         endforeach;
      }
      $output .= '</tbody></table>';
   } elseif ($_POST['action_status'] == 'archive_detail') {
      $output = '
      <form method="post" id="archive_form">
        <input type="hidden" name="id" id="jq_id" value="' . $_POST['data_id'] . '" class="form-control" />
         <input type="hidden" name="action_status" id="jq_action_status" value="' . $_POST['action_status'] . '" class="form-control" />
         <input type="hidden" name="created_by" id="jq_created_by" value="' . $_POST['created_by'] . '" class="form-control" />
      <table class="table table-striped">
          <td><label>Archive Reason ?</label></td>
            <td><textarea name="archive_reason" id="jq_archive_reason" class="form-control" ></textarea></td>
      </table>
         <input type="button" name="archive" id="archive" value="Archive" class="btn btn-success archive_detail" />
      </form>';
   } elseif ($_POST['action_status'] == 'show_archive_data') {
      $output = '';
      $output .= '
      <table id="archive_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th>Account Code</th>
            <th>Account Name</th>
            <th>Description</th>
            <th>Option</th> 
         </tr>
      </thead>
      <tbody>';
      $input = ['body' => ['is_archive' => '']];
      $hasil = get_data_detail($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $output .= '
            <tr>  
               <td>' . $row['account_code'] . '</td>
               <td>' . $row['account_name'] . '</td>
               <td>' . $row['description'] . '</td>
               <td>
               <button type="button" name="unarchive" value="Unarchive" id="' . $row["id"] . '" class="btn btn-danger unarchive_data"><i class="fa fa-upload"></i></button>
               </td>
            </tr>
         ';
         endforeach;
      }
      $output .= '</tbody></table>';
   }
   echo $output;
}
