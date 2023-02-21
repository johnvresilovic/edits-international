<?php

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$service = $_POST['service'];
$comments = $_POST['comments'];

//Validate first
if(empty($name)||empty($email)||empty($service)) {
    echo "Name, email and service are required fields.";
    exit;
}

if(IsInjected($email)) {
    echo "This isn't a valid address.";
    exit;
}

$email_from = $email;
$email_subject = "Inquiry";
$email_body = "\nName : $name \nEmail : $email \nPhone : $phone \nService : $service \nComments : $comments";

$to = "nancybdownes@gmail.com";
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank you page.
header('Location: thank-you.html');

// Function to validate against any email injection attempts
function IsInjected($str) {
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str)) {
    return true;
  }
  else {
    return false;
  }
}
?> 
