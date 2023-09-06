<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<link media="all" rel="stylesheet" href="<?php echo base_url() . $this->config->item('css') . 'admin-dashboard.css' ?>">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Welcome to Talrn Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Dashboard, Version 1.9.1</li>
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
        <div class="col-lg-3 col-12">

          <div class="small-box bg-info ">
            <div class="inner firstRows">
              <h3 style="display: inline">
                <?php echo $active ?>
              </h3>
              <p style="display:inline;">Active Profiles</p>
              <br>
              <p>
                <?php echo $profile_count . ' Total/ ' . $inactive . " Inactive profiles" ?>
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?= base_url('admin/vendor/list') ?>" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-12">

          <div class="small-box bg-info">
            <div class="inner firstRows">
              <h3 style="display: inline">
                <?php echo $active_org ?>
              </h3>
              <p style="display:inline;">Active Org Profiles</p>
              <br>
              <p>
                <?php echo $organisation_count . ' Total Org/ ' . $inactive_org . " Inactive Org profiles" ?>
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?= base_url('admin/stores/') ?>" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-12">

          <div class="small-box bg-info">
            <div class="inner firstRows">
              <div class="inner">
                <h3 style="display: inline">
                  <?php echo $active_ind ?>
                </h3>
                <p style="display:inline;">Active Ind Profiles</p>
                <br>
                <p>
                  <?php echo $individual_count . ' Total Ind / ' . $inactive_ind . " Inactive Ind profiles" ?>
                </p>
              </div>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?= base_url('admin/stores/') ?>" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-12">

          <div class="small-box bg-info">
            <div class="inner firstRows">
              <h3 style="display:inline;">
                <?php echo $users_count ?>
              </h3>
              <p style="display:inline;">Total Vendors</p>
              <br>
              <p>
                <?php echo $upload_profile_users . ' Uploads / ' . $no_upload_profile_users . " No uploads" ?><br>
                <?php echo $total_individual_count . ' ' . ($total_individual_count <= 1 ? 'individual' : 'individuals') . ' / ' . $total_organisation_count . ($total_organisation_count <= 1 ? ' Organisation' : ' Organisations'); ?>
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?= base_url('admin/stores/') ?>" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-12">
          <div class="small-box bg-info">
            <div class="inner">
              <h3 style="display:inline;">
                <?php echo $active_profile_view_count ?>
              </h3>
              <p style="display:inline;">Active Profile Views</p>
              <br>
              <p>
                <?php echo $profile_view_count . ' Total views / ' . $inactive_profile_view_count . " inactive views" ?>
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?= base_url('admin/vendor/reports') ?>" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-12">
          <div class="small-box bg-info">
            <div class="inner">
              <h3 style="display:inline;">
                <?php echo $active_skills_count ?>
              </h3>
              <p style="display:inline;">Active Unique Skills</p>
              <br>
              <p>
                <?php echo $skills_count . ' Total Skills / ' . $inactive_skills_count . " inactive Skills" ?>
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?= base_url('admin/vendor/reports') ?>" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-12">
          <div class="small-box bg-info">
            <div class="inner">
              <h3 style="display:inline;">
                <?php echo $active_industries_count ?>
              </h3>
              <p style="display:inline;">Active Unique Industry</p>
              <br>
              <p>
                <?php echo $industries_count . ' Total Industry / ' . $inactive_industries_count . " inactive Industry" ?>
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?= base_url('admin/vendor/reports') ?>" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-12">
          <div class="small-box bg-info">
            <div class="inner">
              <h3 style="display:inline;">
                <?php echo $active_projects_count ?>
              </h3>
              <p style="display:inline;">Active Projects Report</p>
              <br>
              <p>
                <?php echo $projects_count . ' Total Projects / ' . $inactive_projects_count . " inactive Projects" ?>
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?= base_url('admin/vendor/reports') ?>" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-12">
          <div class="small-box bg-info">
            <div class="inner">
              <h3 style="display:inline;">
                <?php echo $total_clients_count ?>
              </h3>
              <p style="display:inline;">Total Clients</p>
              <br>
              <p>
                <?php echo ($client_pending_count +  $client_approved_count) . ' client jobs ' ?>
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?= base_url('admin/vendor/reports') ?>" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">

          <?php if (in_array('viewAdmin', $user_permission)) { ?>
            <div class="card card-primary card-outline">

              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h6 class="card-text">Profile pending review:&nbsp;
                      <?php echo $pending_count ?>
                    </h6>
                    <h6 class="card-text">Awaiting changes from Vendor:&nbsp;
                      <?php echo $awaiting_count ?>
                    </h6>
                  </div>
                  <div>
                    <a href="<?= base_url('admin/approval') ?>" class="btn btn-primary">Review Profiles</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-primary card-outline">

              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h6 class="card-text">Applicants Pending Review:&nbsp;
                      <?php echo $pending_application_count ?>
                    </h6>
                    <h6 class="card-text">Total Job Applicants:&nbsp;
                      <?php echo $total_application_count ?>
                    </h6>
                  </div>
                  <div>
                    <a href="<?= base_url('admin/requirements') ?>" class="btn btn-primary">Review Applicants</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-primary card-outline">

              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h6 class="card-text">Client pending jobs:&nbsp;
                      <?php echo $client_pending_count ?>
                    </h6>
                    <h6 class="card-text">Client approved jobs:&nbsp;
                      <?php echo $client_approved_count ?>
                    </h6>
                  </div>
                  <div>
                    <a href="<?= base_url('admin/requirements/client') ?>" class="btn btn-primary">Review Jobs</a>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">

          <div class="card">
            <div class="card-header position-relative">
              <h3 class="card-title">Recent Searches</h3>
              <div class="position-absolute" style="right: 2%; margin-top: -8px;">
                <button data-toggle="tooltip" data-placement="bottom" title="Delete recent searches for vendors"
                  type="button" class="btn btn-danger" id="deleteButton" disabled>Delete</button>
              </div>
            </div>
            <div class="card-header">
              <h3 class="card-title">Update your profile skills to get matched on projects</h3>
            </div>
            <div class="card-body recent-searches p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                <?php foreach ($search_reports as $search_data) { ?>
                  <li class="item">
                    <input type="checkbox" class="checkbox" id="checkbox">
                    <label for="checkbox" style="line-height: 0px; margin-bottom: 0;">
                      <div class="product-info">
                        <?php
                        $skills_list = explode(",", $search_data['skills']);
                        foreach ($skills_list as $skill) {
                          echo '<span class="badge badge-info">' . $skill . '</span> ';
                        }
                        ?>
                      </div>
                    </label>
                  </li>
                <?php } ?>

              </ul>
            </div>

          </div>
        </div>
        <!-- /.col-md-6 -->
      </div>
    </div>
    <!-- /.content -->
  </div>
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function () {
    $("#mainNav").addClass('active');

    $(function () {
      $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
      });
    });
  });
