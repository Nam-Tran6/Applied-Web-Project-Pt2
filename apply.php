<?php
session_start();

// Pull errors & old input from session
$errors = $_SESSION['errors'] ?? [];
$old    = $_SESSION['old'] ?? [];

// Helpers (Credits to Youtube: Dani Krossing and ChatGPT)
// Escape output safely to prevent XSS attacks
function e($v){ 
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); 
}

// Get previously entered value for a field (to repopulate after validation fail)
function old($key, $default=''){ 
    global $old; 
    return e($old[$key] ?? $default); 
}

// Keep radio button checked if user selected it before
function checked_radio($name, $value){ 
    global $old; 
    return (isset($old[$name]) && $old[$name] === $value) ? ' checked' : ''; 
}

// Keep dropdown option selected if user chose it before
function selected($name, $value){ 
    global $old; 
    return (isset($old[$name]) && $old[$name] === $value) ? ' selected' : ''; 
}

// Keep checkbox checked if user selected it before
function checked_box($name, $value){
    global $old;
    $arr = $old[$name] ?? [];
    return (is_array($arr) && in_array($value, $arr, true)) ? ' checked' : '';
}

// Display error message under a form field (in red text)
function err($field){ 
    global $errors; 
    return !empty($errors[$field]) 
        ? "<span class='error' style='color:#c0392b;display:block;margin-top:.25rem;font-size:.9rem;'>".e($errors[$field])."</span>" 
        : ""; 
}
?>

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
            background: url(styles/images/back_apply.png);
            
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

        #main_h2 {
            text-align:center; 
            color: #ccc;
            background-color: #1a1a1a;
        }

        .skills-list dd {
            margin-bottom: 0.5em; /* spacing between checkbox */
        }
    </style>
</head>

<body>
    <?php include "header.inc"; ?>
    
    <main>

        <!--H2 Heading for Application Form-->
        <h2 id="main_h2">Tech Talent Application Form</h2>
<?php if (!empty($_SESSION['eoi_number'])): ?> 
        <p style="text-align:center;color:#0a7a0a;font-weight:bold;">
        ✅ Application submitted successfully! <br>
        Your unique EOI number is:
        <span style="color:#0a7a0a;">EOI-<?= str_pad($_SESSION['eoi_number'], 5, '0', STR_PAD_LEFT) ?> </span>
    </p>

<?php 
    unset($_SESSION['eoi_number']); // clear it so it doesn't reappear after refresh
