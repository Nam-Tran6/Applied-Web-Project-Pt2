<?php
session_start();

// Include database connection settings
require_once 'settings.php';

// Establish a connection to the database
$connection = @mysqli_connect($host, $user, $pwd, $sql_db);

// Check if the database connection is successful
if (!$connection) {
    // If there's an error, flash a global error and go back to the form
    $_SESSION['errors'] = ['_global' => 'Database connection failure: please try again later.'];
    $_SESSION['old']    = $_POST ?? [];
    header('Location: apply.php');
    exit;
} 

// Initialize error messages for each form field
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

// Function to sanitize user inputs by removing unwanted characters
function sanitise_input($data){
    $data = trim($data); // Removes extra spaces from the beginning and end
    $data = stripslashes($data); // Removes backslashes
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // Converts special characters to HTML entities
    return $data;
}

// Function to validate the length of a field's input
function validate_length($field_name, $data, $min, $max) {
    $data = trim($data); // Remove extra spaces
    $length = mb_strlen($data, 'UTF-8'); // Get the length of the string

    // Check if the input length is less than the minimum length
    if ($length < $min) {
        return "$field_name must be at least $min characters long.";
    } 
    // Check if the input length is more than the maximum length
    elseif ($length > $max) {
        return "$field_name must not exceed $max characters.";
    } 
    // If the input length is valid, return an empty string
    else {
        return ""; 
    }
}

