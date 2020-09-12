<?php


$message = '';

function clean_text($string)
{
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

if(isset($_POST["name"]) && isset($_POST['email']))
{
    $message = '
        <h3 align="center">User Details</h3>
        <table border="1" width="100%" cellpadding="5" cellspacing="5">
            <tr>
                <td width="30%">Name</td>
                <td width="70%">'.$_POST["name"].'</td>
            </tr>
            <tr>
                <td width="30%">Email</td>
                <td width="70%">'.$_POST["email"].'</td>
            </tr>
            <tr>
                <td width="30%">Phone</td>
                <td width="70%">'.$_POST["phone"].'</td>
            </tr>
           
            <tr>
                <td width="30%">message</td>
                <td width="70%">'.$_POST["message"].'</td>
            </tr>
        </table>
    ';
    echo $message;
    require 'class/class.phpmailer.php';
    $mail = new PHPMailer;
    $mail->IsSMTP();                                //Sets Mailer to send message using SMTP
    $mail->Host = 'mail.musaib.heliohost.org';       //Sets the SMTP hosts of your Email hosting, this for Godaddy
    $mail->Port = '587';                                //Sets the default SMTP server port
    $mail->SMTPAuth = true;                         //Sets SMTP authentication. Utilizes the Username and Password variables
    $mail->Username = 'findmusaib@musaib.heliohost.org';                    //Sets SMTP username
    $mail->Password = 'mdmusaibK66';                    //Sets SMTP password
                                //Sets connection prefix. Options are "", "ssl" or "tls"
    $mail->From = $_POST["email"];                  //Sets the From email address for the message
    $mail->FromName = "Mail Sender====>".$_POST["name"];               //Sets the From name of the message
    $mail->AddAddress('musaibkm@gmail.com', 'Mail System');      //Adds a "To" address
    $mail->WordWrap = 50;                           //Sets word wrapping on the body of the message to a given number of characters
    $mail->IsHTML(true);                            //Sets message type to HTML
    
    $mail->Subject = 'USER QUERY->Portfolio-Musaib';             //Sets the Subject of the message
    $mail->Body = $message;                         //An HTML or plain text message body
    if($mail->Send())                               //Send an Email. Return true on success or false on error
    {
        $msg = 'success';
        echo '<script>alert("Mail Sent Successfully!Thank You");window.location.href="index.html";</script>'
      
    }
    else
    {
        $message = 'Mail Could Not Be Sent!';
        echo $message;
        echo '<script>alert("Mail Could Not Be Sent!Something Internal Error Please confirm your Details are correct");window.location.href="index.html/#contact";</script>';
    }
}
?>