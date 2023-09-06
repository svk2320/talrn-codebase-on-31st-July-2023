<html>

<head>
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"/>
</head>
<div class="content-wrapper">
    <div class="container-fluid py-3">
        <div class="h2">Reports </div>
    </div>
    <section class="container-fluid" style="background-color:white">
        <div class="px-3 py-3 border rounded">
            <div style="font-size: 20px;" class="mb-3">Choose the report type </div>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-bar-chart-line-fill"></i></span>
                <select name="" id="select-box" class="form-control" onchange="toggle()">
                    <option value="Profile View Count">Profile View Count</option>
                    <option value="Industry List">Industries Report</option>
                    <option value="Skill List">Skill List</option>
                    <option value="Job Title List">Job Title List</option>
                    <option value="Search Report">Search Report</option>
                    <option value="Total unique vistors">Activity Logs </option>
                    <option value="Employer Report">Employer Report</option>
                    <option value="Projects Report">Projects Report</option>
                </select>
            </div>
        </div>
    </section>

    <section class="container-fluid tables" id="Profile View Count" style="background-color:white">
        <div class="px-3 py-3 border rounded mt-2">
            <div class="border-bottom h5 pb-3">
                Profile Viewed Report
            </div>
            <div class="table-responsive">
                <table class="table" id="profile_view_table">
                    <thead>
                        <tr>
                            <th scope="col" data-priority="1">Unique ID</th>
                            <th scope="col" data-priority="2">Name</th>
                            <th scope="col" data-priority="5">Company</th>
                            <th scope="col" data-priority="3">Job title</th>
                            <th scope="col" data-priority="4">Views</th>
                            <th scope="col" data-priority="6">Pdf</th>
                            <th scope="col" data-priority="7">Hire</th>
                            <th scope="col" data-priority="8">Share</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="container-fluid tables" id="Industry List" style="background-color:white">
        <div class="px-3 py-3 border rounded mt-2">
            <div class="border-bottom h5 pb-3">
                Industries Report
            </div>
            <div class="table-responsive">
                <table class="table" id="industries_table">
                    <thead>
                        <tr>
                            <th scope="col" data-priority="4">Added By</th>
                            <th scope="col" data-priority="3">Company</th>
                            <th scope="col" data-priority="1">Industries Name</th>
                            <th scope="col" data-priority="2">Projects tagged</th>
                        </tr>
                    </thead>
                    <tbody>
                        

                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="container-fluid tables" id="Skill List" style="background-color:white">
        <div class="px-3 py-3 border rounded mt-2">
            <div class="border-bottom h5 pb-3">
                Skill List
            </div>
            <div class="table-responsive">
                <table class="table" id="skills_table">
                    <thead>
                        <tr>
                            <th scope="col" data-priority="4">Added By</th>
                            <th scope="col" data-priority="3">Company</th>
                            <th scope="col" data-priority="1">Skills</th>
                            <th scope="col" data-priority="2">Profiles Tagged</th>
                        </tr>
                    </thead>
                    <tbody>
                        

                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="container-fluid tables" id="Job Title List" style="background-color:white">
        <div class="px-3 py-3 border rounded mt-2">
            <div class="border-bottom h5 pb-3">
                Job Title List
            </div>
            <div class="table-responsive">
                <table class="table" id="job_title_table">
                    <thead>
                        <tr>
                            <th scope="col" data-priority="4">Added By</th>
                            <th scope="col" data-priority="3">Company</th>
                            <th scope="col" data-priority="1">Job Title</th>
                            <th scope="col" data-priority="2">Profiles Tagged</th>
                        </tr>
                    </thead>
                    <tbody>
                        

                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="container-fluid tables" id="Search Report" style="background-color:white">
        <div class="px-3 py-3 border rounded mt-2">
            <div class="border-bottom h5 pb-3">
                Search Report
            </div>
            <div class="table-responsive">
                <table class="table" id="search_report_table">
                    <thead>
                        <tr>
                            <th scope="col" data-priority="7">IP</th>
                            <th scope="col" data-priority="6">Date Added</th>
                            <th scope="col" data-priority="1">Skills</th>
                            <th scope="col" data-priority="5">Experience</th>
                            <th scope="col" data-priority="4">Industries</th>
                            <th scope="col" data-priority="2">Exact Result</th>
                            <th scope="col" data-priority="3">Partial Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="container-fluid tables" id="Total unique vistors" style="background-color:white">
        <div class="card mt-2">

            <div class="card-header">
                Activity Logs
                <button type="button" class="btn btn-sm btn-primary ml-2" data-toggle="modal"
                    data-target="#activityRange">Select date</button>
            </div>
            <div class="card-body  table-responsive">
                <table class="table table-bordered table-hover" id="total_unique_vistors">
                    <thead>
                        <tr>
                            <th data-priority="1">IP</th>
                            <th data-priority="6">Date & Time</th>
                            <th data-priority="5">Username</th>
                            <th data-priority="4">Email</th>
                            <th data-priority="3">New/Returning</th>
                            <th data-priority="2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="container-fluid tables" id="Employer Report" style="background-color:white">
        <div class="px-3 py-3 border rounded mt-2">
            <div class="border-bottom h5 pb-3">
                Employer Report
            </div>
            <div class="table-responsive">
                <table class="table" id="organisations_table">
                    <thead>
                        <tr>
                            <th scope="col" data-priority="2">Added By</th>
                            <th scope="col" data-priority="3" width="60%">Company</th>
                            <th scope="col" data-priority="4">Profiles</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="container-fluid tables" id="Projects Report" style="background-color:white">
        <div class="px-3 py-3 border rounded mt-2">
            <div class="border-bottom h5 pb-3">
                Projects Report
            </div>
            <div class="table-responsive">
                <table class="table" id="projects_table">
                    <thead>
                        <tr>
                            <th scope="col" data-priority="1">UniqueID</th>
                            <th scope="col" data-priority="3" width="15%">Added By</th>
                            <th scope="col" data-priority="4" width="45%">Project Name </th>
                            <th scope="col" data-priority="5">Industry</th>
                            <th scope="col" data-priority="6">Url</th>
                            <th scope="col" data-priority="7">Profiles</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    
    <div class="modal fade" id="activityRange">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Activity logs date select</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="activity_log_from_date">From date:</label>
                            <input type="date" class="form-control" id="activity_log_from_date"
                                max="<?php echo date('Y-m-d'); ?>">
                            <div class="req text-danger" id="from_error">This feild is required</div>
                        </div>
                        <div class="form-group">
                            <label for="activity_log_to_date">To date:</label>
                            <input type="date" class="form-control" id="activity_log_to_date"
                                max="<?php echo date('Y-m-d'); ?>">
                            <div class="req text-danger" id="to_error">This feild is required</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" onclick='activity_log_date()'>Submit</button>
                </div>

            </div>
        </div>
    </div>
