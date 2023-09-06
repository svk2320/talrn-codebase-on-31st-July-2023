<?php

$f_name=$_POST["first_name"];
$l_name=$_POST["last_name"];
$country=$_POST["country"];
$citizenship=$_POST["citizenship"];
$english=$_POST["english"];
$reason=$_POST["reason"];
$professional_expirience=$_POST["exp"];
$comittment=$_POST["comittment"];
$linkedin=$_POST["linkedin"];
$github=$_POST["github"];
$bio=$_POST["bio"];


$image_target = "userimages/";
$resume_target = "userresume/";

$target_image_file = $image_target . basename($_FILES["userPhoto"]["name"]);
$target_resume_file = $resume_target . basename($_FILES["userResume"]["name"]);

$imageName = htmlspecialchars( basename( $_FILES["userPhoto"]["name"]));
$fileName = htmlspecialchars( basename( $_FILES["userResume"]["name"]));

move_uploaded_file($_FILES["userPhoto"]["tmp_name"], $target_image_file);
move_uploaded_file($_FILES["userResume"]["tmp_name"], $target_resume_file);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="px-2 py-3 h4 bg-dark text-light mt-2">Submitted data</div>
    <div class="container">
        <table class="table">
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Full name</td>
                <td> <?php echo $f_name." ".$l_name; ?></td>
            </tr>
            <tr>
                <td>Country</td>
                <td> <?php echo $country; ?></td>
            </tr>
            <tr>
                <td>Citizenship</td>
                <td> <?php echo $citizenship; ?></td>
            </tr>
            <tr>
                <td>English Proficiency</td>
                <td> <?php echo $english; ?></td>
            </tr>
            <tr>
                <td>Reason</td>
                <td> <?php echo $reason; ?></td>
            </tr>
            <tr>
                <td>Professional expirience</td>
                <td> <?php echo $professional_expirience; ?></td>
            </tr>
            <tr>
                <td>Comittment Type</td>
                <td> <?php echo $comittment; ?></td>
            </tr>
            <tr>
                <td>LinkedIn</td>
                <td> <?php echo $linkedin; ?></td>
            </tr>
            <tr>
                <td>Github</td>
                <td> <?php echo $github; ?></td>
            </tr>
            <tr>
                <td>Bio</td>
                <td> <?php echo $bio; ?></td>
            </tr>
            <tr>
                <td>Image name</td>
                <td> <?php echo $imageName; ?></td>
            </tr>
            <tr>
                <td>Resume name</td>
                <td> <?php echo $fileName; ?></td>
            </tr>
        </table>

    </div>
    <script>
        const education = JSON.parse(localStorage.getItem('education'));
        console.log(education);
        const experience = JSON.parse(localStorage.getItem('experience'));
        console.log(experience);
    </script>
</body>

</html>