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
        $dob = sanitise_input($_POST['Date_of_Birth']);
    }
?>