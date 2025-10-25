<!DOCTYPE html>
<html lang="en">

<head>
    <!--Meta Tag-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Sokna David Heang">
    <meta name="description" content="page for applying for Tech Talent">
    <meta name="keywords" content="Tech Talent, Application">

    <!--Title-->
    <title>Application</title>

    <!--Link to Stylesheet-->
    <link rel="stylesheet" href="styles/layout.css" type="text/css"> 
    
    <style>
        body {
            /* Background illustration, sourced from Adobe Stock + generated with AI
            Name: Vector futuristic sphere of particles and lines. Network connection big data. Abstract technology background.*/
            background: url(styles/images/background2nd.png);
            
            /* Background cover*/
            background-size: cover;
        }

        main { /* Adjust size of main*/
            max-width: 800px; /* Restricts content width for better readability */
            margin: 2rem auto;  /* Horizontally center + Vertical spacing */
        }

        form { /* Grid to allow gap between form sections*/
            display: grid; /* Uses CSS Grid for structured spacing */
            gap: 1.5rem; /* Space between form sections */
        }

        input { 
            display: flex; /* Aligns all input displays together*/
        }

    </style>

<body>
    <?php
        // header inclusions
        include "header.inc";
    ?>
    
    <main>
        <!--H2 Heading for Application Form-->
        <h2 style="text-align:center; color: #ccc;">Tech Talent Application Form</h2>
        
        <!--Sends to this database through post-->
        <form action="https://mercury.swin.edu.au/it000000/formtest.php" method="post">

        <!-- SECTION 1: JOB DETAILS -->
        <section class="form-section">
            <h2>Job Details</h2>
            
            <!--Input 5 length character for Job Reference Number-->
            <div class="form-group">
                <label for="job_reference_number">Job Reference Number: 
                <p>
                    Ref: A1B2C — Senior Product Designer 
                </p>
                <p>
                    Ref: D4E5F — Frontend Engineer, Design Systems
                </p>
                </label>
                <input type="text" id="job_reference_number" name="job_reference_number" maxlength="5" required
                pattern="[A-Za-z0-9]{5}" title="5 Alphanumeric Characters">
            </div>
        </section>
            
        <!-- SECTION 2: PERSONAL DETAILS -->
        <section class="form-section">
            <h2>Personal Details</h2>

            <!--Input to a maxixmum of 20 Alphabetic Characters for First Name-->
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required maxlength="20" pattern="[A-Za-z ]{1,20}" 
                title="20 Alphabetic Characters Max">
            </div>

            <!--Input to a maxixmum of 20 Alphabetic Characters for Last Name-->
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required pattern="[A-Za-z ]{1,20}" maxlength="20" title="20 Alphabetic Characters Max">
            </div>
            
            <!--Input Date of Birth in dd/mm/yyyy formart-->
            <div class="form-group">
                <label for="date">Date of Birth:</label>
                <input type="text" id="date" name="date" placeholder="dd/mm/yyyy" 
                pattern="(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/\d{4}" title="Enter date in dd/mm/yyyy format" required>
            </div>
                
            <!--Fieldset for Gender Selection-->
            <div class="form-group">
                <fieldset>
                    <legend>Select your gender</legend>
                    <div class="radio-group" style= "font-weight: normal">
                        <!--Select Male Radio Button-->
                        <input type="radio" id="male" name="Gender" value="Male" required>
                        <label for="male">Male</label>

                        <!--Select Female Radio Button-->
                        <input type="radio" id="female" name="Gender" value="Female" required>
                        <label for="female">Female</label>
                            
                        <!--Select Other Radio Button-->
                        <input type="radio" id="other" name="Gender" value="Other" required>
                        <label for="other">Other</label>
                    </div>
                </fieldset>
            </div>
        </section>
            
        <!-- SECTION 3: ADDRESS DETAILS -->
        <section class="form-section">
            <h2>Address Details</h2>
            <div class="form-group">
                <!--Input for Street Address, max of 40 characters-->
                <label for="street_address">Street Address:</label>
                <input type="text" id="street_address" name="street_address" required maxlength="40" title="40 Characters Max">
            </div>
                
            <div class="form-group">
                <!--Input for Suburb/Town, max of 40 characters-->
                <label for="suburb">Suburb:</label>
                <input type="text" id="suburb" name="suburb" required maxlength="40" title="40 Characters Max">
            </div>
                
            <div class="form-group">
                <!--Select Box for States-->
                <label for="state">State:</label>
                <br>
                <select id="state" name="state" required>
                    <!--Initial 0ption when selected-->
                    <option value="" disabled selected>Select your State</option>
                    <!--Available Options-->
                    <option value="VIC">VIC</option>
                    <option value="NSW">NSW</option>
                    <option value="QLD">QLD</option>
                    <option value="NT">NT</option>
                    <option value="WA">WA</option>
                    <option value="SA">SA</option>
                    <option value="TAS">TAS</option>
                    <option value="ACT">ACT</option>
                </select>
            </div>

            <div class="form-group">
                <!-- Text input for Postcode-->
                <label for="postcode">Postcode:</label>
                <input type="text" id="postcode" name="postcode" required pattern="\d{4}" maxlength="4" title="4 Digit Postcode">
            </div>
        </section>
            
        <!-- SECTION 4: CONTACT DETAILS -->
        <section class="form-section">
            <!-- Section Heading-->
            <h2>Contact Details</h2>

            <div class="form-group">
                <!--Input Email Link-->
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Enter a valid email address">
            </div>
                
            <div class="form-group">
                <!--Input Phone Number-->
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required pattern="\d{8,12}" maxlength="12" title="8-12 Digit Phone Number">
            </div>
        </section>
            
        <!-- SECTION 5: SKILLS AND EXPERIENCE -->
        <section class="form-section">
            <!--Section Heading-->
            <h2>Skills and Experience</h2>
            
            <div class="form-group">
                <!--Checkbox Fieldset-->
                <fieldset>
                <!--Legend for Skills-->
                <legend>Select Your Skills:</legend>
                    <div class="checkbox-group">
                            <dl class="skills-list">

                            <!--Programming Checkbox-->
                                <dt><input type="checkbox" id="Skill1" name="Skills[]" value="Programming" required title="Select at least one skill"></dt>
                                <dd><label for="Skill1">Programming</label></dd>
                                <br>

                            <!--Web Development Checkbox-->
                                <dt><input type="checkbox" id="Skill2" name="Skills[]" value="Web Development"></dt>
                                <dd><label for="Skill2">Web Development</label></dd>
                                <br>

                            <!--Data Analysis Checkbox-->
                                <dt><input type="checkbox" id="Skill3" name="Skills[]" value="Data Analysis"></dt>
                                <dd><label for="Skill3">Data Analysis</label></dd>
                                <br>

                            <!--Project Management Checkbox-->
                                <dt><input type="checkbox" id="Skill4" name="Skills[]" value="Project Management"></dt>
                                <dd><label for="Skill4">Project Management</label></dd>
                                <br>

                            <!--Cybersecurity Checkbox-->
                                <dt><input type="checkbox" id="Skill5" name="Skills[]" value="Cybersecurity"></dt>
                                <dd><label for="Skill5">Cybersecurity</label></dd>
                                <br>

                            <!--Cloud Computing Checkbox-->
                                <dt><input type="checkbox" id="Skill6" name="Skills[]" value="Cloud Computing"></dt>
                                <dd><label for="Skill6">Cloud Computing</label></dd>
                                <br>

                            <!--AI and Machine Checkbox-->
                                <dt><input type="checkbox" id="Skill7" name="Skills[]" value="AI and Machine Learning"></dt>
                                <dd><label for="Skill7">AI and Machine Learning</label></dd>
                                <br>

                            <!--Other Checkbox-->
                                <dt><input type="checkbox" id="Skill8" name="Skills[]" value="Other"></dt>
                                <dd><label for="Skill8">Other</label></dd>
                        </dl>
                    </div>
                </fieldset>
            </div>
                
            <div class="form-group">
                <label for="other_skills">If Other, please specify:</label>
                <textarea id="other_skills" name="other_skills" rows="5"></textarea>
            </div>
        </section>

        <!-- SECTION 6: FORM CONTROL -->
            <div class="form-actions">
                <!--Submit Application Button-->
                <input type="submit" value="Submit Application">
                <!--Reset Application Button-->
                <input type="reset" value="Reset Application Form">
            </div>
        </form>
    </main>

    <?php
        // header footer
        include "footer.inc";
    ?>
</body>
</html>