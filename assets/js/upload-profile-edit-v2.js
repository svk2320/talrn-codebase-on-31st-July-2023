var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab);

for (i = 1; i < document.getElementsByClassName("stepper-number").length; i++) {
    document.getElementsByClassName("stepper-number")[i].className += " finish";
}
    
    



function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("previous").style.display = "none";
    } else {
        document.getElementById("previous").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("next").innerHTML = "Submit";
    } else {
        document.getElementById("next").innerHTML = "Next";
    }
    fixStepIndicator(n);
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("stepper-number");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" stepper-active", " ");
    }
    for (i = n+1; i < x.length; i++) {
        x[i].className = x[i].className.replace(/finish/g, " ");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " stepper-active";

}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
        //...the form gets submitted:
        console.log('form submit');
        document.getElementById("regForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
    // let labels = document.getElementsByClassName("req");
    // let feilds = document.getElementsByTagName("input");
    // for (i = 0; i < labels.length; i++) {
    //     labels[i].style.display = "none";
    // }
    // for (i = 0; i < feilds.length; i++) {
    //     feilds[i].style.backgroundColor = "white";
    // }

}

function changeTab(nextTab){
        // console.log("NextTab " + nextTab);
        
        document.getElementsByClassName("tab")[currentTab].style.display = "none";
        currentTab = 0;
        
        //checking if all the previous tabs to nextTab follows proper validation rules
        while(currentTab<nextTab){
            
            //showing the first previous tab to nextTab which is failing validation
            if(!validateForm()){
                validationFailModal(currentTab);
                showTab(currentTab);
                return false;
            }
            currentTab++;
        }
        
        //If no validation violating tabs are found, showing the requested nextTab
        currentTab = nextTab;
        showTab(currentTab);
}


function validateForm() {
    var tab_array, current_tab, valid = true;
    tab_array = document.getElementsByClassName("tab");
    current_tab = tab_array[currentTab];
    switch (currentTab) {
        case 0:
            console.log('in case 0');
            valid = validatePersonalDetails();
            break;
        case 1:
            console.log('in case 1');
            valid = validateProfessionalExperience();
            break;
        case 2:
            console.log('in case 2');
            valid = validateSkills(current_tab);
            break;
        case 3:
            console.log('in case 3');
            valid = validateProjectDetails(current_tab);
            break;
        case 4:
            console.log('in case 4');
            valid = true;
            break;
        case 5:
            console.log('in case 5');
            valid = validateEducation(current_tab);
            break;
        case 6:
            console.log('in case 6');
            valid = validateFinish(current_tab);
            break;
    }
    if (valid) {
        document.getElementsByClassName("stepper-number")[currentTab].className += " finish";
    }
    return valid;
}


function onlyAlphabets(str) {
    var hasNumber = /\d/;
    if (hasNumber.test(str)) {
        return false;
    }
    else {
        return true;
    }
}

function onlyNumbers(str) {
    return /^[0-9]+$/.test(str);
}

function validateDot(id) {
    inputValue = document.getElementById(id).value;
    outputTextId = id + '_error';
    if (inputValue.includes('.')) {
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'Do not enter a \'.\' !';
    }
    else {//
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-success';
        document.getElementById(outputTextId).innerHTML = 'Looks good!';
        return true
    }
}

function validateComma(id) {
    inputValue = document.getElementById(id).value;
    outputTextId = id + '_error';
    if (inputValue.includes(',')) {
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'Do not enter a \',\' !';
    }
    else {//
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-success';
        document.getElementById(outputTextId).innerHTML = 'Looks good!';
        return true
    }
}

function validateSpecialChar(id) {
    inputValue = document.getElementById(id).value;
    outputTextId = id + '_error';

    // Space is excluded as special characters
    const specialCharRegex = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;

    if (specialCharRegex.test(inputValue)) {
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'Do not enter special characters!';
        return false;

    }
    else {//
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-success';
        document.getElementById(outputTextId).innerHTML = 'Looks good!';
        return true
    }
}

function validateInput(id, minLength, alphabets_only_flag) {
    //console.log('in validation input: '+ id);
    inputValue = document.getElementById(id).value;
    outputTextId = id + '_error';
    if (inputValue.length == 0) {// checking if empty
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'This field is required!';
        return false;
    }
    else if (inputValue.length < minLength) { //checking for minLength
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'Please enter atleast ' + minLength + ' characters';
        return false;
    } else if (!onlyAlphabets(inputValue) && alphabets_only_flag) { //checking for only alphabetics
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'Please enter only alphabets!';
        return false;
    }
    else {//
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-success';
        document.getElementById(outputTextId).innerHTML = 'Looks good!';
        return true
    }
}

