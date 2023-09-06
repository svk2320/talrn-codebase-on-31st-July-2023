<?php // print_r($links); exit; ?>
<!-- Content Wrapper. Contains page content -->

<!-- Include Font Awesome library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6" style="display:flex">
          <h1 class="m-0 text-dark">Landing Page Profiles</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Landing Page Profiles</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <?php if (isset($message)) { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <?php echo $message; ?>
        </div>
      <?php } ?>
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <!-- /.box -->
        </div>
        <!-- col-md-12 -->
        </div>
        <!-- /.row -->

    <div class="row">
      <div class="col-12">
        <div class="card">
          
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            
            <table id="userTable" class="table table-hover text-nowrap" >
              <thead>
                <tr>
                  <th data-priority="1">Unique ID</th>
                  <th data-priority="2">Name</th>
                  <th data-priority="2">Job Title</th>
                  <th data-priority="4">Employer</th>
                  <th data-priority="4">Projects</th>
                  <th data-priority="4">Highlight</th>
                  <th data-priority="3">Action</th>
                </tr>
              </thead>
              <tbody class="table">
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
    
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">You can only have profiles between 5 to 10 on the landing page</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
    </div>
    
        <!-- Modal -->
    <div class="modal fade" id="moreProfileAreNotAllowed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Landing page cards </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              Landing page cards cannot show over 10 profiles
          </div>
          <div class="modal-footer" style="margin-top: 20px;">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="lessProfileAreNotAllowed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Landing page cards</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              Landing page cards cannot less than 5 profiles - This will revert to standard landing page
          </div>
          <div class="modal-footer" style="margin-top: 20px;">
               <button type="button" class="btn btn-primary" onclick="reduceCards()" data-dismiss="modal">Confirm</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

