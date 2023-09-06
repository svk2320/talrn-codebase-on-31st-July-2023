<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css" />

<link media="all" rel="stylesheet" href="<?php echo base_url() . $this->config->item('css') . 'client-requirements.css' ?>">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit requirement</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('client') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('client/requirements') ?>">Requirements</a>
                        </li>
                        <li class="breadcrumb-item active">Edit requirements</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-body">
                    <form method="post" action="<?php echo base_url('client/requirements/update/').$requirements[0]['id']; ?>" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                  <label class='fw-bold'>Company Logo*</label>
                                    <div>Please upload a high quality Company Logo image</div>
                                    <div style="color: lightslategray;" class="mt-1">JPG/PNG files</div>
                                    <div style="color: lightslategray;">Minimum resolution: 500 x 500 pixels</div>
                                    <div style="color: lightslategray;">Maximum file size: 10MB</div>
                                    
                                    <!-- Warning message for image is not in square shape -->
                                  <div id="warning" style="color: red"></div>
                        
                                  <input type="file" class="mt-2" id="original-image" onchange="validateImage()" accept="image/*" />
                                  <input type="text" name="imageFilePath" class="form-control" id="imageFilePath" value="uploads/company_logo/" style="display: none">
                                  
                                  <div id="popup" class="popup">
                                      <div id="popup-content" class="popup-content">
                                        <!-- Add a close button inside the popup content -->
                            
                                        <h4 class="center-heading bold-heading">Crop your profile photo</h4>
                            
                                        <div class="box-2" style="margin-top: 10px">
                                          <div id="result"></div>
                                        </div>
                            
                                        <div class="box">
                                          <div class="options hide">
                                            <label style="display: none">Width</label>
                                            <input
                                              type="number"
                                              class="img-w"
                                              value="300"
                                              min="100"
                                              max="1200"
                                              style="display: none"
                                            />
                                          </div>
                            
                                          <button type="button" class="btn btn-primary save hide">Save</button>
                                        </div>
                                      </div>
                                    </div>
                            
                                    <!--rightbox-->
                                    <div class="box-2 img-result hide">
                                      <!-- result of crop -->
                                      <img class="cropped" src="" alt="" style="display: none;" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="job-title">Job Title * :</label>
                                    <input type="text" class="form-control" id="job-title" name="job-title" value="<?= $requirements[0]['job_title']?>">
                                    <span id="job-title-error" style="color: red;"></span>
                                </div>
                                <div class="form-group">
                                    <label for="technical-skills">Mandatory Technical Skills * :</label>
                                    <div id="skill_multiselect"></div>
                                    <span id="technical-skills-error" style="color: red;"></span>
                                </div>
                                <div class="form-group">
                                    <label for="experience">Years of Experience * :</label>
                                    <input type="number" class="form-control" id="experience" name="experience" value="<?= $requirements[0]['experience']?>">
                                    <span id="experience-error" style="color: red;"></span>
                                </div>

                                <div class="form-group">
                                    <label for="job-description">Job Description * :</label>
                                    <div id="job-description-editor"></div>
                                    <textarea class="form-control d-none" id="job-description" name="job-description" value="<?= $requirements[0]['job_description']?>"></textarea>
                                    <!--<textarea class="form-control d-none" id="job-description" name="job-description"><?php echo $requirements[0]['job_description']?></textarea>-->
                                    <span id="job-description-error" style="color: red;"></span>
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="employment-type">Employment Type:</label>
                                    <select class="form-control" id="employment-type" name="employment-type">
                                        <option value="FULL_TIME" <?php if ($requirements[0]['employment_type'] === 'FULL_TIME') echo 'selected'; ?>>Full-time</option>
                                        <option value="PART_TIME" <?php if ($requirements[0]['employment_type'] === 'PART_TIME') echo 'selected'; ?>>Part-time</option>
                                        <option value="CONTRACTOR" <?php if ($requirements[0]['employment_type'] === 'CONTRACTOR') echo 'selected'; ?>>Contract</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="job-location-type">Job Location Type:</label>
                                    <select class="form-control" id="job-location-type" name="job-location-type">
                                        <option value="TELECOMMUTE" <?php if ($requirements[0]['job_location_type'] === 'TELECOMMUTE') echo 'selected'; ?>>Remote</option>
                                        <option value="ONSITE" <?php if ($requirements[0]['job_location_type'] === 'ONSITE') echo 'selected'; ?>>Onsite</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="location"> Work Location * :</label>
                                    <input type="text" class="form-control" id="location" name="location" value="<?= $requirements[0]['location']?>">
                                    <span id="location-error" style="color: red;"></span>
                                </div>

                                <div class="form-group">
                                    <label for="interview-rounds">Interview Rounds:</label>
                                    <input type="number" min="0" class="form-control" id="interview-rounds"
                                        value="<?= $requirements[0]['interview_rounds']?>" name="interview-rounds">
                                </div>
                                <label>Monthly Budget:</label>
                                <div class="form-group" style="display: flex;">
                                    <div style="flex: 1;">
                                        <medium for="budget-currency">Currency:</medium>
                                        <select class="form-control" id="budget-currency" name="budget-currency">
                                            <option value="INR" <?php if ($requirements[0]['budget_currency'] === 'INR') echo 'selected'; ?>>INR</option>
                                            <option value="USD" <?php if ($requirements[0]['budget_currency'] === 'USD') echo 'selected'; ?>>USD</option>
                                        </select>
                                    </div>
                                    <div style="flex: 1;">
                                        <medium for="budget-min">Minimum:</medium>
                                        <input type="number" class="form-control" id="budget-min" name="budget-min" value="<?= $requirements[0]['budget_min']?>">
                                    </div>
                                    <div style="flex: 1;">
                                        <medium for="budget-max">Maximum:</medium>
                                        <input type="number" class="form-control" id="budget-max" name="budget-max" value="<?= $requirements[0]['budget_max']?>">
                                    </div>
                                </div>
                                <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="hide-budget" value="1" <?php if ($requirements[0]['hide_budget'] == 1) echo 'checked'; ?>> Hide budget on job page
                                        </label>
                                    </div>
                                <?php
                                $min_date = date('Y-m-d', strtotime('+1 day'));
                                $default_date = date('Y-m-d', strtotime('+30 day'));
                                ?>
                                <div class="form-group">
                                    <label for="valid-through">Valid Through:</label>
                                    <input type="date" class="form-control" id="valid-through" name="valid-through" value="<?= $requirements[0]['valid_through']?>"
                                        min="<?php echo $min_date; ?>" value="<?php echo $default_date; ?>">
                                </div>


                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>


                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
        $("#mainNav").addClass('active');
    });
