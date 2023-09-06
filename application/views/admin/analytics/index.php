<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<style>
h6 {text-align: center;}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Analytics</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Analytics</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Vendor Signups</h3>
                                <div>
                                    <h6 style="display:inline;" id="date-text">
                                        <?php 
                                        $start = 7;
                                        $temp = array_slice($vendor_signups, -$start);
                                        echo "(" . $temp[0]['date'] . "" . " - " . $temp[$start-1]['date'] . ")"  
                                        ?>
                                    </h6>
                                    <a style="display:inline;" class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        Range <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-item" style="cursor: pointer"
                                            onclick="change_vendor_graph(7)">Past 7 days</div>
                                        <div class="dropdown-item" style="cursor: pointer"
                                            onclick="change_vendor_graph(30)">Past 30 days</div>
                                        <div class="dropdown-item" style="cursor: pointer"
                                            onclick="change_vendor_graph(90)">Past 90 days</div>
                                        <div class="dropdown-item" style="cursor: pointer" data-toggle="modal"
                                            data-target="#vendorRange">Custom Range</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg" id="current_total_vendor">820</span>
                                    <span>Current total vendors</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-center">
                                    <span class="text-bold text-lg" id="past_total_vendor">620</span>
                                    <span>Past total vendors</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right" id="vendor_percentage_change">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> 12.5%
                                    </span>
                                    <span>Since last week</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                            <div class="position-relative mb-4">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="vendors-chart" height="250" width="416"
                                    style="display: block; height: 200px; width: 333px;"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> Current
                                </span>
                                <span>
                                    <i class="fas fa-square text-gray"></i> Past
                                </span>
                            </div>
                        </div>

                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Active Users</h3>
                                <div>
                                    <h6 style="display:inline;" id="date-text-active">
                                        <?php 
                                        $start = 7;
                                        $temp = array_slice($vendor_signups, -$start);
                                        echo "(" . $temp[0]['date'] . "" . " - " . $temp[$start-1]['date'] . ")"  
                                        ?>
                                    </h6>
                                    <a style="display:inline;" class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        Range <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-item" style="cursor: pointer"
                                            onclick="change_active_graph(7)">Past 7 days</div>
                                        <div class="dropdown-item" style="cursor: pointer"
                                            onclick="change_active_graph(30)">Past 30 days</div>
                                        <div class="dropdown-item" style="cursor: pointer"
                                            onclick="change_active_graph(90)">Past 90 days</div>
                                        <div class="dropdown-item" style="cursor: pointer" data-toggle="modal"
                                            data-target="#activeUserRange">Custom Range</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg" id="new_active_users">820</span>
                                    <span>New Users</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-center">
                                    <span class="text-bold text-lg" id="returning_active_users">620</span>
                                    <span>Returning users</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-center">
                                    <span class="text-bold text-lg" id="total_active_users">620</span>
                                    <span>Total active users</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right" id="active_percentage_change">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> 12.5%
                                    </span>
                                    <span>Since last week</span>
                                </p>
                            </div>
                            <div class="position-relative mb-4">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="active-users-chart" height="250" width="416"
                                    style="display: block; height: 200px; width: 333px;"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> New Visitors
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-square" style="color:#e7990f"></i> Returning Visitors
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-square text-success"></i> Total Visitors
                                </span>
                            </div>
                        </div>

                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Profile Actions</h3>
                                <div>
                                    <h6 style="display:inline;" id="date-text-profile-actions">
                                        <?php 
                                        $start = 7;
                                        $temp = array_slice($vendor_signups, -$start);
                                        echo "(" . $temp[0]['date'] . "" . " - " . $temp[$start-1]['date'] . ")"  
                                        ?>
                                    </h6>
                                    <a style="display:inline;" class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        Range <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-item" style="cursor: pointer"
                                            onclick="change_action_graph(7)">Past 7 days</div>
                                        <div class="dropdown-item" style="cursor: pointer"
                                            onclick="change_action_graph(30)">Past 30 days</div>
                                        <div class="dropdown-item" style="cursor: pointer"
                                            onclick="change_action_graph(90)">Past 90 days</div>
                                        <div class="dropdown-item" style="cursor: pointer" data-toggle="modal"
                                            data-target="#profileActionsRange">Custom Range</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg" id="profile_views">820</span>
                                    <span>Views</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-center">
                                    <span class="text-bold text-lg" id="profile_pdfs">620</span>
                                    <span>Pdfs</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-center">
                                    <span class="text-bold text-lg" id="profile_hires">620</span>
                                    <span>Hire's</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-bold text-lg" id="profile_shares">620</span>
                                    <span>Shares</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                            <div class="position-relative mb-4">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="profiles-action-chart" height="250" width="416"
                                    style="display: block; height: 200px; width: 333px;"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> Pdf
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-square" style="color: #f43a35"></i> Hire
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-square text-success"></i> views
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-square" style="color: #e7990f"></i> Shares
                                    <span>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Profile Uploads</h3>
                                <div>
                                    <h6 style="display:inline;" id="date-text-profile-uploads">
                                        <?php 
                                        $start = 7;
                                        $temp = array_slice($vendor_signups, -$start);
                                        echo "(" . $temp[0]['date'] . "" . " - " . $temp[$start-1]['date'] . ")"  
                                        ?>
                                    </h6>
                                    <a style="display:inline;" class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        Range <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-item" style="cursor: pointer"
                                            onclick="change_profile_graph(7)">Past 7 days</div>
                                        <div class="dropdown-item" style="cursor: pointer"
                                            onclick="change_profile_graph(30)">Past 30 days</div>
                                        <div class="dropdown-item" style="cursor: pointer"
                                            onclick="change_profile_graph(90)">Past 90 days</div>
                                        <div class="dropdown-item" style="cursor: pointer" data-toggle="modal"
                                            data-target="#profileRange">Custom Range</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg" id="current_total_profile">820</span>
                                    <span>Current total profiles</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-center">
                                    <span class="text-bold text-lg" id="past_total_profile">620</span>
                                    <span>Past total profiles</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right" id="profile_percentage_change">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> 12.5%
                                    </span>
                                    <span>Since last week</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                            <div class="position-relative mb-4">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="profiles-chart" height="250" width="416"
                                    style="display: block; height: 200px; width: 333px;"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> Current
                                </span>
                                <span>
                                    <i class="fas fa-square text-gray"></i> Past
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Total Visitors</h3>
                                <div>
                                    <h6 style="display:inline;" id="date-text-total-visitors">
                                        <?php 
                                        $start = 7;
                                        $temp = array_slice($vendor_signups, -$start);
                                        echo "(" . $temp[0]['date'] . "" . " - " . $temp[$start-1]['date'] . ")"  
                                        ?>
                                    </h6>
                                    <a style="display:inline;" class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        Range <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-item" style="cursor: pointer"
                                            onclick="change_visitor_graph(7)">Past 7 days</div>
                                        <div class="dropdown-item" style="cursor: pointer"
                                            onclick="change_visitor_graph(30)">Past 30 days</div>
                                        <div class="dropdown-item" style="cursor: pointer"
                                            onclick="change_visitor_graph(90)">Past 90 days</div>
                                        <div class="dropdown-item" style="cursor: pointer" data-toggle="modal"
                                            data-target="#totalVisitorsRange">Custom Range</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg" id="new_visitor">820</span>
                                    <span>New visitors</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-center">
                                    <span class="text-bold text-lg" id="returning_visitor">620</span>
                                    <span>Returning visitors</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-center">
                                    <span class="text-bold text-lg" id="total_visitor">620</span>
                                    <span>Total visitors</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right" id="visitor_percentage_change">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> 12.5%
                                    </span>
                                    <span>Since last week</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                            <div class="position-relative mb-4">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="total-visitors-chart" height="250" width="416"
                                    style="display: block; height: 200px; width: 333px;"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> New Visitors
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-square" style="color:#e7990f"></i> Returning Visitors
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-square text-success"></i> Total Visitors
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                Profile Uploads
                            </h3>
                            <!-- /.card-tools -->
                        </div>
                        <div class="card-body">
                            <div id="world-map" style="height: 320px; width: 100%;"></div>
                        </div>
                        <!-- /.card-body-->
                    </div>

                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>

        <!-- /.content -->

        <!-- Custom Range Vendor -->
        <div class="modal fade" id="vendorRange">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Vendor Signups</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form onsubmit="">
                            <div class="form-group">
                                <label for="fromDateVendor">From:</label>
                                <input type="date" class="form-control" id="fromDateVendor"
                                    min="<?php echo min(array_column($vendor_signups, 'date')); ?>"
                                    max="<?php echo max(array_column($vendor_signups, 'date')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="toDateVendor">To:</label>
                                <input type="date" class="form-control" id="toDateVendor"
                                    min="<?php echo min(array_column($vendor_signups, 'date')); ?>"
                                    max="<?php echo max(array_column($vendor_signups, 'date')); ?>">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" data-dismiss="modal"
                            onclick="customDateRangeVendor()">Submit</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Custom Range Active users -->
        <div class="modal fade" id="activeUserRange">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Active User Range</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form onsubmit="">
                            <div class="form-group">
                                <label for="fromDateActive">From:</label>
                                <input type="date" class="form-control" id="fromDateActive"
                                    min="<?php echo min(array_column($active_users, 'date')); ?>"
                                    max="<?php echo max(array_column($active_users, 'date')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="toDateActive">To:</label>
                                <input type="date" class="form-control" id="toDateActive"
                                    min="<?php echo min(array_column($active_users, 'date')); ?>"
                                    max="<?php echo max(array_column($active_users, 'date')); ?>">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" data-dismiss="modal"
                            onclick="customDateRangeActive()">Submit</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Custom Range Profile -->
        <div class="modal fade" id="profileRange">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Profile Uploads</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="fromDateprofile">From:</label>
                                <input type="date" class="form-control" id="fromDateProfile"
                                    min="<?php echo min(array_column($profiles_uploads, 'date')); ?>"
                                    max="<?php echo max(array_column($profiles_uploads, 'date')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="toDateProfile">To:</label>
                                <input type="date" class="form-control" id="toDateProfile"
                                    min="<?php echo min(array_column($profiles_uploads, 'date')); ?>"
                                    max="<?php echo max(array_column($profiles_uploads, 'date')); ?>">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" data-dismiss="modal"
                            onclick="customDateRangeProfile()">Submit</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Custom Range Total Visitors -->
        <div class="modal fade" id="totalVisitorsRange">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Total Visitors</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form onsubmit="">
                            <div class="form-group">
                                <label for="fromDateVisitor">From:</label>
                                <input type="date" class="form-control" id="fromDateVisitor"
                                    min="<?php echo min(array_column($total_visitors, 'date')); ?>"
                                    max="<?php echo max(array_column($total_visitors, 'date')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="toDateVisitor">To:</label>
                                <input type="date" class="form-control" id="toDateVisitor"
                                    min="<?php echo min(array_column($total_visitors, 'date')); ?>"
                                    max="<?php echo max(array_column($total_visitors, 'date')); ?>">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" data-dismiss="modal"
                            onclick="customDateRangeVisitor()">Submit</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Custom Range Profile Actions -->
        <div class="modal fade" id="profileActionsRange">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Profile Actions</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form onsubmit="">
                            <div class="form-group">
                                <label for="fromDateAction">From:</label>
                                <input type="date" class="form-control" id="fromDateAction"
                                    min="<?php echo min(array_column($profile_actions, 'day')); ?>"
                                    max="<?php echo max(array_column($profile_actions, 'day')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="toDateAction">To:</label>
                                <input type="date" class="form-control" id="toDateAction"
                                    min="<?php echo min(array_column($profile_actions, 'day')); ?>"
                                    max="<?php echo max(array_column($profile_actions, 'day')); ?>">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" data-dismiss="modal"
                            onclick="customDateRangeAction()">Submit</button>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.content-wrapper -->