<script type="text/javascript">
      var userTable;
      var rowIndex, colIndex; // Declare global variables for rowIndex and colIndex
      var base_url = "<?php echo base_url(''); ?>";
      var userId;
      
      $(document).ready(function () {
        $('userTable').addClass('active');
        
        // initialize the datatable
        userTable = $('#userTable').DataTable({
          'ajax': base_url + 'admin/vendor/fetchApprovedJobs',
          'order': [],
          'autoWidth': false,
          'dom': '<"pull-left"f><"pull-right"l>tip',
          'language': {
              "zeroRecords": "There are no approved profiles" 
            }
        });
        
        function updateGlobalVariables(row, col) {
          rowIndex = row;
          colIndex = col;
        };
        
        $('#userTable').on('click', 'td', function() {
            var cell = userTable.cell(this);
            var rowIndex = cell.index().row;
            var colIndex = cell.index().column;
            var cellData = userTable.cell(rowIndex, colIndex).data(); // Get the data in the cell at row index 1, column index 2
            
            // Update the global variables
            updateGlobalVariables(rowIndex, colIndex);
        });
        
        history.pushState({}, null, '<?= base_url('admin/vendor/landing_page_profiles') ?>');
      });

    function replaceOpenCustomModal(row, col, newParams, buttonIndex) {
      var cell = userTable.cell({ row: row, column: col });
      var cellData = cell.data();
      
      // Find the button element within the cell
      var buttonElement = $(cell.node()).find('button')[buttonIndex];
      
      // Update the onclick attribute with the new parameters
      buttonElement.setAttribute('onclick', "openCustomModal(" + newParams + ")");
    }
    
    function activeOrInactive(row, col, id) {
        
      var actionCol = userTable.cell({ row: row, column: col }).node();
      var hightlight = userTable.cell({ row: row, column: 5 });
      
      var iconElements = $(actionCol).find('.fa');
      
      iconElements.each(function() {
        var iconElement = $(this);
        
        if (iconElement.hasClass('fa-toggle-on')) {
          iconElement.removeClass('fa-toggle-on').addClass('fa-toggle-off');
          
          // change the openCustomModal parameters on buttons
          replaceOpenCustomModal(row, col, `'Change Hightlight Status', 'Are you sure you want to shows your Hightlight?', 'okButton', 'closeButton', ${id}, 'input'`, 0);
          
          // changing the verified to unverified  
          hightlight.data("<span class=\"text-red\">Inactive</span>");
          hightlight.invalidate();
          userTable.draw();
        } else if (iconElement.hasClass('fa-toggle-off')) {
          iconElement.removeClass('fa-toggle-off').addClass('fa-toggle-on');
          
          // change the openCustomModal parameters on buttons
          replaceOpenCustomModal(row, col, `'Change Hightlight Status', "Do you really want to hide your Highlight?", 'okButton', 'closeButton', ${id}, ''`, 0);
          
          // changing the unverified to verified  
          hightlight.data("<span class=\"text-blue\">Active</span>");
          hightlight.invalidate();
          userTable.draw();
        }
      });
    }
    
    function reduceCards() {
        let formData = new FormData();
            
            $.ajax({
                url: base_url + 'admin/vendor/change_highlight_status_below/' + userId, 
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    
                      // Parse the response as JSON
                      var responseObject = JSON.parse(response);
                    
                      // Extract the value of 'highlightCount' from the parsed object
                      userId = responseObject.userId;
                      var status = responseObject.status;
                        
                    if(status){
                        activeOrInactive(rowIndex, colIndex, userId)
                        $('#openCustomModal').modal('hide');
                    }
                },
                error: function (xhr, status, error) {
                    // Handle the error case
                    console.error(error);
                    // Optionally, you can display an error message to the user
                },
            });
    }

    function actions(Id) {
        
        try {
            var highlightText = document.getElementById("highlightText").value;
        } catch{}
            
            let formData = new FormData();
            formData.append("highlightText", highlightText);
            
            $.ajax({
                url: base_url + 'admin/vendor/change_highlight_status/' + Id, 
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    
                      // Parse the response as JSON
                      var responseObject = JSON.parse(response);
                    
                      // Extract the value of 'highlightCount' from the parsed object
                      var highlightCount = responseObject.highlightCount;
                      var totalHighlight = responseObject.totalHighlight;
                      userId = responseObject.userId;
                    
                      // Now you can use 'highlightCount' in your code
                      console.log("Highlight Count: " + highlightCount);
                        
                    if(highlightCount){
                        activeOrInactive(rowIndex, colIndex, Id)
                        $('#openCustomModal').modal('hide');
                    } else {
                        $('#openCustomModal').modal('hide');
                        
                        // Define the callback function
                        function myCallback() {
                            if (totalHighlight > 5) {
                                $('#moreProfileAreNotAllowed').modal('show');
                            } else {
                                $('#lessProfileAreNotAllowed').modal('show');
                                console.log(userId);
                            }
                        }
                        
                        // Set a timeout of 3 seconds (3000 milliseconds)
                        setTimeout(myCallback, 500);
                                                
                    }
                },
                error: function (xhr, status, error) {
                    // Handle the error case
                    console.error(error);
                    // Optionally, you can display an error message to the user
                },
            });
    };
    
    function validateInput(aTagForOkay) {
        const highlightText = document.getElementById("highlightText");
        const highlightTextError = document.getElementById("highlightTextError");
    
        if (highlightText.value.trim() === "") {
            highlightTextError.style.display = "block";
        } else {
            highlightTextError.style.display = "none";
            actions(aTagForOkay);
        }
    }

    function openCustomModal(title, text, okButton, closeButton, aTagForOkay, input=null) {
    
    CustomModal = `
        <!-- Modal -->
        <div class="modal fade" id="openCustomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">${title}</h5>
                    </div>
                    <div class="modal-body">
                        ${text}
                        ${
                            input
                                ? `<br><div style="margin-top: 40px;">
                                       <label style="margin-right: 20px;">Profile Highlight</label>
                                       <input type="text" id="highlightText" class="no-border">
                                       <div id="highlightTextError" style="color: red; display: none;">* This field is required.</div>
                                   </div>`
                                : ""
                        }
                    </div>
                    <div class="modal-footer" style="margin-top: 20px;">
                        ${closeButton ? '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>' : ""}
                        ${okButton ? `<button type="button" class="btn btn-primary" ${aTagForOkay ? input ? `onclick="validateInput('${aTagForOkay}', )"` : `onclick="actions('${aTagForOkay}')"` : 'data-dismiss="modal"'}>Okay</button>` : ""}
                    </div>
                </div>
            </div>
        </div>
    `;
        
        // Clear local variables
        title = null;
        text = null;
        okButton = null;
        closeButton = null;
        aTagForOkay = null;
        input = null;
                    
        // Append the modal HTML code to the body
        $('body').append(CustomModal);
        
        var modalElement = $('#openCustomModal');

        modalElement.on('hidden.bs.modal', function () {
           // Remove the modal element from the DOM
           modalElement.remove();
        });
        
        $('#openCustomModal').modal('show');
    }
</script>
