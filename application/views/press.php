<link media="all" rel="stylesheet" href="<?php echo base_url() . $this->config->item('css') . 'press.css' ?>">

<section class="bg-light">
  <div class="container pt-md-6 pb-12 py-md-15">
    <!-- <h2 class="fs-15 text-uppercase text-muted mb-3">Our Clients</h2> -->
    <div class="row gx-lg-8 mb-md-10 gy-5">
      <div class="col-lg-7 pt-3" >
        <h1 class="display-2 mb-0 py-2 text-left ">Press Corner</h1>
      </div>
      <!-- /column -->
      <div class="col-lg-4">
        <h3 class="display-7 mb-0 py-2">CONTACT OUR PRESS TEAM</h3>
        <a href="">press@talrn.com</a>
        <p class="lead fs-15 mb-0">Only members of the press will receive a response. For all other inquiries please visit Talrn's 
        <a href="<?= base_url('contact-us') ?>">Contact Us</a> page. Images on this page may be used for publication with credit: "Source: Talrn."</p>
      </div>
      <div class="col-lg-1">
        
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
    <div class="img-con">
      <ul class="image-gallery">
        <!-- html tags are inseted through js -->
        <li><img src="<?= base_url('assets/img/press/Talrn-logo.png') ?>">
          <div class="img-dta">
            <div class="img-nme">Talrn Logo</div>
            <div class="img-dwn"><span class="material-symbols-outlined" style="font-size: 24px;"
                onclick="download(&quot;<?= base_url('assets/img/press/Talrn-logo.png') ?>&quot;,&quot;Talrn-logo&quot;)"><i
                  class="uil uil-download-alt"></i></span></div>
          </div>
        </li>
      </ul>
    </div>
</section>
<script>
  dta = [
    { src: "<?= base_url('assets/img/press/talrn-logo.png') ?>", name: "Talrn logo" },
  ]
  window.onload = function () {
    //load_imgs(dta)
  }

  function load_imgs(imgarr) {
    for (var i = 0; i < imgarr.length; i++) {
      dta = imgarr[i]
      li = document.createElement('li')
      img = document.createElement('img')
      img.src = dta.src
      div_img_data = document.createElement('div')
      div_img_data.className = 'img-dta'
      div_img_nme = document.createElement('div')
      div_img_nme.className = 'img-nme'
      div_img_nme.innerHTML = dta.name
      div_img_dwn = document.createElement('div')
      div_img_dwn.className = 'img-dwn'
      seourlname = dta.name.split(' ').join('-')
      div_img_dwn.innerHTML = '<span class="material-symbols-outlined" onclick=download("' + dta.src + '","' + seourlname + '")><i class="uil uil-download-alt"></i></span>'

      li.appendChild(img)
      li.appendChild(div_img_data)
      div_img_data.appendChild(div_img_nme)
      div_img_data.appendChild(div_img_dwn)

      document.getElementsByClassName('image-gallery')[0].appendChild(li)
    }
  }

  function download(source) {
    const fileName = source.split('/').pop();
    var el = document.createElement("a");
    el.setAttribute("href", source);
    el.setAttribute("download", fileName);
    document.body.appendChild(el);
    el.click();
    el.remove();
  }


  function download(url, name) {
    fetch(url)
      .then(resp => resp.blob())
      .then(blobobject => {
        const blob = window.URL.createObjectURL(blobobject);
        const anchor = document.createElement('a');
        anchor.style.display = 'none';
        anchor.href = blob;
        fileformat = url.split('.')
        fileformat = fileformat[fileformat.length - 1]
        anchor.download = name + ".png";
        document.body.appendChild(anchor);
        anchor.click();
        window.URL.revokeObjectURL(blob);
      })
      .catch(() => console.log('An error in downloading the file'));
  }

</script>
