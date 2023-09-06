<div class="content-wrapper">
    <div class="container-fluid py-3">
        <div class="h2">Advance Profile Search </div>
    </div>
    <style>
        .subsearch {
            padding-top: 42px;
        }

        .form-check-input {
            margin-top: 0.75rem;
            margin-right: 0.25rem;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="<?= base_url('admin/search') ?>">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <label for="keyword">Keyword</label>

                                                <input id="keyword" name="keyword" type="text" class="form-control"
                                                    value="<?= $keyword ?>"
                                                    placeholder="Seperate each keyword with comma..">

                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="form-check subsearch">
                                                <input class="form-check-input check-box-whole" type="checkbox"
                                                    name="find_whole" value="true" id="flexCheckDefault" <?php if ($find_whole) {
                                                        echo 'checked';
                                                    } ?>>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Find whole words only
                                                </label>
                                            </div>

                                        </div>

                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group subsearch">
                                                <button name="submit" type="submit"
                                                    class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Exact Results<span style="font-size: 0.9rem;">
                                <?php if (isset($exact_results)) {
                                    echo ' (Profiles found: ' . sizeof($exact_results) . ')';
                                } ?></span>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                            <table id="ExactResult" class="table table-bordered table-hover" >
                                <thead>
                                    <tr>
                                        <th>Unique ID</th>
                                        <th>Name</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Job title</th>
                                        <th>Experience</th>
                                        <th>(Avg)Monthly/Hourly Rate</th>
                                        <th>Active</th>
                                        <th>Status</th>
                                        <th>Match found in</th>
                                        <th>Match count</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($exact_results)) {
                                        foreach ($exact_results as $profile) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $profile['unique_id'] ?>
                                                </td>
                                                <td>
                                                    <?= $profile['last_name'] . ' ' . $profile['first_name'][0] ?>
                                                </td>
                                                <td>
                                                    <?= $profile['country'] ?>
                                                </td>
                                                <td>
                                                    <?= $profile['city'] ?>
                                                </td>
                                                <td>
                                                    <?= $profile['primary_title'] ?>
                                                </td>
                                                <td>
                                                    <?= $profile['experience'] ?>
                                                </td>
                                                <td>
                                                    <?= $profile['currency']. " " .$profile['ppm'].'/'.$profile['pph'] ?>
                                                </td>
                                                <td>
                                                <?php if ($profile['active'] === '1'){
                                                            echo '<span class="text-green">Active</span>';}
                                                        if($profile['active'] === '0'){
                                                            echo '<span class="text-red">In Active</span>';} 
                                                        if($profile['active'] === '2'){
                                                        echo '<span class="text-red">Draft</span>';}  ?>
                                              </td>
                                                <td>
                                                    <?php
                                                    if ($profile['approval'] === '1') {
                                                        echo '<span class="text-green">Approved</span>';
                                                    }
                                                    if ($profile['approval'] === '0') {
                                                        echo '<span class="text-blue">Pending</span>';
                                                    }
                                                    if ($profile['approval'] === '2') {
                                                        echo '<span class="text-red">Awaiting changes</span>';
                                                    }
                                                    if ($profile['approval'] === '3') {
                                                        echo '<span class="text-red">Rejected</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?= $profile['found_in'] ?>
                                                </td>
                                                <td>
                                                    <?= $profile['count'] ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo base_url('profile/' . strtolower($profile['profile_url']) . '/' . strtolower($profile['unique_id'])) ?>"
                                                        class="btn btn-default" target="_blank"><i class="fa fa-eye"></i></a>
                                                    <?php  if(in_array('viewVendor', $this->permission)){ ?>
                                                    <a href="<?php echo base_url('/admin/users/profileinfo/' . $profile['vendor_id']) ?>"
                                                        class="btn btn-default" target="_blank"><i
                                                            class="fa fa-user-circle"></i></a>
                                                    <?php } ?>
                                                    <?php  if(in_array('viewPartner', $this->permission) && !in_array('viewAdmin', $this->permission)){ ?>
                                                        
                                                        <a href="<?php echo base_url('home/profile2pdfpartner/' . $profile['id']. $pdf_parameters) ?>" class="btn btn-default"><i class="fa fa-download"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php }
                                    } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <?php if(sizeof($partial_results) > 0) {?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Partial Results<span style="font-size: 0.9rem;">
                                <?php if (isset($partial_results)) {
                                    echo ' (Profiles found: ' . sizeof($partial_results) . ')';
                                } ?></span>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                            <table id="partialResult" class="table table-bordered table-hover" >
                                <thead>
                                    <tr>
                                        <th>Unique ID</th>
                                        <th>Name</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Job title</th>
                                        <th>Experience</th>
                                        <th>(Avg)Monthly/Hourly Rate</th>
                                        <th>Active</th>
                                        <th>Status</th>
                                        <th>Match found in</th>
                                        <th>Match count</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($partial_results)) {
                                        foreach ($partial_results as $profile) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $profile['unique_id'] ?>
                                                </td>
                                                <td>
                                                    <?= $profile['last_name'] . ' ' . $profile['first_name'][0] ?>
                                                </td>
                                                <td>
                                                    <?= $profile['country'] ?>
                                                </td>
                                                <td>
                                                    <?= $profile['city'] ?>
                                                </td>
                                                <td>
                                                    <?= $profile['primary_title'] ?>
                                                </td>
                                                <td>
                                                    <?= $profile['experience'] ?>
                                                </td>
                                                <!--// active, pph, ppm, currency, approval-->
                                                <td>
                                                    <?= $profile['currency']. " " .$profile['ppm'].'/'.$profile['pph'] ?>
                                                </td>
                                                <td>
                                                    <?php if ($profile['active'] === '1'){
                                                                echo '<span class="text-green">Active</span>';}
                                                            if($profile['active'] === '0'){
                                                                echo '<span class="text-red">In Active</span>';} 
                                                            if($profile['active'] === '2'){
                                                            echo '<span class="text-red">Draft</span>';}  ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($profile['approval'] === '1') {
                                                        echo '<span class="text-green">Approved</span>';
                                                    }
                                                    if ($profile['approval'] === '0') {
                                                        echo '<span class="text-blue">Pending</span>';
                                                    }
                                                    if ($profile['approval'] === '2') {
                                                        echo '<span class="text-red">Awaiting changes</span>';
                                                    }
                                                    if ($profile['approval'] === '3') {
                                                        echo '<span class="text-red">Rejected</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?= $profile['found_in'] ?>
                                                </td>
                                                <td>
                                                    <?= $profile['count'] ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo base_url('profile/' . strtolower($profile['profile_url']) . '/' . strtolower($profile['unique_id'])) ?>"
                                                        class="btn btn-default" target="_blank"><i class="fa fa-eye"></i></a>
                                                    <?php  if(in_array('viewVendor', $this->permission)){ ?>
                                                    <a href="<?php echo base_url('/admin/users/profileinfo/' . $profile['vendor_id']) ?>"
                                                        class="btn btn-default" target="_blank"><i
                                                            class="fa fa-user-circle"></i></a>
                                                    <?php } ?>
                                                    <?php  if(in_array('viewPartner', $this->permission) && !in_array('viewAdmin', $this->permission)){ ?>
                                                        
                                                        <a href="<?php echo base_url('home/profile2pdfpartner/' . $profile['id']. $pdf_parameters) ?>" class="btn btn-default"><i class="fa fa-download"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php }
                                    } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <?php } ?>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#ExactResult').DataTable({
                responsive: true,
                "dom": '<"pull-left"f><"pull-right"l>tip',
                "language": {
                    "search": "Filter records:"
                },
                "autoWidth": false,
                order: [[5, 'desc']],
            });
            
            $('#partialResult').DataTable({
                responsive: true,
                "dom": '<"pull-left"f><"pull-right"l>tip',
                "language": {
                    "search": "Filter records:"
                },
                "autoWidth": false,
                order: [[5, 'desc']],
            });
        });
    </script>



</div>