</div>
<style>
    .link-container {
      display: flex;
      align-items: center;
    }
    .link-container a {
      white-space: nowrap;
      margin-right: 5px;
    }
    
    .tables {
        width: 100%; /* Set the container height to occupy the full viewport height */
        display: block;
    }
    .tables table {
        border-collapse: collapse; /* Merge cell borders */
        width: 100%; /* Make the table width fill its container */
        
    }
    
    .tables th, .tables td {
        border: 0.4px solid #f0f0f0;
        padding: 15px; /* Add some padding for better readability */
    }
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
  }

  @media (max-width: 767px) {
    .table-responsive {
      width: 100%;
      margin-bottom: 15px;
      overflow-y: hidden;
      -ms-overflow-style: -ms-autohiding-scrollbar;
      border: 1px solid #ddd;
    }
  }


</style>
<footer>
<script type="text/javascript">
  function toggle() {
    let current = document.getElementById('select-box').value;

    // Hide all tables
    let tables = document.getElementsByClassName('tables');
    for (var i = 0; i < tables.length; i++) {
      tables[i].style.display = "none";
    }

    // Show the selected table
    document.getElementById(current).style.display = "block";
  }

  $(document).ready(function() {
 
    // Initialize DataTables for each table
    $('#profile_view_table').DataTable({
      ajax: "<?php echo base_url(); ?>" + 'admin/report/profile_view_data',
      order: [[4, 'desc']]
    });

    $('#industries_table').DataTable({
      ajax: "<?php echo base_url(); ?>" + 'admin/report/industries_table_data',
      order: [[3, 'desc']],bAutoWidth: false,
    });

    $('#skills_table').DataTable({
      ajax: "<?php echo base_url(); ?>" + 'admin/report/skills_table_data',
      order: [[3, 'desc']],bAutoWidth: false,
    });

    $('#job_title_table').DataTable({
      ajax: "<?php echo base_url(); ?>" + 'admin/report/job_title_table_data',
      order: [[3, 'desc']],bAutoWidth: false,
    });

    $('#search_report_table').DataTable({
      ajax: "<?php echo base_url(); ?>" + 'admin/report/search_report_table_data',
      order: [[1, 'desc']],bAutoWidth: false
    });
    $('#organisations_table').DataTable({
      ajax: "<?php echo base_url(); ?>" + 'admin/report/organisations_table_data',
      order: [[1, 'desc']],bAutoWidth: false
    });
     $('#projects_table').DataTable({
      ajax: "<?php echo base_url(); ?>" + 'admin/report/projects_table_data',
      order: [[1, 'desc']],bAutoWidth: false
    });


      
    var activity_table = $('#total_unique_vistors').DataTable();

    if (activity_table && $.fn.DataTable.isDataTable(activity_table)) {
        // Clear the table data
        activity_table.clear().draw();
    
        // Load new data using AJAX
        activity_table.ajax.url("<?php echo base_url(); ?>" + 'admin/report/total_unique_vistors_data').load();
    } else {
        // Initialize the DataTable
        activity_table = $('#total_unique_vistors').DataTable({
            ajax: "<?php echo base_url(); ?>" + 'admin/report/total_unique_vistors_data',
            order: [[4, 'desc']],
            bAutoWidth: false
        });
    }
      
    // Hide all tables except the first one
    let tables = document.getElementsByClassName('tables');
    for (var i = 1; i < tables.length; i++) {
      tables[i].style.display = "none";
    }

    // Show the first table initially
    tables[0].style.display = "block";
  });
