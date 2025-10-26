<?php
session_start();
include "settings.php"; // Connects to your database

//  Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Create a new MySQLi connection to the database
$conn = new mysqli($host, $user, $pwd, $sql_db);

// Check if connection failed and stop script with error message
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize default variables
$message = ""; // Used to store success or error messages
$order_by = "EOInumber"; // Default column to sort the results by if the user doesn't choose another field
$search_sql = "";  // Placeholder for search query text not currently used, but kept for clarity or future use

// DELETE All EOIs BY JOB REFERENCE

if (isset($_POST['delete_ref'])) {
    $job_ref = trim($_POST['delete_ref']);

    $stmt = $conn->prepare("DELETE FROM eoi WHERE job_ref_num = ?");
    $stmt->bind_param("s", $job_ref);

    if ($stmt->execute()) {
        $message = " All EOIs for Job Reference '$job_ref' deleted successfully.";
    } else {
        $message = "Error deleting EOIs.";
    }
}

// DELETE SINGLE EOI
if (isset($_POST['delete_eoi'])) {
    $eoi_num = $_POST['delete_eoi'];

    $stmt = $conn->prepare("DELETE FROM eoi WHERE EOInumber = ?");
    $stmt->bind_param("i", $eoi_num);

    if ($stmt->execute()) {
        $message = "EOI #$eoi_num deleted successfully.";
    } else {
        $message = "Error deleting EOI #$eoi_num.";
    }
}

// UPDATE EOI STATUS

if (isset($_POST['update_status'])) {
    $eoi_num = $_POST['eoi_num'];
    $new_status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE eoi SET status = ? WHERE EOInumber = ?");
    $stmt->bind_param("si", $new_status, $eoi_num);

    if ($stmt->execute()) {
        $message = " Status updated successfully.";
    } else {
        $message = " Error updating status.";
    }
}


// FILTER & SORT EOIs

$where_clauses = [];  // Store conditional filters (WHERE)
$params = [];         // Values for the placeholders
$types = "";          // Data types for bind_param()

// Filter by job reference
if (!empty($_GET['job_ref'])) {
    $where_clauses[] = "job_ref_num = ?";
    $params[] = $_GET['job_ref'];
    $types .= "s";
}

// Filter by first name (partial match)
if (!empty($_GET['first_name'])) {
    $where_clauses[] = "first_name LIKE ?";
    $params[] = "%" . $_GET['first_name'] . "%";
    $types .= "s";
}

// Filter by last name (partial match)
if (!empty($_GET['last_name'])) {
    $where_clauses[] = "last_name LIKE ?";
    $params[] = "%" . $_GET['last_name'] . "%";
    $types .= "s";
}

// Sorting option
if (!empty($_GET['sort_by'])) {
    $order_by = $_GET['sort_by'];
}


// Build SQL dynamically based on user input
$sql = "SELECT * FROM eoi";
if (count($where_clauses) > 0) {
    $sql .= " WHERE " . implode(" AND ", $where_clauses);
}
$sql .= " ORDER BY $order_by";

// Prepare the SQL statement safely
$stmt = $conn->prepare($sql);
if (count($params) > 0) {
    $stmt->bind_param($types, ...$params);}
    $stmt->execute();
    $result = $stmt->get_result();
?>

<!-- FRONTEND SECTION -->

<!DOCTYPE html>
<html lang="en">
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="manage page for manager to acess manage page">
    <meta name="keywords" content="Company Details, manage page, Common Navigation, Jira & Github link">
    <link rel="stylesheet" href="">
    <meta name="author" content="Sothearith Kuy">
<title>Manage EOIs</title>
<style>
   body {
   
    background: #f5f5f5; /* Light grey background */
    margin: 0;
    padding: 20px;
}

/* Headings */
h1 {
    text-align: center; /* Center the heading */
    color: #333; /* Dark grey text color */
}

