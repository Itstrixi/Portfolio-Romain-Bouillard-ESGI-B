<!DOCTYPE html> // declare un document html5
<html lang="fr"> // debut du document en francais
<head>
    <meta charset="UTF-8"> // permet d'afficher les caracteres speciaux correctement
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> // rend le site adaptable sur mobile
    <link rel="stylesheet" href="index.css"> // relie le fichier css pour le style
    <title>Portfolio - Accueil</title> // titre qui s'affiche dans l'onglet
</head>

<body> // debut du contenu visible

<header>
    <h1>Bienvenue sur mon Portfolio</h1>
    <nav>
        // menu pour naviguer entre les pages
        <a href="index.php">Accueil</a>
        <a href="competences.php">Competences</a>
        <a href="backoffice.php">Backoffice</a>
    </nav>
</header>

<div class="container">
    // image de profil
    <img src="imagemoto.jpg" alt="Photo de profil" class="profile-img">

    // section a propos
    <h2>a propos de moi</h2>
    <p>je suis passionne par les <strong>jeux video</strong>, l'<strong>informatique</strong> et le <strong>sport</strong>. j'aime apprendre de nouvelles choses et developper mes competences.</p>

    // liste des competences
    <h2>competences</h2>
    <ul>
        <li>C</li>
        <li>C++</li>
        <li>HTML</li>
        <li>CSS</li>
        <li>PHP</li>
        <li>Python</li>
    </ul>
</div>

</body>
</html>