</script>



    <script>
    
        $.hideModal = function() {
            $('#activityRange').modal('hide')
        };
         
        var activity_table;
        var base_url = "<?php echo base_url(); ?>";
        
        function validateDateRange(fromDate, toDate) {
          var from = new Date(fromDate);
          var to = new Date(toDate);
          
          if (from.getTime() > to.getTime()) {
            return false;
          } else {
            return true;
          }
        }

        function activity_log_date() {
            
            document.getElementById("from_error").style.display = 'none';
            document.getElementById("to_error").style.display = 'none';
                        
            var from_date = document.getElementById("activity_log_from_date").value;
            var to_date = document.getElementById("activity_log_to_date").value;
            
            if(from_date.length == 0){// checking if empty
            document.getElementById("from_error").style.display = 'block';
            document.getElementById("from_error").className = 'req text-danger';
            document.getElementById("from_error").innerHTML = 'This field is required!';
            return false;
            }
            
            if(to_date.length == 0){// checking if empty
            document.getElementById("to_error").style.display = 'block';
            document.getElementById("to_error").className = 'req text-danger';
            document.getElementById("to_error").innerHTML = 'This field is required!';
            return false;
            }
            
            if(!validateDateRange(from_date, to_date)){// checking if date range is correct
            document.getElementById("from_error").style.display = 'block';
            document.getElementById("from_error").className = 'req text-danger';
            document.getElementById("from_error").innerHTML = 'Invalid date range!, From date should be before To date';
            return false;
            }
            
            $.hideModal();
            
            
                if ($.fn.DataTable.isDataTable('#total_unique_vistors')) {
                // Destroy the existing DataTable instance
                $('#total_unique_vistors').DataTable().destroy();
              }
            
              // Reinitialize the DataTable with the updated date range
              $('#total_unique_vistors').DataTable({
                ajax: base_url + 'admin/report/activity_log_data?start=' + from_date + '&end=' + to_date,
                order: [],
                bAutoWidth: false
              });

        }
    </script>

</footer>
</html>
