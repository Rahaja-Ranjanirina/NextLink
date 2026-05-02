<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>NextLink - Identifiants Étudiant</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#04081a; color:#fff; padding:20px;">
    <div style="max-width:600px; margin:auto; background: rgba(0,0,0,0.7); padding:30px; border-radius:15px;">
        <h2 style="color:#00d2ff;">Bonjour {{ $student->prenom }} {{ $student->name }}</h2>
        <p>Votre compte NextLink a été créé avec succès !</p>
        <p><strong>Email :</strong> {{ $student->email }}</p>
        <p><strong>Mot de passe :</strong> {{ $password }}</p>
        <p>Nous vous recommandons de changer votre mot de passe après votre première connexion.</p>
        <p style="margin-top:20px;">Merci,<br>NextLink Team</p>
    </div>
</body>
</html>
