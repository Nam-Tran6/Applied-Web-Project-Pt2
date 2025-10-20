<?php
$job_ref_error = "";
$first_name_error = "";
$last_name_error = "";
$dob_error = "";
$address_error = "";
$suburb_error = "";
$postcode_error = "";
$email_error = "";
$phone_error = "";
$other_skills_error = "";
$state_error = "";
$gender_error = "";
$skills_error = "";

function sanitise_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

function validate_length($field_name, $data, $min, $max) {
        $data = trim($data);
        $length = mb_strlen($data, 'UTF-8');

        if ($length < $min) {
        return "$field_name must be at least $min characters long.";
        } elseif ($length > $max) {
        return "$field_name must not exceed $max characters.";
        } else {
        return ""; 
        }
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
        $skills = isset($_POST['Skills']) ? implode(", ", array_map('sanitise_input', $_POST["Skills"])) : "";

        if (empty($job_ref)) {
            $job_ref_error = "Job Reference Number is required.<br>";
        } else {
            $length_error = validate_length("Job Reference Number", $job_ref, 5, 5);
            if (!empty($length_error)) {
                $job_ref_error = $length_error . "<br>";
            } elseif (!preg_match("/^[A-Za-z0-9]{5}$/", $job_ref)) {
                $job_ref_error = "Job Reference Number must be exactly 5 alphanumeric characters.<br>";
            }
        }

        if (empty($first_name)) {
            $first_name_error = "First Name is required.<br>";
        } else {
            $length_error = validate_length("First Name", $first_name, 1, 20);
            if (!empty($length_error)) {
                $first_name_error = $length_error . "<br>";
            } elseif (!preg_match("/^[A-Za-z ]{1,20}$/", $first_name)) {
                $first_name_error = "20 Alphabetic Characters Max<br>";
            }
        }
        
        if (empty($last_name)) {
            $last_name_error = "Last Name is required.<br>";
        } else {
            $length_error = validate_length("Last Name", $last_name, 1, 20);
            if (!empty($length_error)) {
                $last_name_error = $length_error . "<br>";
            } elseif (!preg_match("/^[A-Za-z ]{1,20}$/", $last_name)) {
                $last_name_error = "20 Alphabetic Characters Max.<br>";
            }
            
        }  
        
        if (empty($dob)) {
            $dob_error = "Date of Birth is required.<br>";
        } elseif (!preg_match("/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/\d{4}$/", $dob)) {
            $dob_error = "Date of Birth must be in dd/mm/yyyy format.<br>";
        }

        if (empty($gender)) {
            $gender_error = "Gender is required.<br>";
        }

        if (empty($address)) {
            $address_error = "Street Address is required.<br>";
        } else {
            $length_error = validate_length("Street Address", $address, 1, 40);
            if (!empty($length_error)) {
                $address_error = $length_error . "<br>";
            }
        }

        if (!empty($job_ref_error) || !empty($first_name_error) || !empty($last_name_error) || !empty($dob_error) 
            || !empty($gender_error) || !empty($address_error)) {
            echo $job_ref_error;
            echo $first_name_error;
            echo $last_name_error;
            echo $dob_error;
            echo $gender_error;
            echo $address_error;
            }
    }
?>