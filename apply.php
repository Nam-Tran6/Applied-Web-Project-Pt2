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
        main { /* Adjust size of main*/
            max-width: 800px; /* Restricts content width for better readability */
            margin: 2rem auto;  /* Horizontally center + Vertical spacing */
        }

        form { /* Grid to allow gap between form sections*/
            display: grid; /* Uses CSS Grid for structured spacing */
            gap: 1.5rem; /* Space between form sections */
        }
    </style>

<body>
    <?php
        // header inclusions
        include "header.inc";
    ?>
    
    <main>
        <!--H2 Heading for Application Form-->
        <h2 style="text-align:center;">Tech Talent Application Form</h2>
        
        <!--Sends to this database through post-->
        <form action="process_eoi.php" method="POST">

        <!-- SECTION 1: JOB DETAILS -->
        <section class="form-section">
            <h2>Job Details</h2>
            
            <!--Input 5 length character for Job Reference Number-->
            <div class="form-group">
                <label for="Job_Reference_Number">Job Reference Number:</label>
                <input type="text" id="Job_Reference_Number" name="Job_Reference_Number">
            </div>
        </section>
            
        <!-- SECTION 2: PERSONAL DETAILS -->
        <section class="form-section">
            <h2>Personal Details</h2>

            <!--Input to a maxixmum of 20 Alphabetic Characters for First Name-->
            <div class="form-group">
                <label for="First_Name">First Name:</label>
                <input type="text" id="First_Name" name="First_Name">
            </div>

            <!--Input to a maxixmum of 20 Alphabetic Characters for Last Name-->
            <div class="form-group">
                <label for="Last_Name">Last Name:</label>
                <input type="text" id="Last_Name" name="Last_Name">
            </div>
            
            <!--Input Date of Birth in dd/mm/yyyy formart-->
            <div class="form-group">
                <label for="DOB">Date of Birth:</label>
                <input type="text" id="DOB" name="DOB" placeholder="dd/mm/yyyy">
            </div>
                
            <!--Fieldset for Gender Selection-->
            <div class="form-group">
                <fieldset>
                    <legend>Select your gender</legend>
                    <div class="radio-group" style= "font-weight: normal">
                        <!--Select Male Radio Button-->
                        <input type="radio" id="Male" name="Gender" value="Male">
                        <label for="Male">Male</label>

                        <!--Select Female Radio Button-->
                        <input type="radio" id="Female" name="Gender" value="Female">
                        <label for="Female">Female</label>
                            
                        <!--Select Other Radio Button-->
                        <input type="radio" id="Other" name="Gender" value="Other">
                        <label for="Other">Other</label>
                    </div>
                </fieldset>
            </div>
        </section>
            
        <!-- SECTION 3: ADDRESS DETAILS -->
        <section class="form-section">
            <h2>Address Details</h2>
            <div class="form-group">
                <!--Input for Street Address, max of 40 characters-->
                <label for="Street_Address">Street Address:</label>
                <input type="text" id="Street_Address" name="Street_Address">
            </div>
                
            <div class="form-group">
                <!--Input for Suburb/Town, max of 40 characters-->
                <label for="Suburb/Town">Suburb:</label>
                <input type="text" id="Suburb/Town" name="Suburb/Town">
            </div>
                
            <div class="form-group">
                <!--Select Box for States-->
                <label for="State">State:</label>
                <select id="State" name="State">
                    <!--Initial 0ption when selected-->
                    <option value="" disabled selected>Select your state</option>
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
                <label for="Postcode">Postcode:</label>
                <input type="text" id="Postcode" name="Postcode">
            </div>
        </section>
            
        <!-- SECTION 4: CONTACT DETAILS -->
        <section class="form-section">
            <!-- Section Heading-->
            <h2>Contact Details</h2>

            <div class="form-group">
                <!--Input Email Link-->
                <label for="Email">Email:</label>
                <input type="email" id="Email" name="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Enter a valid email address">
            </div>
                
            <div class="form-group">
                <!--Input Phone Number-->
                <label for="Phone">Phone Number:</label>
                <input type="tel" id="Phone" name="Phone" required pattern="\d{8,12}" maxlength="12" title="8-12 Digit Phone Number">
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
                            <div>
                                <dt><input type="checkbox" id="Skill1" name="Skills[]" value="Programming" required title="Select at least one skill"></dt>
                                <dd><label for="Skill1">Programming</label></dd>
                            </div>

                            <!--Web Development Checkbox-->
                            <div>
                                <dt><input type="checkbox" id="Skill2" name="Skills[]" value="Web Development"></dt>
                                <dd><label for="Skill2">Web Development</label></dd>
                            </div>

                            <!--Data Analysis Checkbox-->
                            <div>
                                <dt><input type="checkbox" id="Skill3" name="Skills[]" value="Data Analysis"></dt>
                                <dd><label for="Skill3">Data Analysis</label></dd>
                            </div>

                            <!--Project Management Checkbox-->
                            <div>
                                <dt><input type="checkbox" id="Skill4" name="Skills[]" value="Project Management"></dt>
                                <dd><label for="Skill4">Project Management</label></dd>
                            </div>

                            <!--Cybersecurity Checkbox-->
                            <div>
                                <dt><input type="checkbox" id="Skill5" name="Skills[]" value="Cybersecurity"></dt>
                                <dd><label for="Skill5">Cybersecurity</label></dd>
                            </div>

                            <!--Cloud Computing Checkbox-->
                            <div>
                                <dt><input type="checkbox" id="Skill6" name="Skills[]" value="Cloud Computing"></dt>
                                <dd><label for="Skill6">Cloud Computing</label></dd>
                            </div>

                            <!--AI and Machine Checkbox-->
                            <div>
                                <dt><input type="checkbox" id="Skill7" name="Skills[]" value="AI and Machine Learning"></dt>
                                <dd><label for="Skill7">AI and Machine Learning</label></dd>
                            </div>

                            <!--Other Checkbox-->
                            <div>
                                <dt><input type="checkbox" id="Skill8" name="Skills[]" value="Other"></dt>
                                <dd><label for="Skill8">Other</label></dd>
                            </div>
                        </dl>
                    </div>
                </fieldset>
            </div>
                
            <div class="form-group">
                <label for="Other_Skills">If Other, please specify:</label>
                <textarea id="Other_Skills" name="Other_Skills" rows="5"></textarea>
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