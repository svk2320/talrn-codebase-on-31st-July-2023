<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Email Reminders</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin')?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?= base_url('admin/reminder')?>">Email reminders</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            Send Emails : <button type="button" class="btn btn-primary"
                                onclick="window.location.href='<?= base_url('admin/reminder/sendreminder') ?>'">Send</button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <?php if(isset($email_count)){ ?>
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            Total emails sent :<?=$email_count ?> <br>
                            Success: <?=$email_success ?> <br>
                            Failures: <?=$email_failure ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <?php } ?>
                    <div class="card">
                        <div class="card-header">
                            Email Reminder Logs
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="manageTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>Date</th>
                                            <th>Status</th> 
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <style>
        .pull-left {
            float: left !important;
        }

        .pull-right {
            float: right !important;
        }
    </style>

    <script type="text/javascript">
        var manageTable;
        var base_url = "<?php echo base_url(); ?>";


        $(document).ready(function () {
            $('#storesMainNav').addClass('active');
            // initialize the datatable
            manageTable = $('#manageTable').DataTable({
                responsive :true,
                'ajax': base_url + 'admin/reminder/fetchEmailData',
                'order': [],
                "dom": '<"pull-left"f><"pull-right"l>tip',
                "language": {
                    "search": "Filter records:"
                }
            });
        });

    </script>



</div>