<script>
    //vendor graph date range
    function customDateRangeVendor() {
        var fromDate = document.getElementById("fromDateVendor").value;
        var toDate = document.getElementById("toDateVendor").value;
        
        // var temp = data_labels_vendor.slice(0 - id);
        // var end = temp.length-1;
        // var start = 0;
        

        console.log("From date: " + fromDate);
        console.log("To date: " + toDate);
        if (fromDate == '') {
            return;
        }

        var start = data_labels_vendor.indexOf(fromDate);
        var end = data_labels_vendor.indexOf(toDate) + 1;
        
        document.getElementById("date-text").innerHTML = "(" + fromDate +" - "+ toDate +")";


        if (toDate == '') {
            end = data_labels_vendor.length;
        }

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode = 'index'
        var intersect = true


        var current_total_vendor = data_list_vendor.slice(start, end).reduce((total, current) => total + current, 0);

        var past_total_vendor = data_list_vendor.slice(start - (end - start), start).reduce((total, current) => total + current, 0);

        var vendor_percentage_change = ((current_total_vendor - past_total_vendor) / past_total_vendor) * 100;

        console.log(current_total_vendor, past_total_vendor, vendor_percentage_change);

        document.getElementById('current_total_vendor').innerText = current_total_vendor;

        document.getElementById('past_total_vendor').innerText = past_total_vendor;


        // Select the span element by its ID and update its HTML
        var percentageChangeElement = document.getElementById("vendor_percentage_change");
        if (vendor_percentage_change > 0) {
            percentageChangeElement.innerHTML = '<span class="text-success" ><i class="fas fa-arrow-up"></i> ' + Math.abs(vendor_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
        }
        else {
            percentageChangeElement.innerHTML = '<span class="text-danger" ><i class="fas fa-arrow-down"></i> ' + Math.abs(vendor_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
        }



        vendorChart.destroy();
        vendorChart = $('#vendors-chart')
        vendorChart = new Chart(vendorChart, {
            data: {
                labels: data_labels_vendor.slice(start, end),
                datasets: [{
                    type: 'line',
                    data: data_list_vendor.slice(start, end),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    pointBorderColor: '#007bff',
                    pointBackgroundColor: '#007bff',
                },
                {
                    type: 'line',
                    data: data_list_vendor.slice(start - (end - start), start),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#ced4da',
                    pointBorderColor: '#ced4da',
                    pointBackgroundColor: '#ced4da',
                    borderDash: [10, 5]
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true
                        },
                        ticks: $.extend({
                            beginAtZero: true,
                            suggestedMax: Math.max.apply(null, data_list_vendor.slice(start, end))
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: true
                        },
                        ticks: { maxTicksLimit: 15 }
                    }]
                }
            }
        });
    }
</script>
<script>
    //profile upload date range
    function customDateRangeProfile() {
        var fromDate = document.getElementById("fromDateProfile").value;
        var toDate = document.getElementById("toDateProfile").value;

        console.log("From date: " + fromDate);
        console.log("To date: " + toDate);
        if (fromDate == '') {
            return;
        }
        
        var start = data_labels_vendor.indexOf(fromDate);
        var end = data_labels_vendor.indexOf(toDate) + 1;
        
        document.getElementById("date-text-profile-uploads").innerHTML = "(" + fromDate +" - "+ toDate +")";

        var start = data_labels_profile.indexOf(fromDate);
        var end = data_labels_profile.indexOf(toDate) + 1;

        if (toDate == '') {
            end = data_labels_profile.length;
        }

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode = 'index'
        var intersect = true


        var current_total_profile = data_list_profile.slice(start, end).reduce((total, current) => total + current, 0);

        var past_total_profile = data_list_profile.slice(start - (end - start), start).reduce((total, current) => total + current, 0);

        var profile_percentage_change = ((current_total_profile - past_total_profile) / past_total_profile) * 100;

        console.log(current_total_profile, past_total_profile, past_total_profile);

        document.getElementById('current_total_profile').innerText = current_total_profile;

        document.getElementById('past_total_profile').innerText = past_total_profile;


        // Select the span element by its ID and update its HTML
        var percentageChangeElement = document.getElementById("profile_percentage_change");
        if (profile_percentage_change > 0) {
            percentageChangeElement.innerHTML = '<span class="text-success" ><i class="fas fa-arrow-up"></i> ' + Math.abs(profile_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
        }
        else {
            percentageChangeElement.innerHTML = '<span class="text-danger" ><i class="fas fa-arrow-down"></i> ' + Math.abs(profile_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
        }


        profilesChart.destroy()
        profilesChart = $('#profiles-chart')
        profilesChart = new Chart(profilesChart, {
            data: {
                labels: data_labels_profile.slice(start, end),
                datasets: [{
                    type: 'line',
                    data: data_list_profile.slice(start, end),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    pointBorderColor: '#007bff',
                    pointBackgroundColor: '#007bff',
                },
                {
                    type: 'line',
                    data: data_list_profile.slice(start - (end - start), start),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#ced4da',
                    pointBorderColor: '#ced4da',
                    pointBackgroundColor: '#ced4da',
                    borderDash: [10, 5]
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true
                        },
                        ticks: $.extend({
                            beginAtZero: true,
                            suggestedMax: Math.max.apply(null, data_list_profile.slice(start, end))
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: true
                        },
                        ticks: { maxTicksLimit: 15 }
                    }]
                }
            }
        });
    }


</script>

<script>
    //Active users date range
    function customDateRangeActive() {
        var fromDate = document.getElementById("fromDateActive").value;
        var toDate = document.getElementById("toDateActive").value;

        console.log("From date: " + fromDate);
        console.log("To date: " + toDate);
        if (fromDate == '') {
            return;
        }
        
        var start = data_labels_vendor.indexOf(fromDate);
        var end = data_labels_vendor.indexOf(toDate) + 1;
        
        document.getElementById("date-text-active").innerHTML = "(" + fromDate +" - "+ toDate +")";

        var start = data_labels_active.indexOf(fromDate);
        var end = data_labels_active.indexOf(toDate) + 1;

        if (toDate == '') {
            end = data_labels_active.length;
        }

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }


        var new_active_users = data_list_active_new.slice(start, end).reduce((total, current) => total + current, 0);

        var returning_active_users = data_list_active_returning.slice(start, end).reduce((total, current) => total + current, 0);

        var total_active_users = new_active_users + returning_active_users;

        var new_active_users_past = data_list_active_new.slice(start - (end - start), start).reduce((total, current) => total + current, 0);

        var returning_active_users_past = data_list_active_returning.slice(start - (end - start), start).reduce((total, current) => total + current, 0);

        var total_active_users_past = new_active_users_past + returning_active_users_past;

        var active_percentage_change = ((total_active_users - total_active_users_past) / total_active_users_past) * 100;


        document.getElementById('new_active_users').innerText = new_active_users;

        document.getElementById('returning_active_users').innerText = returning_active_users;

        document.getElementById('total_active_users').innerText = total_active_users;

        // Select the span element by its ID and update its HTML
        var percentageChangeElement = document.getElementById("active_percentage_change");
        if (active_percentage_change > 0) {
            percentageChangeElement.innerHTML = '<span class="text-success" ><i class="fas fa-arrow-up"></i> ' + Math.abs(active_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
        }
        else {
            percentageChangeElement.innerHTML = '<span class="text-danger" ><i class="fas fa-arrow-down"></i> ' + Math.abs(active_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
        }

        var mode = 'index'
        var intersect = true
        activeUsersChart.destroy();
        activeUsersChart = $('#active-users-chart')
        activeUsersChart = new Chart(activeUsersChart, {
            data: {
                labels: data_labels_active.slice(start, end),
                datasets: [{
                    type: 'line',
                    data: data_list_active_new.slice(start, end),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    pointBorderColor: '#007bff',
                    pointBackgroundColor: '#007bff',
                }, {
                    type: 'line',
                    data: data_list_active_returning.slice(start, end),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#e7990f',
                    pointBorderColor: '#e7990f',
                    pointBackgroundColor: '#e7990f',
                }, {
                    type: 'line',
                    data: data_list_active_total.slice(start, end),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#28a745',
                    pointBorderColor: '#28a745',
                    pointBackgroundColor: '#28a745',
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true
                        },
                        ticks: $.extend({
                            beginAtZero: true,
                            suggestedMax: Math.max.apply(null, data_list_active_total.slice(start, end))
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: true
                        },
                        ticks: { maxTicksLimit: 15 }
                    }]
                }
            }
        });
    }


</script>
<script>
    //Total Visitors date range
    function customDateRangeVisitor() {
        var fromDate = document.getElementById("fromDateVisitor").value;
        var toDate = document.getElementById("toDateVisitor").value;

        console.log("From date: " + fromDate);
        console.log("To date: " + toDate);
        if (fromDate == '') {
            return;
        }
        
        var start = data_labels_vendor.indexOf(fromDate);
        var end = data_labels_vendor.indexOf(toDate) + 1;
        
        document.getElementById("date-text-total-visitors").innerHTML = "(" + fromDate +" - "+ toDate +")"; 
        
        var start = data_labels_visitor.indexOf(fromDate);
        var end = data_labels_visitor.indexOf(toDate) + 1;

        if (toDate == '') {
            end = data_labels_visitor.length;
        }

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }


        var new_visitor = data_list_visitor_new.slice(start, end).reduce((total, current) => total + current, 0);

        var returning_visitor = data_list_visitor_returning.slice(start, end).reduce((total, current) => total + current, 0);

        var total_visitor = new_visitor + returning_visitor;

        var new_visitor_past = data_list_visitor_new.slice(start - (end - start), start).reduce((total, current) => total + current, 0);

        var returning_visitor_past = data_list_visitor_returning.slice(start - (end - start), start).reduce((total, current) => total + current, 0);

        var total_visitor_past = new_visitor_past + returning_visitor_past;

        var visitor_percentage_change = ((total_visitor - total_visitor_past) / total_visitor_past) * 100;


        document.getElementById('new_visitor').innerText = new_visitor;

        document.getElementById('returning_visitor').innerText = returning_visitor;

        document.getElementById('total_visitor').innerText = total_visitor;

        // Select the span element by its ID and update its HTML
        var percentageChangeElement = document.getElementById("visitor_percentage_change");
        if (visitor_percentage_change > 0) {
            percentageChangeElement.innerHTML = '<span class="text-success" ><i class="fas fa-arrow-up"></i> ' + Math.abs(visitor_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
        }
        else {
            percentageChangeElement.innerHTML = '<span class="text-danger" ><i class="fas fa-arrow-down"></i> ' + Math.abs(visitor_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
        }

        var mode = 'index'
        var intersect = true
        visitorsChart.destroy();
        visitorsChart = $('#total-visitors-chart')
        visitorsChart = new Chart(visitorsChart, {
            data: {
                labels: data_labels_visitor.slice(start, end),
                datasets: [{
                    type: 'line',
                    data: data_list_visitor_new.slice(start, end),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    pointBorderColor: '#007bff',
                    pointBackgroundColor: '#007bff',
                },
                {
                    type: 'line',
                    data: data_list_visitor_returning.slice(start, end),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#e7990f',
                    pointBorderColor: '#e7990f',
                    pointBackgroundColor: '#e7990f',
                },
                {
                    type: 'line',
                    data: data_list_visitor_total.slice(start, end),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#28a745',
                    pointBorderColor: '#28a745',
                    pointBackgroundColor: '#28a745',
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true
                        },
                        ticks: $.extend({
                            beginAtZero: true,
                            suggestedMax: Math.max.apply(null, data_list_visitor_total.slice(start, end)),
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: true
                        },
                        ticks: { maxTicksLimit: 15 }
                    }]
                }
            }
        });
    }


</script>

<script>
    //Profile Actions date range
    function customDateRangeAction() {
        var fromDate = document.getElementById("fromDateAction").value;
        var toDate = document.getElementById("toDateAction").value;

        console.log("From date: " + fromDate);
        console.log("To date: " + toDate);
        if (fromDate == '') {
            return;
        }
        
        var start = data_labels_vendor.indexOf(fromDate);
        var end = data_labels_vendor.indexOf(toDate) + 1;
        
        document.getElementById("date-text-profile-actions").innerHTML = "(" + fromDate +" - "+ toDate +")";

        var start = data_labels_actions.indexOf(fromDate);
        var end = data_labels_actions.indexOf(toDate) + 1;

        if (toDate == '') {
            end = data_labels_actions.length;
        }

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }


        var profile_views = data_list_actions_view.slice(start, end).reduce((total, current) => total + current, 0);

        var profile_hires = data_list_actions_hire.slice(start, end).reduce((total, current) => total + current, 0);

        var profile_shares = data_list_actions_share.slice(start, end).reduce((total, current) => total + current, 0);

        var profile_pdfs = data_list_actions_pdf.slice(start, end).reduce((total, current) => total + current, 0);


        document.getElementById('profile_views').innerText = profile_views;

        document.getElementById('profile_hires').innerText = profile_hires;

        document.getElementById('profile_shares').innerText = profile_shares;

        document.getElementById('profile_pdfs').innerText = profile_pdfs;

        var mode = 'index'
        var intersect = true
        profileActionsChart.destroy();
        profileActionsChart = $('#profiles-action-chart')
        profileActionsChart = new Chart(profileActionsChart, {
            data: {
                labels: data_labels_actions.slice(start, end),
                datasets: [{
                    type: 'line',
                    data: data_list_actions_pdf.slice(start, end),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    pointBorderColor: '#007bff',
                    pointBackgroundColor: '#007bff',
                },
                {
                    type: 'line',
                    data: data_list_actions_hire.slice(start, end),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#f43a35',
                    pointBorderColor: '#f43a35',
                    pointBackgroundColor: '#f43a35',
                },
                {
                    type: 'line',
                    data: data_list_actions_share.slice(start, end),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#e7990f',
                    pointBorderColor: '#e7990f',
                    pointBackgroundColor: '#e7990f',
                },
                {
                    type: 'line',
                    data: data_list_actions_view.slice(start, end),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#28a745',
                    pointBorderColor: '#28a745',
                    pointBackgroundColor: '#28a745',
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true
                        },
                        ticks: $.extend({
                            beginAtZero: true,
                            suggestedMax: Math.max.apply(null, data_list_actions_view.slice(start, end)),
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: true
                        },
                        ticks: { maxTicksLimit: 15 }
                    }]
                }
            }
        });
    }


