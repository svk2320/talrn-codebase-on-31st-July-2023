<?php
// print_r($links);
// exit;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6" style="display:flex">
                    <h1 class="m-0 text-dark">Sticky header</h1>
                    <a href="<?php echo base_url('admin/announcements/create_sticky_header') ?>" class="btn btn-primary"
                        style="margin-left:30px;">Create Sticky header</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/announcements/index') ?>">Announcements</a></li>
                        <li class="breadcrumb-item active">Sticky header</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <?php if (isset($message)) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <?php echo $message; ?>
                </div>
                <div id="messageContainer"></div>
            <?php } ?>
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">

                        <!-- Place the HTML table -->
                        <table id="userTable" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Sticky header Text</th>
                                    <th>Date Till</th>
                                    <th>Status</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody class="table">
                                <?php if ($list) { // Check if $list is defined ?>
                                    <?php foreach ($list as $k => $v): ?>
                                        <tr>
                                            <td>
                                                <?php echo isset($v['text']) ? $v['text'] : ''; ?>
                                            </td>
                                            <td>
                                                <?php echo isset($v['expiration_date']) ? $v['expiration_date'] : ''; ?>
                                            </td>
                                            <td>
                                                <?php

                                                if ($v['active'] === '1') {
                                                    echo '<span class="text-green">Active</span>';
                                                } elseif ($v['active'] === '0') {
                                                    echo '<span class="text-red">Inactive</span>';
                                                }

                                                ?>
                                            </td>
                                            <td>
                                                <?php if ($v['active'] === '1'): ?>
                                                    <a data-toggle="tooltip" data-placement="bottom" title="turn off sticky header" href="<?php echo base_url("admin/announcements/update_sticky_header/") . $v['id'] ?>"
                                                    class="btn btn-default"><i class="fa fa-toggle-on"></i></a>
                                                <?php elseif ($v['active'] === '0'): ?>
                                                    <a data-toggle="tooltip" data-placement="bottom" title="turn on sticky header" href="<?php echo base_url("admin/announcements/update_sticky_header/") . $v['id'] ?>"
                                                    class="btn btn-default"><i class="fa fa-toggle-off"></i></a>
                                                <?php endif; ?>
                                                <a data-toggle="tooltip" data-placement="bottom" title="edit sticky header" href="<?php echo base_url("admin/announcements/edit_sticky_header/") . $v['id'] ?>"
                                                    class="btn btn-default"><i class="fa fa-edit"></i></a>
                                                <button data-toggle="tooltip" data-placement="bottom" title="delete sticky header" onclick="deleteRowAjax(<?php echo $v['id']; ?>, this)" class="btn btn-default">
                                                  <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php } ?>
                            </tbody>
                        </table>


                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
    function deleteRow(button) {
      const rowToDelete = button.parentNode.parentNode; // Get the <tr> element containing the button
      rowToDelete.remove();
    }
    
    function deleteRowAjax(id, button) {
      deleteRow(button);
        
      var URL = '<?php echo base_url("admin/announcements/delete_sticky_header/"); ?>' + id;
      var formData = new FormData(); // You can add data to send to the server if needed
    
      // Send the data via AJAX to the server
      $.ajax({
        url: URL,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          console.log(response);
          // You can refresh the page or update the UI as required
          // For example, you could remove the row from the table.
          
          // Create a new element to display the message
          var messageElement = document.createElement('div');
          messageElement.classList.add('alert', 'alert-success', 'alert-dismissible');
          messageElement.role = 'alert';
          messageElement.innerHTML = `Sticky Header has been deleted <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>`;
        
          // Append the message element to the container where you want to show it
          var messageContainer = document.getElementById('messageContainer'); // Replace 'messageContainer' with the actual ID of the container
          messageContainer.appendChild(messageElement);
        },
        error: function (xhr, status, error) {
          // Handle the error case
          console.error(error);
        },
      });
    }

    $(document).ready(function () {
        $('#userTable').DataTable({
            order: [],
            "dom": '<"pull-left"f><"pull-right"l>tip',
            language: {
                "zeroRecords": "No sticky header created yet!"
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        history.pushState({}, null, '<?= base_url('admin/announcements/sticky_header/') ?>');
    });

</script>
