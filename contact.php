<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset = "utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Maggie's Magic Cleaning - Contact Us</title>
        <link rel="stylesheet" href = "css/mystyle.css">
        <link rel="stylesheet" href = "https://fonts.googleapis.com/css2?family=Inter">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    </head>
    <body>

    <?php
    //defines variables and sets them to empty values
    $fnameErr = $lnameErr = $emailErr = "";
    $fname = $lname = $email = $textbox = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty($_POST["fname"])) {
            $fnameErr = "First name required";
        }
        else {
            $name = test_input($_POST["fname"]);
            //check for only letters and whitespace
            if(!preg_match("/^[a-zA-z-' ]*$/", $fname)) {
                $fnameErr = "Only letters and white space allowed";
            }
        }

        if(empty($_POST["lname"])) {
            $lnameErr = "Last name required";
        }
        else {
            $lname = test_input($_POST["lname"]);
            //check for only letters and whitespace
            if(!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
                $lnameErr = "Only letters and white space allowed";
            }
        }

        if(empty($_POST["email"])) {
            $emailErr = "Email required";
        }
        else {
            $email = test_input($_POST["email"]);
            //check for proper email
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email";
            }
        }

        if(empty($_POST["textbox"])) {
            $textbox = "";
        }
        else {
            $textbox = test_input($_POST["textbox"]);
        }

        if(empty($fnameErr) && empty($lnameErr) && empty($emailErr)) {
            $to = "abrahamlovescoc@gmail.com"; //FIX ME: UPDATE AFTER TESTING

            $subject = "New Contact Form Submission";

            $body = "First Name: $fname\n";
            $body .= "Last Name: $lname\n";
            $body .= "Email: $email\n";
            $body .= "Message:\n$textbox";

            $headers = "From: no-reply@gmail.com\r\nReply-To: $email\r\n";

            if(mail($to, $subject, $body, $headers)) {
                echo "<p class='success'>Message sent successfully!</p>";
            }
            else {
                echo "<p class='error'>Message failed to send. Please try again later.</p>";
            }

        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>

        <!-- NAVIGATION BAR -->
        <div class="topnav">
            <div class="topnav-right">
                <a href="index.html">Home</a>
                <a href="aboutus.html">About Us</a>
                <a class="active" href="contact.html">Contact Us</a>
            </div>
        </div>

        <!-- PAGE CONTENT -->
        <div class="page-content contact" id="contact-fade-target">
            <h1>Contact Us</h1>
            <h2>Questions? Feel free to contact us through email!</h2>
            <p><span class="error">* required field</p>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form">
                    <div class="form-group">
                        <label for="fname">First Name</label><br>
                        <input type="text" id="fname" name="fname" value="<?php echo $fname;?>" required><br>
                        <span class="error">* <?php echo $fnameErr;?></span>
                    </div>  
                    <div class="form-group"> 
                        <label for="lname">Last Name</label><br>
                        <input type="text" id="lname" name="lname" value="<?php echo $lname;?>" required><br>
                        <span class="error">* <?php echo $lnameErr;?></span>
                    </div>
                    <div class="form-group"> 
                        <label for="email">Email</label><br>
                        <input type="email" id="email" name="email" value="<?php echo $email;?>" required><br>
                        <span class="error">* <?php echo $email;?></span>
                    </div>
                    <div class="form-group"> 
                        <div class="messagebox">
                            <label for="textbox">Enter Message</label><br>
                            <textarea id="textbox" name="textbox" placeholder="Add extra details here"><?php echo $textbox;?></textarea><br>
                        </div>
                        <input type="submit" value="Submit">
                    </div>
                </div>
            </form>

            <?php
            echo "<h2>Your Input:</h2>";
            echo $fname;
            echo "<br>";
            echo $lname;
            echo "<br>";
            echo $email;
            echo "<br>";
            echo $texbox;
            ?>

        </div>
        
        <script>
            const fadeTarget = document.getElementById("contact-fade-target");

            if(!sessionStorage.getItem("contactPageSeen")) {
                fadeTarget.classList.add("fade-in");
                sessionStorage.setItem("contactPageSeen", "true");
            }
        </script>

    </body>
</html>