<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'settings.php';

$connection = @mysqli_connect($host, $user, $pwd, $sql_db);

if (!$connection) {
    echo "<p>Database connection failure: </p>";
} else {
    // echo "<p>Database connection successful</p>";
}

$job_ref_error = "";
$first_name_error = "";
$last_name_error = "";
$dob_error = "";
$address_error = "";
$suburb_error = "";
$postcode_error = "";
$email_error = "";
$phone_error = "";
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
        $suburb = sanitise_input($_POST['Suburb_Town']);
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
        } elseif (!preg_match("/^\d{4}\/(0[1-9]|1[012])\/(0[1-9]|[12][0-9]|3[01])$/", $dob)) {
            $dob_error = "Date of Birth must be in yyyy/mm/dd format.<br>";
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

        if (empty($suburb)) {
            $suburb_error = "Suburb/Town is required.<br>";
        } else {
            $length_error = validate_length("Suburb/Town", $suburb, 1, 40);
            if (!empty($length_error)) {
                $suburb_error = $length_error . "<br>";
            }
        }

        if (empty($postcode)) {
            $postcode_error = "Postcode is required.<br>";
        } else {
            $length_error = validate_length("Postcode", $postcode, 4, 4);
            if (!empty($length_error)) {
                $postcode_error = $length_error . "<br>";
            } elseif (!preg_match("/^\d{4}$/", $postcode)) {
                $postcode_error = "Postcode must be exactly 4 digits.<br>";
            }
        }

        if (empty($state)) {
            $state_error = "State is required.<br>";
        }

        if (empty($skills)) {
            $skills_error = "At least one skill must be selected.<br>";
        }

        if (empty($email)) {
            $email_error = "Email is required.<br>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format.<br>";
        }

        if (empty($phone)) {
            $phone_error = "Phone Number is required.<br>";
        } else {
            $length_error = validate_length("Phone Number", $phone, 8, 12);
            if (!empty($length_error)) {
                $phone_error = $length_error . "<br>";
            } elseif (!preg_match("/^\d{8,12}$/", $phone)) {
                $phone_error = "Phone Number must be 8 to 12 digits.<br>";
            }
        } 

        if (!empty($job_ref_error) || !empty($first_name_error) || !empty($last_name_error) || !empty($dob_error) 
            || !empty($gender_error) || !empty($address_error) || !empty($suburb_error) || !empty($postcode_error) 
            || !empty($state_error) || !empty($skills_error) || !empty($email_error) || !empty($phone_error)) {
            echo $job_ref_error;
            echo $first_name_error;
            echo $last_name_error;
            echo $dob_error;
            echo $gender_error;
            echo $address_error;
            echo $suburb_error;
            echo $postcode_error;
            echo $state_error;
            echo $skills_error;
            echo $email_error;
            echo $phone_error;
        } else {
            $sql = "INSERT INTO eoi (job_ref_num, first_name, last_name, dob, gender, address, suburb, state, postcode, email, phone_number, skills, others, status) 
            VALUES ('$job_ref', '$first_name', '$last_name', '$dob', '$gender', '$address', '$suburb', '$state', '$postcode', '$email', '$phone', '$skills', '$other_skills', 'New')"; 
        }

       if (mysqli_query($connection, $sql)) {
            $eoi_number = mysqli_insert_id($connection);
            echo "<h2>Application Submitted Successfully!</h2>";
            echo "<p>Thank you, <strong>$first_name</strong>.</p>";
            echo "<p>Your unique EOI number is: <strong>EOI-" . str_pad($eoi_number, 5, '0', STR_PAD_LEFT) . "</strong></p>";
            echo "<p>Please keep this number for future reference.</p>";
        } else {
            echo "Error: " . mysqli_error($connection);
        }
        mysqli_close($connection);
    } else {
        header ('Location: apply.php');
    }

?>