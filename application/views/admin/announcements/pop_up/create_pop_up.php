<html>

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
</head>

<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Create pop up announcement</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/announcements/index') ?>">Announcements</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/announcements/pop_up') ?>">Pop up announcement</a>
                        </li>
                        <li class="breadcrumb-item active">Create pop up announcement</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                
                <script>
            	    console.log('value', <?php echo json_encode($title); ?>);
            	</script>

                <form method="POST" action="<?php echo site_url('admin/announcements/pop_up_savedata'); ?>" onsubmit="return validateForm()">
                    <div class="form-group row">
                        <label for="text-editor" class="col-md-2 col-form-label">Pop up Title:</label>
                        <div class="col-md-4">
                            <input class="form-control" id="title" name="title" placeholder="Title text, keep it short" oninput="clearWarning('titleWarning')" />
                            <div id="titleWarning" class="text-danger"></div> <!-- Warning div for title -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text-editor" class="col-md-2 col-form-label">Pop up Text:</label>
                        <div class="col-md-4">
                            <textarea class="form-control" id="text" name="text" rows="6" placeholder="Use HTML to create something special for your pop up announcement" oninput="clearWarning('textWarning')"></textarea>
                            <div id="textWarning" class="text-danger"></div> <!-- Warning div for title -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text1" class="col-md-2 col-form-label">Show till:</label>
                        <div class="col-md-4">
                            <input id="text1" name="text1" type="date" class="form-control" oninput="clearWarning('text1Warning')">
                            <div id="text1Warning" class="text-danger"></div> <!-- Warning div for title -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Show pop up to:</label>
                        <div class="col-md-10">
                            <div class="checkbox"> <label> <input type="checkbox" name="Admin" value="1"> &nbsp;&nbsp;Admin </label> (Shown as a pop to all Admin Users) </div>
                            <div class="checkbox"> <label> <input type="checkbox" name="Website" value="1"> &nbsp;&nbsp;Website </label> (Shown as a pop up to all users that visit Talrn.com) </div>
                            <div class="checkbox"> <label> <input type="checkbox" name="Organization" value="1"> &nbsp;&nbsp;Organization </label> <?php echo '(Shown as a pop to all '  . $organisation_count .  ' Orgnization Accounts on Talrn)' ?> </div>
                            <div class="checkbox"> <label> <input type="checkbox" name="Individual" value="1"> &nbsp;&nbsp;Individual </label> <?php echo '(Shown as a pop up to all ' . $individual_count . ' Individual Accounts on Talrn)'; ?> </div>
                            <div class="checkbox"> <label> <input type="checkbox" name="Client" value="1"> &nbsp;&nbsp;Client </label> <?php echo '(Shown as a pop up to all ' . $client_count . ' Client on Talrn)'; ?> </div>
                            <div id="checkboxWarning" class="text-danger"></div> <!-- Warning div for checkboxes -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-4 col-8">
                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
  // Get the current date in the format "YYYY-MM-DD"
  const today = new Date().toISOString().slice(0, 10);

  // Set the minimum attribute of the input field to the current date
  document.getElementById("text1").setAttribute("min", today);
</script>


<script>
    function clearWarning(warningId) {
        document.getElementById(warningId).innerHTML = '';
    }

    function validateForm() {
        var title = document.getElementById('title').value;
        var text = document.getElementById('text').value;
        var text1 = document.getElementById('text1').value;
        var adminCheckbox = document.getElementsByName('Admin')[0];
        var websiteCheckbox = document.getElementsByName('Website')[0];
        var organizationCheckbox = document.getElementsByName('Organization')[0];
        var individualCheckbox = document.getElementsByName('Individual')[0];
        var clientCheckbox = document.getElementsByName('Client')[0];

        var isValid = true;

        // Validation for title
        if (title.trim() === '') {
            document.getElementById('titleWarning').innerHTML = 'Title cannot be empty.';
            isValid = false;
        } else {
            document.getElementById('titleWarning').innerHTML = '';
        }
        
        // Validation for title
        if (text.trim() === '') {
            document.getElementById('textWarning').innerHTML = 'Text cannot be empty.';
            isValid = false;
        } else {
            document.getElementById('textWarning').innerHTML = '';
        }
        
        // Validation for title
        if (text1.trim() === '') {
            document.getElementById('text1Warning').innerHTML = 'Date cannot be empty.';
            isValid = false;
        } else {
            document.getElementById('text1Warning').innerHTML = '';
        }
        
        // Validation for title
        if (text1.trim() === '') {
            document.getElementById('text1Warning').innerHTML = 'Date cannot be empty.';
            isValid = false;
        } else {
            document.getElementById('text1Warning').innerHTML = '';
        }
        
        // Validation for at least one checkbox selected
        if (!adminCheckbox.checked && !websiteCheckbox.checked && !clientCheckbox.checked && !organizationCheckbox.checked && !individualCheckbox.checked) {
            document.getElementById('checkboxWarning').innerHTML = 'Please select atleast one of the following category of users to show to';
            isValid = false;
        } else {
            document.getElementById('checkboxWarning').innerHTML = '';
        }

        return isValid;
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#mainNav").addClass('active');

        $('#text-editor').summernote({
            placeholder: 'Enter notification...',
            height: 100,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ],
            callbacks: {
                onChange: function (contents, $editable) {
                    $('#text').val(contents);
                },
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    setTimeout(function () {
                        document.execCommand('insertText', false, bufferText);
                    }, 10);
                }
            },
            pastePlain: true

        });
        
        history.pushState({}, null, '<?= base_url('admin/announcements/pop-up/create') ?>');
    });

</script>

</html>
