<!DOCTYPE html>
<html>
<head>
    <title>CV</title>
</head>
<body>

<h1>CV de {{ $student->name }} {{ $student->prenom }}</h1>

<p><strong>Centre d'intérêt :</strong> {{ $cv->centre_interet }}</p>

<p><strong>Expérience :</strong> {{ $cv->experience }}</p>

<p><strong>Formation :</strong> {{ $cv->formation }}</p>

<p><strong>Compétences :</strong> {{ $cv->competence }}</p>

<p><strong>Certifications :</strong> {{ $cv->certification }}</p>

</body>
</html>