<section>
    <div class="container">
        <div class="row">

            <div class="col-lg-6">
                <div class="text-dark fw-bold landingpage-header poppins">Hire iOS Developers and
                    manage them <br>
                    with <span class="text-primary">ease</span></div>
                <div class="fw-bold text-primary poppins mt-3">
                    <a href="<?=base_url('hire')?>">
                        <span id="started-text">Hire iOS Developer</span> <i class="bi bi-arrow-right-circle"
                            id="started-arrow"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-6 header-image-container py-3">
                <div class="image-container">
                    <div>
                    <div id="floating-count-one" class="first-float">
                        <div class="green-dot"></div>
                        <?=$profiles_count ?>+ iOS Developers available
                    </div>
                    </div>

                    <div>
                    <div id="floating-count-one">
                        <div class="green-dot"></div>
                        <?=$skills_count ?>+ skills such as <?=$skills_name?> & more
                    </div>
                    </div>
                    <div>
                    <div id="floating-count-one">
                        <div class="green-dot"></div>
                        <?=$industries_count ?>+ industry experts in <?=$industries_name?> & more
                    </div>
                    </div>
                    
                </div>
            </div>        
        </div>
    </div>
</section>

<section>
    <div class="container pb-4">
        <div id="outshines-container" class="py-10 px-6">
            <div class="row" id="outshines-wrapper">
                <div class="col-lg-8 h1 text-light">
                    Augment your team with  <br> highly-skilled iOS Developers
                </div>
                <div class="col-lg-4">
                    <a href="<?=base_url('profiles')?>"><button class="btn btn-light text-dark form-control mt-3"
                            id="first-section-button">View Profiles</button></a>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    function getIndustryData(industry) {
        document.getElementById('industry-name').innerHTML = industry;
        document.getElementById('Industry-name').innerHTML = industry;
        document.getElementById('Industry-Name').innerHTML = industry;
        console.log(industry);
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            var profile_skills = [];
            var profile_list = JSON.parse(this.responseText);
            var industry_wrapper = document.getElementById('industry_card_list');
            var profile_card_list = industry_wrapper.getElementsByClassName('profile');

            // Sort the profiles based on the "verified" value and "last_login" descending
            profile_list.sort((a, b) => {
                if (a.verified === "1" && b.verified !== "1") {
                    return -1; // "a" comes before "b"
                } else if (a.verified !== "1" && b.verified === "1") {
                    return 1; // "b" comes before "a"
                } else {
                    // If both have the same "verified" value, sort by "last_login" descending
                    return new Date(b.last_login) - new Date(a.last_login);
                }
            });

            for (var i = 0; i < profile_list.length; i++) {
                var profile_skills = profile_list[i].skills;
                // var profile_unique_id = profile_list[i].unique_id;
                var profile_experience = profile_list[i].experience;
                var profile_verified = profile_list[i].verified;
                var profile_verified_date = profile_list[i].verified_date;
                var profile_pdf = "<?=base_url('home/profile2pdf/')?>" + profile_list[i].id;
                var profile_url = "<?=base_url('profile/')?>" + profile_list[i].profile_url +"/"+ profile_list[i].unique_id;
                profile_url = profile_url.toLowerCase();
                
                var imageElement = profile_card_list[i].getElementsByClassName('verification_img')[0];
                
                if (!(profile_verified_date === null)) {
                    const targetDate = new Date(profile_verified_date);
                    const currentDate = new Date();
                    
                    const interval = Math.floor((currentDate - targetDate) / (1000 * 60 * 60 * 24));
                    
                    var borderStyle = ((profile_verified == 1 && (30 - interval)) ? 'border: 3px solid #5271ff;' : '');
                    
                    var imageSrc = ((profile_verified == 1 && (30 - interval)) ? ("<?=base_url()?>" + 'assets/img/verified-icon.png') : '');
                    var imageStyle = ((profile_verified == 1 && (30 - interval)) ? 'position: relative; width: 19px; padding-bottom: 2px;' : '');
                    
                    
                    
                    if(profile_verified == 1 && (30 - interval)){
                        imageElement.setAttribute('src',imageSrc);
                        imageElement.setAttribute('style', imageStyle);
                        imageElement.setAttribute('data-bs-toggle', 'popover');
                        imageElement.setAttribute('data-bs-trigger', 'hover');
                        imageElement.setAttribute('data-bs-placement', 'bottom');
                        imageElement.setAttribute('data-bs-html', 'true');
                        imageElement.setAttribute('data-bs-content', profile_list[i].last_name + '\'s identity has been verified to provide a trusted & reliable experience. <br><br>Talrn guarantees a seamless collaboration experience for you.');
                        initializePopoverAgain(imageElement);
                    }
                    
                    else{
                        imageElement.setAttribute('src','');
                        imageElement.setAttribute('style', '');
                        imageElement.setAttribute('data-bs-toggle', '');
                        imageElement.setAttribute('data-bs-trigger', '');
                        imageElement.setAttribute('data-bs-placement', '');
                        imageElement.setAttribute('data-bs-html', '');
                        imageElement.setAttribute('data-bs-content', '');
                        
                    }
                }else{
                        imageElement.setAttribute('src','');
                        imageElement.setAttribute('style', '');
                        imageElement.setAttribute('data-bs-toggle', '');
                        imageElement.setAttribute('data-bs-trigger', '');
                        imageElement.setAttribute('data-bs-placement', '');
                        imageElement.setAttribute('data-bs-html', '');
                        imageElement.setAttribute('data-bs-content', '');
                        
                }
                
                if(profile_list[i].userPhoto != 'uploads/'){
                    var profile_img = "<?=base_url()?>" + profile_list[i].userPhoto;
                }
                else{
                    var profile_img = "<?=base_url('assets/img/noimage.jpg')?>"
                }
                
                for (var j = 0; j < profile_skills.length && j < 3 ; j++ ){
                    profile_card_list[i].getElementsByClassName('card-pills')[j].innerHTML =  profile_skills[j].slice(0,8); 
                }
                profile_industries = profile_list[i].profile_industries;
                var industries_html = '';
                for(var j = 0; j < profile_industries.length && j < 2 ; j++ ){
                    if(j == 0){
                        industries_html += '<u>' + profile_industries[j]+ '</u>';
                    }
                    else{
                        industries_html += ', <u>' + profile_industries[j]+ '</u>';
                    }
                }
                var industries_html = industries_html.slice(0,50);
                profile_card_list[i].getElementsByClassName('profile_hire')[0].innerHTML = 'Hire '+ profile_list[i].last_name + ' ' + profile_list[i].first_name[0];
                profile_card_list[i].getElementsByClassName('profile_industries')[0].innerHTML = industries_html;
                profile_card_list[i].getElementsByClassName('profile_img')[0].src = profile_img;
                profile_card_list[i].getElementsByClassName('primary_title')[0].innerHTML = profile_list[i].primary_title + ', ' + profile_experience + ((profile_experience === 1) ? ' year' : (profile_experience > 1) ? ' years' : ' > year')
                profile_card_list[i].getElementsByClassName('profile_unique_id')[0].innerHTML = profile_list[i].unique_id;
                profile_card_list[i].getElementsByClassName('profile_name')[0].innerHTML = profile_list[i].last_name + ' ' + profile_list[i].first_name[0];
                profile_card_list[i].getElementsByClassName('profile_bio')[0].innerHTML = profile_list[i].bio.slice(0, 150) + '...';
                profile_card_list[i].getElementsByClassName('download_pdf')[0].setAttribute('href', profile_pdf );
                profile_card_list[i].getElementsByClassName('profile_url')[0].setAttribute('href', profile_url );
                // if(profile_list[i].city == ''){
                //     profile_card_list[i].getElementsByClassName('location')[0].innerHTML = profile_list[i].country;
                // }
                // else{
                //     profile_card_list[i].getElementsByClassName('location')[0].innerHTML = profile_list[i].city +','+profile_list[i].country;
                // }
            }
            document.getElementById('industry_options').style.display = 'none';
            document.getElementById('industry_profile').style.display = 'flex';

        }
        xhttp.open("GET", "<?= base_url('industries/industryList/')?>" + industry);
        xhttp.send();
    }

    function reset() {
        document.getElementById('industry_profile').style.display = 'none';
        document.getElementById('industry_options').style.display = 'block';
        document.getElementsByClassName('swiper-button swiper-button-prev')[0].click();
        document.getElementsByClassName('swiper-button swiper-button-prev')[0].click();
        document.getElementsByClassName('swiper-button swiper-button-prev')[0].click();
    }
