<?php
if(isset($_POST['email'])) {
     
    // Informations du mail à envoyé
    $email_to = "labigne.adrien@gmail.com";
    $email_subject = "Mail d'un utilisateur Device Versa";
     
     
    function died($error) {
        // Messages d'érreurs
        echo "Nous sommes vraiment désolés, mais il semble y avoir des érreurs dans les informations que vous avez rentrés";
        echo "Les érreurs sont les suivantes.<br /><br />";
        echo $error."<br /><br />";
        echo "Corrigez les pour avoir notre reconnaissance éternel (et envoyer votre message).<br /><br />";
        die();
    }
     
    // Erreurs inattendus lors de la validation 
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {
        died('Nous sommes vraiment désolés, mais il semble y avoir des érreurs dans les informations que vous avez rentrés.');       
    }
     
    $name = $_POST['name']; // Requis
    $email_from = $_POST['email']; // Requis
    $message = $_POST['message']; // Requis
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {    
    $error_message .= "L'adresse mail que vous avez rentré ne semble pas être valide.<br />";
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'Le nom que vous avez entrer ne semble pas être valide.<br />';
  }
  if(strlen($message) < 2) {
    $error_message .= 'Le message que vous avez entrer ne semble pas être valide.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Détails de l'utilisateur.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Nom : ".clean_string($name)."\n";
    $email_message .= "Email : ".clean_string($email_from)."\n";
    $email_message .= "Message : ".clean_string($message)."\n";
      
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();

$mailResponse = mail($email_to, $email_subject, $email_message, $headers);  

if($mailResponse) { //if $mailResponse is True (if the mail was sent)

    header('Location: contact-success.html'); //redirecting to contact-success.html

} else {
    echo "Désolé, il y à eu un problème. Pouvez-vous réessayer ? Merci";   
}

?> 
<?php
}
?>