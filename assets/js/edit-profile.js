var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab);

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
        x[i].className = x[i].className.replace(" finish", " ");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " stepper-active";

}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    if(n==1 && !validateForm()) return false;
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


function validateForm(){
    var tab_array,current_tab ,valid = true;
    tab_array = document.getElementsByClassName("tab");
    current_tab = tab_array[currentTab];
    switch(currentTab){
        case 0:
            console.log('in case 0');
            valid = validatePersonalDetails();
            break;
        case 1:
            console.log('in case 1');
            valid = validateEducation(current_tab);
            break;
        case 2:
            console.log('in case 2');
            valid = validateProfessionalExperience(current_tab);
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
            valid = true;
            break;
        case 6:
            console.log('in case 6');
            valid = validateFinish(current_tab);
            break;
    }
    if(valid){
        document.getElementsByClassName("stepper-number")[currentTab].className += " finish";
    }
    return valid;
}


function onlyAlphabets(str){
    var hasNumber = /\d/; 
    if(hasNumber.test(str)){
        return false;
    }
    else{
        return true;
    }
}


function validateInput(id,minLength,alphabets_only_flag){
    //console.log('in validation input: '+ id);
    inputValue = document.getElementById(id).value;
    outputTextId = id +'_error';
    if(inputValue.length == 0){// checking if empty
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'This field is required!';
        return false;
    }
    else if(inputValue.length <  minLength){ //checking for minLength
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'Please enter atleast '+ minLength +' characters';
        return false;
    }else if(!onlyAlphabets(inputValue) && alphabets_only_flag ){ //checking for only alphabetics
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'Please enter only alphabets!';
        return false;
    }
    else{//
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-success';
        document.getElementById(outputTextId).innerHTML = 'Looks good!';
        return true
    }
}

function validateNumberInput(id,min,max){
    inputValue = document.getElementById(id).value;
    value = Number(inputValue);
    outputTextId = id +'_error';
    if(inputValue.length == 0){// checking if empty
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'This field is required!';
        return false;
    }
    else if(max == 0 ){ //checking for Min and max = 0
        if(value < min){
            document.getElementById(outputTextId).style.display = 'block';
            document.getElementById(outputTextId).className = 'req text-danger';
            document.getElementById(outputTextId).innerHTML = 'The number should be more than ' + min;
            return false;
        }
        else{ // all good
            document.getElementById(outputTextId).style.display = 'block';
            document.getElementById(outputTextId).className = 'req text-success';
            document.getElementById(outputTextId).innerHTML = 'Looks good!';
            return true;
        }
    }
    else if(value < min ||  value > max){ //checking for Min and max value
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'The number should be between ' + min + ' and ' + max;
        return false;
    }
    else{ // all good
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-success';
        document.getElementById(outputTextId).innerHTML = 'Looks good!';
        return true;
    }
}

function validateSelect(id,default_selector){
    inputValue = document.getElementById(id).value;
    outputTextId = id +'_error';
    if(inputValue == default_selector){
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-danger';
        document.getElementById(outputTextId).innerHTML = 'This field is required!';
        return false;
    }
    else{
        document.getElementById(outputTextId).style.display = 'block';
        document.getElementById(outputTextId).className = 'req text-success';
        document.getElementById(outputTextId).innerHTML = 'Looks good!';
        return true
    }
}

