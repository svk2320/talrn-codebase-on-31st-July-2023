<?php if (!isset($profiles[0])) {
    echo 'something went wrong';
    return false;
} ?>
<?php $fullname = $profiles[0]['last_name'] . ' ' . substr($profiles[0]['first_name'], 0, 1); ?>

<?php
$profileID = (int) $profiles[0]['id'];  
function flat($array, &$return)
{
    if (is_array($array)) {
        array_walk_recursive($array, function ($a) use (&$return) {
            flat($a, $return);
        });
    } else if (is_string($array) && stripos($array, '[') !== false) {
        $array = explode(',', trim($array, "[]"));
        flat($array, $return);
    } else {
        $return[] = $array;
    }
}
$return = array();
flat($profiles[0]['skills'], $return);

function stripQuotes($text)
{
    return preg_replace('/^(\'(.*)\'|"(.*)")$/', '$2$3', $text);
}

function url_encode_custom($input){
    $output = trim($input);
    $output = str_replace(' ', '-', $output);
    $output = str_replace('/', '-and-', $output);
    $output = strtolower($output);
    return $output;
} 

?>
<div class="container">
    <section class="px-3 border-bottom">
        <section>
            <div class="row mt-4">
                <div class="text-muted">
                    <i class="uil uil-arrow-left"></i> <a href="<?=base_url('home');?>">Home</a> / <a
                        href="<?=base_url('profiles');?>">iOS Developers</a> / <?php echo $profiles[0]['unique_id'];?>
                </div>
                <div class="col-lg-4" id="profile-image-container">
                    <img src="<?=base_url($profiles[0]['userPhoto'])?>" onerror="this.onerror=null; this.src='<?=base_url('assets/img/noimage.jpg')?>'"class="img-fluid mt-4" id="profile-image" style="aspect-ratio:1">
                </div>
                <div class="col-lg-8">
                    <div class="mt-3">
                        <div class="h5 text-muted" id="profile-title"><?php echo $fullname;?>
                                <?php
                                    if (!($profiles[0]['verified_date'] === null)) {
                                        $targetDate = new DateTime($profiles[0]['verified_date']);
                                        $currentDate = new DateTime(); // Current date and time
                                        
                                        $interval = $currentDate->diff($targetDate);
                                        
                                        $daysDifference = $interval->format('%a');
        
                                        $imageSrc = ($profiles[0]['verified'] && (30 - $daysDifference)) ? base_url('assets/img/verified-icon.png') : '';
                                        $imageStyle = ($profiles[0]['verified'] && (30 - $daysDifference)) ?  'position: relative; width: 19px;' : '';
                                        
                                    }
                                ?>
                                
                            <?php if($profiles[0]['verified'] && (30 - $daysDifference)) { ?>
                            <img data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="bottom" data-bs-html = "true" data-bs-content="<?php echo $profiles[0]['last_name'] ?>'s identity has been verified to provide a trusted & reliable experience. <br><br>Talrn guarantees a seamless collaboration experience for you."  src="<?php echo $imageSrc; ?>" style="<?php echo $imageStyle; ?>" />
                            <?php } ?>
                            
                                <span class="uid" style="padding-left: 0px !important; margin-left: 5px !important;"><?=$profiles[0]['unique_id']?></span> <span
                                style="margin-left:10px;"><?php echo $profiles[0]['active'] === '1' ? '<span class="text-green" style="font-size: 12px;">Active</span>' : '<span class="text-red" style="font-size: 12px;">In Active</span>'; ?></span>
                        </div>
                        <div class="h5 text-dark"><?php echo $profiles[0]['primary_title'] ; ?> in
                            <?php echo $profiles[0]['city'];?></div>
                        <div class="mt-2" id="profile-bio">
                            <?php echo $profiles[0]['bio'] ; ?>
                        </div>

                    </div>
                </div>
                <div class="skill-container mt-5">
                    <?php for($skill = 0; $skill < sizeof($profile_skills); $skill++) { ?>
                    <div class="skill-pill">
                    <a target="_blank" href="<?php echo base_url('skills/') . url_encode_custom($profile_skills[$skill]['name']); ?>" class="text-dark">
                        <?= $profile_skills[$skill]['name'] ?>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <section>
            <div class="subsection mt-3">
                <div class="subsection-items px-2 py-2">
                    <span class="h5">Industries : </span>
                    <!-- <span class="h5" style="font-weight:normal;"><u>Banking</u>,</span>
                    <span class="h5" style="font-weight:normal;"><u>Automotive</u>,</span>
                    <span class="h5" style="font-weight:normal;"><u>eCommerce</u></span> -->
                    <?php
                    $industry_array = array();
                    for ($i = 0; $i < sizeof($profile_pro); $i++) {
                        array_push($industry_array, $profile_pro[$i]['industry']);
                    } 
                    $industries = array_unique($industry_array);
                    $industries = array_values($industries);
                    ?>
                    <?php for ($i = 0; $i < sizeof($industries); $i++) { 
                        if ($i == 0){
                            echo '<u>'.$industries[$i].'</u>';                         }
                        else{ 
                            echo ', <u>'.$industries[$i].'</u>';
                        }
                     } ?>

                </div>
            </div>
        </section>
        <section>
            <div class="subsection-2 mt-2 mb-2" style="text-align:center !important;">
                <div class="subsection-items px-2 py-2 actions-container">
                    <div class="btn btn-light text-dark" onclick="share()"><i style="margin-right:10px;" class="uil uil-share"></i> Share
                    </div>
                    <!-- <a href=""> -->
                        <div class="btn btn-light text-dark" onclick="hire()" ><i style="margin-right:10px;"
                                class="uil uil-chat-info"></i>
                            Hire <?php echo $fullname;?></div>
                    <!-- </a> -->
                    <script>
                        function share() {
                            
                            // Send a request to the first link without waiting for a response
                            fetch('<?=base_url('home/addsharecount/'.$profileID); ?>', {method: 'GET'})
                                .catch(error => {
                                console.error('Request failed:', error);
                                });

                            navigator.share({url:''});
                        }


                        function hire() {
                            // Send a request to the first link without waiting for a response
                            fetch('<?=base_url('home/addhirecount/'.$profileID); ?>', {method: 'GET'})
                                .catch(error => {
                                console.error('Request failed:', error);
                                });

                            // Redirect the user to the second link
                            window.location.href = '<?=base_url('hire'); ?>';
                        }
                    </script>

                        <?php
                                    if(isset($_SESSION['id'])){
                                        if($profiles[0]['vendor_id']!=$_SESSION['id']){?>
                                        
                    <a href="<?= base_url('home/profile2pdf/'.$profileID) ?>">
                        <div class="btn btn-light text-dark"><i style="margin-right:10px;"
                                class="uil uil-download-alt"></i>
                            Download PDF</div>
                    </a>
                    
                     <?php } else { ?>
                     
                    <div  data-bs-toggle="dropdown" class=" dropdown btn btn-light text-dark dropdown-toggle"><i style="margin-right:10px;"
                                                class="uil uil-download-alt"></i>
                                            Download PDF</div>
                                            <ul class="dropdown-menu">
                                              <li><a href="<?= base_url('home/profile2pdf/'.$profileID) ?>" class="dropdown-item">Download Talrn CV</a></li>
                                              <li><a href="<?php echo ($profiles[0]['verified'] && (30 - $daysDifference))? base_url('home/profile2pdfVerified/'.$profileID): base_url('admin/verified'); ?>" class="dropdown-item">Download CV</a></li>
                                            </ul>
                                        <?php }}else{ ?>
                                            <a href="<?= base_url('home/profile2pdf/'.$profileID) ?>">
                        <div class="btn btn-light text-dark"><i style="margin-right:10px;"
                                class="uil uil-download-alt"></i>
                            Download PDF</div>
                    </a>
                                        <?php } ?>
                </div>
            </div>
        </section>
    </section>

    <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-7 col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <i class="bi bi-calendar-check"></i>
                            <span style="position:relative;top:2px;left:5px;">Availability</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
            <!-- • IST Time Zone -->
            <div class="col-5 col-lg-7 sction-content"><?php echo $profiles[0]['comittment'];?></div>
        </div>
    </section>

    <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-7 col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <i class="bi bi-hourglass"></i>
                            <span style="position:relative;top:2px;left:5px;">Total experience</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
           <div class="col-5 col-lg-6 sction-content">
            <?php if ($profiles[0]['experience'] < 1) {
                    echo "< 1 years ";
                    } else {
                    echo $profiles[0]['experience'] . " years";
                    }?>
                    </div>
        </div>
    </section>

    <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <i class="bi bi-code-slash"></i>
                            <span style="position:relative;top:2px;left:5px;">Technical skills</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="row section-content">

                    <?php for($skill = 0; $skill < sizeof($profile_skills); $skill++) { ?>
                    <div class="row">
                        <?php
                            $year = (int)$profile_skills[$skill]['year'];
                            $month = (int)$profile_skills[$skill]['month'];
                        ?>
                        <div class="col-lg-4 col-6 py-1"><?= $profile_skills[$skill]['name'] ?></div>
                        <?php if ($year > 0 && $month > 0) { ?>
                            <div class="col-lg-8 col-6 py-1"><?= $year ?> Years & <?= $month ?> Months </div>
                        <?php }elseif($year == 0 && $month == 0){ ?>
                            <div class="col-lg-8 col-6 py-1"></div>
                        <?php }elseif($month == 0){ ?>
                            <div class="col-lg-8 col-6 py-1"><?= $year ?> Years </div>
                        <?php }elseif($year == 0){ ?>
                            <div class="col-lg-8 col-6 py-1"><?= $month ?> Months </div>
                        <?php } ?>

                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>

    <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <i class="bi bi-gear"></i>
                            <span style="position:relative;top:2px;left:5px;">Projects</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 section-content">

                <?php for ($i = 0; $i < sizeof($profile_pro); $i++) {
                         ?>
                <div class="mb-3">
                    <?php $project_url=$profile_pro[$i]['url'];?>
                    <div class="h5" id="project-title">
                        <span id="project-title-text"><?php echo $profile_pro[$i]['title']; ?></span> 
                            <?php
                            if(!$project_url == ""){
                                echo "
                                <span
                                    style='font-weight:normal;font-size:14px' class='px-5'><a
                                    href='".$project_url."' target='blank'>View project <i
                                    class='bi bi-box-arrow-up-right'
                                    style='font-size:12px;position:relative;bottom:4px;'></i> </a>
                                </span>     
                                ";
                            }
                            ?>
                    </div>
                    <div class="px-4 mb-2 text-muted">
                    
                    <?php 
                        if(!empty($profile_pro[$i]['pro_start'])){
                            echo $profile_pro[$i]['pro_start'] . ' to ' . $profile_pro[$i]['pro_end'];
                        }
                    ?>
                            
                    </div>
                    <div id="project-details">
                        <div class="fw-bold">Description</div>
                        <div class="mb-2"><?php echo $profile_pro[$i]['description']; ?></div>

                        <div class="fw-bold">Roles and Responsibilites</div>
                        <div class="mb-2"><?php echo $profile_pro[$i]['responsibilities'];?></div>
                        <div class="fw-bold mb-2">Technologies: <span
                                style="font-weight:normal"><?php echo $profile_pro[$i]['technologies']; ?></span></div>
                        <div class="fw-bold mb-2">Industry: <span
                                style="font-weight:normal"><?php echo $profile_pro[$i]['industry'];?></span></div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </section>

    <?php if(($profile_exp[0]['title'])!='') { ?>
    <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <i class="bi bi-briefcase"></i>
                            <span style="position:relative;top:2px;left:5px;">Work history</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 section-content">
                
                <div class="mb-2">
                    <div class="text-dark">
                        <?php echo  $profile_exp[0]['title']; ?> <?php echo ($profile_exp[0]['start'] != '' ? "• ".$profile_exp[0]['start'] : '')  . ($profile_exp[0]['end'] != '' ? " to ".$profile_exp[0]['end'] : ''); ?>
                    
                    <div class="mb-2"><?php echo $profile_exp[0]['description'] != '' ? "Description: ".$profile_exp[0]['description'] : ''; ?></div>
                </div>
                
                <?php if (sizeof($profile_exp) > 1) {
                for ($i = 1; $i < sizeof($profile_exp); $i++) {  ?>
                <div class="mb-2">
                    <div class="text-dark">
                        <?php echo  $profile_exp[$i]['title']; ?> <?php echo ($profile_exp[$i]['start'] != '' ? "• ".$profile_exp[$i]['start'] : '')  . ($profile_exp[$i]['end'] != '' ? " to ".$profile_exp[$i]['end'] : ''); ?>
                    </div>
                    <div class="text-dark">
                        <?php echo $profile_exp[$i]['company_name']; ?>  
                    </div>

                    <div class="mb-2"><?php echo $profile_exp[$i]['description'] != '' ? "Description: ".$profile_exp[$i]['description'] : ''; ?></div>
                </div>
                <?php }} ?>
            </div>
        </div>
    </section>
    <?php } ?>

<?php
if(isset($profiles[0]['soft_skill']) && strlen($profiles[0]['soft_skill']) && !empty(trim($profiles[0]['soft_skill']))) {
    $soft_skills = explode(",", $profiles[0]['soft_skill']);
    $filtered_soft_skills = array_filter($soft_skills, 'trim');
    if (!empty($filtered_soft_skills)) {
?>
<section class="px-3 border-bottom">
    <div class="row py-3 mt-1">
        <div class="col-lg-4">
            <div class="h5">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <i class="bi bi-nut"></i>
                        <span style="position:relative;top:2px;left:5px;">Soft skills</span>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 section-content">
            <?php
            foreach ($filtered_soft_skills as $soft_skill) {
                echo "<div class='soft-skill'>$soft_skill</div>";
            }
            ?>
        </div>
    </div>
</section>
<?php
    }
}
?>


    <?php if(isset($profile_cert[0]['name']) && $profile_cert[0]['name']) { ?>
    <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <i class="bi bi-patch-check"></i>
                            <span style="position:relative;top:2px;left:5px;">Certifications</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 section-content">
                <?php for ($i = 0; $i < sizeof($profile_cert); $i++) { ?>
                <div class="mb-2">
                    <div class="text-dark">
                        <?php echo $profile_cert[$i]['name']; ?> <?php echo $profile_cert[$i]['issuer'] != '' ? "by ".$profile_cert[$i]['issuer'] : ''; ?>
                    </div>
                    <div class="text-muted">
                        <?php echo $profile_cert[$i]['year'] != '0' ? $profile_cert[$i]['year'] : ''; ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php } ?>

    <?php if(sizeof($profile_edu) > 0 && ($profile_edu[0]['degree'] != 'None'))  { ?>
    <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                                class="bi bi-mortarboard" viewBox="0 0 16 16">
                                <path
                                    d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5ZM8 8.46 1.758 5.965 8 3.052l6.242 2.913L8 8.46Z" />
                                <path
                                    d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46l-3.892-1.556Z" />
                            </svg>
                            <span style="position:relative;top:2px;left:5px;">Education</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 section-content">
                <?php
                for ($i = 0; $i < sizeof($profile_edu); $i++) {
                ?>
                <div class="mb-2">
                    <div class="text-dark">
                        <?= $profile_edu[$i]['degree'] ?> degree in <?= $profile_edu[$i]['major'] ?>
                    </div>
                    <div class="text-muted" style="font-size:16px">
                        <?= $profile_edu[$i]['univ'] ?>
                    </div>
                    <div class="text-muted">
                        <?php echo $profile_edu[$i]['edu_start'] . ' to ' . $profile_edu[$i]['edu_end']; ?>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </section>
    <?php } ?>

    <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26">
                                <path d="m475 976 181-480h82l186 480h-87l-41-126H604l-47 126h-82Zm151-196h142l-70-194h-2l-70 194Zm-466 76-55-55 204-204q-38-44-67.5-88.5T190 416h87q17 33 37.5 62.5T361 539q45-47 75-97.5T487 336H40v-80h280v-80h80v80h280v80H567q-22 69-58.5 135.5T419 598l98 99-30 81-127-122-200 200Z" />
                            </svg>
                            <span style="position:relative;top:2px;left:5px;">Language</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
            <!-- • IST Time Zone -->
            <div class="col-lg-7 sction-content">English - <?php echo ucfirst($profiles[0]['english']);?></div>
        </div>
    </section>

    <section>
        <center>
            <div class="subsection-2 py-4 mb-1 ">
                <div class="subsection-items px-2 py-2 actions-container">
                    <div class="btn btn-light text-dark" onclick="navigator.share({url:''})"><i style="margin-right:10px;" class="uil uil-share"></i> Share </div>
                    <a href="<?=base_url('hire'); ?>">
                        <div class="btn btn-light text-dark"><i style="margin-right:10px;"
                                class="uil uil-chat-info"></i>
                            Hire <?php echo $fullname;?></div>
                    </a>

                    <a href="<?= base_url('home/profile2pdf/'.$profileID) ?>">
                        <div class="btn btn-light text-dark"><i style="margin-right:10px;"
                                class="uil uil-download-alt"></i>
                            Download PDF</div>
                    </a>
                </div>
            </div>
        </center>
    </section>
</div>

<!-- page footer -->

<section class="px-10 mb-8">
    <div class="row bg-primary py-14 bottom-footer">
        <div class="col-lg-6 text-center" id="footer-section-one" style="border-right:2px solid white;">
            <div class="h1 text-light text-center">Hire software <br> developers today</div>
            <a href="<?=base_url('hire');?>"><button class="btn btn-light text-dark mt-4"
                    style="border-radius:50px;">Connect with us</button></a>
        </div>
        <div class="col-lg-6 text-center" id="footer-section-two">
            <div class="h1 text-light text-center">Join the iOS<br>developer network </div>
            <a href="<?=base_url('join');?>"><button class="btn btn-light text-dark mt-4"
                    style="border-radius:50px;">Join Talrn</button></a>
        </div>
    </div>
</section>