endif; 
?>
<!-- Credit to Youtube: Dani Krossing and ChatGPT for the error display functions -->

        
        <form action="process_eoi.php" method="POST" aria-labelledby="main_h2">

        <!-- SECTION 1: JOB DETAILS -->
        <section class="form-section" aria-labelledby="job_details_heading">
            <h2 id="job_details_heading">Job Details</h2>
            <div class="form-group">
                <label for="job_reference_number">Job Reference Number:
                </label>
                <input type="text" id="job_reference_number" name="Job_Reference_Number" 
                value="<?= old('Job_Reference_Number') ?>" aria-labelledby="job_reference_number">
                <?= err('job_ref') ?>
            </div>
        </section>
            
        <!-- SECTION 2: PERSONAL DETAILS -->
        <section class="form-section" aria-labelledby="personal_details_heading">
            <h2 id="personal_details_heading">Personal Details</h2>

            <div class="form-group">

                <label id="label_firstname" for="First_Name">First Name:</label>
                <input type="text" id="First_Name" name="First_Name" 
                value="<?= old('First_Name') ?>" aria-labelledby="label_firstname">
                <?= err('first_name') ?>

            </div>

            <div class="form-group">
                <label id="label_lastname" for="Last_Name">Last Name:</label>
                <input type="text" id="Last_Name" name="Last_Name" 
                value="<?= old('Last_Name') ?>" aria-labelledby="label_lastname">
                <?= err('last_name') ?>
            </div>
            
            <div class="form-group">
                <label id="label_dob" for="DOB">Date of Birth:</label>
                <input type="text" id="DOB" name="DOB" placeholder="yyyy/mm/dd" 
                value="<?= old('DOB') ?>" aria-labelledby="label_dob">
                <?= err('dob') ?>
            </div>
                
            <div class="form-group">
                <fieldset aria-labelledby="gender_legend">
                    <legend id="gender_legend">Select your gender</legend>
                    <div class="radio-group" style="font-weight: normal">
                        <input type="radio" id="male" name="Gender" value="Male" <?= checked_radio('Gender','Male') ?>>
                        <label for="male">Male</label>

                        <input type="radio" id="female" name="Gender" value="Female" <?= checked_radio('Gender','Female') ?>>
                        <label for="female">Female</label>
                            
                        <input type="radio" id="other" name="Gender" value="Other" <?= checked_radio('Gender','Other') ?>>
                        <label for="other">Other</label>
                    </div>
                    <?= err('gender') ?>
                </fieldset>
            </div>
        </section>
            
        <!-- SECTION 3: ADDRESS DETAILS -->
        <section class="form-section" aria-labelledby="address_details_heading">
            <h2 id="address_details_heading">Address Details</h2>
            <div class="form-group">

                <label id="label_street" for="street_address">Street Address:</label>
                <input type="text" id="street_address" name="Street_Address" 
                value="<?= old('Street_Address') ?>" aria-labelledby="label_street">
                <?= err('address') ?>
            </div>
                
            <div class="form-group">
                <label id="label_suburb" for="suburb_town">Suburb:</label>
                <input type="text" id="suburb_town" name="Suburb_Town" 
                value="<?= old('Suburb_Town') ?>" aria-labelledby="label_suburb">
                <?= err('suburb') ?>
            </div>     
                
            <div class="form-group">
                <label id="label_state" for="state">State:</label>
                <select id="state" name="State" aria-labelledby="label_state">
                    <option value="" disabled <?= (old('State')===''?' selected':'') ?>>Select your state</option>
                    <option value="VIC" <?= selected('State','VIC') ?>>VIC</option>
                    <option value="NSW" <?= selected('State','NSW') ?>>NSW</option>
                    <option value="QLD" <?= selected('State','QLD') ?>>QLD</option>
                    <option value="NT" <?= selected('State','NT') ?>>NT</option>
                    <option value="WA" <?= selected('State','WA') ?>>WA</option>
                    <option value="SA" <?= selected('State','SA') ?>>SA</option>
                    <option value="TAS" <?= selected('State','TAS') ?>>TAS</option>
                    <option value="ACT" <?= selected('State','ACT') ?>>ACT</option>
                </select>
                <?= err('state') ?>
            </div>

            <div class="form-group">
                <label id="label_postcode" for="postcode">Postcode:</label>
                <input type="text" id="postcode" name="Postcode" 
                value="<?= old('Postcode') ?>" aria-labelledby="label_postcode">
                <?= err('postcode') ?>
            </div>
        </section>
            
        <!-- SECTION 4: CONTACT DETAILS -->
        <section class="form-section" aria-labelledby="contact_details_heading">
            <h2 id="contact_details_heading">Contact Details</h2>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="Email" value="<?= old('Email') ?>">
                <?= err('email') ?>
            </div>
                
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="Phone" value="<?= old('Phone') ?>">
                <?= err('phone') ?>
            </div>
        </section>
            
        <!-- SECTION 5: SKILLS AND EXPERIENCE -->
        <section class="form-section" aria-labelledby="skills_heading">
            <h2 id="skills_heading">Skills and Experience</h2>
            
            <div class="form-group">
                <fieldset aria-labelledby="skills_legend">
                    <legend id="skills_legend">Select Your Skills:</legend>
                    <div class="checkbox-group">
                        <dl class="skills-list">
                            <!--Checkbox for Programming-->
                            <div><dt><input type="checkbox" id="Skill1" name="skills[]" value="Programming" 
                            <?= checked_box('skills','Programming') ?>></dt><dd><label for="Skill1">Programming</label></dd></div>

                            <!--Checkbox for Web Programming-->
                            <div><dt><input type="checkbox" id="Skill2" name="skills[]" value="Web Development" 
                            <?= checked_box('skills','Web Development') ?>></dt><dd><label for="Skill2">Web Development</label></dd></div>

                            <!--Checkbox for Data Analysis-->
                            <div><dt><input type="checkbox" id="Skill3" name="skills[]" value="Data Analysis" 
                            <?= checked_box('skills','Data Analysis') ?>></dt><dd><label for="Skill3">Data Analysis</label></dd></div>

                            <!--Checkbox for Project Management-->
                            <div><dt><input type="checkbox" id="Skill4" name="skills[]" value="Project Management" 
                            <?= checked_box('skills','Project Management') ?>></dt><dd><label for="Skill4">Project Management</label></dd></div>

                            <!--Checkbox for Project Cybersecurity-->
                            <div><dt><input type="checkbox" id="Skill5" name="skills[]" value="Cybersecurity" 
                            <?= checked_box('skills','Cybersecurity') ?>></dt><dd><label for="Skill5">Cybersecurity</label></dd></div>

                            <!--Checkbox for Project Cloud Computing-->
                            <div><dt><input type="checkbox" id="Skill6" name="skills[]" value="Cloud Computing" 
                            <?= checked_box('skills','Cloud Computing') ?>></dt><dd><label for="Skill6">Cloud Computing</label></dd></div>

                            <!--Checkbox for AI and Machine Learning-->
                            <div><dt><input type="checkbox" id="Skill7" name="skills[]" value="AI and Machine Learning" 
                            <?= checked_box('skills','AI and Machine Learning') ?>></dt><dd><label for="Skill7">AI and Machine Learning</label></dd></div>

                            <!--Checkbox for Other-->
                            <div><dt><input type="checkbox" id="Skill8" name="skills[]" value="Other" 
                            <?= checked_box('skills','Other') ?>></dt><dd><label for="Skill8">Other</label></dd></div>
                        </dl>
                    </div>
                    <?= err('skills') ?>
                </fieldset>
            </div>
                
            <div class="form-group">
                <label id="label_other_skills" for="other_skills">If Other, please specify:</label>
                <textarea id="other_skills" name="Other_Skills" rows="5" aria-labelledby="label_other_skills">
                <?= old('Other_Skills') ?></textarea>
            </div>
        </section>

        <!-- SECTION 6: FORM CONTROL -->
        <div class="form-actions">
            <input type="submit" value="Submit Application">
            <input type="reset" value="Reset Application Form">
        </div>
        </form>
    </main>

    <?php
        unset($_SESSION['errors'], $_SESSION['old']); // clear session after render
        include "footer.inc";
    ?>
</body>
</html>
