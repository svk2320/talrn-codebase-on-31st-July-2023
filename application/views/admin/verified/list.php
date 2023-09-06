<?php // print_r($links); exit; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6" style="display:flex">
          <h1 class="m-0 text-dark">Profile Verification</h1>
            <a href="<?php echo base_url('admin/verified/verified') ?>" class="btn btn-primary" style="margin-left:30px;">Verified list</a>
            
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Verification</li>
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

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body table-responsive">
            <table id="userTable" class="table table-hover text-nowrap" >
              <thead>
                <tr>
                  <th data-priority="1">Unique ID</th>
                  <th data-priority="3">Name</th>
                  <th data-priority="5">Company</th>
                  <th data-priority="4">Status</th>
                  <th data-priority="2">Actions</th>
                  <th data-priority="6">Verified Date</th>
                  <th data-priority="7">Days counter</th>
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

<script type="text/javascript">
//   $(document).ready(function() {
//   $("#profilelist").addClass('active');

//   $('#userTable').DataTable({
//     order: [],
//     responsive: true,
//     autoWidth: false,
//     ajax: '<?=base_url()?>' + 'admin/verified/fetchProfilesData',
//     dom: '<"pull-left"f><"pull-right"l>tip',
//     language: {
//       "zeroRecords": "No profiles to verify!" 
//     }
//   });

//   history.pushState({}, null, '<?= base_url('admin/verified/list') ?>');
// });

      var userTable;
      var rowIndex, colIndex; // Declare global variables for rowIndex and colIndex
      var base_url = "<?php echo base_url(''); ?>";
      
    
      $(document).ready(function () {
        $('#verifiedlist').addClass('active');
        
        // initialize the datatable
        userTable = $('#userTable').DataTable({
          'ajax': base_url + 'admin/verified/fetchProfilesData',
          'order': []
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
        
        history.pushState({}, null, '<?= base_url('admin/verified/list') ?>');
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
      var changeVerification = userTable.cell({ row: row, column: 3 });
      var addDate = userTable.cell({ row: row, column: 5 });
      var addCountForRemainingDays = userTable.cell({ row: row, column: 6 });
      
      // Getting the current date
      var verifiedDate = new Date(); // Assuming value['verified_date'] contains the date string
      var day = verifiedDate.getDate();
      var options = { month: 'long', day: 'numeric', year: 'numeric' };
      var formattedDate = verifiedDate.toLocaleDateString('en-US', options);
        
      // Function to get the ordinal suffix for the day
      function getOrdinalSuffix(day) {
        if (day > 3 && day < 21) return 'th';
        switch (day % 10) {
          case 1: return 'st';
          case 2: return 'nd';
          case 3: return 'rd';
          default: return 'th';
        }
      }
      
      // Add the ordinal suffix to the day in the formatted date
      formattedDate = formattedDate.replace(/\b(\d+)\b/, function(match, p1) {
        return p1 + getOrdinalSuffix(parseInt(p1));
      });
      
      // Remove the comma from the formatted date
      formattedDate = formattedDate.replace(',', '');
      
      var iconElements = $(actionCol).find('.fa');
      
      iconElements.each(function() {
        var iconElement = $(this);
        
        if (iconElement.hasClass('fa-toggle-on')) {
          iconElement.removeClass('fa-toggle-on').addClass('fa-toggle-off');
          
          // change the openCustomModal parameters on buttons
          replaceOpenCustomModal(row, col, `'Change User Verification Status', 'Are you sure you want to change status to "Verified"?', 'okButton', 'closeButton', ${id}`, 0);
          
          // changing the verified to unverified  
          changeVerification.data("<span>Unverified</span>");
          changeVerification.invalidate();
          
          // changing the add date 
          addDate.data(" ");
          addDate.invalidate();
          
          // changing the add Count for remaining days
          addCountForRemainingDays.data(" ");
          addCountForRemainingDays.invalidate();
          
          userTable.draw();
        } else if (iconElement.hasClass('fa-toggle-off')) {
          iconElement.removeClass('fa-toggle-off').addClass('fa-toggle-on');
          
          // change the openCustomModal parameters on buttons
          replaceOpenCustomModal(row, col, `'Change User Verification Status', 'Are you sure you want to change status to "Unverified"?', 'okButton', 'closeButton', ${id}`, 0);
          
          // changing the unverified to verified  
          changeVerification.data("<span class=\"text-blue\">Verified</span>");
          changeVerification.invalidate();
          
          // changing the add date 
          addDate.data(`<span>${formattedDate}</span>`);
          addDate.invalidate();
          
          // changing the add Count for remaining days
          addCountForRemainingDays.data("<span>30 days</span>");
          addCountForRemainingDays.invalidate();
          
          userTable.draw();
        }
      });
    }

    function actions(Id) {
    
        // Send an AJAX request to the PHP controller
        var xhr = new XMLHttpRequest();
        
        xhr.open("POST", "change_status/" + Id , true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
          activeOrInactive(rowIndex, colIndex, Id)
           
            $('#openCustomModal').modal('hide');
          };
        };
        
        xhr.send();
    
    };

    function openCustomModal(title, text, okButton, closeButton, aTagForOkay) {
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
                  </div>
                  <div class="modal-footer">
                    ${closeButton ? '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>' : ""}
                    ${okButton ? `<button type="button" class="btn btn-primary" ${aTagForOkay ? `onclick="actions('${aTagForOkay}')"` : 'data-dismiss="modal"'}>Okay</button>` : ""}
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
