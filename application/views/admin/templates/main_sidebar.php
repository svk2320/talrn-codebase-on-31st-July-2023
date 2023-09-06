<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4" style="background-color:#5473FF;">
  <!-- Brand Logo -->
  <a href="<?php echo base_url('admin/dashboard'); ?>" class="brand-link">
    <img src="<?php echo base_url('assets/img/'); ?>T.png" alt="Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text text-light font-weight-light">Talrn</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>dist/img/user.jpg" class="img-circle elevation-2"
          alt="User Image">
      </div>
      <div class="info">
        <a href="<?php echo base_url('admin/dashboard'); ?>" class="d-block user_id_text text-light">
          <?php
          if ($_SESSION['username'] == 'Individual') {
            $nameParts = explode(' ', $_SESSION['name']);
            $lastName = end($nameParts);
            echo $lastName;
          } else {
            echo $_SESSION['username'];
          } ?>
        </a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php if ($user_permission) { ?>
          <?php if (in_array('viewAdmin', $user_permission)) { ?>
            <li class="nav-item">
              <a href="<?php echo base_url('admin'); ?>" class="nav-link" id="">
                <i class="text-light nav-icon fas fa-tachometer-alt"></i>
                <p class="text-light">
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(''); ?>" class="nav-link" id="" target="_blank">
                <i class="text-light nav-icon fas fa-external-link-alt"></i>
                <p class="text-light">
                  View Talrn
                </p>
              </a>
            </li>
            <?php
            if (in_array('viewAnnouncmenet', $user_permission)) { ?>
              <li class="nav-item has-treeview" id="li-users">
                <a href="#" class="nav-link" id="link-users">
                  <i class="text-light nav-icon fas fa-bell"></i>
                  <p class="text-light">
                    Announcements
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <?php if (in_array('viewAnnouncmenet', $user_permission)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/announcements/show_all_popups'); ?>" class="nav-link" id="Reports">
                        <i class="text-light nav-icon fas fa-envelope"></i>
                        <p class="text-light">
                          Talrn (Admin only)
                        </p>
                      </a>
                    </li>
                  <?php }
                  if (in_array('viewAnnouncmenet', $user_permission)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/announcements/show_all_popups_for_individual'); ?>" class="nav-link"
                        id="showAllPopups">
                        <i class="text-light nav-icon fas fa-envelope"></i>
                        <p class="text-light">
                          Vendor - Individuals
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/announcements/show_all_popups_for_organisation'); ?>" class="nav-link"
                        id="showAllPopups">
                        <i class="text-light nav-icon fas fa-envelope"></i>
                        <p class="text-light">
                          Vendor - Organizations
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/announcements/show_all_popups_for_client'); ?>" class="nav-link"
                        id="showAllPopups">
                        <i class="text-light nav-icon fas fa-envelope"></i>
                        <p class="text-light">
                          Clients
                        </p>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              </li>
            <?php }
            if (in_array('viewReport', $user_permission) || in_array('viewAnalytics', $user_permission)) { ?>
              <li class="nav-item has-treeview" id="li-users">
                <a href="#" class="nav-link" id="link-users">
                  <i class="text-light nav-icon fas fa-chart-bar"></i>
                  <p class="text-light">
                    Reports
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <?php if (in_array('viewReport', $user_permission)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/vendor/reports'); ?>" class="nav-link" id="Reports">
                        <i class="text-light nav-icon fas fa-chart-bar"></i>
                        <p class="text-light">
                          User Reports
                        </p>
                      </a>
                    </li>
                  <?php }
                  if (in_array('viewAnalytics', $user_permission)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/analytics'); ?>" class="nav-link" id="Analytics">
                        <i class="text-light nav-icon fas fa-chart-line"></i>
                        <p class="text-light">
                          Analytics
                        </p>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              </li>
            <?php }
            if (in_array('viewProfile', $user_permission)) { ?>
              <li class="nav-item has-treeview" id="li-users">
                <a href="#" class="nav-link" id="link-users">
                  <i class="text-light nav-icon fas fa-users"></i>
                  <p class="text-light">
                    Profiles
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <?php if (in_array('viewPartner', $user_permission)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/vendor/global-profile-list'); ?>" class="nav-link" id="partnerlist">
                        <i class="text-light nav-icon fas fa-globe"></i>
                        <p class="text-light">
                          Global Profile List
                        </p>
                      </a>
                    </li>
                  <?php }
                  if (in_array('viewAdvanceSearch', $user_permission)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/search'); ?>" class="nav-link">
                        <i class="text-light nav-icon fas fa-search"></i>
                        <p class="text-light">
                          Advance Search
                        </p>
                      </a>
                    </li>
                  <?php }
                  if (in_array('modifyProfile', $user_permission)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/vendor'); ?>" class="nav-link" id="profileupload">
                        <i class="text-light nav-icon fas fa-upload"></i>
                        <p class="text-light">
                          Upload Profile
                        </p>
                      </a>
                    </li>
                  <?php }
                  if (in_array('viewProfile', $user_permission)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/vendor/list'); ?>" class="nav-link" id="profilelist">
                        <i class="text-light nav-icon fas fa-list-ol"></i>
                        <p class="text-light">
                          Profile List
                        </p>
                      </a>
                    </li>
                  <?php }
                  if (in_array('viewAdmin', $user_permission)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/vendor/deleted_profiles'); ?>" class="nav-link"
                        id="deletedProfileList">
                        <i class="text-light nav-icon fas fa-user-times"></i>
                        <p class="text-light">
                          Deleted Profiles List
                        </p>
                      </a>
                    </li>
                  <?php }
                  if (in_array('viewApproval', $user_permission)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/approval'); ?>" class="nav-link" id="partnerlist">
                        <i class="text-light nav-icon fas fa-thumbs-up"></i>
                        <p class="text-light">
                          Profile Approval
                        </p>
                      </a>
                    </li>
                  <?php }
                  if (in_array('viewVerification', $user_permission)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/verified/list'); ?>" class="nav-link" id="verifiedlist">
                        <i class="text-light nav-icon fas fa-user-check"></i>
                        <p class="text-light">
                          Profile Verification
                        </p>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              </li>
            <?php }
            if (in_array('viewAdmin', $user_permission)) { ?>
              <li class="nav-item has-treeview" id="li-users">
                <a href="#" class="nav-link" id="link-users">
                  <i class="text-light nav-icon fas fa-edit"></i>
                  <p class="text-light">
                    Customizations
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <?php if (in_array('viewAdmin', $user_permission)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/vendor/landing_page_profiles'); ?>" class="nav-link"
                        id=" landingPageProfile">
                        <i class="text-light nav-icon fas fa-pager"></i>
                        <p class="text-light">
                          Landing page profiles
                        </p>
                      </a>
                    </li>
                  <?php }
                  if (in_array('modifySuggestion', $user_permission)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/vendor/report_control'); ?>" class="nav-link" id="suggestionMainNav">
                        <i class="text-light nav-icon fas fa-edit"></i>
                        <p class="text-light">
                          Edit Custom Fields
                        </p>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              </li>
            <?php }
            if (in_array('viewProfile', $user_permission)) { ?>

              <li class="nav-item has-treeview" id="li-users">
                <a href="#" class="nav-link" id="link-users">
                  <i class="text-light nav-icon fas fa-briefcase"></i>
                  <p class="text-light">
                    Jobs
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <?php if (in_array('viewRequirements', $user_permission)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/requirements/create'); ?>" class="nav-link" id="requirementlist">
                        <i class="text-light nav-icon fas fa-bullhorn"></i>
                        <p class="text-light">
                          Create Jobs
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/requirements'); ?>" class="nav-link" id="requirementlist">
                        <i class="text-light nav-icon fas fa-bullhorn"></i>
                        <p class="text-light">
                          Talrn Jobs
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/requirements/client'); ?>" class="nav-link" id="requirementlist">
                        <i class="text-light nav-icon fas fa-bullhorn"></i>
                        <p class="text-light">
                          Client Jobs
                        </p>
                      </a>
                    </li>
                  <?php }
                  if (in_array('viewProfile', $user_permission)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('remote-ios-jobs'); ?>" class="nav-link" id="appliedjob" target="_blank">
                        <i class="text-light nav-icon fas fa-building"></i>
                        <p class="text-light">
                          Remote iOS Jobs
                        </p>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              </li>
            <?php }
            if (in_array('viewAnnouncmenet', $user_permission)) { ?>
              <li class="nav-item has-treeview" id="li-users">
                <a href="#" class="nav-link" id="link-users">
                  <i class="text-light nav-icon fas fa-comments"></i>
                  <p class="text-light">
                    Communication tools
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url('admin/announcements'); ?>" class="nav-link" id="announcements">
                      <i class="text-light nav-icon fas fa-bell"></i>
                      <p class="text-light">
                        All
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('admin/announcements/sticky_header'); ?>" class="nav-link"
                      id="announcements">
                      <i class="text-light nav-icon fas fa-bell"></i>
                      <p class="text-light">
                        Sticky headers
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('admin/announcements/pop_up/'); ?>" class="nav-link" id="announcements">
                      <i class="text-light nav-icon fas fa-bell"></i>
                      <p class="text-light">
                        Pop up announcements
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php }
            if (in_array('viewProfile', $user_permission)) { ?>
              <li class="nav-item has-treeview" id="li-users">
                <a href="#" class="nav-link" id="link-users">
                  <i class="text-light nav-icon fas fa-user"></i>
                  <p class="text-light">
                    User Management
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                  <?php
                  if (in_array('viewProfile', $user_permission)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/users/profile/'); ?>" class="nav-link" id="profileMainNav">
                        <i class="text-light nav-icon fas fa-user-circle"></i>
                        <p class="text-light">
                          My Account
                        </p>
                      </a>
                    </li>
                  <?php }
                  if (in_array('modifyVendor', $user_permission)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/stores/'); ?>" class="nav-link" id="storesMainNav">
                        <i class="text-light far fa-circle nav-icon"></i>
                        <p class="text-light">
                          Vendors
                        </p>
                      </a>
                    </li>
                  <?php }
                  if (in_array('modifyVendor', $user_permission)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('admin/clients'); ?>" class="nav-link" id="manage-clients">
                        <i class="text-light far fa-circle nav-icon"></i>
                        <p class="text-light">Clients</p>
                      </a>
                    </li>
                  <?php }
                  if (in_array('modifyGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)) { ?>
                    <li class="nav-item has-treeview" id="li-groups">
                      <a href="#" class="nav-link" id="link-groups">
                        <i class="text-light nav-icon fas fa-users"></i>
                        <p class="text-light">
                          Permissions
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <?php if (in_array('modifyGroup', $user_permission)) { ?>
                          <li class="nav-item">
                            <a href="<?php echo base_url('admin/groups/create'); ?>" class="nav-link" id="create-groups">
                              <i class="text-light far fa-circle nav-icon"></i>
                              <p class="text-light">Create User Group</p>
                            </a>
                          </li>
                        <?php }
                        if (in_array('modifyGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)) { ?>
                          <li class="nav-item">
                            <a href="<?php echo base_url('admin/groups/'); ?>" class="nav-link" id="manage-groups">
                              <i class="text-light far fa-circle nav-icon"></i>
                              <p class="text-light">Manage User Group</p>
                            </a>
                          </li>
                        <?php } ?>
                      </ul>
                    </li>

                  <?php } ?>
                </ul>
              </li>
            <?php }
            if (in_array('viewReminders', $user_permission)) { ?>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/reminder'); ?>" class="nav-link" id="emaillist">
                  <i class="text-light nav-icon fas fa-envelope-open-text"></i>
                  <p class="text-light">
                    Email Reminders
                  </p>
                </a>
              </li>
            <?php }
            if (!in_array('viewAdmin', $user_permission)) { ?>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/verified'); ?>" class="nav-link" id="verify">
                  <i class="text-light nav-icon fas fa-check-circle"></i>
                  <p class="text-light">
                    Verify Profile
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/vendor/applied_jobs'); ?>" class="nav-link" id="appliedjob">
                  <i class="text-light nav-icon fas fa-briefcase"></i>
                  <p class="text-light">
                    My Applied Jobs
                  </p>
                </a>
              </li>
              <?php
              if (isset($_SESSION['verified'])) { ?>
                <li class="nav-item">
                  <a href="<?php echo base_url('admin/verified/customurl'); ?>" class="nav-link" id="customurl">
                    <i class="text-light nav-icon fas fa-link"></i>
                    <p class="text-light">
                      Custom URL
                    </p>
                  </a>
                </li>
              <?php }
            } ?>
            
          <?php } else { ?>
            <li class="nav-item">
              <a href="<?php echo base_url('admin'); ?>" class="nav-link" id="">
                <i class="text-light nav-icon fas fa-tachometer-alt"></i>
                <p class="text-light">
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(''); ?>" class="nav-link" id="" target="_blank">
                <i class="text-light nav-icon fas fa-external-link-alt"></i>
                <p class="text-light">
                  View Talrn
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/users/profile/'); ?>" class="nav-link" id="profileMainNav">
                <i class="text-light nav-icon fas fa-user-circle"></i>
                <p class="text-light">
                  My Account
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/vendor/list'); ?>" class="nav-link" id="profilelist">
                <i class="text-light nav-icon fas fa-list-ol"></i>
                <p class="text-light">
                  Profile List
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/vendor'); ?>" class="nav-link" id="profileupload">
                <i class="text-light nav-icon fas fa-upload"></i>
                <p class="text-light">
                  Upload Profile
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/verified'); ?>" class="nav-link" id="verify">
                <i class="text-light nav-icon fas fa-check-circle"></i>
                <p class="text-light">
                  Verify Profile
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/vendor/applied_jobs'); ?>" class="nav-link" id="appliedjob">
                <i class="text-light nav-icon fas fa-briefcase"></i>
                <p class="text-light">
                  My Applied Jobs
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('remote-ios-jobs'); ?>" class="nav-link" id="appliedjob" target="_blank">
                <i class="text-light nav-icon fas fa-building"></i>
                <p class="text-light">
                  Remote iOS Jobs
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/announcements/show_all_popups'); ?>" class="nav-link" id="showAllPopups">
                <i class="text-light nav-icon fas fa-envelope"></i>
                <p class="text-light">
                  Announcements
                </p>
              </a>
            </li>
          <?php }
        } ?>
        <li class="nav-item">
          <a href="<?php echo base_url('admin/auth/logout'); ?>" class="nav-link" id="profileMainNav">
            <i class="text-light nav-icon fas fa-sign-out-alt"></i>
            <p class="text-light">
              Sign Out
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>