</script>

<script>
    var visitorsChart;
    var profilesChart;
    var activeUsersChart;
    var vendorChart;
    var profileActionsChart;
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(function () {
            'use strict'

            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }

            var mode = 'index'
            var intersect = true

            <?php
            $vendor_signups_this_week = array_slice($vendor_signups, -7);
            $vendor_signups_last_week = array_slice($vendor_signups, -14, 7);

            ?>

            var current_total_vendor = <?php echo array_sum(array_column($vendor_signups_this_week, 'signups')); ?>

            var past_total_vendor = <?php echo array_sum(array_column($vendor_signups_last_week, 'signups')); ?>

            var vendor_percentage_change = ((current_total_vendor - past_total_vendor) / past_total_vendor) * 100;


            document.getElementById('current_total_vendor').innerText = current_total_vendor;

            document.getElementById('past_total_vendor').innerText = past_total_vendor;


            // Select the span element by its ID and update its HTML
            var percentageChangeElement = document.getElementById("vendor_percentage_change");
            if (vendor_percentage_change > 0) {
                percentageChangeElement.innerHTML = '<span class="text-success" ><i class="fas fa-arrow-up"></i> ' + Math.abs(vendor_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
            }
            else {
                percentageChangeElement.innerHTML = '<span class="text-danger" ><i class="fas fa-arrow-down"></i> ' + Math.abs(vendor_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
            }




            vendorChart = $('#vendors-chart')
            vendorChart = new Chart(vendorChart, {
                data: {
                    labels: [<?php
                    foreach ($vendor_signups_this_week as $day) {
                        echo "'" . $day['date'] . "',";
                    }
                    ?>],
                    datasets: [{
                        type: 'line',
                        data: [<?php

                        foreach ($vendor_signups_this_week as $day) {
                            echo $day['signups'] . ",";
                        }
                        ?>],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        pointBorderColor: '#007bff',
                        pointBackgroundColor: '#007bff',
                    },
                    {
                        type: 'line',
                        data: [<?php
                        foreach ($vendor_signups_last_week as $day) {
                            echo $day['signups'] . ",";
                        }
                        ?>],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#ced4da',
                        pointBorderColor: '#ced4da',
                        pointBackgroundColor: '#ced4da',
                        borderDash: [10, 5]
                    }]
                },
                options: {
                    
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                suggestedMax: <?php echo max(array_column($vendor_signups_this_week, 'signups')); ?>
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: true
                            }
                        }]
                    }
                }
            });

            <?php
            $profiles_uploads_this_week = array_slice($profiles_uploads, -7);
            $profiles_uploads_last_week = array_slice($profiles_uploads, -14, 7);
            ?>

            var current_total_profile = <?php echo array_sum(array_column($profiles_uploads_this_week, 'uploads')); ?>

            var past_total_profile = <?php echo array_sum(array_column($profiles_uploads_last_week, 'uploads')); ?>

            var profile_percentage_change = ((current_total_profile - past_total_profile) / past_total_profile) * 100;


            document.getElementById('current_total_profile').innerText = current_total_profile;

            document.getElementById('past_total_profile').innerText = past_total_profile;


            // Select the span element by its ID and update its HTML
            var percentageChangeElement = document.getElementById("profile_percentage_change");
            if (profile_percentage_change > 0) {
                percentageChangeElement.innerHTML = '<span class="text-success" ><i class="fas fa-arrow-up"></i> ' + Math.abs(profile_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
            }
            else {
                percentageChangeElement.innerHTML = '<span class="text-danger" ><i class="fas fa-arrow-down"></i> ' + Math.abs(profile_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
            }

            profilesChart = $('#profiles-chart')
            profilesChart = new Chart(profilesChart, {
                data: {
                    labels: [<?php

                    foreach ($profiles_uploads_this_week as $day) {
                        echo "'" . $day['date'] . "',";
                    }
                    ?>],
                    datasets: [{
                        type: 'line',
                        data: [<?php

                        foreach ($profiles_uploads_this_week as $day) {
                            echo $day['uploads'] . ",";
                        }
                        ?>],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        pointBorderColor: '#007bff',
                        pointBackgroundColor: '#007bff',
                    }, {
                        type: 'line',
                        data: [<?php

                        foreach ($profiles_uploads_last_week as $day) {
                            echo $day['uploads'] . ",";
                        }
                        ?>],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#ced4da',
                        pointBorderColor: '#ced4da',
                        pointBackgroundColor: '#ced4da',
                        borderDash: [10, 5]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                suggestedMax: <?php echo max(array_column($profiles_uploads_this_week, 'uploads')); ?>
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: true
                            }
                        }]
                    }
                }
            })

            <?php
            $active_users_this_week = array_slice($active_users, -7);
            $active_users_last_week = array_slice($active_users, -14, 7);
            ?>

            var new_active_users = <?php echo array_sum(array_column($active_users_this_week, 'new_logged_users')); ?>

            var returning_active_users = <?php echo array_sum(array_column($active_users_this_week, 'returning_logged_users')); ?>

            var total_active_users = new_active_users + returning_active_users;

            var new_active_users_past = <?php echo array_sum(array_column($active_users_last_week, 'new_logged_users')); ?>

            var returning_active_users_past = <?php echo array_sum(array_column($active_users_last_week, 'returning_logged_users')); ?>

            var total_active_users_past = new_active_users_past + returning_active_users_past;

            var active_percentage_change = ((total_active_users - total_active_users_past) / total_active_users_past) * 100;


            document.getElementById('new_active_users').innerText = new_active_users;

            document.getElementById('returning_active_users').innerText = returning_active_users;

            document.getElementById('total_active_users').innerText = total_active_users;

            // Select the span element by its ID and update its HTML
            var percentageChangeElement = document.getElementById("active_percentage_change");
            if (active_percentage_change > 0) {
                percentageChangeElement.innerHTML = '<span class="text-success" ><i class="fas fa-arrow-up"></i> ' + Math.abs(active_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
            }
            else {
                percentageChangeElement.innerHTML = '<span class="text-danger" ><i class="fas fa-arrow-down"></i> ' + Math.abs(active_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
            }

            activeUsersChart = $('#active-users-chart')
            activeUsersChart = new Chart(activeUsersChart, {
                data: {
                    labels: [<?php

                    foreach ($active_users_this_week as $day) {
                        echo "'" . $day['date'] . "',";
                    }
                    ?>],
                    datasets: [{
                        type: 'line',
                        data: [<?php

                        foreach ($active_users_this_week as $day) {
                            echo $day['new_logged_users'] . ",";
                        }
                        ?>],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        pointBorderColor: '#007bff',
                        pointBackgroundColor: '#007bff',
                    }, {
                        type: 'line',
                        data: [<?php
                        foreach ($active_users_this_week as $day) {
                            echo $day['returning_logged_users'] . ",";
                        }
                        ?>],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#e7990f',
                        pointBorderColor: '#e7990f',
                        pointBackgroundColor: '#e7990f',
                    }, {
                        type: 'line',
                        data: [<?php
                        foreach ($active_users_this_week as $day) {
                            echo ($day['returning_logged_users'] + $day['new_logged_users']) . ",";
                        }
                        ?>],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#28a745',
                        pointBorderColor: '#28a745',
                        pointBackgroundColor: '#28a745',
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                suggestedMax: <?php echo max(array_column($active_users_this_week, 'new_logged_users')); ?>
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: true
                            }
                        }]
                    }
                }
            })
            
            <?php
            $total_visitors_this_week = array_slice($total_visitors, -7);
            $total_visitors_last_week = array_slice($total_visitors, -14, 7);
            ?>

            var new_visitor = <?php echo array_sum(array_column($total_visitors_this_week, 'new_visitors')); ?>

            var returning_visitor = <?php echo array_sum(array_column($total_visitors_this_week, 'returning_visitors')); ?>

            var total_visitor = new_visitor + returning_visitor;

            var new_visitor_past = <?php echo array_sum(array_column($total_visitors_last_week, 'new_visitors')); ?>

            var returning_visitor_past = <?php echo array_sum(array_column($total_visitors_last_week, 'returning_visitors')); ?>

            var total_visitor_past = new_visitor_past + returning_visitor_past;

            var visitor_percentage_change = ((total_visitor - total_visitor_past) / total_visitor_past) * 100;


            document.getElementById('new_visitor').innerText = new_visitor;

            document.getElementById('returning_visitor').innerText = returning_visitor;

            document.getElementById('total_visitor').innerText = total_visitor;

            // Select the span element by its ID and update its HTML
            var percentageChangeElement = document.getElementById("visitor_percentage_change");
            if (visitor_percentage_change > 0) {
                percentageChangeElement.innerHTML = '<span class="text-success" ><i class="fas fa-arrow-up"></i> ' + Math.abs(visitor_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
            }
            else {
                percentageChangeElement.innerHTML = '<span class="text-danger" ><i class="fas fa-arrow-down"></i> ' + Math.abs(visitor_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
            }

            visitorsChart = $('#total-visitors-chart')
            visitorsChart = new Chart(visitorsChart, {
                data: {
                    labels: [<?php

                    foreach ($total_visitors_this_week as $day) {
                        echo "'" . $day['date'] . "',";
                    }
                    ?>],
                    datasets: [{
                        type: 'line',
                        data: [<?php

                        foreach ($total_visitors_this_week as $day) {
                            echo $day['new_visitors'] . ",";
                        }
                        ?>],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        pointBorderColor: '#007bff',
                        pointBackgroundColor: '#007bff',
                    },
                    {
                        type: 'line',
                        data: [<?php

                        foreach ($total_visitors_this_week as $day) {
                            echo $day['returning_visitors'] . ",";
                        }
                        ?>],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#e7990f',
                        pointBorderColor: '#e7990f',
                        pointBackgroundColor: '#e7990f',
                    },
                    {
                        type: 'line',
                        data: [<?php

                        foreach ($total_visitors_this_week as $day) {
                            echo ($day['returning_visitors'] + $day['new_visitors']) . ",";
                        }
                        ?>],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#28a745',
                        pointBorderColor: '#28a745',
                        pointBackgroundColor: '#28a745',
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                suggestedMax: <?php echo max(array_column($total_visitors_this_week, 'new_visitors')); ?>
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: true
                            }
                        }]
                    }
                }
            });


            <?php
            $profile_actions_this_week = array_slice($profile_actions, -7);
            ?>

            var profile_views = <?php echo array_sum(array_column($profile_actions_this_week, 'views')); ?>

            var profile_hires = <?php echo array_sum(array_column($profile_actions_this_week, 'hires')); ?>

            var profile_shares = <?php echo array_sum(array_column($profile_actions_this_week, 'shares')); ?>

            var profile_pdfs = <?php echo array_sum(array_column($profile_actions_this_week, 'pdfs')); ?>


            document.getElementById('profile_views').innerText = profile_views;

            document.getElementById('profile_hires').innerText = profile_hires;

            document.getElementById('profile_shares').innerText = profile_shares;

            document.getElementById('profile_pdfs').innerText = profile_pdfs;


            profileActionsChart = $('#profiles-action-chart')
            profileActionsChart = new Chart(profileActionsChart, {
                data: {
                    labels: [<?php

                    foreach ($profile_actions_this_week as $day) {
                        echo "'" . $day['day'] . "',";
                    }
                    ?>],
                    datasets: [{
                        type: 'line',
                        data: [<?php

                        foreach ($profile_actions_this_week as $day) {
                            echo $day['views'] . ",";
                        }
                        ?>],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#28a745',
                        pointBorderColor: '#28a745',
                        pointBackgroundColor: '#28a745',
                    },
                    {
                        type: 'line',
                        data: [<?php

                        foreach ($profile_actions_this_week as $day) {
                            echo $day['pdfs'] . ",";
                        }
                        ?>],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        pointBorderColor: '#007bff',
                        pointBackgroundColor: '#007bff',
                    }
                        ,
                    {
                        type: 'line',
                        data: [<?php

                        foreach ($profile_actions_this_week as $day) {
                            echo $day['hires'] . ",";
                        }
                        ?>],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#f43a35',
                        pointBorderColor: '#f43a35',
                        pointBackgroundColor: '#f43a35',
                    }
                        ,
                    {
                        type: 'line',
                        data: [<?php

                        foreach ($profile_actions_this_week as $day) {
                            echo $day['shares'] . ",";
                        }
                        ?>],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#e7990f',
                        pointBorderColor: '#e7990f',
                        pointBackgroundColor: '#e7990f',
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                suggestedMax: <?php echo max(array_column($profile_actions_this_week, 'views')); ?>
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: true
                            }
                        }]
                    }
                }
            });
        });
    });
