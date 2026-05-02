<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau mot de passe NextLink</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f7fb; color: #1f2937; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: #ffffff; padding: 30px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
        <h2 style="color: #3b82f6;">Réinitialisation de votre mot de passe</h2>
        <p>Bonjour {{ $user->prenom ?? $user->name }},</p>
        <p>Une demande de réinitialisation a été validée. Votre nouveau mot de passe temporaire est :</p>
        <p style="font-size: 18px; font-weight: 700; color: #111827;">{{ $password }}</p>
        <p>Utilisez-le pour vous connecter, puis changez-le dès que possible.</p>
        <p style="margin-top: 24px;">Merci,<br>Équipe NextLink</p>
    </div>
</body>
</html>
