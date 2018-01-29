
<?php
if(isset($_POST['email'])) {
 
    
    $email_to = "labas@gmail.com";
    $email_subject = "Tema";
 
    function died($error) {
        // if error
        echo "Įvyko klaida ";
        echo "Ištaisykite klaidas.<br /><br />";
        echo $error."Ištaisykite klaidas.<br /><br />";
        echo "<br /><br />";
        die();
    }
 
 
    // validation
    if(!isset($_POST['first_name']) ||
        
        !isset($_POST['email']) ||
        !isset($_POST['subject']) ||
        !isset($_POST['comments'])) {
        died('Įvyko klaida');       
    }
 
     
 
    $first_name = $_POST['first_name']; // required
    
    $email_from = $_POST['email']; // required
    $subject = $_POST['subject']; // not required
    $comments = $_POST['comments']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Neteisingai įvestas paštas.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'Neteisingai įvestas vardas.<br />';
  }
 
  
 
  if(strlen($comments) < 2) {
    $error_message .= 'Neteisingas tekstas.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Vardas: ".clean_string($first_name)."\n";
    
    $email_message .= "El. paštas: ".clean_string($email_from)."\n";
    $email_message .= "Tema: ".clean_string($subject)."\n";
    $email_message .= "Žinutė: ".clean_string($comments)."\n";
 
// headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- success message -->
 
Aciu
<?php
$url = $_SERVER['HTTP_REFERER']; // right back to the referrer page from where you came.
echo '<meta http-equiv="refresh" content="3;URL=' . $url . '">';
?> 
 
<?php
 
}
?>

