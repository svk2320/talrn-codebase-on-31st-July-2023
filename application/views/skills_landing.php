
</style>
<link rel="stylesheet" href="./template/rangeslider/range.css">
<section class="wrapper bg-light">
    <div class="container pb-10 pb-md-16">
        <div class="row gy-10">
            <div class="col-lg-9 order-lg-2">
                <div class="row align-items-center mb-10 position-relative zindex-1">
                </div>
                <!--/.row -->
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Hire Talents with skills in <span class="text-primary"><?=$skill ?></span></h2>
                        <!-- <hr style="margin: 0.5rem 0;color: rgb(164 174 198);"> -->
                    </div>
                </div>

                <div class="row mt-4 " id="profile_list_wrapper">
                    <?php if (sizeof($profiles)) {
                            for ($i = 0; $i < sizeof($profiles); $i++) {
                    ?>

                    <?php 
                        $profile_industries = $this->model_home->getIndustriesByProfileId($profiles[$i]['id']);
                        $industry_pro_list = array();
                        foreach($profile_industries as $industry){
                            if($industry['industry'] == ''){
                                continue;
                            }
                            array_push($industry_pro_list,$industry['industry']);
                        }
                        
                    ?>
                    <div class="col-lg-6 mb-4 ">
                        <a style="color:black;" target="_blank"
                            href="<?= base_url('profile/' . strtolower($profiles[$i]['profile_url']) . '/' . strtolower($profiles[$i]['unique_id']) ) ?>">
                            <div class=" shadow-lg px-3 py-3 rounded">
                                <div class="row">
                                    <div class="col-lg-4 col-4">
                                        <?php
                                            if (!($profiles[$i]['verified_date'] === null)) {
                                                $targetDate = new DateTime($profiles[$i]['verified_date']);
                                                $currentDate = new DateTime(); // Current date and time
                                                
                                                $interval = $currentDate->diff($targetDate);
                                                
                                                $daysDifference = $interval->format('%a');
                
                                                $imageStyle = (($profiles[$i]['verified'] && (30 - $daysDifference)) ? 'border: 3px solid #5271ff' : '') . ';';
                                            } else {
                                                $imageStyle = ' ';
                                            }
                                        ?>
                                        <center>
                                            <img src="<?=base_url($profiles[$i]['userPhoto'])?>" style="<?= $imageStyle ?>;" onerror="this.onerror=null; this.src='<?=base_url('assets/img/noimage.jpg')?>'" id="card-image" class="proimg">
                                        </center>
                                    </div>
                                    <div class="col-lg-8 col-8">
                                        <div class="mt-2">
                                            <span><?php echo $profiles[$i]['last_name'] . ' ' . mb_substr($profiles[$i]['first_name'], 0, 1) ?>
                                                <?php
                                                    if (!($profiles[$i]['verified_date'] === null)) {
                                                        $targetDate = new DateTime($profiles[$i]['verified_date']);
                                                        $currentDate = new DateTime(); // Current date and time
                                                        
                                                        $interval = $currentDate->diff($targetDate);
                                                        
                                                        $daysDifference = $interval->format('%a');
                        
                                                        $imageSrc = ($profiles[$i]['verified'] && (30 - $daysDifference)) ? base_url('assets/img/verified-icon.png') : '';
                                                        $imageStyle = ($profiles[$i]['verified'] && (30 - $daysDifference)) ?  'position: relative; width: 19px;' : '';
                                                    }
                                                    
                                                ?>
                                                
                                                    <?php if($profiles[$i]['verified'] && (30 - $daysDifference)) { ?>
                                                    <img data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="bottom" data-bs-html = "true" data-bs-content="<?php echo $profiles[$i]['last_name'] ?>'s identity has been verified to provide a trusted & reliable experience. <br><br>Talrn guarantees a seamless collaboration experience for you."  src="<?php echo $imageSrc; ?>" style="<?php echo $imageStyle; ?>" />
                                                    <?php } ?>
                                            <span
                                                    class="text-danger px-5"
                                                    style="font-size:10px"><?php echo $profiles[$i]['unique_id'];?></span></span>
                                            <span class="profile-card-title" style="font-size:14px;" <?php
                                                $title = (strlen($profiles[$i]['primary_title']) > 25) ? substr($profiles[$i]['primary_title'],0,24).'...' : $profiles[$i]['primary_title'];
                                            ?> class="profile-card-exp"><?php echo $title ;?>,
                                                <?php echo $profiles[$i]['experience'] ;?> years</span>
                                        </div>
                                        <div>
                                            <?php 
                    
                                                $profile_skills = $this->model_home->profile_skills($profiles[$i]['id']);
                                                for($skill = 0; $skill < sizeof($profile_skills) && $skill < 3 ; $skill++) { 
                                                ?>
                                            <div class="card-pills">
                                                <?php
                                                    if(strlen($profile_skills[$skill]['name'])>10){
                                                        echo substr($profile_skills[$skill]['name'],0,8)."...";
                                                    } 
                                                    else{
                                                        echo $profile_skills[$skill]['name'];
                                                    }
                                                 ?>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-description" style="word-wrap:break-word">
                                    <?php
                                    $string = (strlen($profiles[$i]['bio']) > 170) ? substr($profiles[$i]['bio'],0,170).'...' : $profiles[$i]['bio'];
                                    echo $string;
                                ?>
                                </div>
                                <div class="card-industries" style="word-wrap:break-word;">
                                    <b>Industries:</b><?php
                                
                                    $char_count = 0;
                                    foreach($industry_pro_list as $industry){
                                        if($industry == $industry_pro_list[0]){
                                            $char_count += strlen($industry);
                                            if ($char_count > 50){
                                                echo ',...';
                                                break;
                                            }else{
                                                echo '<u>'.$industry.'</u>';
                                            }
                                        }
                                        else{
                                            $char_count += strlen($industry);
                                            if ($char_count > 50){
                                                echo ',...';
                                                break;
                                            }else{
                                                echo ', <u>'.$industry.'</u>';
                                            }
                                        }
                                    }
                                    ?>
                                    <!--<u>Banking</u>, <u>Healthcare</u>-->
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-6 actions text-center">
                                        <a href="<?=base_url('hire');?>"><i class="uil uil-chat-info"></i> Hire
                                            <?php echo $profiles[$i]['last_name'] . ' ' . mb_substr($profiles[$i]['first_name'], 0, 1) ?></a>
                                    </div>
                                    <div class="col-lg-6 col-6 actions text-center">
                                        <?php $profileID = (int) $profiles[$i]['id'];
                                        
                                    if(isset($_SESSION['id'])){
                                        if($profiles[$i]['vendor_id']!=$_SESSION['id']){?>
                                    
                                        <a href="<?= base_url('home/profile2pdf/'.$profileID) ?>"><i class="bi bi-download"></i> <span class="px-1">Download PDF</span></a>
                                        
                                        <?php } else { ?>
                                        
                                        <a style="display:inline;" class="dropdown dropdown-toggle" data-bs-toggle="dropdown" href="#"><i class="bi bi-download"></i> <span class="px-1">Download PDF<span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                              <li><a href="<?= base_url('home/profile2pdf/'.$profileID) ?>" class="dropdown-item">Download Talrn CV</a></li>
                                              <li><a href="<?php echo ($profiles[$i]['verified'] && (30 - $daysDifference))? base_url('home/profile2pdfVerified/'.$profileID): base_url('admin/verified'); ?>" class="dropdown-item">Download CV</a></li>
                                            </ul>
                                        <?php }}else{ ?>
                                            <a href="<?= base_url('home/profile2pdf/'.$profileID) ?>"><i class="bi bi-download"></i> <span class="px-1">Download PDF</span></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                        </a>
                    </div>
                    <?php }
                        } else { ?>
                    <div class="project item col-md-6 col-xl-4">No more recored..</div>
                    <?php } ?>

                </div>
            </div>
            <!-- /column -->
            <aside class="col-lg-3 sidebar pt-1 pt-lg-10">
                <div class="widget mt-1">
                    <h4 class="widget-title mb-3">Hiring resources</h4>
                    <ul class="list-unstyled ps-0">
                        <li class="mb-1">
                            <a href="https://blog.Talrn.com/how-to-hire-ios-developers/" target="_blank"
                                class="align-items-center rounded link-body" aria-expanded="true"> Guide to Hiring
                                devs<span class="fs-sm text-muted ms-1">(->)</span>
                        </li>
                        <li class="mb-1">
                            <a href="https://blog.Talrn.com/ios-job-template/" target="_blank"
                                class="align-items-center rounded collapsed link-body" aria-expanded="false"> Job
                                Template <span class="fs-sm text-muted ms-1">(->)</span>
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="https://blog.Talrn.com/common-interview-questions-for-ios/" target="_blank"
                                class="align-items-center rounded collapsed link-body" aria-expanded="false">
                                Interview Questions
                                <span class="fs-sm text-muted ms-1">(->)</span>
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="https://blog.Talrn.com/resource-outsourcing-mistakes/" target="_blank"
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
                            <a href="https://calendly.com/superlabs/discovery" target="blank"
                                class="align-items-center rounded link-body" aria-expanded="true"> Book a
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
                        <img src="<?=base_url('assets/img/icons/solid/employees.svg') ?>"
                            class="svg-inject icon-svg icon-svg-sm solid-mono text-navy me-4" alt="" />
                    </div>
                    <div>
                        <h4 class="mb-1">Verified profiles</h4>
                        <p class="mb-0">Talrn vets profiles rigorously & the best candidates are handpicked by our
                            experts.</p>
                    </div>
                </div>
            </div>
            <!--/column -->
            <div class="col-md-6 col-lg-4">
                <div class="d-flex flex-row">
                    <div>
                        <img src="<?=base_url('assets/img/icons/solid/paper-plane.svg') ?>"
                            class="svg-inject icon-svg icon-svg-sm solid-mono text-navy me-4" alt="" />
                    </div>
                    <div>
                        <h4 class="mb-1">Fast onboarding</h4>
                        <p class="mb-0">You'll be able to get an developer working on your project within 2 to 3
                            business days.</p>
                    </div>
                </div>
            </div>
            <!--/column -->
            <div class="col-md-6 col-lg-4">
                <div class="d-flex flex-row">
                    <div>
                        <img src="<?=base_url('assets/img/icons/solid/globe-2.svg') ?>"
                            class="svg-inject icon-svg icon-svg-sm solid-mono text-navy me-4" alt="" />
                    </div>
                    <div>
                        <h4 class="mb-1">Effortless scaling</h4>
                        <p class="mb-0">With our large talent pool of dev, you can effortlessly scale your team
                            fast.</p>
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

