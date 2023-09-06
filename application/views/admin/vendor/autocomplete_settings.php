<div class="content-wrapper">
    <div class="container-fluid py-3">
        <div class="h2">Edit Custom Fields</div>
    </div>
    <?php if ($status == 'success') { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $message ?>
            </div>
            <?php } if ($status == 'failure') { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $message ?>
            </div>
            <?php } ?>
    <section class="container-fluid"  style="background-color:white">
        <div class="px-3 py-3 border rounded">
            <div style="font-size: 20px;" class="mb-3">Choose the List type </div>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-bar-chart-line-fill"></i></span>
                <select name="" id="select-box" class="form-control" onchange="toggle()">
                    <option value="Industry List">Industries Name List</option>
                    <option value="Skill List">Skills Name List</option>
                    <option value="Job Title List">Job Title Name List</option>    
                </select>
            </div>
        </div>
    </section>

    <section class="container-fluid tables" id="Industry List"  style="background-color:white">
        <div class="px-3 py-3 border rounded mt-2">
            <div class="border-bottom h5 pb-3">
                Industries Report
            </div>
            <div>
            <?php
                $attributes = array('name' => 'frmRegistration', 'id' => 'regForm', 'enctype' => "multipart/form-data");
                echo form_open('admin/vendor/industry_replace', $attributes);
            ?>
            <fieldset>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-4 control-label" for="merge">Choose the industry names you want to merge:</label>  
            <div class="col-md-4">
            <div id="industry_merge_multiselect" class="form-control">
            
            </div> 
            </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-4 control-label" for="industry_replace">Replace With:</label>  
            <div class="col-md-4">
            <input id="replace" name="industry_replace" type="text" placeholder="" class="form-control input-md" required> 
            </div>
            </div>

            <!-- Button -->
            <div class="form-group">
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-primary">Submit</button>
            </div>
            </div>
            </fieldset>
            <?php echo form_close(); ?>
            </div>
        </div>
    </section>

    <section class="container-fluid tables" id="Skill List"  style="background-color:white">
        <div class="px-3 py-3 border rounded mt-2">
            <div class="border-bottom h5 pb-3">
                Skill List  
            </div>
            <div>
            <?php
                $attributes = array('name' => 'frmRegistration', 'id' => 'regForm', 'enctype' => "multipart/form-data");
                echo form_open('admin/vendor/skill_replace', $attributes);
            ?>
            <fieldset>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-4 control-label" for="merge">Choose the skill names you want to merge:</label>  
            <div class="col-md-4">
            <div id="skill_merge_multiselect" class="form-control">
            
            </div> 
            </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-4 control-label" for="skill_replace">Replace With:</label>  
            <div class="col-md-4">
            <input id="replace" name="skill_replace" type="text" placeholder="" class="form-control input-md" required> 
            </div>
            </div>

            <!-- Button -->
            <div class="form-group">
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-primary">Submit</button>
            </div>
            </div>
            </fieldset>
            <?php echo form_close(); ?>
            </div>
        </div>
    </section>

    <section class="container-fluid tables" id="Job Title List"  style="background-color:white">
        <div class="px-3 py-3 border rounded mt-2">
            <div class="border-bottom h5 pb-3">
                Job Title List
            </div>
            <div>
            <?php
                $attributes = array('name' => 'frmRegistration', 'id' => 'regForm', 'enctype' => "multipart/form-data");
                echo form_open('admin/vendor/job_title_replace', $attributes);
            ?>
            <fieldset>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-4 control-label" for="merge">Choose the Job Titles you want to merge:</label>  
            <div class="col-md-4">
            <div id="job_title_merge_multiselect" class="form-control">
            
            </div> 
            </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-4 control-label" for="job_title_replace">Replace With:</label>  
            <div class="col-md-4">
            <input id="replace" name="job_title_replace" type="text" placeholder="" class="form-control input-md" required> 
            </div>
            </div>

            <!-- Button -->
            <div class="form-group">
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-primary">Submit</button>
            </div>
            </div>
            </fieldset>
            <?php echo form_close(); ?>
            </div>
        </div>
    </section>

    <section class="container-fluid tables" id="Soft Skill List"  style="background-color:white">
        <div class="px-3 py-3 border rounded mt-2">
            <div class="border-bottom h5 pb-3">
                Soft Skills List
            </div>
           
        </div>
    </section>

    <script>
        let tables = document.getElementsByClassName('tables');
        for (var i = 0; i < tables.length; i++) {
            tables[i].style.display = "none";
        }
        tables[0].style.display = "block";

        function toggle() {
            let current = document.getElementById('select-box').value;
            for (var i = 0; i < tables.length; i++) {
                tables[i].style.display = "none";
            }
            document.getElementById(current).style.display = "block";
        }
    </script>
    <script>
    var skills_tags;
    var Industries_tags;
    var job_title_tags;
    $(document).ready(function () {
      skills_tag = $('#skill_merge_multiselect').magicSuggest({
        placeholder: 'Search for skills',
        name: 'skill_merge_list',
        allowFreeEntries: false,
        data: '<?php echo base_url('autocomplete/skill_search_all')?>',
        selectionStacked: false
      });

      Industries_tags = $('#industry_merge_multiselect').magicSuggest({
        placeholder: 'Search for industries',
        name: 'industry_merge_list',
        allowFreeEntries: false,
        data: '<?php echo base_url('autocomplete/industry_distinct_search')?>',
        selectionStacked: false
      });

      job_title_tags = $('#job_title_merge_multiselect').magicSuggest({
        placeholder: 'Search for Job titles',
        name: 'job_title_merge_list',
        allowFreeEntries: false,
        data: '<?php echo base_url('autocomplete/job_title_search_all')?>',
        selectionStacked: false
      });
    });
  </script>
</div>