function validateSkillName(id, minLength, alphabets_only_flag) {
    //console.log('in validation input: '+ id);
    inputValue = document.getElementById(id).value;
    outputTextId = id + '_error';
    if (inputValue.length == 0) {// checking if empty
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'This field is required!';
        return false;
    }
    else if (inputValue.length < minLength) { //checking for minLength
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'Please enter atleast ' + minLength + ' characters';
        return false;
    } else if (!onlyAlphabets(inputValue) && alphabets_only_flag) { //checking for only alphabetics
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'Please enter only alphabets!';
        return false;
    } else if (onlyNumbers(inputValue)) { //checking for only numbers
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'Please do not enter only numbers!';
        return false;
    }
    else if (inputValue.includes('-') || inputValue.includes('(') || inputValue.includes('/') || inputValue.includes(')')) { //checking for '-()/'
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'Please do not enter symbols!';
        return false;
    }
    else {//
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-success';
        document.getElementById(outputTextId).innerHTML = 'Looks good!';
        return true
    }
}

function validateNumberInput(id, min, max) {
    inputValue = document.getElementById(id).value;
    value = Number(inputValue);
    outputTextId = id + '_error';
    if (inputValue.length == 0) {// checking if empty
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'This field is required!';
        return false;
    }
    else if (max == 0) { //checking for Min and max = 0
        if (value <= min) {
            document.getElementById(outputTextId).style.display = 'block';
            document.getElementById(outputTextId).className = 'req text-danger';
            document.getElementById(outputTextId).innerHTML = 'The number should be more than or equal to ' + min;
            return false;
        }
        else { // all good
            document.getElementById(outputTextId).style.display = 'block';
            document.getElementById(outputTextId).className = 'req text-success';
            document.getElementById(outputTextId).innerHTML = 'Looks good!';
            return true;
        }
    }
    else if (value < min || value > max) { //checking for Min and max value
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'The number should be between ' + min + ' and ' + max;
        return false;
    }
    else { // all good
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-success';
        document.getElementById(outputTextId).innerHTML = 'Looks good!';
        return true;
    }
}

function validateSelect(id, default_selector) {
    inputValue = document.getElementById(id).value;
    outputTextId = id + '_error';
    if (inputValue == default_selector) {
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'This field is required!';
        return false;
    }
    else {
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-success';
        document.getElementById(outputTextId).innerHTML = 'Looks good!';
        return true
    }
}

function validateStartAndEndDate(start_id, end_id) {
    start_value = document.getElementById(start_id).value;
    start_text_id = start_id + '_error';
    end_value = document.getElementById(end_id).value;
    end_text_id = end_id + '_error';
    if ((start_value == '') || (end_value == '')) {//if either dates are empty
        if (start_value == '') {
            document.getElementById(start_text_id).style.display = 'block';
            document.getElementById(start_text_id).className = 'req text-danger';
            document.getElementById(start_text_id).innerHTML = 'This field is required!';
        }
        else {
            document.getElementById(start_text_id).style.display = 'block';
            document.getElementById(start_text_id).className = 'req text-success';
            document.getElementById(start_text_id).innerHTML = 'Looks good!';
        }
        if (end_value == '') {
            document.getElementById(end_text_id).style.display = 'block';
            document.getElementById(end_text_id).className = 'req text-danger';
            document.getElementById(end_text_id).innerHTML = 'This field is required!';
        }
        else {
            document.getElementById(end_text_id).style.display = 'block';
            document.getElementById(end_text_id).className = 'req text-success';
            document.getElementById(end_text_id).innerHTML = 'Looks good!';
        }
        return false;
    }
    else {
        const start_date = new Date(start_value);
        const end_date = new Date(end_value);
        if (start_date < end_date) {
            document.getElementById(start_text_id).style.display = 'block';
            document.getElementById(start_text_id).className = 'req text-success';
            document.getElementById(start_text_id).innerHTML = 'Looks good!';
            document.getElementById(end_text_id).style.display = 'block';
            document.getElementById(end_text_id).className = 'req text-success';
            document.getElementById(end_text_id).innerHTML = 'Looks good!';
            return true;
        }
        else {
            document.getElementById(start_text_id).style.display = 'block';
            document.getElementById(start_text_id).className = 'req text-danger';
            document.getElementById(start_text_id).innerHTML = 'Start date should be smaller!';
            document.getElementById(end_text_id).style.display = 'block';
            document.getElementById(end_text_id).className = 'req text-danger';
            document.getElementById(end_text_id).innerHTML = 'End date  should be largers!';
            return false;
        }
    }


}