// Check if the form is submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and sanitize the user inputs from the form
    $job_ref = sanitise_input($_POST['Job_Reference_Number'] ?? '');
    $first_name = sanitise_input($_POST['First_Name'] ?? '');
    $last_name = sanitise_input($_POST['Last_Name'] ?? '');
    $dob = sanitise_input($_POST['DOB'] ?? '');
    $address = sanitise_input($_POST['Street_Address'] ?? '');
    $suburb = sanitise_input($_POST['Suburb_Town'] ?? '');
    $postcode = sanitise_input($_POST['Postcode'] ?? '');
    $email = sanitise_input($_POST['Email'] ?? '');
    $phone = sanitise_input($_POST['Phone'] ?? '');
    $other_skills = sanitise_input($_POST['Other_Skills'] ?? '');
    $state = isset($_POST['State']) ? $_POST['State'] : ''; // Set default value to empty string if not set
    $gender = sanitise_input($_POST['Gender'] ?? '');
    // Accept either 'skills' or legacy 'Skills' from the form (minimal change, more robust)
    $skills_input = $_POST['skills'] ?? ($_POST['Skills'] ?? []);
    $skills = is_array($skills_input) ? implode(", ", array_map('sanitise_input', $skills_input)) : ""; // Convert skills array to a comma-separated string

    // Validation checks for each field
    if (empty($job_ref)) {
        $job_ref_error = "Job Reference Number is required.";
    } else {
        $length_error = validate_length("Job Reference Number", $job_ref, 5, 5);
        if (!empty($length_error)) {
            $job_ref_error = $length_error;
        } elseif (!preg_match("/^[A-Za-z0-9]{5}$/", $job_ref)) { 
            // Check if Job Reference Number is exactly 5 alphanumeric characters
            $job_ref_error = "Job Reference Number must be exactly 5 alphanumeric characters.";
        }
    }

    // Validate first name
    if (empty($first_name)) {
        $first_name_error = "First Name is required.";
    } else {
        $length_error = validate_length("First Name", $first_name, 1, 20);
        if (!empty($length_error)) {
            $first_name_error = $length_error;
        } elseif (!preg_match("/^[A-Za-z ]{1,20}$/", $first_name)) { 
            // Check if first name contains only alphabetic characters and spaces
            $first_name_error = "20 Alphabetic Characters Max";
        }
    }
    
    // Validate last name
    if (empty($last_name)) {
        $last_name_error = "Last Name is required.";
    } else {
        $length_error = validate_length("Last Name", $last_name, 1, 20);
        if (!empty($length_error)) {
            $last_name_error = $length_error;
        } elseif (!preg_match("/^[A-Za-z ]{1,20}$/", $last_name)) { 
            // Check if last name contains only alphabetic characters and spaces
            $last_name_error = "20 Alphabetic Characters Max.";
        }
    }  
    
    // Validate date of birth
    if (empty($dob)) {
        $dob_error = "Date of Birth is required.";
    } elseif (!preg_match("/^\d{4}\/(0[1-9]|1[012])\/(0[1-9]|[12][0-9]|3[01])$/", $dob)) { 
        // Validate date of birth format (yyyy/mm/dd)
        $dob_error = "Date of Birth must be in yyyy/mm/dd format.";
    }

    // Validate gender
    if (empty($gender)) {
        $gender_error = "Gender is required.";
    }

    // Validate street address
    if (empty($address)) {
        $address_error = "Street Address is required.";
    } else {
        $length_error = validate_length("Street Address", $address, 1, 40);
        if (!empty($length_error)) {
            $address_error = $length_error;
        }
    }

    // Validate suburb/town
    if (empty($suburb)) {
        $suburb_error = "Suburb/Town is required.";
    } else {
        $length_error = validate_length("Suburb/Town", $suburb, 1, 40);
        if (!empty($length_error)) {
            $suburb_error = $length_error;
        }
    }

    // Validate postcode
    if (empty($postcode)) {
        $postcode_error = "Postcode is required.";
    } else {
        $length_error = validate_length("Postcode", $postcode, 4, 4);
        if (!empty($length_error)) {
            $postcode_error = $length_error;
        } elseif (!preg_match("/^\d{4}$/", $postcode)) { 
            // Check if postcode is exactly 4 digits
            $postcode_error = "Postcode must be exactly 4 digits.";
        }
    }

    // Validate state
    if (empty($state)) {
        $state_error = "State is required.";
    }

    // Validate skills
    if (empty($skills)) {
        $skills_error = "At least one skill must be selected.";
    }

    // Validate email
    if (empty($email)) {
        $email_error = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        // Check if email format is valid
        $email_error = "Invalid email format.";
    }

    // Validate phone number
    if (empty($phone)) {
        $phone_error = "Phone Number is required.";
    } else {
        $length_error = validate_length("Phone Number", $phone, 8, 12);
        if (!empty($length_error)) {
            $phone_error = $length_error;
        } elseif (!preg_match("/^\d{8,12}$/", $phone)) { 
            // Check if phone number is between 8 and 12 digits
            $phone_error = "Phone Number must be 8 to 12 digits.";
        }
    } 

    // If any field has an error, flash errors + old input and go back to form
    if (!empty($job_ref_error) || !empty($first_name_error) || !empty($last_name_error) || !empty($dob_error) 
        || !empty($gender_error) || !empty($address_error) || !empty($suburb_error) || !empty($postcode_error) 
        || !empty($state_error) || !empty($skills_error) || !empty($email_error) || !empty($phone_error)) {
        
        // Map to the keys your apply page expects
        $_SESSION['errors'] = [
            'job_ref'    => $job_ref_error,
            'first_name' => $first_name_error,
            'last_name'  => $last_name_error,
            'dob'        => $dob_error,
            'gender'     => $gender_error,
            'address'    => $address_error,
            'suburb'     => $suburb_error,
            'postcode'   => $postcode_error,
            'state'      => $state_error,
            'skills'     => $skills_error,
            'email'      => $email_error,
            'phone'      => $phone_error
        ];
        $_SESSION['old'] = $_POST; // preserve raw inputs for repopulating
        header('Location: apply.php');
        mysqli_close($connection);
        exit;
    } else {
        // If no errors, insert the data into the database
        $sql = "INSERT INTO eoi (job_ref_num, first_name, last_name, dob, gender, address, suburb, state, postcode, email, phone_number, skills, others, status) 
                VALUES ('$job_ref', '$first_name', '$last_name', '$dob', '$gender', '$address', '$suburb', '$state', '$postcode', '$email', '$phone', '$skills', '$other_skills', 'New')"; 

        // Execute the query and check for success
        if (mysqli_query($connection, $sql)) {
            $eoi_number = mysqli_insert_id($connection); // Get the unique ID of the inserted record
            // Store EOI number in session ; can display it if you ever want
            $_SESSION['eoi_number'] = $eoi_number;
            // Clear old input on success
            unset($_SESSION['old'], $_SESSION['errors']);
            // Redirect back to the form 
            header('Location: apply.php');
        } else {
            // Flash DB error and go back
            $_SESSION['errors'] = ['_global' => 'Error saving your application: ' . mysqli_error($connection)];
            $_SESSION['old']    = $_POST;
            header('Location: apply.php');
        }
        // Close the database connection and stop
        mysqli_close($connection);
        exit;
    }
} else {
    // If the form is not submitted via POST, redirect to the application form page
    header('Location: apply.php');
    exit;
}