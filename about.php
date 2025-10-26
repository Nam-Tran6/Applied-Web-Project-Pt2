<!DOCTYPE html>
<html lang="en">
    <head>
        <!--Meta Tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Sokna David Heang">
        <meta name="description" content="Learn more about our tech startup, and the team behind it.">
        <meta name="keywords" content="Tech Startup, Applying, Job, Careers">
        
        <title>About Us</title> 
        <!-- Title of the Page (Tab Bar) -->
        
        <link rel="stylesheet" href="styles/layout.css" type="text/css">
        <!--Link to Stylesheet-->

        <style>
            body {
            /* Background illustration, sourced from Adobe Stock + generated with AI
            Name: Abstract Big Data visualization digital network connection concept background. Artificial intelligenc
            e and engineering technology. Global network, Lines plexus, minimal array. Vector illustration.
            Link: https://stock.adobe.com/search?k=network+array&search_type=usertyped&asset_id=383217485 */
            background: url(styles/images/back_about.png);
            
            /* Background cover*/
            background-size: cover;
            }

            table, th, td {
                border: 1px solid black;   /* draws the borders */
                border-collapse: collapse; /* merges double borders */
                background-color: #ccc;
            }

            .information {
                margin: 3em; /* outside of box*/
                padding: 1em; /* inside of box*/
                width: 30%; /* changes the aside shrinks and expands*/
                border: 2px solid black; /* Adds a 2 pixel solid black line*/
                border-radius: 14px; /*rounds off rectangle*/
                background-color: #ccc;
            }

            .flex-layout {
                display: flex; /* Flex Layout*/
                flex-wrap: wrap; /* Items wrapped to additional lines*/
                justify-content: center; /* Centers objects*/
            }

            #funfacts {
                display: flex;
                justify-content: center;
            }

            #funfacts h2 {
                align-content: center;
                margin: 1em
            }
        </style>     
    </head>

<body>
    <?php
        // header inclusions
        include "header.inc";
    ?>

    <main>
        <!-- Main heading for the page, centered using inline CSS -->
        <h1 id = "heading" style="text-align:center;">Team Profile: The Lads</h1>
        
        <div class="flex-layout">
            <section class="information">
                <h2>Member Contributions &amp; Quotes</h2>
                <!-- Subheading introducing the contributions section -->
                <dl>

                    <!-- Description list for Kha Nam Tran-->
                    <dt>Kha Nam Tran — Front-end Lead</dt>
                    <dd>Contribution: Coded index.html, style.css</dd>
                    <dd>Quote: "Viciously Coding"</dd>
                    <dd>Favorite Language: French</dd>
                    <dd>Translation: Codage vicieux</dd>

                    <!-- Description list for Sothearith Kuy -->
                    <dt>Sothearith Kuy— Front-end Engineer</dt>
                    <dd>Contribution: Coded job.html</dd>
                    <dd>Quote: "Code Breaker"</dd>
                    <dd>Favourite language: Spanish</dd>
                    <dd>Translation: descifrador de códigos</dd>


                    <!-- Description list for Sokna David Heang -->
                    <dt>Sokna David Heang — Front-end Engineer</dt>
                    <dd>Contribution: Coded about.html + apply.html</dd>
                    <dd>Quote: "Eat, Sleep, Code, Repeat"</dd>
                    <dd>Favourite language: German</dd>
                    <dd>Translation: Essen, Schlafen, Code, Wiederholen</dd>
                </dl>
            </section>

            <section class="information">
            <!--Class Day and Time Aside Text-->
                        <h2>Class Day &amp; Time</h2>
                <div>
                    <!-- Unordered list to display class day and time -->
                    <ul>
                        <!--Day list-->
                        <li>Day
                            <ul>
                                <li>Thursday</li>                       
                            </ul>
                        </li>
                        
                        <!--Time List-->
                        <li>Time
                            <ul>
                                <li>12:30 PM - 2:30 PM</li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div>
                    <!--Description List for Student IDs-->
                    <h2>Student ID</h2>
                        <dl>
                            <dt>Kha Nam Tran</dt>
                                <dd>104555355</dd>
                            <dt>Sokna David Hoang</dt>
                                <dd>105962079</dd>
                            <dt>Sothearith Kuy</dt>
                                <dd>105069886</dd>
                        </dl> 
                </div>    
            </section>
        </div>

        <!--Section detailing Photo-->
            <section id = "photo" style="text-align:center;">
                <h2>Group Photo</h2>
                <hr>
                <figure> 
                    <img style = "border: 5px solid black;" src="images/team-photo.jpg" alt="Group photo of The Lads team">
                    <figcaption>The Lads — Semester 2, 2025. Left to right: Kha Nam Tran, Sothearith Kuy, 
                    Sokna David Hoang, Rakibul.</figcaption>
                </figure> 
                <hr>
            </section>

            <?php
                //Section involving facts about team
                echo"<section id='funfacts'>";
                echo"<h2>Fun Facts:</h2>";
                
                //Runs settings once 
                require_once("settings.php"); 
                //connects to database with the code necessary
                $conn = mysqli_connect ($host, $user, $pwd, $sql_db);

                //failsafe if $conn does not connect, leading to prompt detaling error 
                if(!$conn){
                    echo " <p> Database Connection failed, dude: ".mysqli_connect_error()."</p>";
                
                    // else select all data from funfacts table
                }else {
                    $sql = "SELECT * FROM funfacts";

                    // copies queries from funfacts into $results
                    $result = mysqli_query($conn, $sql);
                    

                    //if result is true + results has more then 0 rows
                    if($result && mysqli_num_rows($result)>0) {
                        //While loop to ensures that all data is searched through
                        //starts a table tag
                        echo "<table>
                            <thead>
                                <tr>
                                    <th>Member</th>
                                    <th>Dream Job</th>
                                    <th>Coding Snack</th>
                                    <th>Hometown</th>
                                    <th>Sport</th>
                                    <th>Movie</th>
                                </tr>
                            </thead>
                        <tbody>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            //gathers special characters from data in funfacts table
                            $member = htmlspecialchars($row["member"]); 
                            $dream = htmlspecialchars($row["dream_job"]);
                            $coding = htmlspecialchars($row["coding_snacks"]);
                            $home = htmlspecialchars($row["hometown"]);
                            $sport = htmlspecialchars($row["sport"]);
                            $movie = htmlspecialchars($row["movie"]);

                            //produces a new table for each seperate id
                            echo "<tr>
                                <td>$member</td>
                                <td>$dream</td>
                                <td>$coding</td>
                                <td>$home</td>
                                <td>$sport</td>
                                <td>$movie</td>
                            </tr>";
                            }

                        //closes the table tag
                        echo "</tbody>
                            </table>";
                        
                        // Fail state for when no data is given
                        } else {
                            echo "<p>No Data Found</p>";
                        }
                    mysqli_close($conn);
                }
                echo"</section>";

                // header footer
                include "footer.inc";
            ?>
        </main>
    </body>
</html>