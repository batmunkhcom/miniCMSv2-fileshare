<?

function mbmSendEmail($from = 'BATMUNKH Moltov|admin@mng.cc', $to = 'M.Batmunkh|info@mng.cc', $subject = 'hi. test', $content = 'test') {

    $from = explode("|", $from);
    $to = explode("|", $to);





    $mail = $GLOBALS['PHPMAILER']; // defaults to using php "mail()"

    $body = $content;
    $body = eregi_replace("[\]", '', $body);

    $mail->AddReplyTo($from[1], $from[0]);

    $mail->From = $from[1];
    $mail->FromName = $from[0];

//    $mail->AddReplyTo("name@yourdomain.com", "First Last");

    $address = $to[1];
    $mail->AddAddress($address, $to[0]);

    $mail->Subject = $subject;

//    $mail->AltBody = ""; // optional, comment out and test

    $mail->Body = ($body);

//    $mail->AddAttachment("images/phpmailer.gif");      // attachment
//    $mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

    if (!$mail->Send()) {
        return 0;
    } else {
        return 1;
    }




    /*
      $mail = new PHPMailer();

      $body = file_get_contents('contents.html');
      $body = eregi_replace("[\]", '', $body);

      $mail->IsSMTP(); // telling the class to use SMTP
      $mail->Host = "mail.ndc.gov.mn"; // SMTP server
      $mail->SMTPDebug = 2;                     // enables SMTP debug information (for testing)
      // 1 = errors and messages
      // 2 = messages only
      $mail->SMTPAuth = true;                  // enable SMTP authentication
      $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
      $mail->Host = "mail.ndc.gov.mn";      // sets GMAIL as the SMTP server
      $mail->Port = 587;                   // set the SMTP port for the GMAIL server
      $mail->Username = "batmunkh@ndc.gov.mn";  // GMAIL username
      $mail->Password = "marlboro";            // GMAIL password

      $mail->SetFrom('do_not_reply@ndc.gov.mn', 'MNDC');

      $mail->AddReplyTo("name@yourdomain.com", "First Last");

      $mail->Subject = "PHPMailer Test Subject via smtp (Gmail), basic";

      $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

      $mail->MsgHTML($body);

      $address = "whoto@otherdomain.com";
      $mail->AddAddress($address, "John Doe");

      //    $mail->AddAttachment("images/phpmailer.gif");      // attachment
      //    $mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

      if (!$mail->Send()) {
      return 0;
      } else {
      return 1;
      }
     */
}

function mbmCheckEmail($email) {
    if (!eregi("^[a-z]+[a-z0-9_-]*(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.([a-z]+){2,}$", $email)) {
        return false; // invalid email address
    } else {
        return true;
    }
}

?>