</script>

<section id="industry_options">
    <div class="container mb-4" id="third-section">
        <div class="row">
            <div class="col-lg-6" style="padding:0px 28px">
                <div class="extraordinary-title smaller fw-bold poppins text-dark mt-3">
                    Scale your team with Talrn's immediately available resources
                </div>
                <div class="text-dark extraordinary-body mt-2">
                    Find pre-vetted iOS developers that have previously worked in the same industry instantly.
                </div>
                <div class="text-dark extraordinary-body mt-3 fw-bold">
                    What is your industry?
                </div>
                <div class="pills-container mt-1">
                    <div class="industry-pills" onclick="getIndustryData('Healthcare')">Healthcare</div>
                    <div class="industry-pills" onclick="getIndustryData('Automotive')">Automotive</div>
                    <div class="industry-pills" onclick="getIndustryData('Banking')">Banking</div>
                    <div class="industry-pills" onclick="getIndustryData('Capital Markets')">Capital Markets</div>
                    <div class="industry-pills" onclick="getIndustryData('Travel')">Travel</div>
                    <div class="industry-pills" onclick="getIndustryData('Ecommerce')">Digital Commerce</div>
                </div>
                <!--<div class="text-muted mt-4">-->
                <!--    <u>View all</u>-->
                <!--</div>-->
            </div>
            <div class="col-lg-6 text-center">
                <img src="<?= base_url('assets/img/team.webp');?>" id="person-image" alt="">
            </div>
        </div>
    </div>
