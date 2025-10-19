<?php
function sanitise_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $job_ref = sanitise_input($_POST['Job_Reference_Number']);
        $first_name = sanitise_input($_POST['First_Name']);
        $last_name = sanitise_input($_POST['Last_Name']);
        $dob = sanitise_input($_POST['DOB']);
        $address = sanitise_input($_POST['Street_Address']);
        $suburb = sanitise_input($_POST['Suburb/Town']);
        $postcode = sanitise_input($_POST['Postcode']);
        $email = sanitise_input($_POST['Email']);
        $phone = sanitise_input($_POST['Phone']);
        $other_skills = sanitise_input($_POST['Other_Skills']);
        $state = isset($_POST['State']) ? $_POST['State'] : '';
        $gender = sanitise_input($_POST['Gender']);
        
        
    }
?>