function validateStartAndEndDate(start_id,end_id){
    start_value = document.getElementById(start_id).value;
    start_text_id = start_id +'_error';
    end_value = document.getElementById(end_id).value;
    end_text_id = end_id +'_error';
    if((start_value == '') || (end_value == '')) {//if either dates are empty
        if(start_value == ''){
            document.getElementById(start_text_id).style.display = 'block';
            document.getElementById(start_text_id).className = 'req text-danger';
            document.getElementById(start_text_id).innerHTML = 'This field is required!';
        }
        else{
            document.getElementById(start_text_id).style.display = 'block';
            document.getElementById(start_text_id).className = 'req text-success';
            document.getElementById(start_text_id).innerHTML = 'Looks good!';
        }
        if(end_value == ''){
            document.getElementById(end_text_id).style.display = 'block';
            document.getElementById(end_text_id).className = 'req text-danger';
            document.getElementById(end_text_id).innerHTML = 'This field is required!';
        }
        else{
            document.getElementById(end_text_id).style.display = 'block';
            document.getElementById(end_text_id).className = 'req text-success';
            document.getElementById(end_text_id).innerHTML = 'Looks good!';
        }
        return false;
    }
    else{
        const start_date = new Date(start_value);
        const end_date = new Date(end_value);
        if(start_date < end_date){
            document.getElementById(start_text_id).style.display = 'block';
            document.getElementById(start_text_id).className = 'req text-success';
            document.getElementById(start_text_id).innerHTML = 'Looks good!';
            document.getElementById(end_text_id).style.display = 'block';
            document.getElementById(end_text_id).className = 'req text-success';
            document.getElementById(end_text_id).innerHTML = 'Looks good!';
            return true;
        }
        else{
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

function validatePersonalDetails(){
    var valid = true;
    // validation for first name
    result = validateInput('first_name',2,true);
    valid = valid && result;

    //validation for last name
    result = validateInput('last_name',1,true);
    valid = valid && result;

    //validation for city
    result = validateInput('city',2,true);
    valid = valid && result;

    //validation for country
    result = validateInput('country',2,true);
    valid = valid && result;

    //validation for citizenship
    result = validateInput('citizenship',2,true);
    valid = valid && result;
    
    return valid;

}

function validateEducation(current_tab){
    var valid = true;
    edu_list = current_tab.getElementsByClassName('education');
    for(i = 0; i < edu_list.length;i++){
        //validation for degree
        result = validateSelect('degree'+i,'None');
        valid = valid && result;

        //validation for major
        result = validateInput('major'+i,2,true);
        valid = valid && result;

        //validation for university
        result = validateInput('university'+i,2,true);
        valid = valid && result;

        //validation for start and end date
        result = validateStartAndEndDate('edu_start'+i,'edu_end'+i);
        valid = valid && result;
    }
    
    return valid;

}



function validateProfessionalExperience(current_tab){
    var valid = true;
    
    // validation for experience years
    result = validateNumberInput('years_of_experience',0,45);
    valid = valid && result;

    // validation for primary job title
    result = validateInput('primary_job_title',2,false);
    valid = valid && result;

    //validation for skills 
    skill_list = current_tab.getElementsByClassName('skill_list');
    for(i = 0; i < skill_list.length;i++){
        //validation for skill name
        result = validateInput('skill_name'+i,1,false);
        valid = valid && result;

        //validation for skill year
        result = validateNumberInput('skill_year'+i,0,45);
        valid = valid && result;

        //validation for skill month
        result = validateNumberInput('skill_month'+i,0,11);
        valid = valid && result;
    }
    if (skill_list.length < 5){
        document.getElementById('skills_error').style.display = 'block';
        document.getElementById('skills_error').className = 'req text-danger';
        document.getElementById('skills_error').innerHTML = 'Atleast 5 skills are required!';
        valid = valid && false;
    }
    else{
        document.getElementById('skills_error').style.display = 'none';
        valid = valid && true;
    }

    //validation for comittment
    comittment_list = document.getElementsByName('comittment');
    comittment_checked = false
    for(i = 0; i < comittment_list.length;i++){
        if(comittment_list[i].checked){
            comittment_checked = true;
        }
    }
    if(comittment_checked){
        document.getElementById('comittment_error').style.display = 'block';
        document.getElementById('comittment_error').className = 'req text-success';
        document.getElementById('comittment_error').innerHTML = 'Looks good!';
        valid = valid && true;
    }
    else{
        document.getElementById('comittment_error').style.display = 'block';
        document.getElementById('comittment_error').className = 'req text-danger';
        document.getElementById('comittment_error').innerHTML = 'This Field is required!';
        valid = valid && false;
    }

    
    return valid;

}

function  validateProjectDetails(current_tab){
    var valid = true;
    project_list = current_tab.getElementsByClassName('project');
    for(i = 0; i < project_list.length;i++){
        //validation for project title
        result = validateInput('project_title'+i,2,false);
        valid = valid && result;

        //validation for project technologies
        result = validateInput('project_tech'+i,2,false);
        valid = valid && result;

        //validation for project description
        result = validateInput('project_description'+i,50,false);
        valid = valid && result;

        //validation for project responsibilities
        result = validateInput('project_resp'+i,50,false);
        valid = valid && result;

        //validation for project URL
        // result = validateInput('project_url'+i,5,false);
        // valid = valid && result;

        //validation for  project industry
        result = validateInput('project_industry'+i,2,false);
        valid = valid && result;


    }

    return valid;
}

function validateFinish(current_tab){
    var valid = true,pph_max,pph_min;
    //validation for pph max
    result = validateNumberInput('pph_min',0,0);
    valid = valid && result;

    //validation for ppm
    result = validateNumberInput('pph_max',0,0);
    valid = valid && result;

    if(valid == true){
        pph_max = Number(document.getElementById('pph_max').value);
        pph_min = Number(document.getElementById('pph_min').value);
        if(pph_min > pph_max){
            document.getElementById('pph_error').style.display = 'block';
            document.getElementById('pph_error').className = 'req text-danger';
            document.getElementById('pph_error').innerHTML = 'Minimum value should be smaller than Maximum value!';
            valid = valid && false;
        }
        else{
            document.getElementById('pph_error').style.display = 'block';
            document.getElementById('pph_error').className = 'req text-success';
            document.getElementById('pph_error').innerHTML = 'looks good!';
            valid = valid && true;
        }
    }

    

    //validation for short bio
    result = validateInput('bio',50,false);
    valid = valid && result;

    return valid;

}




// function validateForm() {
//     // This function deals with validation of the form fields
//     var x, y, i, valid = true;
//     x = document.getElementsByClassName("tab");
//     y = x[currentTab].getElementsByTagName("input");
//     z = x[currentTab].getElementsByClassName("req");
//     g = x[currentTab].getElementsByTagName("textarea");
//     c = 0;
//     // A loop that checks every input field in the current tab:
//     for (i = 0; i < y.length; i++) {
//         if (y[i].value == "Full-time" || y[i].value == "Part-time" || y[i].value == "Hourly") {
//             if (y[i].checked != true) {
//                 c++;
//             }
//             if (c == 3) {
//                 y[i].className += " invalid";
//                 z[i - 2].style.display = "block";
//                 // and set the current valid status to false:
//                 valid = false;
//             }
//         }
//         // If a field is empty...
//         if (y[i].value == "" && y[i].id == "reqfeild" || y[i].value == "" && y[i].id == "start_pro" || y[i].value == "" && y[i].id == "end_pro") {
//             // add an "invalid" class to the field:
//             y[i].className += " invalid";
//             z[i].style.display = "block";
//             // and set the current valid status to false:
//             valid = false;
//         }
//     }

//     for (i = 0; i < g.length; i++) {
//         // If a field is empty...
//         if (g[i].value == "" && g[i].id == "reqfeild") {
//             // add an "invalid" class to the field:
//             g[i].className += " invalid";
//             if (g[i].name == "bio") {
//                 z[i].style.display = "block";
//             } else {
//                 z[i + 2].style.display = "block";
//             }
//             // and set the current valid status to false:
//             valid = false;
//         }
//     }
//     return valid; // return the valid status
// }


