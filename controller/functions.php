<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Validation for input data
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

// Login Code
    if (isset($_POST['btnLogin'])) {
        $loginEmail = test_input($_POST['loginEmail']);
        $loginPassword = test_input($_POST['loginPassword']);
        $loginError = "";
        if (!empty($loginEmail) && !empty($loginPassword)) {
            $loginQuery = "SELECT * FROM users WHERE Email = '" . $loginEmail . "' AND Password = '" . $loginPassword . "' AND Verified = 'yes'";
            $count = $con->query($loginQuery);
            if ($count->num_rows > 0) {
                while ($loginRow = $count->fetch_assoc()) {
                    if ($loginEmail == $loginRow['Email'] && $loginPassword != $loginRow['Password']) {
                        $loginError = "Invalid Password!";
                    } elseif ($loginEmail == $loginRow['Email'] && $loginPassword == $loginRow['Password']) {
                        $loginError = "";
                        session_start();
                        $_SESSION['userID'] = $loginRow['UserID'];
                        $_SESSION['userFirstName'] = $loginRow['FirstName'];
                        $_SESSION['userLastName'] = $loginRow['LastName'];
                        header('Location: section-groups.php');
                    } else {
                        $loginError = "Your Login Email or Password is invalid";
                    }
                }
            } else {
                $loginError = "Your login email or password is invalid or you did not verify your email!";
            }
        } else {
            $loginError = "Please enter your email and password!";
        }
    }

// Forgot Password
    if (isset($_POST['btnSendPassword'])) {
        $recoveryEmail = $regCode = $forgotPasswordErrorMsg = $forgotPasswordSuccessMsg = $pass = "";
        $recoveryEmail = test_input($_POST['recoveryEmail']);
        $regCode = test_input($_POST['regCode']);
        if (!empty($recoveryEmail) && !empty($regCode)) {
            if (strlen($recoveryEmail) > 50 || !filter_var($recoveryEmail, FILTER_VALIDATE_EMAIL)) {
                $forgotPasswordErrorMsg = "Invalid email format!";
            } elseif (strlen($regCode) > 20 || !preg_match('/^[0-9]+$/', $regCode)) {
                $forgotPasswordErrorMsg = "Invalid registration code!";
            } else {
                if (empty($forgotPasswordErrorMsg)) {
                    $forgotPasswordQ = "SELECT Email,Password,Code FROM users WHERE Email = '" . $recoveryEmail . "' AND Verified = 'yes'";
                    $countPass = $con->query($forgotPasswordQ);
                    if ($countPass->num_rows > 0) {
                        while ($countPassRow = $countPass->fetch_assoc()) {
                            if ($recoveryEmail != $countPassRow['Email']) {
                                $forgotPasswordErrorMsg = "Invalid email!";
                            } elseif ($regCode != $countPassRow['Code']) {
                                $forgotPasswordErrorMsg = "Invalid registration code!";
                            } else {
                                if (empty($forgotPasswordErrorMsg)) {
                                    $forgotPasswordErrorMsg = "";
                                    $pass = $countPassRow['Password'];
//                                    $subject = "Recovery of password";
//                                    $message = "Hi,<br><br>You requested for your password. Here is your password.<br>Password: " . $pass . "<br><br>Best Regards,<br>YourQS<br>Residential | Cost | Estimating";
//                                    $headers = 'MIME-Version: 1.0' . PHP_EOL; // PHP_EOL automatically inserts \r or \n or \r\n as appropriate
//                                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL; // for HTML e-mail, use text/html
//                                    $headers .= 'From: COMPANY_EMAIL@COMPANY.COM'; // This instruction overrides sendmail_from above. IMPORTANT: do not include PHP_EOL here
//                                    mail($recoveryEmail, $subject, $message, $headers); // sends the e-mail
                                    $forgotPasswordSuccessMsg = "We have send your password on your registered email.";
                                }
                            }
                        }
                    } else {
                        $forgotPasswordErrorMsg = "Entered email or registration code is incorrect!";
                    }
                }
            }
        } else {
            $forgotPasswordErrorMsg = "Please enter email and registration code.";
        }
    }

