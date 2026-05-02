<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue sur NextLink</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f4f4f7; padding: 24px;">
    <div style="max-width: 640px; margin: auto; background: #fff; padding: 24px; border-radius: 16px;">
        <h1>Bienvenue sur NextLink</h1>
        <p>Bonjour {{ $etudiant->prenom }} {{ $etudiant->name }},</p>
        <p>Votre enseignant <strong>{{ $enseignant->full_name }}</strong> vous a ajouté à la plateforme NextLink.</p>
        <p>Vous pouvez vous connecter avec :</p>
        <ul>
            <li><strong>Email :</strong> {{ $etudiant->email }}</li>
            <li><strong>Mot de passe :</strong> {{ $plainPassword }}</li>
        </ul>
        <p>Changez votre mot de passe dès votre première connexion.</p>
        <p>Bonne continuation,<br>Équipe NextLink</p>
    </div>
</body>
</html>
