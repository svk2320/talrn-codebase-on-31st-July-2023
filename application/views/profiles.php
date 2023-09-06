<?php

function limit_text($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
    }
?>
<style>
    .proimg{
        aspect-ratio:1;
    }

    .profile-card{
        min-width: 360px;
    }
</style>
<link rel="stylesheet" href="./template/rangeslider/range.css">
<section class="wrapper bg-light">
    <div class="container pb-14 pb-md-16">
        <div class="row gy-10">
            <div class="col-lg-9 order-lg-2">
                <div class="row align-items-center mb-10 position-relative zindex-1">
                </div>
                <!--/.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div id="magicsuggest">
                    
                        </div>
                    </div>
                </div>

                <div class="row mt-4" id="profile_list_wrapper">
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
                    <div class="col-lg-6 mb-4 profile-card">
                        <a style="color:black;" target="_blank"
                            href="<?= base_url('profile/' . strtolower($profiles[$i]['profile_url']) . '/' . strtolower($profiles[$i]['unique_id'] )) ?>">
                            <div class=" shadow-lg px-2 py-2 rounded ">
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
                                            <span
                                                ><?php echo mb_substr($profiles[$i]['last_name'], 0, 10) . ' ' . mb_substr($profiles[$i]['first_name'], 0, 1) ?>
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
                                                
                                                    <span class="text-danger px-5" style="font-size:10px; padding-left: 0px !important;"><?php echo $profiles[$i]['unique_id'];?></span></span>
                                            <span class="profile-card-title" style="font-size:14px;" <?php
                                                $title = (strlen($profiles[$i]['primary_title']) > 20) ? substr($profiles[$i]['primary_title'],0,20).'...' : $profiles[$i]['primary_title'];
                                            ?> class="profile-card-exp"><?php echo $title ;?>,
                                                <?php echo ($profiles[$i]['experience'] < 1) ? '< 1' : $profiles[$i]['experience']; ?> year<?php echo ($profiles[$i]['experience'] < 2) ? '' : 's'; ?></span>
                                        </div>
                                        <div>
                                            <?php 
                    
                                                $profile_skills = $this->model_home->profile_skills($profiles[$i]['id']);
                                                for($skill = 0; $skill < sizeof($profile_skills) && $skill < 3 ; $skill++) { 
                                                ?>
                                            <div class="card-pills">
                                                <?php
                                                    if(strlen($profile_skills[$skill]['name'])>=7){
                                                        echo substr($profile_skills[$skill]['name'],0,7)."..";
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
                                    $string = (strlen($profiles[$i]['bio']) > 140) ? substr($profiles[$i]['bio'],0,140).'...' : $profiles[$i]['bio'];
                                    echo $string;
                                ?>
                                </div>
                                <div class="card-industries" style="word-wrap:break-word;">
                                    <b>Industries:</b><?php
                                
                                    $char_count = 0;
                                    foreach($industry_pro_list as $industry){
                                        if($industry == $industry_pro_list[0]){
                                            $char_count += strlen($industry);
                                            if ($char_count > 55){
                                                echo ',...';
                                                break;
                                            }else{
                                                echo '<u>'.$industry.'</u>';
                                            }
                                        }
                                        else{
                                            $char_count += strlen($industry);
                                            if ($char_count > 55){
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
                                            <?php echo mb_substr($profiles[$i]['last_name'], 0, 13) . ' ' . mb_substr($profiles[$i]['first_name'], 0, 1) ?></a>
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
                <div id="no results" style="display:none">
                    <p>No result based on your filter</p>
                    <p>Remove filters to get results or <a href="<?=base_url('contact-us')?>">Connect with our Expert team</a> to find the profile for you</p>
                </div>
                <section id="partial_section" style="display:none">
                    <h2>Partial Results</h2>
                    <hr style="margin: 0.5rem 0;color: rgb(164 174 198);">
                    <div class="row mt-4" id="partial_list_wrapper">   
                    </div> 
                </section>
                <?php if (isset($links))
                    echo $links; ?>
            </div>
            <!-- /column -->
            <aside class="col-lg-3 sidebar pt-10">
                <section id="filter_wrapper" style="display:none" >
                <div class="h3"> Filters</div>
                <div class="mt-1" id="industry_filter" >
                    <div class="h5 text-dark">Industries</div>
                    <?php for($i = 0; $i < sizeof($industry_report);$i++){ ?>
                        <div class="industry-item mb-2 <?php if($i > 6){echo "d-none";} ?>">
                            <label for=""><?=$industry_report[$i]['industry']." (".$industry_report[$i]['num'].")" ?></label>
                            <input type="checkbox" name="industries[]" value="<?=$industry_report[$i]['industry'] ?>" onclick="search()" style="transform:scale(1.2);"
                            <?php  
                                if(isset($ind_list)){
                                    if(in_array($industry_report[$i]['industry'],$ind_list)){
                                        echo 'checked';
                                    }
                                }
                            ?>
                            >
                        </div>
                    <?php } ?>
                    <u><div id="show-more" onclick="showMore()" style="cursor: pointer;color:black">Show more</div></u>
                </div>
                <div class="h5 mt-3">Years of experience</div>
                <div class="range_container mb-5">
                    <div class="sliders_control">
                        <input id="fromSlider" type="range" value="<?php if(isset($exp_data)){echo $exp_data[0];}else{echo '0'; } ?>" min="0" max="60" />
                        <input id="toSlider" type="range" value="<?php if(isset($exp_data)){echo $exp_data[1];}else{echo '60'; } ?>" min="0" max="60" />
                    </div>
                    <div class="form_control">
                        <div class="form_control_container">
                            <div class="form_control_container__time">Min</div>
                            <input class="form_control_container__time__input" type="number" id="fromInput" value="<?php if(isset($exp_data)){echo $exp_data[0];}else{echo '0'; } ?>"
                                min="0" max="60" />
                        </div>
                        <div class="form_control_container">
                            <div class="form_control_container__time">Max</div>
                            <input class="form_control_container__time__input" type="number" id="toInput" value="<?php if(isset($exp_data)){echo $exp_data[1];}else{echo '60'; } ?>"
                                min="0" max="60" />
                        </div>
                    </div>
                </div>
                </section>
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
                        <p class="mb-0">Talrn vets iOS profiles rigorously & the best candidates are handpicked by our
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
                        <p class="mb-0">You'll be able to get an iOS developer working on your project within 2 to 3
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
                        <p class="mb-0">With our large talent pool of iOS dev, you can effortlessly scale your team
                            fast.</p>
                    </div>
                </div>
            </div>
            <!--/column -->
        </div>
        <!--/.row -->
    </div>
    <script>
        function truncate(str, length) {
            if (str.length > length) {
                return str.slice(0, length) + '...';
            } else return str;
        }
        
        function populate_exact(profile_list) {
            var card = 'fdfdg';
            var profile_list_wrapper = document.getElementById('profile_list_wrapper');
            profile_list_wrapper.innerHTML = '';
            if(profile_list.length == 0){
                document.getElementById('no results').style.display = "block";
            } else{
                document.getElementById('no results').style.display = "none";
            }
            for(var i = 0; i < profile_list.length;i++){
                card = generate(profile_list[i]);
                profile_list_wrapper.innerHTML += card;
            }
            
            initializePopovers();
        }

        function populate_partial(profile_list) {
            var card = 'fdfdg';
            var profile_list_wrapper = document.getElementById('partial_list_wrapper');
            console.log('in partial list populate');
            profile_list_wrapper.innerHTML = '';
            if(profile_list.length == 0){
                document.getElementById('partial_section').style.display = 'none';
            }
            else{
                document.getElementById('partial_section').style.display = 'block';
            }
            for(var i = 0; i < profile_list.length;i++){
                card = generate(profile_list[i]);
                profile_list_wrapper.innerHTML += card;
            }
            
            initializePopovers();
        }
        
        function generate(profile) {
            const base_url = "<?=base_url() ?>";
            var profile_url = base_url + 'profile/'+ profile.profile_url +"/"+ profile.unique_id;
            profile_url = profile_url.toLowerCase();
            var profile_img = base_url + profile.userPhoto;
            var full_name = profile.last_name.slice(0,13) + ' ' + profile.first_name[0];
            var unique_id = profile.unique_id;
            var primary_title = profile.primary_title;
            if (primary_title == ""){primary_title = "iOS Developer"}
            var exp = profile.experience < 1 ? '< 1' : (profile.experience == 1 ? '1 year' : profile.experience + ' years');
            var bio = profile.bio;
            var verified = profile.verified;
            var verified_date = profile.verified_date;
            
                            const targetDate = new Date(verified_date);
                const currentDate = new Date();
                
                const interval = Math.floor((currentDate - targetDate) / (1000 * 60 * 60 * 24));
                
                
            
            if (!(verified_date === null)) {

                var borderStyle = ((verified == 1 && (30 - interval)) ? 'border: 3px solid #5271ff;' : '');
                var imageSrc = ((verified == 1 && (30 - interval)) ? (base_url + 'assets/img/verified-icon.png') : '');
                var imageStyle = ((verified == 1 && (30 - interval)) ? 'position: relative; width: 19px;margin-left:5px;' : '');
                var popoverattributes = ((verified == 1 && (30 - interval)) ? 'data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="bottom" data-bs-html = "true" data-bs-content="' + profile.last_name + '\'s identity has been verified to provide a trusted & reliable experience. <br><br>Talrn guarantees a seamless collaboration experience for you."': '');
            } else {
                var borderStyle = '';
                
                var imageSrc = '';
                var imageStyle = '';
                var popoverattributes = 'hbhbhnb';
            }
            
            bio = bio.slice(0,140);
            if(bio.length==140){
                bio+="...";
            }

            primary_title = primary_title.slice(0,18);
            if(primary_title.length == 18){
                primary_title+="...";
            }
            
            var hire = base_url + 'hire';
            var pdf = base_url + 'home/profile2pdf/' + profile.id;
            var vpdf  = ((verified == 1 && (30 - interval)) ? (base_url + 'home/profile2pdfVerified/' + profile.id) : (base_url + 'admin/verified') );
            
            var skills = '';
            
            for(var i = 0;i < profile.skills.length && i < 3;i++){
                if(profile.skills[i].length>8){
                    profile.skills[i] = profile.skills[i].slice(0,8) + '..';
                }
            }
            
            for(var i = 0;i < profile.skills.length && i < 3;i++){
                skills += '<div class="card-pills">'+ profile.skills[i] +'</div>\n';
            }
            var industries = '';
            for(var i = 0;i < profile.profile_industries.length && i < 3;i++){
                if(i == 0){
                    industries += '<u>'+ profile.profile_industries[i] +'</u>';
                }
                else{
                    industries += ', <u>'+ profile.profile_industries[i] +'</u>';
                }
            }
            industries = industries.slice(0,60);
            if(industries.length == 60){
                industries += "...";
            }
            card_html = `
            <div class="col-lg-6 mb-4">
                    <a style="color:black;" target="_blank"
                        href="` + profile_url + `">
                        <div class=" shadow-lg px-2 py-2 rounded">
                            <div class="row">
                                <div class="col-lg-4 col-4">
                                    <center><img src="`+profile_img+`" onerror="this.onerror=null; this.src='<?=base_url('assets/img/noimage.jpg')?>'" style="` + borderStyle + `"  id="card-image" class="proimg"></center>
                                </div>
                                <div class="col-lg-8 col-8">
                                    <div class="mt-2">
                                        <span >
                                            ` + full_name + `<img ` +  popoverattributes + `src="` + imageSrc + `" style="` + imageStyle + `">` + `<span class="text-danger" style="font-size:10px; margin-left:5px;">` + unique_id + `</span>
                                        </span>
                                        <span class="profile-card-title"  style="font-size:14px;">
                                            ` + primary_title + `, ` + exp + `
                                        </span>
                                    </div>
                                    <div>
                                        ` + skills + `
                                    </div>
                                </div>
                            </div>
                            <div class="card-description" style="word-wrap:break-word">
                                ` + bio + `
                            </div>
                            <div class="card-industries">
                                Industries: ` + industries + `
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-6 actions text-center">
                                    <a href="` + hire + `"><i class="uil uil-chat-info"></i> Hire
                                        ` + full_name + `
                                    </a>
                                </div>
                                <div class="col-lg-6 col-6 actions text-center">`;
                            <?php if(isset($_SESSION['id'])){ ?>
                                    
                                    var vendorID = <?php echo $_SESSION['id']; ?>;

                                    if(profile.vendor_id!=vendorID){
                                card_html += `<a href="` + pdf + `"><i class="bi bi-download"></i> <span class="px-1">Download PDF</span></a>`;
                                        
                                        }else{
                                        
                               card_html +=     `<a style="display:inline;" class="dropdown dropdown-toggle" data-bs-toggle="dropdown" href="#"><i class="bi bi-download"></i> <span class="px-1">Download PDF<span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                              <li><a href="` + pdf + `" class="dropdown-item">Download Talrn CV</a></li>
                                              <li><a href="` + vpdf + `" class="dropdown-item">Download CV</a></li>
                                            </ul>`;}
                            <?php }else{ ?>
                            card_html += `<a href="` + pdf + `"><i class="bi bi-download"></i> <span class="px-1">Download PDF</span></a>`;
                                        <?php } ?>
                        card_html +=        `</div>
                            </div>
                        </div>
                    </a>
                </div>`;
                return card_html;
        }
        
    </script>
    <script>
        function showMore() {
            var industryFilter = document.getElementById("industry_filter");
            var showMoreButton = document.getElementById("show-more");
            
            var industryItems = industryFilter.querySelectorAll(".industry-item");
            
            for (var i = 6; i < industryItems.length; i++) {
                industryItems[i].classList.toggle("d-none");
            }
            
            if (showMoreButton.innerText === "Show more") {
                showMoreButton.innerText = "Show less";
            } else {
                showMoreButton.innerText = "Show more";
            }
        }

    </script>
    <script>
    
        function initializePopovers() {
          $(function() {
            $('[data-bs-toggle="popover"]').popover({
              trigger: 'manual' // Initialize the popover with 'manual' trigger
            }).on('mouseenter', function() {
              var _this = this;
              $(this).popover('show');
              $('.popover').on('mouseleave', function() {
                $(_this).popover('hide');
              });
            }).on('mouseleave', function() {
              var _this = this;
              setTimeout(function() {
                if (!$('.popover:hover').length) {
                  $(_this).popover('hide');
                }
              }, 100);
            });
          });
        }

        function search() {
            var skill_list = skill_tags.getValue();
            if(skill_list == 0){
                history.pushState({}, null, '<?= base_url('profiles') ?>');
                location.reload();
            }
            var min = Number(document.getElementById('fromInput').value);
            var max = Number(document.getElementById('toInput').value);
            var industry_filter_wrapper = document.getElementById('industry_filter');
            var industry_filter = industry_filter_wrapper.querySelectorAll('input[name="industries[]"]:checked');
            var industries = [];
            for(var x = 0, l = industry_filter.length; x < l;  x++) {
                var aIds = industries.push(industry_filter[x].value);
            }
            var json_filters = {
                "skills" : skill_list,
                "industries": industries,
                "experience":[min,max]
            };
            $.ajax({
                type: "POST",
                url: '<?php echo base_url('autocomplete/search')?>',
                dataType: "json",
                data: JSON.stringify(json_filters),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    populate_exact(data[0]);
                    populate_partial(data[1]);
                    document.getElementById('filter_wrapper').style.display = 'block';
                    document.getElementById('pagination').style.display = 'none';
                    search_url = '<?= base_url('profiles?skills=') ?>' + skill_list.join(",") ;
                    if(min != 0 || max != 60){
                        search_url += '&exp='+ min + ',' + max;
                    }
                    if(industries.length > 0){
                        search_url += '&ind=' + industries.join(",");
                    }
                    history.pushState({}, null, search_url);
                }
            });
            
        }

    </script>
    <script>
        function controlFromInput(fromSlider, fromInput, toInput, controlSlider) {
            const [from, to] = getParsed(fromInput, toInput);
            fillSlider(fromInput, toInput, '#C6C6C6', '#5271ff', controlSlider);
            search();
            if (from > to) {
                fromSlider.value = to;
                fromInput.value = to;
            } else {
                fromSlider.value = from;
            }
        }

        function controlToInput(toSlider, fromInput, toInput, controlSlider) {
            const [from, to] = getParsed(fromInput, toInput);
            fillSlider(fromInput, toInput, '#C6C6C6', '#5271ff', controlSlider);
            setToggleAccessible(toInput);
            search();
            if (from <= to) {
                toSlider.value = to;
                toInput.value = to;
            } else {
                toInput.value = from;
            }
        }

        function controlFromSlider(fromSlider, toSlider, fromInput) {
            const [from, to] = getParsed(fromSlider, toSlider);
            fillSlider(fromSlider, toSlider, '#C6C6C6', '#5271ff', toSlider);
            search();
            if (from > to) {
                fromSlider.value = to;
                fromInput.value = to;
            } else {
                fromInput.value = from;
            }
        }

        function controlToSlider(fromSlider, toSlider, toInput) {
            const [from, to] = getParsed(fromSlider, toSlider);
            fillSlider(fromSlider, toSlider, '#C6C6C6', '#5271ff', toSlider);
            search();
            setToggleAccessible(toSlider);
            if (from <= to) {
                toSlider.value = to;
                toInput.value = to;
            } else {
                toInput.value = from;
                toSlider.value = from;
            }
        }

        function getParsed(currentFrom, currentTo) {
            const from = parseInt(currentFrom.value, 10);
            const to = parseInt(currentTo.value, 10);
            return [from, to];
        }

        function fillSlider(from, to, sliderColor, rangeColor, controlSlider) {
            const rangeDistance = to.max - to.min;
            const fromPosition = from.value - to.min;
            const toPosition = to.value - to.min;
            controlSlider.style.background = `linear-gradient(
             to right,
             ${sliderColor} 0%,
             ${sliderColor} ${(fromPosition)/(rangeDistance)*100}%,
             ${rangeColor} ${((fromPosition)/(rangeDistance))*100}%,
             ${rangeColor} ${(toPosition)/(rangeDistance)*100}%, 
             ${sliderColor} ${(toPosition)/(rangeDistance)*100}%, 
             ${sliderColor} 100%)`;
               }

        function setToggleAccessible(currentTarget) {
            const toSlider = document.querySelector('#toSlider');
            if (Number(currentTarget.value) <= 0) {
                toSlider.style.zIndex = 2;
            } else {
                toSlider.style.zIndex = 0;
            }
        }

        const fromSlider = document.querySelector('#fromSlider');
        const toSlider = document.querySelector('#toSlider');
        const fromInput = document.querySelector('#fromInput');
        const toInput = document.querySelector('#toInput');
        fillSlider(fromSlider, toSlider, '#C6C6C6', '#5271ff', toSlider);
        setToggleAccessible(toSlider);

        fromSlider.onclick = () => controlFromSlider(fromSlider, toSlider, fromInput);
        toSlider.onclick = () => controlToSlider(fromSlider, toSlider, toInput);
        fromInput.oninput = () => controlFromInput(fromSlider, fromInput, toInput, toSlider);
        toInput.oninput = () => controlToInput(toSlider, fromInput, toInput, toSlider);
    </script>
    <!-- /.container -->

    <script>
    var skill_tags;
  
    $(document).ready(function () {
      skill_tags = $('#magicsuggest').magicSuggest({
        placeholder: 'Search for skills ',
        allowFreeEntries: true,
        data: '<?php echo base_url('autocomplete/skill_search_all')?>',
        selectionPosition: 'bottom',
        selectionStacked: false,
        <?php if(isset($skill_list)) { ?>
        value:[<?php 
                for($i=0;$i<count($skill_list);$i++){
                  if ($i == 0){
                    echo '"'.$skill_list[$i].'"';
                  }
                  else{
                    echo ',"'.$skill_list[$i].'"';
                  }  
                }
      ?>],
      <?php } ?>
        strictSuggest: true,
        noSuggestionText: 'Press "ENTER" to add {{query}}'

      });
      
      $(skill_tags).on('selectionchange', function(e,m){
        if(this.getValue().length == 0){
            location.reload();
        }
        search();
    });
    });
    
  </script>
</section>
<!-- /section -->

<script type="text/javascript">

        // history.pushState({}, null, '<?= base_url('profiles/') ?>');

    </script>