</script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>

  const deleteButton = document.getElementById("deleteButton");
  const checkboxes = document.querySelectorAll(".checkbox");
  var base_url = "<?php echo base_url(''); ?>";

  // Attach a change event listener to each checkbox
  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", updateDeleteButtonState);
  });

  function updateDeleteButtonState() {
    const isAnyCheckboxChecked = Array.from(checkboxes).some((checkbox) => checkbox.checked);
    deleteButton.disabled = !isAnyCheckboxChecked;
  }

  // Function to collect the selected values and send them to the backend
  function sendSelectedDataToBackend() {
    const selectedValues = [];
    const selectedCheckboxes = document.querySelectorAll('.checkbox:checked');

    selectedCheckboxes.forEach((checkbox) => {
      const badgeContainer = checkbox.nextElementSibling.querySelector('.product-info');
      if (badgeContainer) {
        const badges = badgeContainer.querySelectorAll('.badge-info');
        const values = Array.from(badges).map((badge) => badge.textContent.trim());
        selectedValues.push(values.join(','));
      }
    });

    const data = JSON.stringify({ selectedValues: selectedValues });

    let formData = new FormData();
    formData.append("selectedValues", data);

    // Send the data via AJAX to the server
    $.ajax({
      url: base_url + 'admin/dashboard/hideSearchItemsForVendors',
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {

        // Parse the JSON string into a JavaScript object
        if (response.status === "success") {
          selectedCheckboxes.forEach((checkbox) => {
            const listItem = checkbox.closest('.item');
            listItem.parentNode.removeChild(listItem);
          });

          // Optionally, you can display a success message to the user
          console.log("Selected items removed successfully.");
        }
      },
      error: function (xhr, status, error) {
        // Handle the error case
        console.error(error);
        // Optionally, you can display an error message to the user
      },
    });
  }

  // Attach click event listener to the "Delete" button
  deleteButton.addEventListener("click", sendSelectedDataToBackend);

</script>


<script>
  var swiper = new Swiper(".slide-content", {
    // slidesPerView: 6,
    spaceBetween: 10,
    // loop: true,
    centerSlide: 'true',
    fade: 'true',
    resistance: 'false',
    grabCursor: 'true',
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
    },
    // navigation: {
    //   nextEl: ".swiper-button-next",
    //   prevEl: ".swiper-button-prev",
    // },

    // breakpoints:{
    //     0: {
    //         slidesPerView: 1 ,
    //     },
    //     750: {
    //         slidesPerView: 2,
    //     },
    //     1200: {
    //         slidesPerView: 3,
    //     },
    // },
  });
</script>