</section>
<style>
    .profile_img{
        aspect-ratio: 1;
    }
</style>

<section id="industry_profile">
    <div class="container" style="padding:0px 30px;">
        <div class="row mt-3">
            <div class="col-lg-9 industry-header smaller">You selected <b><span id="industry-name"></span></b>, here are
                recently updated developers that have built products in <span id="Industry-Name"></span> industry.
            </div>
            <div class="col-lg-3">
                <div id="reset-button" class="col-lg-12 col-4 text-center" onclick='reset()' role='button'>Reset</div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="swiper-container nav-bottom nav-color mb-14" data-margin="30" data-dots="false" data-nav="true"
                data-items-lg="3" data-items-md="2">
                <div class="swiper">
                    <div class="swiper-wrapper" id="industry_card_list">

                        <div class="swiper-slide border card px-3 py-3 profile">

                            <div class="col-lg-12 ">
                                <div class="px-3 py-3 rounded">
                                    <a style="color:black;" class="profile_url" target="_blank" href="#">
                                        <div class="row">
                                            <div class="col-lg-4 col-4">
                                                <center><img class="profile_img" src="<?=base_url('assets/img/noimage.jpg')?>" onerror="this.onerror=null; this.src='<?=base_url('assets/img/noimage.jpg')?>'"
                                                        id="card-image" style="aspect-ratio: 1;">
                                                </center>
                                            </div>
                                            <div class="col-lg-8 col-8">
                                                <div class="mt-2">
                                                    <span class="profile_name">Mohd Belal Naim</span>
                                                    <img class="verification_img" src="" style="">
                                                    <span class="profile_unique_id text-danger" style="font-size:10px">TALFR08</span>
                                                    <span class="profile-card-title profile-card-exp primary_title"
                                                        style="font-size:14px;">Software Engineer, 7 years</span>
                                                </div>
                                                <div>

                                                    <div class="card-pills">
                                                        React
                                                    </div>
                                                    <div class="card-pills">
                                                        Java
                                                    </div>
                                                    <div class="card-pills">
                                                        HTML
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-description" style="word-wrap:break-word" >
                                            <span class="profile_bio">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi amet
                                            velit provident neque? Laudan</span>
                                        </div>
                                        <div class="card-industries" style="word-wrap:break-word;">
                                            <b>Industries:</b> <span class="profile_industries"> </span>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-6 actions text-center">
                                                <a href="<?=base_url('hire');?>"><i class="uil uil-chat-info"></i><span class="profile_hire"> </span></a>
                                            </div>
                                            <div class="col-lg-6 col-6 actions text-center">

                                                <a href="#" class="download_pdf"><i class="bi bi-download"></i> <span class="px-1">Download
                                                        PDF</span></a>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            </div>

                        </div>


                        <div class="swiper-slide border card px-3 py-3 profile">

                            <div class="col-lg-12 ">
                                <div class="px-3 py-3 rounded">
                                    <a style="color:black;" class="profile_url" target="_blank" href="#">
                                        <div class="row">
                                            <div class="col-lg-4 col-4">
                                                <center><img class="profile_img" src="<?=base_url('assets/img/noimage.jpg')?>" onerror="this.onerror=null; this.src='<?=base_url('assets/img/noimage.jpg')?>'"
                                                        id="card-image" style="aspect-ratio: 1;">
                                                </center>
                                            </div>
                                            <div class="col-lg-8 col-8">
                                                <div class="mt-2">
                                                    <span class="profile_name">Mohd Belal Naim</span>
                                                    <img class="verification_img" src="" style="">
                                                    <span class="profile_unique_id text-danger" style="font-size:10px">TALFR08</span>
                                                    <span class="profile-card-title profile-card-exp primary_title"
                                                        style="font-size:14px;">Software Engineer, 7 years</span>
                                                </div>
                                                <div>

                                                    <div class="card-pills">
                                                        React
                                                    </div>
                                                    <div class="card-pills">
                                                        Java
                                                    </div>
                                                    <div class="card-pills">
                                                        HTML
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-description" style="word-wrap:break-word" >
                                            <span class="profile_bio">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi amet
                                            velit provident neque? Laudan</span>
                                        </div>
                                        <div class="card-industries" style="word-wrap:break-word;">
                                            <b>Industries:</b> <span class="profile_industries"> </span>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-6 actions text-center">
                                                <a href="<?=base_url('hire');?>"><i class="uil uil-chat-info"></i><span class="profile_hire"> </span></a>
                                            </div>
                                            <div class="col-lg-6 col-6 actions text-center">

                                                <a href="#" class="download_pdf"><i class="bi bi-download"></i> <span class="px-1">Download
                                                        PDF</span></a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>


                        <div class="swiper-slide border card px-3 py-3 profile">

                            <div class="col-lg-12 ">
                            <div class="px-3 py-3 rounded">
                                    <a style="color:black;" class="profile_url" target="_blank" href="#">
                                        <div class="row">
                                            <div class="col-lg-4 col-4">
                                                <center><img class="profile_img" src="<?=base_url('assets/img/noimage.jpg')?>" onerror="this.onerror=null; this.src='<?=base_url('assets/img/noimage.jpg')?>'"
                                                        id="card-image" style="aspect-ratio: 1;">
                                                </center>
                                            </div>
                                            <div class="col-lg-8 col-8">
                                                <div class="mt-2">
                                                    <span class="profile_name">Mohd Belal Naim</span>
                                                    <img class="verification_img" src="" style="">
                                                    <span class="profile_unique_id text-danger" style="font-size:10px">TALFR08</span>
                                                    <span class="profile-card-title profile-card-exp primary_title"
                                                        style="font-size:14px;">Software Engineer, 7 years</span>
                                                </div>
                                                <div>

                                                    <div class="card-pills">
                                                        React
                                                    </div>
                                                    <div class="card-pills">
                                                        Java
                                                    </div>
                                                    <div class="card-pills">
                                                        HTML
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-description" style="word-wrap:break-word" >
                                            <span class="profile_bio">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi amet
                                            velit provident neque? Laudan</span>
                                        </div>
                                        <div class="card-industries" style="word-wrap:break-word;">
                                            <b>Industries:</b> <span class="profile_industries"> </span>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-6 actions text-center">
                                                <a href="<?=base_url('hire');?>"><i class="uil uil-chat-info"></i><span class="profile_hire"> </span></a>
                                            </div>
                                            <div class="col-lg-6 col-6 actions text-center">

                                                <a href="#" class="download_pdf"><i class="bi bi-download"></i> <span class="px-1">Download
                                                        PDF</span></a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>


                        <div class="swiper-slide border card px-3 py-3 profile">

                            <div class="col-lg-12 ">
                            <div class="px-3 py-3 rounded">
                                    <a style="color:black;" class="profile_url" target="_blank" href="#">
                                        <div class="row">
                                            <div class="col-lg-4 col-4">
                                                <center><img class="profile_img" src="<?=base_url('assets/img/noimage.jpg')?>" onerror="this.onerror=null; this.src='<?=base_url('assets/img/noimage.jpg')?>'"
                                                        id="card-image" style="aspect-ratio: 1;">
                                                </center>
                                            </div>
                                            <div class="col-lg-8 col-8">
                                                <div class="mt-2">
                                                    <span class="profile_name">Mohd Belal Naim</span>
                                                    <img class="verification_img" src="" style="">
                                                    <span class="profile_unique_id text-danger" style="font-size:10px">TALFR08</span>
                                                    <span class="profile-card-title profile-card-exp primary_title"
                                                        style="font-size:14px;">Software Engineer, 7 years</span>
                                                </div>
                                                <div>

                                                    <div class="card-pills">
                                                        React
                                                    </div>
                                                    <div class="card-pills">
                                                        Java
                                                    </div>
                                                    <div class="card-pills">
                                                        HTML
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-description" style="word-wrap:break-word" >
                                            <span class="profile_bio">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi amet
                                            velit provident neque? Laudan</span>
                                        </div>
                                        <div class="card-industries" style="word-wrap:break-word;">
                                            <b>Industries:</b> <span class="profile_industries"> </span>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-6 actions text-center">
                                                <a href="<?=base_url('hire');?>"><i class="uil uil-chat-info"></i><span class="profile_hire"> </span></a>
                                            </div>
                                            <div class="col-lg-6 col-6 actions text-center">

                                                <a href="#" class="download_pdf"><i class="bi bi-download"></i> <span class="px-1">Download
                                                        PDF</span></a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>


                        <div class="swiper-slide border card px-3 py-3 profile">

                            <div class="col-lg-12 ">
                            <div class="px-3 py-3 rounded">
                                    <a style="color:black;" class="profile_url" target="_blank" href="#">
                                        <div class="row">
                                            <div class="col-lg-4 col-4">
                                                <center><img class="profile_img" src="<?=base_url('assets/img/noimage.jpg')?>" onerror="this.onerror=null; this.src='<?=base_url('assets/img/noimage.jpg')?>'"
                                                        id="card-image" style="aspect-ratio: 1;">
                                                </center>
                                            </div>
                                            <div class="col-lg-8 col-8">
                                                <div class="mt-2">
                                                    <span class="profile_name">Mohd Belal Naim</span>
                                                    <img class="verification_img" src="" style="">
                                                    <span class="profile_unique_id text-danger" style="font-size:10px">TALFR08</span>
                                                    <span class="profile-card-title profile-card-exp primary_title"
                                                        style="font-size:14px;">Software Engineer, 7 years</span>
                                                </div>
                                                <div>

                                                    <div class="card-pills">
                                                        React
                                                    </div>
                                                    <div class="card-pills">
                                                        Java
                                                    </div>
                                                    <div class="card-pills">
                                                        HTML
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-description" style="word-wrap:break-word" >
                                            <span class="profile_bio">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi amet
                                            velit provident neque? Laudan</span>
                                        </div>
                                        <div class="card-industries" style="word-wrap:break-word;">
                                            <b>Industries:</b> <span class="profile_industries"> </span>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-6 actions text-center">
                                                <a href="<?=base_url('hire');?>"><i class="uil uil-chat-info"></i><span class="profile_hire"> </span></a>
                                            </div>
                                            <div class="col-lg-6 col-6 actions text-center">

                                                <a href="#" class="download_pdf"><i class="bi bi-download"></i> <span class="px-1">Download
                                                        PDF</span></a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>


                        <div class="swiper-slide card shadow-lg px-3 py-3 bg-primary" style="height:auto;display:flex;flex-direction:column;justify-content:center;"> 

                            <div>
                            <div class="text-light mb-2">
                                There are more developers in <span id='Industry-name'>Healthcare</span>
                                sector on Talrn
                            </div>
                            </div>
                            <div>
                                <a href='<?=base_url('profiles')?>'><button
                                        class="btn  btn-light text-dark form-control">See all
                                        profiles</button></a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container" style="margin-top:40px;">
        <div id="large-section-1">
            <div class="large-section-header text-light smaller">Talrn is the world’s largest network of <br>
                top iOS
                talent.</div>
            <div class="large-section-content">Save 70% on staff costs, while driving innovation & growth.
                Guaranteed.</div>
            <div class="row">
                <div class="col-lg-4 large-section-blocks">
                    <a href="<?=base_url('discover')?>">
                        <div class="section-1-card rounded px-3 py-3">
                            <div class="poppins fw-bold">Featured works on Talrn</div>
                            <div class="section-block-content">
                                <div class="row">
                                    <div class="col-lg-9 col-9">Explore the best works delivered by developers</div>
                                    <div class="col-lg-3 col-3" style="text-align:right;"><i
                                            class="bi bi-arrow-right-circle" style="position:relative; top:20px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 large-section-blocks">
                    <a href="<?=base_url('profiles')?>">
                        <div class="section-1-card rounded px-3 py-3">
                            <div class="poppins fw-bold">See all profiles on Talrn</div>
                            <div class="section-block-content">
                                <div class="row">
                                    <div class="col-lg-9 col-9">Discover top developer profiles available on Talrn</div>
                                    <div class="col-lg-3 col-3" style="text-align:right;"><i
                                            class="bi bi-arrow-right-circle" style="position:relative; top:20px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 large-section-blocks hover-effect">
                    <a href="<?=base_url('join')?>">
                        <div class="section-1-card rounded px-3 py-3">
                            <div class="poppins fw-bold">Apply as a developer</div>
                            <div class="section-block-content">
                                <div class="row">
                                    <div class="col-lg-9 col-9">Start your journey as a developer with Talrn</div>
                                    <div class="col-lg-3 col-3" style="text-align:right;"><i
                                            class="bi bi-arrow-right-circle" style="position:relative; top:20px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="mt-6">
        <center>
            <div class="text-center smaller text-dark fw-bold poppins mt-3 col-lg-7" id="marquee-header">
                We’ve helped <span class="text-primary">250+</span> clients outsource their software development
            </div>
            <div>And just to name a few...</div>
        </center>

        <div style="margin-top:50px">
            <div class="marquee mt-4 pt-3">
                <ul class="marquee__content">
                    <div class="marquee-block">
                        <div class="marquee-title">Buyhive</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/15.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="row">
                            <div class="col-lg-7 col-7">
                                <div class="marquee-title">Mogul</div>
                            </div>
                            <div class="col-lg-5 col-5">
                                <div class="active-badge">
                                    <div class="active-dot"></div>
                                    <div class="active-badge-text">Active</div>
                                </div>
                            </div>
                        </div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/6.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Bracketology</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/1.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">RXR</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/22.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Remoteshare</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/18.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="row">
                            <div class="col-lg-7 col-7">
                                <div class="marquee-title">1871</div>
                            </div>
                            <div class="col-lg-5 col-5">
                                <div class="active-badge">
                                    <div class="active-dot"></div>
                                    <div class="active-badge-text">Active</div>
                                </div>
                            </div>
                        </div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/28.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">UCFS </div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/27.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Keller Offers</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/25.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                    <div class="marquee-block">
                        <div class="marquee-title">Simple night</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/8.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                    <div class="marquee-block">
                        <div class="marquee-title">EVA</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/2.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                    <div class="marquee-block">
                        <div class="marquee-title">Kopfspringer</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/16.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                    <div class="marquee-block">
                        <div class="row">
                            <div class="col-lg-7 col-7">
                                <div class="marquee-title">Kiwiwrite</div>
                            </div>
                            <div class="col-lg-5 col-5">
                                <div class="active-badge">
                                    <div class="active-dot"></div>
                                    <div class="active-badge-text">Active</div>
                                </div>
                            </div>
                        </div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/14.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                    <div class="marquee-block">
                        <div class="marquee-title">Maro</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/7.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                </ul>

                <ul class="marquee__content">
                    <div class="marquee-block">
                        <div class="marquee-title">Buyhive</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/15.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="row">
                            <div class="col-lg-7 col-7">
                                <div class="marquee-title">Mogul</div>
                            </div>
                            <div class="col-lg-5 col-5">
                                <div class="active-badge">
                                    <div class="active-dot"></div>
                                    <div class="active-badge-text">Active</div>
                                </div>
                            </div>
                        </div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/6.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Bracketology</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/1.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">RXR</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/22.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Remoteshare</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/18.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="row">
                            <div class="col-lg-7 col-7">
                                <div class="marquee-title">1871</div>
                            </div>
                            <div class="col-lg-5 col-5">
                                <div class="active-badge">
                                    <div class="active-dot"></div>
                                    <div class="active-badge-text">Active</div>
                                </div>
                            </div>
                        </div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/28.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">UCFS </div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/27.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Keller Offers</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/25.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                    <div class="marquee-block">
                        <div class="marquee-title">Simple night</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/8.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                    <div class="marquee-block">
                        <div class="marquee-title">EVA</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/2.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                    <div class="marquee-block">
                        <div class="marquee-title">Kopfspringer</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/16.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                    <div class="marquee-block">
                        <div class="row">
                            <div class="col-lg-7 col-7">
                                <div class="marquee-title">Kiwiwrite</div>
                            </div>
                            <div class="col-lg-5 col-5">
                                <div class="active-badge">
                                    <div class="active-dot"></div>
                                    <div class="active-badge-text">Active</div>
                                </div>
                            </div>
                        </div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/14.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                    <div class="marquee-block">
                        <div class="marquee-title">Maro</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/7.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                </ul>
            </div>

            <div class="marquee mt-4">
                <ul class="marquee__content__rev">
                    <div class="marquee-block">
                        <div class="marquee-title">Farechild</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/13.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Aurum</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/21.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Big Shoulders Fund</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/12.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Biograph</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/23.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">YOVI</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/26.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Skoller</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/11.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Shiny Registry</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/10.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">SOCPOC</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/4.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Hedge</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/3.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Loan Shout</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/17.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                    <div class="marquee-block">
                        <div class="marquee-title">Assuricare</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/20.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                    <div class="marquee-block">
                        <div class="marquee-title">Arkstone</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/9.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                    <div class="marquee-block">
                        <div class="marquee-title">Videobomb</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/5.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                </ul>

                <ul class="marquee__content__rev">
                    <div class="marquee-block">
                        <div class="marquee-title">Farechild</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/13.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Aurum</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/21.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Big Shoulders Fund</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/12.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Biograph</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/23.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">YOVI</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/26.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Skoller</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/11.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Shiny Registry</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/10.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">SOCPOC</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/4.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Hedge</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/3.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>
                    <div class="marquee-block">
                        <div class="marquee-title">Loan Shout</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/17.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                    <div class="marquee-block">
                        <div class="marquee-title">Assuricare</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/20.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                    <div class="marquee-block">
                        <div class="marquee-title">Arkstone</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/9.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                    <div class="marquee-block">
                        <div class="marquee-title">Videobomb</div>
                        <div class="marquee-content">
                            <span>12 month <br> engagement</span>
                            <span><img src="<?=base_url('assets/img/logos/5.png')?>" class="logo-img" alt=""></span>
                        </div>
                    </div>

                </ul>

            </div>
        </div>

    </div>
    </div>
