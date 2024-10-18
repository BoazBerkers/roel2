<?php
// Check of het formulier is ingediend via POST-methode
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Haal de ingevoerde gegevens op en valideer ze
    $naam = isset($_POST['naam']) ? htmlspecialchars(trim($_POST['naam'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
    $website = isset($_POST['website']) ? htmlspecialchars(trim($_POST['website'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';
    
    // Controleer of alle velden zijn ingevuld
    if (!empty($naam) && !empty($email) && !empty($phone) && !empty($website) && !empty($message)) {
        
        // Valideer het e-mailadres
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            // E-mailinstellingen
            $to = "boaz@birchweb.nl";  // Verander dit naar jouw e-mailadres
            $subject = "Nieuwe aanvraag website scan";
            $body = "Naam: $naam\nE-mail: $email\nTelefoon: $phone\nWebsite: $website\nBericht:\n$message";
            $headers = "From: $email\r\nReply-To: $email";

            // Verstuur de e-mail
            if (mail($to, $subject, $body, $headers)) {
                echo "Bedankt voor je bericht! We nemen zo snel mogelijk contact met je op.";
            } else {
                echo "Er ging iets mis tijdens het versturen van je bericht. Probeer het later opnieuw.";
            }
        } else {
            echo "Ongeldig e-mailadres.";
        }
    } else {
        echo "Vul alle velden in.";
    }
}
?>
