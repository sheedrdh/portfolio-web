<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et sécurisation des données
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));
    
    // Validation de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.html?error=email");
        exit();
    }
    
    // Configuration de l'email
    $to = "votre.email@example.com"; // Remplacez par votre email
    $subject = "Contact Portfolio - $prenom $nom";
    $body = "Nouveau message de contact:\n\n";
    $body .= "Nom: $nom\n";
    $body .= "Prénom: $prenom\n";
    $body .= "Email: $email\n\n";
    $body .= "Message:\n$message";
    
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Envoi de l'email
    if (mail($to, $subject, $body, $headers)) {
        header("Location: index.html?success=1");
    } else {
        header("Location: index.html?error=1");
    }
    exit();
}
?>