// Register Code
    if (isset($_POST['btnRegister'])) {
        $fname = $lname = $email = $password = $confirmPass = $alreadyReg = "";
        $fname = test_input($_POST['firstName']);
        $lname = test_input($_POST['lastName']);
        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);
        $confirmPass = test_input($_POST['confirmPassword']);
        $errorMessage = $regSuccessMsg = $alreadyReg = "";
        $verifyQ = "SELECT Email FROM users WHERE Email='" . $email . "'";
        $getEmail = $con->query($verifyQ);
        if ($getEmail->num_rows > 0) {
            $alreadyReg = "yes";
        } else {
            $alreadyReg = "no";
        }
        if ($alreadyReg == "no") {
            if (!empty($fname) || !empty($lname) || !empty($email) || !empty($password) || !empty($confirmPass)) {
                if (strlen($fname) > 20 || !preg_match("/^[a-zA-Z ]*$/", $fname)) {
                    $errorMessage = "First Name should be alphabets and not more than 20 characters!";
                } elseif (strlen($lname) > 20 || !preg_match("/^[a-zA-Z ]*$/", $lname)) {
                    $errorMessage = "Last Name should be alphabets and not more than 20 characters!";
                } elseif (strlen($email) > 50 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errorMessage = "Invalid email format!";
                } elseif (strlen($password) > 15) {
                    $errorMessage = "Password cannot be more than 15 characters!";
                } elseif (strlen($confirmPass) > 20) {
                    $errorMessage = "Confirm Password cannot be more than 20 characters!";
                } elseif ($confirmPass != $password) {
                    $errorMessage = "Password and Confirm Password must be same!";
                } else {
                    if (empty($errorMessage)) {
                        $userType = "user";
                        $verified = "no";
                        $randNumber = mt_rand(100, 999);
                        $now = date("dmyhis");
                        $code = $randNumber . $now;
                        $regQuery = "INSERT INTO users(UserType, FirstName, LastName, Email, Password, Verified, Code) VALUES('" . $userType . "','" . $fname . "','" . $lname . "','" . $email . "','" . $password . "','" . $verified . "','" . $code . "')";
                        if ($con->query($regQuery) === TRUE) {
//                            $subject = "Registration code";
//                            $message = "Hi " . $fname . " " . $lname . ",<br><br>Welcome to YourQS!<br><br>Your registration Code is: " . $code . "<br>Steps to register:<br>1) Please click on Verify button from Register section on the website.<br>2) Enter email and registration code to verify your account.<br>That's all you have to do.<br><br><strong>Note: Save your registration code. It is needed if you ever need to change your password.</strong><br><br>Best Regards,<br>YourQS<br>Residential | Cost | Estimating";
//                            $headers = 'MIME-Version: 1.0' . PHP_EOL; // PHP_EOL automatically inserts \r or \n or \r\n as appropriate
//                            $headers .= 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL; // for HTML e-mail, use text/html
//                            $headers .= 'From: COMPANY_EMAIL@COMPANY.COM'; // This instruction overrides sendmail_from above. IMPORTANT: do not include PHP_EOL here
//                            mail($email, $subject, $message, $headers); // sends the e-mail
                            $errorMessage = "";
                            $regSuccessMsg = "We have sent a registration code on your email. Please click on Verify to continue.";
                        } else {
                            echo "Error: " . $regQuery . "<br>" . $con->error;
                        }
                    }
                }
            } else {
                $errorMessage = "All fields are compulsory!";
                $regSuccessMsg = "";
            }
        } else {
            $errorMessage = "This email is already registered. Please enter another email.";
        }
    }