// Function to validate the project URL field
function validateProjectURL(link_id) {
    link_value = document.getElementById(link_id).value;
    link_text_id = link_id +'_error';
    const projectURLRegex = /^(ftp|http|https|www):\/\/[^ "]+$/;
    
    if (projectURLRegex.test(link_value) || link_value.trim() === '') {
        
        document.getElementById(link_text_id).style.display = 'block';
        document.getElementById(link_text_id).className = 'req text-success';
        document.getElementById(link_text_id).innerHTML = 'Looks good!';
        return true;
        
      } else if(link_value = ''){
          
        return true;
          
      }else {
        document.getElementById(link_text_id).style.display = 'block';
        document.getElementById(link_text_id).className = 'req text-danger';
        document.getElementById(link_text_id).innerHTML = 'Enter a valid URL';
        return false;
      }
}





function validatePersonalDetails() {
    var valid = true;
    // validation for first name
    result = validateInput('first_name', 2, true);
    valid = valid && result;

    // validation for Dot in first name
    if (validateInput('first_name', 2, true)) {
        result = validateDot('first_name');
        valid = valid && result;
    }

    //validation for last name
    result = validateInput('last_name', 2, true);
    valid = valid && result;

    // validation for Dot in last name
    if (validateInput('last_name', 2, true)) {
        result = validateDot('last_name');
        valid = valid && result;
    }

    //validation for city
    result = validateInput('city', 2, true);
    valid = valid && result;

    //validation for country
    result = validateInput('country', 2, true);
    valid = valid && result;

    //validation for citizenship
    result = validateInput('citizenship', 2, true);
    valid = valid && result;

    //validation for English proficiency
    proficiency_list = document.getElementsByName('english');
    proficiency_checked = false;
    for (i = 0; i < proficiency_list.length; i++) {
        if (proficiency_list[i].checked) {
            proficiency_checked = true;
        }
    }
    if (proficiency_checked) {
        document.getElementById('proficiency_error').style.display = 'block';
        document.getElementById('proficiency_error').className = 'req text-success';
        document.getElementById('proficiency_error').innerHTML = 'Looks good!';
        valid = valid && true;
    }
    else {
        document.getElementById('proficiency_error').style.display = 'block';
        document.getElementById('proficiency_error').className = 'req text-danger';
        document.getElementById('proficiency_error').innerHTML = 'This Field is required!';
        valid = valid && false;
    }

    return valid;

}

function validateSkills(current_tab) {
    var valid = true;

    // validation for skills 
    var skill_list = current_tab.getElementsByClassName('skill_list');
    var skill_value_list = [];
    for (i = 0; i < skill_list.length; i++) {

        skill_value_list.push(document.getElementById('skill_name' + i).value);
        //validation for skill name
        result = validateSkillName('skill_name' + i, 1, false);
        valid = valid && result;

        // validation for commas
        if (validateSkillName('skill_name' + i, 1, false)) {
            result = validateComma('skill_name' + i);
            valid = valid && result;
        }


        //validation for skill year
        result = validateNumberInput('skill_year' + i, 0, 45);
        valid = valid && result;

        //validation for skill month
        result = validateNumberInput('skill_month' + i, 0, 11);
        valid = valid && result;
    }



    var duplicates = skill_value_list.filter((e, i, a) => a.indexOf(e) !== i);
    if (skill_list.length < 5) {
        document.getElementById('skills_error').style.display = 'block';
        document.getElementById('skills_error').className = 'req text-danger';
        document.getElementById('skills_error').innerHTML = 'Atleast 5 skills are required!';
        valid = valid && false;
    }
    else if (duplicates.length != 0 && valid == true) {
        document.getElementById('skills_error').style.display = 'block';
        document.getElementById('skills_error').className = 'req text-danger';
        document.getElementById('skills_error').innerHTML = 'Duplicate skills not allowed!';

        for (i = 0; i < skill_list.length; i++) {

            id = 'skill_name' + i;
            skill = document.getElementById(id).value;
            outputTextId = id + '_error';

            if (duplicates.includes(skill)) {// checking if current skill is in duplicate skills or not
                document.getElementById(outputTextId).style.display = 'block';
                document.getElementById(outputTextId).className = 'req text-danger';
                document.getElementById(outputTextId).innerHTML = 'Duplicate Skill!';
            }

        }

        valid = valid && false;
    }
    else {
        document.getElementById('skills_error').style.display = 'none';
        valid = valid && true;
    }




    return valid;

}



function validateEducation(current_tab) {
    var valid = true;
    edu_list = current_tab.getElementsByClassName('education');
    for (i = 0; i < edu_list.length; i++) {
        //validation for degree
        result = validateSelect('degree' + i, 'None');
        valid = valid && result;

        //validation for major
        result = validateInput('major' + i, 2, true);
        valid = valid && result;

        //validation for university
        result = validateInput('university' + i, 2, true);
        valid = valid && result;

        //validation for start and end date
        result = validateStartAndEndDate('edu_start' + i, 'edu_end' + i);
        valid = valid && result;
    }

    return valid;

}



function validateProfessionalExperience() {
    var valid = true;

    // validation for experience years
    result = validateNumberInput('years_of_experience', 0, 45);
    valid = valid && result;

    // validation for primary job title
    result = validateInput('primary_job_title', 2, false);
    valid = valid && result;


    //validation for job status
    job_status_list = document.getElementsByName('job_status');
    job_status_checked = false
    for (i = 0; i < job_status_list.length; i++) {
        if (job_status_list[i].checked) {
            job_status_checked = true;
        }
    }
    if(job_status_list.length == 1){
        job_status_checked = true;
    }
    if (job_status_checked) {
        document.getElementById('job_status_error').style.display = 'block';
        document.getElementById('job_status_error').className = 'req text-success';
        document.getElementById('job_status_error').innerHTML = 'Looks good!';
        valid = valid && true;
    }
    else {
        document.getElementById('job_status_error').style.display = 'block';
        document.getElementById('job_status_error').className = 'req text-danger';
        document.getElementById('job_status_error').innerHTML = 'This Field is required!';
        valid = valid && false;
    }

    //validation for comittment
    comittment_list = document.getElementsByName('comittment');
    comittment_checked = false
    for (i = 0; i < comittment_list.length; i++) {
        if (comittment_list[i].checked) {
            comittment_checked = true;
        }
    }
    if (comittment_checked) {
        document.getElementById('comittment_error').style.display = 'block';
        document.getElementById('comittment_error').className = 'req text-success';
        document.getElementById('comittment_error').innerHTML = 'Looks good!';
        valid = valid && true;
    }
    else {
        document.getElementById('comittment_error').style.display = 'block';
        document.getElementById('comittment_error').className = 'req text-danger';
        document.getElementById('comittment_error').innerHTML = 'This Field is required!';
        valid = valid && false;
    }




    return valid;

}

function validateProjectDetails(current_tab) {
    var valid = true;
    project_list = current_tab.getElementsByClassName('project');
    for (i = 0; i < project_list.length; i++) {
        //validation for project title
        result = validateInput('project_title' + i, 2, false);
        valid = valid && result;

        //validation for project technologies
        result = validateInput('project_tech' + i, 2, false);
        valid = valid && result;

        //validation for project description
        result = validateInput('project_description' + i, 50, false);
        valid = valid && result;

        //validation for project responsibilities
        result = validateInput('project_resp' + i, 50, false);
        valid = valid && result;

          //validation for project link
        result = validateProjectURL('project_url' + i);
        valid = valid && result;
        

        //validation for  project industry
        result = validateInput('project_industry' + i, 2, false);
        valid = valid && result;

        //validation for special characters in project industry
        if (validateInput('project_industry' + i, 2, false)) {
            result = validateSpecialChar('project_industry' + i);
            valid = valid && result;
        }
    }
    if (project_list.length < 2) {
        document.getElementById('projects_error').style.display = 'block';
        document.getElementById('projects_error').className = 'req text-danger';
        document.getElementById('projects_error').innerHTML = 'Atleast 2 projects are required!';
        valid = valid && false;
    }
    else {
        document.getElementById('projects_error').style.display = 'none';
        valid = valid && true;
    }



    return valid;
}

function validateFinish(current_tab) {
    var valid = true, pph_max, pph_min;
    //validation for pph max
    result = validateNumberInput('pph_min', 100, 9999999);
    valid = valid && result;

    //validation for ppm
    result = validateNumberInput('pph_max', 100, 9999999);
    valid = valid && result;

    if (valid == true) {
        pph_max = Number(document.getElementById('pph_max').value);
        pph_min = Number(document.getElementById('pph_min').value);
        if (pph_min > pph_max) {
            document.getElementById('pph_error').style.display = 'block';
            document.getElementById('pph_error').className = 'req text-danger';
            document.getElementById('pph_error').innerHTML = 'Minimum value should be smaller than Maximum value!';
            valid = valid && false;
        }
        else {
            document.getElementById('pph_error').style.display = 'block';
            document.getElementById('pph_error').className = 'req text-success';
            document.getElementById('pph_error').innerHTML = 'looks good!';
            valid = valid && true;
        }
    }



    //validation for short bio
    result = validateInput('bio', 160, false);
    valid = valid && result;

    return valid;

}