/* Form Container */
form {
    background: #fff; /* White background for form */
    padding: 20px;
    margin: 20px auto;
    max-width: 800px; /* Limit form width */
    border-radius: 8px; /* Rounded corners */
    
}

/* Input Fields, Dropdowns, and Buttons */
input,
select,
button {
    margin: 8px 0;
    padding: 8px;
    width: 100%; /* Full width elements */
    box-sizing: border-box; /* Include padding in total width */
}

/* Table Styles  */
table {
    width: 100%; /* Full-width table */
    border-collapse: collapse; /* Merge table borders */
    background: white; /* White background */
    margin-top: 20px;
}

th,
td {
    border: 1px solid #ccc; /* Light grey border */
    padding: 10px;
    text-align: left;
}

th {
    background: grey; /* Header background color */
    color: white; /* White header text */
}


</style>
</head>
<body>

<!-- Logged-in info -->
<div class="logout">
    Logged in as <b><?php echo htmlspecialchars($_SESSION['user']); ?></b> | 
    <a href="logout.php">Logout</a>
</div>

<h1>Manage EOIs</h1>

<!-- Message after actions -->
<?php if ($message): ?>
<p id="message"><?php echo $message; ?></p>
<?php endif; ?>

<!-- FILTER / SORT FORM -->
<form method="get">
    <h3>Search / Filter EOIs</h3>

    <label>Job Reference:</label>
    <input type="text" name="job_ref" placeholder="e.g., A1B2C" value="<?php echo htmlspecialchars($_GET['job_ref'] ?? ''); ?>">

    <label>First Name:</label>
    <input type="text" name="first_name" value="<?php echo ($_GET['first_name'] ?? ''); ?>">

    <label>Last Name:</label>
    <input type="text" name="last_name" value="<?php echo ($_GET['last_name'] ?? ''); ?>">

    <label>Sort By:</label>
    <select name="sort_by">
        <option value="EOInumber">EOI Number</option>
        <option value="first_name">First Name</option>
        <option value="last_name">Last Name</option>
        <option value="job_ref_num">Job Reference</option>
        
    </select>

    <button class="btn" type="submit">Search</button>
</form>

<!--  DELETE FORM -->
<form method="post">
    <h3>Delete All EOIs by Job Reference</h3>
    <input type="text" name="delete_ref" placeholder="Enter Job Reference (e.g., A1B2C)" required>
    <button class="btn" type="submit">Delete EOIs</button>
</form>

<!-- EOI TABLE -->
<table>
    <tr>
        <th>EOI #</th>
        <th>Job Ref</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Skills</th>
        <th>Status</th>
        <th>Change Status</th>
        <th>Delete</th>
        
        
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['EOInumber']; ?></td>
        <td><?php echo ($row['job_ref_num']); ?></td>
        <td><?php echo ($row['first_name']); ?></td>
        <td><?php echo ($row['last_name']); ?></td>
        <td><?php echo ($row['email']); ?></td>
        <td><?php echo ($row['phone_number']); ?></td>
        <td><?php echo ($row['skills']); ?></td>
        <td><?php echo ($row['status']); ?></td>
        
        <td>
    <form method="post" style="margin:0;"onsubmit="return confirm('Are you sure you want to update this EOI?');">
        <input type="hidden" name="eoi_num" value="<?php echo $row['EOInumber']; ?>">
        <select name="status">
            <option value="New" <?php if($row['status']=="New") echo "selected"; ?>>New</option>
            <option value="Current" <?php if($row['status']=="Current") echo "selected"; ?>>Current</option>
            <option value="Final" <?php if($row['status']=="Final") echo "selected"; ?>>Final</option>
        </select>
        <button class="btn" name="update_status" type="submit">Update</button>
    </form>
</td>
<td>
    <form method="post" style="margin:0;" onsubmit="return confirm('Are you sure you want to delete this EOI?');">
        <input type="hidden" name="delete_eoi" value="<?php echo $row['EOInumber']; ?>">
        <button class="btn" type="submit">Delete</button>
    </form>
</td>

    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>

<?php