// Verification Code
    if (isset($_POST['btnVerify'])) {
        $verifyErrorMsg = $verifySuccessMsg = $registeredEmail = $verficationCode = $subject = $message = "";
        $registeredEmail = test_input($_POST['registeredEmail']);
        $verficationCode = test_input($_POST['verficationCode']);
        $verifyQ = "SELECT FirstName,LastName,Email,Code FROM users WHERE Email = '" . $registeredEmail . "' AND Verified = 'no'";

        $count = $con->query($verifyQ);
        if ($count->num_rows > 0) {
            while ($verificationRow = $count->fetch_assoc()) {
                if (!empty($registeredEmail) || !empty($verficationCode)) {
                    if (strlen($registeredEmail) > 50 || !filter_var($registeredEmail, FILTER_VALIDATE_EMAIL)) {
                        $verifyErrorMsg = "Email should be valid and not more than 50 characters!";
                    } elseif (strlen($verficationCode) > 15 || preg_match("/^[a-zA-Z ]*$/", $verficationCode)) {
                        $verifyErrorMsg = "Invalid verification code!";
                    } else {
                        if (empty($verifyErrorMsg)) {
                            if ($registeredEmail == $verificationRow['Email']) {
                                if ($verficationCode == $verificationRow['Code']) {
                                    $verifiedFirstName = $verifiedLastName = "";
                                    $verifiedFirstName = $verificationRow['FirstName'];
                                    $verifiedLastName = $verificationRow['LastName'];
                                    $updateRegQ = "UPDATE users SET Verified='yes' WHERE Email='" . $registeredEmail . "'";
                                    if ($con->query($updateRegQ) === TRUE) {
                                        $verifyErrorMsg = "";
//                                        $subject = "Registration successful";
//                                        $message = "Hi " . $verifiedFirstName . " " . $verifiedLastName . ",<br><br>Your have registered successfully.<br><br>Best Regards,<br>YourQS<br>Residential | Cost | Estimating";
//                                        $headers = 'MIME-Version: 1.0' . PHP_EOL; // PHP_EOL automatically inserts \r or \n or \r\n as appropriate
//                                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL; // for HTML e-mail, use text/html
//                                        $headers .= 'From: COMPANY_EMAIL@COMPANY.COM'; // This instruction overrides sendmail_from above. IMPORTANT: do not include PHP_EOL here
//                                        mail($registeredEmail, $subject, $message, $headers); // sends the e-mail
                                        $verifySuccessMsg = "You have registered successfully! <a href='index.php#portfolio' class='btn btn-default'><strong> Login</strong></a> to continue.";
                                    } else {
                                        $verifyErrorMsg = "Invalid verification code or email!";
                                    }
                                } else {
                                    $verifyErrorMsg = "Invalid verification code!";
                                }
                            } else {
                                $verifyErrorMsg = "Invalid email!";
                            }
                        } else {
                            $verifyErrorMsg = "Invalid verification code or email!";
                        }
                    }
                } else {
                    $verifyErrorMsg = "Please enter all fields!";
                }
            }
        } else {
            $verifyErrorMsg = "Invalid verification code or email! Email may be already registered.";
        }
    }
// Contact Us Code
    if (isset($_POST['btnContact'])) {
        $to = "shahutkarshn@rediffmail.com"; // The address that will receive the e-mail
        $contactName = test_input($_POST['contactName']);
        $from = test_input($_POST['contactEmail']); // This is the sender's Email address
        $message = test_input($_POST['message']);
        $subject = "Contact Me";
        if (!empty($contactName) || !empty($from) || !empty($message)) {
            if (strlen($from) > 50) {
                $contactErrorMessage = "Email should be less than 50 characters!";
            } elseif ($contactName > 15) {
                $contactErrorMessage = "Name should be less than 15 characters!";
            } elseif ($message > 65) {
                $contactErrorMessage = "Message should be less than 65 characters!";
            } elseif (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
                $contactErrorMessage = "Invalid Email!";
            } else {
//                $headers = 'MIME-Version: 1.0' . PHP_EOL; // PHP_EOL automatically inserts \r or \n or \r\n as appropriate
//                $headers .= 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL; // for HTML e-mail, use text/html
//                $headers .= 'From: COMPANY_EMAIL@COMPANY.COM'; // This instruction overrides sendmail_from above. IMPORTANT: do not include PHP_EOL here
//                mail($to, $subject, $message, $headers); // sends the e-mail
                $contactSuccessMsg = "Hi,<br><br>Thanks for contacting us! We will reply back soon.<br><br>Best Regards,<br>YourQS<br>Residential | Cost | Estimating";
            }
        } else {
            $contactErrorMessage = "Please enter all fields!";
        }
    }
}
?>