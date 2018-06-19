<?php

    // Replace this with your own email address
    $siteOwnersEmail = 'info@ultragreencoffee-nigeria.com, UltraGreenCoffeenigeria@gmail.com';


    if($_POST) {

        $name = trim(stripslashes($_POST['contactName']));
        $address = trim(stripslashes($_POST['address']));
        $email = trim(stripslashes($_POST['contactEmail']));
        $phone = trim(stripslashes($_POST['phone']));
        $itemNum = trim(stripslashes($_POST['itemNum']));

        // Check Name
        if (strlen($name) < 2) {
            $error['name'] = "Please enter your name.";
        }
        // Check Address
        if (strlen($address) < 10) {
            $error['address'] = "Please enter correctly your address, specify land mark.";
        }
        // Check Email
        if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
            $error['email'] = "Please enter a valid email address.";
        }
        //Check Phone
        if (strlen($phone) < 10) {
            $error['phone'] = "Please enter your Phone number.";
        }
        // Check Message
        if (strlen($itemNum) < 1) {
            $error['itemNum'] = "Please enter your message. It should have at least 15 characters.";
        }

        // Set Message
        $message .= "Email from: " . $name . "<br />";
        $message .= "Client address: " . $address . "<br />";
        $message .= "Email address: " . $email . "<br />";
        $message .= "Phone Number: " .$phone . "<br/>";
        $message .= "Number of Item: " .$itemNum;
        $message .= "<br /> ----- <br /> This email was sent from your site's contact form. <br />";

        // Set From: header
        $from =  $name . " <" . $email . ">";

        // Email Headers
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: ". $email . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


        if (!$error) {

            ini_set("sendmail_from", $siteOwnersEmail); // for windows server
            $mail = mail($siteOwnersEmail, $phone, $message, $headers);

            if ($mail) { echo "OK"; }
            else { echo "Something went wrong. Please try again."; }
            
        } # end if - no validation error

        else {

            $response = (isset($error['name'])) ? $error['name'] . "<br /> \n" : null;
            $response = (isset($error['address'])) ? $error['address'] . "<br /> \n" : null;
            $response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
            $response = (isset($error['phone'])) ? $error['phone'] . "<br /> \n" : null;
            $response .= (isset($error['itemNum'])) ? $error['itemNum'] . "<br />" : null;
            
            echo $response;

        } # end if - there was a validation error

    }

?>