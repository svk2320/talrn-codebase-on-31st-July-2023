<section class="wrapper bg-gray">
    <div class="container py-3 py-md-5">
        <nav class="d-inline-block" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profiles</li>
            </ol>
        </nav>
        <!-- /nav -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->
<section class="wrapper bg-light">
    <div class="container pb-14 pb-md-16 pt-12">
        <div class="row gy-10">
            <div class="col-lg-9 order-lg-2">
                <div class="row align-items-center mb-10 position-relative zindex-1">
                    <div class="col-md-7 col-xl-8 pe-xl-20">
                        <h2 class="display-6 mb-1">Developer Profiles</h2>
                        <!-- <p class="mb-0 text-muted">Showing 1–9 of 30 results</p> -->
                    </div>

                    <!-- <div class="col-md-5 col-xl-4 ms-md-auto text-md-end mt-5 mt-md-0">
                        <div class="form-select-wrapper">
                            <select class="form-select">
                                <option value="popularity">Sort by popularity</option>
                                <option value="rating">Sort by average rating</option>
                                <option value="newness">Sort by newness</option>
                                <option value="price: low to high">Sort by price: low to high</option>
                                <option value="price: high to low">Sort by price: high to low</option>
                            </select>
                        </div>
                    </div> -->

                </div>
                <!--/.row -->
                <div class="grid grid-view projects-masonry shop mb-13">
                    <div class="row gx-md-8 gy-10 gy-md-13 isotope">
                        <?php if (sizeof($profiles)) {
                            for ($i = 0; $i < sizeof($profiles); $i++) {
                                $fullname = $profiles[$i]['last_name'] . ' ' . mb_substr($profiles[$i]['first_name'], 0, 1);
                                $fullname = ucwords(strtolower($fullname));
                        ?>
                        <div class="project item col-md-6 col-xl-4">
                            <figure class="rounded mb-6">

                                <?php
                                $profileID = (int) $profiles[$i]['id'];
                                if (file_exists('./profileimages/256X256/' . $profileID . '.jpg')) {
                                    $profileImg = base_url() . $this->config->item('product_image_medium') . $profileID . '.jpg';
                                } else if (file_exists('./profileimages/256X256/' . $profileID . '.png')) {
                                    $profileImg = base_url() . $this->config->item('product_image_medium') . $profileID . '.png';
                                } else {
                                    $profileImg = base_url() . $this->config->item('product_noimage_thumb') . 'noimage.jpg';
                                }

                                ?>
                                <img src="<?= $profileImg ?>" srcset="<?= $profileImg ?> 2x"
                                    alt="<?= $profiles[$i]['first_name'] ?>" />
                                <a href="<?= base_url('home/profiledetails/' . $profiles[$i]['id'] . '/' . strtolower($profiles[$i]['last_name']) . '-' . strtolower(mb_substr($profiles[$i]['first_name'], 0, 1))) ?>"
                                    class="item-cart">View profile </a>
                            </figure>
                            <div class="post-header">
                                <div>
                                    <span>
                                    <h2 class="post-title h3 fs-22" style="display:inline;"><a
                                        href="<?= base_url('home/profiledetails/' . $profiles[$i]['id'] . '/resume/' . bin2hex(random_bytes(7)) . '/' . strtolower($profiles[$i]['last_name']) . '-' . strtolower(mb_substr($profiles[$i]['first_name'], 0, 1))) ?>"
                                        class="link-dark">
                                        <?php echo $fullname; ?>
                                    </a></h2>
                                    </span>
                                    <span>
                                    <span class="text-red px-1"
                                    style="font-size: 12px; float: inline-end;"><?=$profiles[$i]['unique_id']?></span>
                                    </span>
                                </div>
                                <div class="d-flex flex-row align-items-center justify-content-between mb-2">
                                    <div class="post-category text-ash mb-0">
                                        <?php if(strlen($profiles[$i]['primary_title'])) { echo $profiles[$i]['primary_title']; } else { echo "&nbsp;";} ?>
                                    </div>
                                </div>


                                                      
                        <div class="skills">
                            
                            <?php 
                            //$profile_skills = array();

                            $styleCode = null;
                            $profile_skills = $this->model_home->profile_skills($profiles[$i]['id']);
                            for($skill = 0; $skill < sizeof($profile_skills) && $skill < 3 ; $skill++) { 
                                if(strlen($profile_skills[$skill]['name']) >= 5) {
                                    $styleCode = "width:77px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;";
                                } else {
                                    $styleCode = "width:55px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;";
                                }
                            ?>
                            <div style="<?=$styleCode?>">
                                <?= $profile_skills[$skill]['name'] ?>
                            </div>
                            <?php } ?>

                        </div>
                            </div>
                            <!-- /.post-header -->
                        </div>
                        <?php }
                        } else { ?>
                        <div class="project item col-md-6 col-xl-4">No more recored..</div>
                        <?php } ?>
                    </div>
                    <!-- /.row -->
                </div>
                <?php if (isset($links))
                    echo $links; ?>
            </div>
            <!-- /column -->
            <aside class="col-lg-3 sidebar">
                <div class="widget mt-1">
                    <h4 class="widget-title mb-3">Hiring resources</h4>
                    <ul class="list-unstyled ps-0">
                        <li class="mb-1">
                            <a href="https://blog.talrn.com/how-to-hire-ios-developers/" target="_blank"
                                class="align-items-center rounded link-body" aria-expanded="true"> Guide to Hiring iOS
                                devs<span class="fs-sm text-muted ms-1">(->)</span>
                        </li>
                        <li class="mb-1">
                            <a href="https://blog.talrn.com/ios-job-template/" target="_blank"
                                class="align-items-center rounded collapsed link-body" aria-expanded="false"> iOS Job
                                Template <span class="fs-sm text-muted ms-1">(->)</span>
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="https://blog.talrn.com/common-interview-questions-for-ios/" target="_blank"
                                class="align-items-center rounded collapsed link-body" aria-expanded="false"> iOS
                                Interview Questions
                                <span class="fs-sm text-muted ms-1">(->)</span>
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="https://blog.talrn.com/resource-outsourcing-mistakes/" target="_blank"
                                class="align-items-center rounded collapsed link-body" aria-expanded="false"> Common
                                Mistakes <span class="fs-sm text-muted ms-1">(->)</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.widget -->
                <div class="widget mt-1">
                    <h4 class="widget-title mb-3">Need help?</h4>
                    <ul class="list-unstyled ps-0">
                        <li class="mb-1">
                            <a href="https://calendly.com/superlabs/discovery" target="blank" class="align-items-center rounded link-body" aria-expanded="true"> Book a
                                meeting<span class="fs-sm text-muted ms-1">(->)</span>
                        </li>
                        <li class="mb-1">
                            <a href="https://wa.me/+919820045154" target="_blank"
                                class="align-items-center rounded collapsed link-body" aria-expanded="false"> Chat with
                                an expert
                                <span class="fs-sm text-muted ms-1">(->)</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.widget -->
                <!-- /.widget -->
            </aside>
            <!-- /column .sidebar -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->
    <!-- /section -->
    <section class="wrapper bg-gray">
      <div class="container py-12 py-md-14">
        <div class="row gx-lg-8 gx-xl-12 gy-8">
          <div class="col-md-6 col-lg-4">
            <div class="d-flex flex-row">
              <div>
                 <img src="<?=base_url('assets/img/icons/solid/employees.svg') ?>" class="svg-inject icon-svg icon-svg-sm solid-mono text-navy me-4" alt="" /> 
              </div>
              <div>
                <h4 class="mb-1">Verified profiles</h4>
                <p class="mb-0">Talrn vets iOS profiles rigorously & the best candidates are handpicked by our experts.</p>
              </div>
            </div>
          </div>
          <!--/column -->
          <div class="col-md-6 col-lg-4">
            <div class="d-flex flex-row">
              <div>
                <img src="<?=base_url('assets/img/icons/solid/paper-plane.svg') ?>" class="svg-inject icon-svg icon-svg-sm solid-mono text-navy me-4" alt="" />
              </div>
              <div>
                <h4 class="mb-1">Fast onboarding</h4>
                <p class="mb-0">You'll be able to get an iOS developer working on your project within 2 to 3 business days.</p>
              </div>
            </div>
          </div>
          <!--/column -->
          <div class="col-md-6 col-lg-4">
            <div class="d-flex flex-row">
              <div>
                <img src="<?=base_url('assets/img/icons/solid/globe-2.svg') ?>" class="svg-inject icon-svg icon-svg-sm solid-mono text-navy me-4" alt="" />
              </div>
              <div>
                <h4 class="mb-1">Effortless scaling</h4>
                <p class="mb-0">With our large talent pool of iOS dev, you can effortlessly scale your team fast.</p>
              </div>
            </div>
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->