</script>
<script>
    const data_list_vendor = [<?php foreach ($vendor_signups as $day) {
        echo $day['signups'] . ",";
    } ?>]

    const data_labels_vendor = [<?php foreach ($vendor_signups as $day) {
        echo "'" . $day['date'] . "',";
    } ?>]

    const data_list_profile = [<?php foreach ($profiles_uploads as $day) {
        echo $day['uploads'] . ",";
    } ?>]

    const data_labels_profile = [<?php foreach ($profiles_uploads as $day) {
        echo "'" . $day['date'] . "',";
    } ?>]

    const data_labels_active = [<?php foreach ($active_users as $day) {
        echo "'" . $day['date'] . "',";
    } ?>]

    const data_list_active_new = [<?php foreach ($active_users as $day) {
        echo $day['new_logged_users'] . ",";
    } ?>]

    const data_list_active_returning = [<?php foreach ($active_users as $day) {
        echo $day['returning_logged_users'] . ",";
    } ?>]

    const data_list_active_total = [<?php foreach ($active_users as $day) {
        echo ($day['new_logged_users'] + $day['returning_logged_users']) . ",";
    } ?>]

    const data_labels_visitor = [<?php foreach ($total_visitors as $day) {
        echo "'" . $day['date'] . "',";
    } ?>]

    const data_list_visitor_new = [<?php foreach ($total_visitors as $day) {
        echo $day['new_visitors'] . ",";
    } ?>]

    const data_list_visitor_returning = [<?php foreach ($total_visitors as $day) {
        echo $day['returning_visitors'] . ",";
    } ?>]

    const data_list_visitor_total = [<?php foreach ($total_visitors as $day) {
        echo ($day['new_visitors'] + $day['returning_visitors']) . ",";
    } ?>]

    const data_labels_actions = [<?php foreach ($profile_actions as $day) {
        echo "'" . $day['day'] . "',";
    } ?>]

    const data_list_actions_view = [<?php foreach ($profile_actions as $day) {
        echo $day['views'] . ",";
    } ?>]

    const data_list_actions_pdf = [<?php foreach ($profile_actions as $day) {
        echo $day['pdfs'] . ",";
    } ?>]

    const data_list_actions_hire = [<?php foreach ($profile_actions as $day) {
        echo $day['hires'] . ",";
    } ?>]

    const data_list_actions_share = [<?php foreach ($profile_actions as $day) {
        echo $day['shares'] . ",";
    } ?>]


    function change_vendor_graph(id) {

        var temp = data_labels_vendor.slice(0 - id);
        var end = temp.length-1;
        var start = 0;
        
        document.getElementById("date-text").innerHTML = "(" + temp[start] +" - "+ temp[end] +")";
        console.log(temp[0]+" "+typeof(temp[id-1]));
        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode = 'index'
        var intersect = true



        var current_total_vendor = data_list_vendor.slice(0 - id).reduce((total, current) => total + current, 0);

        var past_total_vendor = data_list_vendor.slice(0 - 2 * id, 0 - id).reduce((total, current) => total + current, 0);

        var vendor_percentage_change = ((current_total_vendor - past_total_vendor) / past_total_vendor) * 100;

        console.log(current_total_vendor, past_total_vendor, vendor_percentage_change);

        document.getElementById('current_total_vendor').innerText = current_total_vendor;

        document.getElementById('past_total_vendor').innerText = past_total_vendor;


        // Select the span element by its ID and update its HTML
        var percentageChangeElement = document.getElementById("vendor_percentage_change");
        if (vendor_percentage_change > 0) {
            percentageChangeElement.innerHTML = '<span class="text-success" ><i class="fas fa-arrow-up"></i> ' + Math.abs(vendor_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
        }
        else {
            percentageChangeElement.innerHTML = '<span class="text-danger" ><i class="fas fa-arrow-down"></i> ' + Math.abs(vendor_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
        }

        vendorChart.destroy();
        vendorChart = $('#vendors-chart')
        vendorChart = new Chart(vendorChart, {
            data: {
                labels: data_labels_vendor.slice(0 - id),
                datasets: [{
                    type: 'line',
                    data: data_list_vendor.slice(0 - id),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    pointBorderColor: '#007bff',
                    pointBackgroundColor: '#007bff',
                },
                {
                    type: 'line',
                    data: data_list_vendor.slice(0 - 2 * id, 0 - id),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#ced4da',
                    pointBorderColor: '#ced4da',
                    pointBackgroundColor: '#ced4da',
                    borderDash: [10, 5]
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true
                        },
                        ticks: $.extend({
                            beginAtZero: true,
                            suggestedMax: Math.max.apply(null, data_list_vendor.slice(0 - id))
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: true
                        },
                        ticks: { maxTicksLimit: 15 }
                    }]
                }
            }
        });
    }

    function change_profile_graph(id) {
        
        var temp = data_labels_vendor.slice(0 - id);
        var end = temp.length-1;
        var start = 0;
        
        document.getElementById("date-text-profile-uploads").innerHTML = "(" + temp[start] +" - "+ temp[end] +")";

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode = 'index'
        var intersect = true
        profilesChart.destroy()

        var current_total_profile = data_list_profile.slice(0 - id).reduce((total, current) => total + current, 0);

        var past_total_profile = data_list_profile.slice(0 - 2 * id, 0 - id).reduce((total, current) => total + current, 0);

        var profile_percentage_change = ((current_total_profile - past_total_profile) / past_total_profile) * 100;

        console.log(current_total_profile, past_total_profile, past_total_profile);

        document.getElementById('current_total_profile').innerText = current_total_profile;

        document.getElementById('past_total_profile').innerText = past_total_profile;


        // Select the span element by its ID and update its HTML
        var percentageChangeElement = document.getElementById("profile_percentage_change");
        if (profile_percentage_change > 0) {
            percentageChangeElement.innerHTML = '<span class="text-success" ><i class="fas fa-arrow-up"></i> ' + Math.abs(profile_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
        }
        else {
            percentageChangeElement.innerHTML = '<span class="text-danger" ><i class="fas fa-arrow-down"></i> ' + Math.abs(profile_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
        }

        profilesChart = $('#profiles-chart')
        profilesChart = new Chart(profilesChart, {
            data: {
                labels: data_labels_profile.slice(0 - id),
                datasets: [{
                    type: 'line',
                    data: data_list_profile.slice(0 - id),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    pointBorderColor: '#007bff',
                    pointBackgroundColor: '#007bff',
                },
                {
                    type: 'line',
                    data: data_list_profile.slice(0 - 2 * id, 0 - id),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#ced4da',
                    pointBorderColor: '#ced4da',
                    pointBackgroundColor: '#ced4da',
                    borderDash: [10, 5]
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true
                        },
                        ticks: $.extend({
                            beginAtZero: true,
                            suggestedMax: Math.max.apply(null, data_list_profile.slice(0 - id))
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: true
                        },
                        ticks: { maxTicksLimit: 15 }
                    }]
                }
            }
        });
    }



    function change_active_graph(id) {

        var temp = data_labels_vendor.slice(0 - id);
        var end = temp.length-1;
        var start = 0;
        
        document.getElementById("date-text-active").innerHTML = "(" + temp[start] +" - "+ temp[end] +")";
        console.log(temp[0]+" "+typeof(temp[id-1]));
        
        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }
        

        var new_active_users = data_list_active_new.slice(0 - id).reduce((total, current) => total + current, 0);

        var returning_active_users = data_list_active_returning.slice(0 - id).reduce((total, current) => total + current, 0);

        var total_active_users = new_active_users + returning_active_users;

        var new_active_users_past = data_list_active_new.slice(0 - 2 * id, 0 - id).reduce((total, current) => total + current, 0);

        var returning_active_users_past = data_list_active_returning.slice(0 - 2 * id, 0 - id).reduce((total, current) => total + current, 0);

        var total_active_users_past = new_active_users_past + returning_active_users_past;

        var active_percentage_change = ((total_active_users - total_active_users_past) / total_active_users_past) * 100;


        document.getElementById('new_active_users').innerText = new_active_users;

        document.getElementById('returning_active_users').innerText = returning_active_users;

        document.getElementById('total_active_users').innerText = total_active_users;

        // Select the span element by its ID and update its HTML
        var percentageChangeElement = document.getElementById("active_percentage_change");
        if (active_percentage_change > 0) {
            percentageChangeElement.innerHTML = '<span class="text-success" ><i class="fas fa-arrow-up"></i> ' + Math.abs(active_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
        }
        else {
            percentageChangeElement.innerHTML = '<span class="text-danger" ><i class="fas fa-arrow-down"></i> ' + Math.abs(active_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
        }

        var mode = 'index'
        var intersect = true
        activeUsersChart.destroy();
        activeUsersChart = $('#active-users-chart')
        activeUsersChart = new Chart(activeUsersChart, {
            data: {
                labels: data_labels_active.slice(0 - id),
                datasets: [{
                    type: 'line',
                    data: data_list_active_new.slice(0 - id),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    pointBorderColor: '#007bff',
                    pointBackgroundColor: '#007bff',
                }, {
                    type: 'line',
                    data: data_list_active_returning.slice(0 - id),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#e7990f',
                    pointBorderColor: '#e7990f',
                    pointBackgroundColor: '#e7990f',
                }, {
                    type: 'line',
                    data: data_list_active_total.slice(0 - id),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#28a745',
                    pointBorderColor: '#28a745',
                    pointBackgroundColor: '#28a745',
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true
                        },
                        ticks: $.extend({
                            beginAtZero: true,
                            suggestedMax: Math.max.apply(null, data_list_active_total.slice(0 - id))
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: true
                        },
                        ticks: { maxTicksLimit: 15 }
                    }]
                }
            }
        });
    }

    function change_visitor_graph(id) {

        var temp = data_labels_vendor.slice(0 - id);
        var end = temp.length-1;
        var start = 0;
        
        document.getElementById("date-text-total-visitors").innerHTML = "(" + temp[start] +" - "+ temp[end] +")";
        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }


        var new_visitor = data_list_visitor_new.slice(0 - id).reduce((total, current) => total + current, 0);

        var returning_visitor = data_list_visitor_returning.slice(0 - id).reduce((total, current) => total + current, 0);

        var total_visitor = new_visitor + returning_visitor;

        var new_visitor_past = data_list_visitor_new.slice(0 - 2 * id, 0 - id).reduce((total, current) => total + current, 0);

        var returning_visitor_past = data_list_visitor_returning.slice(0 - 2 * id, 0 - id).reduce((total, current) => total + current, 0);

        var total_visitor_past = new_visitor_past + returning_visitor_past;

        var visitor_percentage_change = ((total_visitor - total_visitor_past) / total_visitor_past) * 100;


        document.getElementById('new_visitor').innerText = new_visitor;

        document.getElementById('returning_visitor').innerText = returning_visitor;

        document.getElementById('total_visitor').innerText = total_visitor;

        // Select the span element by its ID and update its HTML
        var percentageChangeElement = document.getElementById("visitor_percentage_change");
        if (visitor_percentage_change > 0) {
            percentageChangeElement.innerHTML = '<span class="text-success" ><i class="fas fa-arrow-up"></i> ' + Math.abs(visitor_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
        }
        else {
            percentageChangeElement.innerHTML = '<span class="text-danger" ><i class="fas fa-arrow-down"></i> ' + Math.abs(visitor_percentage_change).toFixed(0) + '% </span><span >Percentage change</span>';
        }

        var mode = 'index'
        var intersect = true
        visitorsChart.destroy();
        visitorsChart = $('#total-visitors-chart')
        visitorsChart = new Chart(visitorsChart, {
            data: {
                labels: data_labels_visitor.slice(0 - id),
                datasets: [{
                    type: 'line',
                    data: data_list_visitor_new.slice(0 - id),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    pointBorderColor: '#007bff',
                    pointBackgroundColor: '#007bff',
                },
                {
                    type: 'line',
                    data: data_list_visitor_returning.slice(0 - id),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#e7990f',
                    pointBorderColor: '#e7990f',
                    pointBackgroundColor: '#e7990f',
                },
                {
                    type: 'line',
                    data: data_list_visitor_total.slice(0 - id),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#28a745',
                    pointBorderColor: '#28a745',
                    pointBackgroundColor: '#28a745',
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true
                        },
                        ticks: $.extend({
                            beginAtZero: true,
                            suggestedMax: Math.max.apply(null, data_list_visitor_total.slice(0 - id)),
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: true
                        },
                        ticks: { maxTicksLimit: 15 }
                    }]
                }
            }
        });
    }

    function change_action_graph(id) {
        
        var temp = data_labels_vendor.slice(0 - id);
        var end = temp.length-1;
        var start = 0;
        
        document.getElementById("date-text-profile-actions").innerHTML = "(" + temp[start] +" - "+ temp[end] +")";

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var profile_views = data_list_actions_view.slice(0 - id).reduce((total, current) => total + current, 0);

        var profile_hires = data_list_actions_hire.slice(0 - id).reduce((total, current) => total + current, 0);

        var profile_shares = data_list_actions_share.slice(0 - id).reduce((total, current) => total + current, 0);

        var profile_pdfs = data_list_actions_pdf.slice(0 - id).reduce((total, current) => total + current, 0);


        document.getElementById('profile_views').innerText = profile_views;

        document.getElementById('profile_hires').innerText = profile_hires;

        document.getElementById('profile_shares').innerText = profile_shares;

        document.getElementById('profile_pdfs').innerText = profile_pdfs;


        var mode = 'index'
        var intersect = true
        profileActionsChart.destroy();
        profileActionsChart = $('#profiles-action-chart')
        profileActionsChart = new Chart(profileActionsChart, {
            data: {
                labels: data_labels_actions.slice(0 - id),
                datasets: [{
                    type: 'line',
                    data: data_list_actions_pdf.slice(0 - id),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    pointBorderColor: '#007bff',
                    pointBackgroundColor: '#007bff',
                },
                {
                    type: 'line',
                    data: data_list_actions_hire.slice(0 - id),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#f43a35',
                    pointBorderColor: '#f43a35',
                    pointBackgroundColor: '#f43a35',
                },
                {
                    type: 'line',
                    data: data_list_actions_share.slice(0 - id),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#e7990f',
                    pointBorderColor: '#e7990f',
                    pointBackgroundColor: '#e7990f',
                },
                {
                    type: 'line',
                    data: data_list_actions_view.slice(0 - id),
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#28a745',
                    pointBorderColor: '#28a745',
                    pointBackgroundColor: '#28a745',
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true
                        },
                        ticks: $.extend({
                            beginAtZero: true,
                            suggestedMax: Math.max.apply(null, data_list_actions_view.slice(0 - id)),
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: true
                        },
                        ticks: { maxTicksLimit: 15 }
                    }]
                }
            }
        });
    }

</script>
<script>
    <?php
    // Read the countries.json file
    $countries = json_decode(file_get_contents("./assets/countries.json"), true);

    // Create an array with the counts for each country
    $country_counts = array();
    foreach ($profiles_uploads_location as $row) {
        $country_counts[$row['country_code']] = $row['num_rows'];
    }

    foreach ($countries as $country) {
        if (!isset($country_counts[$country['code']])) {
            $country_counts[$country['code']] = '0';
        }
    }
    $result = array();
    foreach ($country_counts as $code => $count) {
        $result[] = array('code' => $code, 'count' => $count);
    }
    ?>
    var profile_location_data = {
        <?php
        foreach ($result as $country) {
            echo $country['code'] . ":" . $country['count'] . ",";
        }

        ?>
    };
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#mainNav").addClass('active');
    });
</script>