</script>
<script>
    var skills_tags;
    $(document).ready(function () {
        var technicalSkills = `<?= $requirements[0]['technical_skills']?>`; // Assuming the value is a string of joined tags

        // Split the string into an array of tags
        var tagArray = technicalSkills.split(',');

        skills_tag = $('#skill_multiselect').magicSuggest({
            placeholder: 'Search for skills',
            name: 'skill_list',
            allowFreeEntries: true,
            data: '<?php echo base_url('autocomplete/skill_search_all') ?>',
            selectionStacked: false,
            strictSuggest: true,
            cache: true
        });

        skills_tag.setValue(tagArray);

            $('#job-description-editor').summernote({
                placeholder: 'Enter job description...',
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ],
                callbacks: {
                    onChange: function (contents, $editable) {
                        $('#job-description').val(contents);
                    },
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        setTimeout(function () {
                            document.execCommand('insertText', false, bufferText);
                        }, 10);
                    }
                },
                pastePlain: true
            });

            var jobDescription = `<?php echo $requirements[0]['job_description']?>`; // Assuming the value is a string of joined skills
            $('#job-description-editor').summernote('code', jobDescription);
    });
</script>
<script>
    // Prevent submit on enter key press
    document.addEventListener("keydown", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
        }
    });
</script>
<script>
    $(document).ready(function () {
        $('form').submit(function (event) {
            event.preventDefault();

            // Get form values
            var jobTitle = $('#job-title').val();
            var jobExperience = $('#experience').val();
            var technicalSkills = skills_tag.getValue();
            var jobDescription = $('#job-description').val();
            var jobLocationType = $('#job-location-type').val();
            var jobLocation = $('#location').val();

            // Validate form fields
            var isValid = true;
            if (!jobTitle) {
                $('#job-title').addClass('is-invalid');
                $('#job-title-error').text('Job Title is required.').show();
                isValid = false;
            } else {
                $('#job-title').removeClass('is-invalid');
                $('#job-title-error').hide();
            }
            
            var isValid = true;
            if (!jobExperience) {
                $('#experience').addClass('is-invalid');
                $('#experience-error').text('Year of experience should be more than 0 years and less than 50 years').show();
                isValid = false;
            } else {
                var experienceValue = parseInt(jobExperience, 10); // Convert the input value to an integer
                
                if (experienceValue <= 0) {
                    $('#experience').addClass('is-invalid');
                    $('#experience-error').text('Year of experience should be greater than 0 years').show();
                    isValid = false;
                } else if (experienceValue > 50) {
                    $('#experience').addClass('is-invalid');
                    $('#experience-error').text('Year of experience should be less than 50 years').show();
                    isValid = false;
                } else {
                    $('#experience').removeClass('is-invalid');
                    $('#experience-error').hide();
                }
            }

            if (!technicalSkills || !technicalSkills.length) {
                skills_tag.collapse();
                //skills_tag.expand();
                $('#skill_multiselect').addClass('is-invalid');
                $('#technical-skills-error').text('Technical Skills are required.').show();
                isValid = false;
            } else {
                $('#skill_multiselect').removeClass('is-invalid');
                $('#technical-skills-error').hide();
            }

            // Remove leading/trailing white spaces to ensure accurate word count
            var trimmedDescription = jobDescription.trim();
            
            // Split the trimmed description into words using a regular expression
            var words = trimmedDescription.split(/\s+/);
            
            // Get the word count
            var wordCount = words.length;
            
            // Minimum required word count (e.g., 100)
            var minimumWordCount = 100;
            
            if (wordCount < minimumWordCount) {
                $('#job-description-editor').addClass('is-invalid');
                $('#job-description-error').text('Job Description must have at least 100 words.').show();
                isValid = false;
            } else {
                $('#job-description-editor').removeClass('is-invalid');
                $('#job-description-error').hide();
            }

            if(!jobLocation){
                $('#location').addClass('is-invalid');
                $('#location-error').text('Location is required.').show();
                isValid = false;
            } else {
                $('#job-location').removeClass('is-invalid');
                $('#job-location-error').hide();
            }

            if (isValid) {
                // Submit the form if it's valid
                this.submit();
            }
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js"></script>
<script>
  var imageFileName = document.getElementById("imageFilePath");
  var jobTitle = document.getElementById("job-title");
  var fileInput = document.querySelector("#original-image");
  let resultContainer = document.querySelector("#result"),
    img_result = document.querySelector(".img-result"),
    img_w = document.querySelector(".img-w"),
    img_h = document.querySelector(".img-h"),
    options = document.querySelector(".options"),
    save = document.querySelector(".save"),
    cropped = document.querySelector(".cropped"),
    dwn = document.querySelector(".download"),
    upload = document.querySelector("#original-image"),
    cropper = "",
    popup = document.getElementById("popup");

  function validateImage(callback) {
    var fileInput = document.getElementById("original-image");
    var filePath = fileInput.value;

    // Check file size
    var fileSize = fileInput.files[0].size; // in bytes
    var maxSizeMB = 10; // 10MB
    var maxSizeBytes = maxSizeMB * 1024 * 1024; // Convert to bytes
    
    if (fileSize > maxSizeBytes) {
      document.getElementById("warning").innerHTML =
        "Upload an image with a file size up to 10MB.";
      fileInput.value = "";
      if (typeof callback === "function") {
        callback(false);
      }
      return false;
    }
    
    // Check if a file is selected
    if (filePath.trim() === "") {
      document.getElementById("warning").innerHTML =
        "Choose an image file.";
      fileInput.value = "";
      if (typeof callback === "function") {
        callback(false);
      }
      return false;
    }

    // Check if the image dimensions are square and size is within limits
    var img = new Image();
    img.src = window.URL.createObjectURL(fileInput.files[0]);
    img.onload = function () {

     // Check if the image dimensions are within the specified limits
      if (this.width < 499 || this.height < 499) {
        document.getElementById("warning").innerHTML =
          "Provide an image that has dimensions greater than 500x500 pixels.";
        fileInput.value = "";
        if (typeof callback === "function") {
          callback(false);
        }
        return false;
      }

      document.getElementById("warning").innerHTML = "";
      if (typeof callback === "function") {
        callback(true);
      }
    };
  }

  function dataURLtoFile(dataURL, fileName) {
    var arr = dataURL.split(",");
    var mime = "image/webp"; // Set the mime type to WebP
    var bstr = atob(arr[1]);
    var n = bstr.length;
    var u8arr = new Uint8Array(n);

    while (n--) {
      u8arr[n] = bstr.charCodeAt(n);
    }

    return new File([u8arr], fileName, { type: mime });
  }

      // on change show image with crop options
      upload.addEventListener("change", (e) => {
        if (e.target.files.length) {
          validateImage((isValid) => {
            if (isValid) {
              // start file reader
              const reader = new FileReader();
              reader.onload = (e) => {
                if (e.target.result) {
                  // create new image
                  let img = document.createElement("img");
                  img.id = "image";
                  img.src = e.target.result;
    
                  // clean result before
                  resultContainer.innerHTML = "";
                  
                  // append new image
                  resultContainer.appendChild(img);
    
                  // show save btn and options
                  save.classList.remove("hide");
                  options.classList.remove("hide");
    
                  // init cropper
                  cropper = new Cropper(img, {
                    aspectRatio: 1,
                    minContainerHeight: 316,
                    minContainerWidth: 316,
                    minCanvasHeight: 316,
                    minCanvasWidth: 316,
                    minCropBoxWidth: 175,
                    minCropBoxHeight: 175
                  });
    
                  // Display the popup
                  popup.style.display = "block";
                }
              };
              reader.readAsDataURL(e.target.files[0]);
            }
          });
        }
      });
  
    save.addEventListener("click", function (e) {
        e.preventDefault();
    
        // Get the unique ID from the profile URL
        let url = window.location.href;
        let uniqueId = url.substring(url.lastIndexOf('/') + 1);
    
        // Get the cropped image data
        let croppedCanvas = cropper.getCroppedCanvas({ width: 500, height: 500 });
        let imgData = croppedCanvas.toDataURL("image/webp");
    
        // Extract the original file name from the file input field
        let originalFileName = fileInput.files[0].name;
    
        // Prepare the data to be sent via AJAX
        let formData = new FormData();
        formData.append("croppedImage", dataURLtoFile(imgData, originalFileName));
        
        let newFileName = originalFileName.replace(/\.[^.]+$/, '.webp');
        formData.append("fileTitle", newFileName);
    
        var base_url = "<?php echo base_url(''); ?>";
    
        // Send the data via AJAX to the server
        $.ajax({
            url: base_url + 'client/requirements/uploadProfileImg', 
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                
                // Parse the JSON string into a JavaScript object
                var responseObject = JSON.parse(response);
                
                // Access the fileName property
                var fileName = responseObject.fileName;
                
                imageFileName.value = "uploads/company_logo/" + fileName;
                
            },
            error: function (xhr, status, error) {
                // Handle the error case
                console.error(error);
            },
        });
    
        // Close the popup
        popup.style.display = "none";
    });
    

  document.addEventListener("DOMContentLoaded", function () {
    var fileInput = document.querySelector("#original-image");

    fileInput.addEventListener("change", function (event) {
      validateImage((isValid) => {
        if (isValid) {
          popup.style.display = "block";
        }
      });
    });

  });
</script>