</section>

<section>
    <div class="container" style="margin-top:40px;">
        <div id="large-section-2">
            <div class="large-section-header text-light smaller">Experience Talrn's managed <br> services.</div>
            <div class="large-section-content col-lg-10">Full-scale resource augmentation with a dedicated
                success manager to manage your team's performance.
                Book a free call with our team.</div>
            <div class="row">
                <div class="col-lg-4 large-section-blocks">
                    <div class="bg-primary rounded px-3 py-3 text-light">
                        <div class="poppins fw-bold">Premium Plan</div>
                        <div>
                            <span style="font-size:20px">$160</span> /mo
                        </div>
                        <div class="section-block-content">
                            <a href="<?=base_url('hire')?>">
                                <div class="plan-button">
                                    Know More
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 large-section-blocks">
                    <div class="section-2-card rounded px-3 py-3">
                        <div class="poppins fw-bold">Standard Plan</div>
                        <div>
                            <span style="font-size:20px">$0</span> /mo
                        </div>
                        <div class="section-block-content">
                            <a href="<?=base_url('hire')?>">
                                <div class="plan-button">
                                    Know More
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 large-section-blocks">
                    <div class="bg-primary rounded px-3 py-3 text-light">
                        <div class="poppins fw-bold">Customized Plan</div>
                        <!--<div style="font-size:14px">-->
                        <div style="font-size:20px">
                            Get in touch with our team
                        </div>
                        <div class="section-block-content">
                            <a href="<?=base_url('hire')?>">
                                <div class="plan-button">
                                    Contact Us
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section>
    <div class="container mt-6">
        <div class="text-center fw-bold poppins h2 mt"><span class="text-primary">Talrn</span> in the news</div>
        <center>
            <div class="col-lg-4">We are recognized as one of the leading platforms for on-demand talent.</div>
        </center>
        <div class="row text-center">
            <div class="col-lg-3 col-6">
                <img src="<?=base_url('assets/img/brands/z1.webp')?>" alt="" class="img-fluid mt-8" style="width:50%">
            </div>
            <div class="col-lg-3 col-6">
                <img src="<?=base_url('assets/img/brands/z2.webp')?>" alt="" class="img-fluid mt-8" style="width:50%">
            </div>
            <div class="col-lg-3 col-6">
                <img src="<?=base_url('assets/img/brands/z3.webp')?>" alt="" class="img-fluid mt-8" style="width:50%">
            </div>
            <div class="col-lg-3 col-6">
                <img src="<?=base_url('assets/img/brands/z4.webp')?>" alt="" class="img-fluid mt-8" style="width:50%">
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container mb-7 px-6">
        <div class="row bg-primary rounded mt-8 start-journey-wrapper">
            <div class="col-lg-6 px-4">
                <div class="text-light outsourcing-text smaller">Start your outsourcing <br> journey today</div>
                <div class="row py-3">
                    <div class="col-lg-4 text-light py-1"> <i style="position:relative;bottom:2px;"
                            class="bi bi-check-circle"></i> <span>Independent</span></div>
                    <div class="col-lg-3 text-light py-1"> <i style="position:relative;bottom:2px;"
                            class="bi bi-check-circle"></i> <span>Secure</span></div>
                    <div class="col-lg-4 text-light py-1"> <i style="position:relative;bottom:2px;"
                            class="bi bi-check-circle"></i> <span>Transparent</span></div>
                </div>
            </div>
            <div class="col-lg-6">
                <center><a href="<?=base_url('profiles')?>">
                        <button class="col-lg-8 col-12 btn btn-light text-dark" id="last-section-button">View
                         Profiles</button>
                    </a></center>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">

        history.pushState({}, null, '<?= base_url('/') ?>');

    </script>
    
<style>
    .popover-body {
        font-family: var(--bs-body-font-family);
        font-weight: var(--bs-body-font-weight);
        line-height: var(--bs-body-line-height);
        font-size: 12px;
        color:black;
        padding: 1rem 1.25rem 1rem;
    }
    .popover{
        max-width: 200px;
        border-radius: 0.8rem;
        margin-top: 5px !important;
        margin-bottom: 5px !important;
        box-shadow: 0rem 0rem 1.25rem rgba(30, 34, 40, 0.3);
    }
    .popover-arrow{
        margin-top: 1px;
        margin-bottom: 1px;
    }

</style>
