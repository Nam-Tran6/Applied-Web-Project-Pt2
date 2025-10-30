
<!DOCTYPE html>
<html lang="en">

<head>
    <!--Meta Tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="General details about our company">
    <meta name="keywords" content="Company Details, Common Navigation, Jira & Github link">
    <meta name="author" content="Sothearith Kuy">

    <!--Title-->
    <title>Job Info</title>

    <!--Link to Stylesheet-->
    <link rel="stylesheet" href="styles/layout.css" type="text/css">

    <style>
        body {
            /* Background illustration, sourced from Adobe Stock + generated with AI */
            background: url(styles/images/back_job.png);
            
            /* Background cover*/
            background-size: cover;
        }

        aside {
            float: right;
            width: 25%; /* Width of <aside> 25% to parentcontainer. */
            padding: 18px; /* Adds space between border and text */
            border-radius: 8px; /* Rounds corners of border with an 8px radius. */
            background-color: #ccc; /*White Blackground */
        }

        article {
            padding: 18px; /* 18px of inner spacing */
            border-radius: 8px; /* Rounds corners of the border with an 8px radius. */
            background-color: #ccc; /*White Background*/
        }

        .applybtn {
            display: inline-block; /* Button is horizontal*/
            padding: 12px 24px; /* Space between text and border*/
            font-size: 16px; /* Applies font changes*/
            color: white; /* button color is white*/
            margin-top: 10px; /* slight top margin for importance*/
            background: #0073e6; /* Job site style blue */
            border-radius: 8px; /* Corner round off 8px*/
            text-decoration: none; /* Removes underline*/
        }

        #apply {
            padding: 10px; /* 18px of inner spacing */
            border-radius: 8px; /* Rounds corners of the border with an 8px radius. */
            background-color: #ccc; /*White Background*/
            margin-bottom: 1em; /*adds spacing on bottom*/
        }

        #job_title { /*id for h2 main title*/
            color: #ccc; /* Changes text color to #ccc*/
            width: 30%; /* Sets limit to 30%*/
            background-color: #1a1a1a; /* Makes background solid to improve visibility*/
        }

    </style>
</head>

<body>
    <?php
    session_start();
        // header inclusions
        include "header.inc";
        include "settings.php";


// Create a new MySQLi connection to the database
$conn = new mysqli($host, $user, $pwd, $sql_db);

// Check if connection failed and stop script with error message
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    ?>

<main style="margin: 50px">
    <section>
        <h2 id="job_title">Open Positions</h2>

        <?php
        $sql = "SELECT * FROM jobs ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $responsibilities = explode("\n", $row['key_responsibilities']);
                $requirements = explode("\n", $row['essential_requirements']);
                $preferable = explode("\n", $row['preferable']);
                ?>

                <article aria-labelledby="job-<?php echo $row['id']; ?>">
                    <h3 id="job-<?php echo $row['id']; ?>">
                        Ref: <?php echo htmlspecialchars($row['ref']); ?> — 
                        <?php echo htmlspecialchars($row['title']); ?>
                    </h3>

                    <p><?php echo nl2br(htmlspecialchars($row['short_description'])); ?></p>

                    <dl>
                        <dt>Salary</dt>
                        <dd><?php echo htmlspecialchars($row['salary']); ?></dd>
                        <dt>Reporting line</dt>
                        <dd>Reports to <?php echo htmlspecialchars($row['reporting_line']); ?></dd>
                    </dl>

                    <h4>Key Responsibilities</h4>
                    <ol>
                        <?php foreach ($responsibilities as $item) {
                            if (trim($item)) echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                        } ?>
                    </ol>

                    <h4>Essential requirements</h4>
                    <ul>
                        <?php foreach ($requirements as $item) {
                            if (trim($item)) echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                        } ?>
                    </ul>

                    <h4>Preferable</h4>
                    <ul>
                        <?php foreach ($preferable as $item) {
                            if (trim($item)) echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                        } ?>
                    </ul>

                    <a href="apply.php?job=<?php echo urlencode($row['ref']); ?>" class="applybtn">Apply Now</a>
                </article>

                <br>
                <?php
            }
        } else {
            echo "<p>No open positions at this time.</p>";
        }
        ?>
    </section>

    <section id="apply" aria-labelledby="apply-title" style="float: left; width: 60%">
        <h2 id="apply-title" style="color: black;">How to apply</h2>
        <p>Send a one-page cover note and portfolio or GitHub link to 
           <a href="mailto:info@thebox.com">info@thebox.com</a> 
           with the reference code in the subject line.</p>
        <p>We review applications on a rolling basis and aim for an interview loop 
           that includes a short design/code exercise and two cross-functional interviews.</p>
        <p>Company is an equal-opportunity employer. Candidates must be authorized 
           to work in the country they apply from.</p>
    </section>

    <aside aria-labelledby="perks-title">
        <h3 id="perks-title">Perks & practicals</h3>
        <ul>
            <li>Flexible remote working (core overlap hours)</li>
            <li>Competitive equity and parental leave</li>
            <li>Learning budget and home office allowance</li>
        </ul>
    </aside>
</main>

    <?php
        // header footer
        include "footer.inc";
    ?>
</body>

</html>