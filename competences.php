<?php
session_start(); // demarre une session pour stocker des donnees

// si la session 'competences' n'existe pas encore, on l'initialise
if (!isset($_SESSION['competences']) || !is_array($_SESSION['competences'])) {
    $_SESSION['competences'] = [
        ['nom' => 'C', 'niveau' => 4],
        ['nom' => 'C++', 'niveau' => 3],
        ['nom' => 'HTML', 'niveau' => 5],
        ['nom' => 'CSS', 'niveau' => 4],
        ['nom' => 'PHP', 'niveau' => 4],
        ['nom' => 'Python', 'niveau' => 5],
    ];
}

// on recupere les competences depuis la session
$competences = $_SESSION['competences'];
?>

<!DOCTYPE html> // fichier html5
<html lang="fr"> // langue francaise
<head>
    <meta charset="UTF-8"> // encodage des caracteres
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> // adapte la page aux ecrans
    <link rel="stylesheet" href="competences.css"> // lien vers le style css de la page
    <title>Portfolio - Competences</title> // titre de la page
</head>
<body>

    <header>
        <h1>Mes Competences</h1>
        <nav>
            // liens de navigation entre les pages
            <a href="index.php">Accueil</a>
            <a href="competences.php">Competences</a>
            <a href="backoffice.php">Backoffice</a>
        </nav>
    </header>

    <div class="container">
        <h2>Liste de mes competences</h2>
        <table>
            <thead>
                <tr><th>Competence</th><th>Niveau de maitrise</th></tr> // en-tetes du tableau
            </thead>
            <tbody>
                <?php foreach ($competences as $competence): ?> // boucle sur chaque competence
                    <tr>
                        <td><?php echo htmlspecialchars($competence['nom']); ?></td> // nom de la competence
                        <td>
                            <div class="niveau-bar">
                                // barre de progression selon le niveau
                                <div style="width: <?php echo ($competence['niveau'] / 5) * 100; ?>%;"></div>
                            </div>
                            <span><?php echo $competence['niveau']; ?> / 5</span> // texte du niveau
                        </td>
                    </tr>
                <?php endforeach; ?> // fin de la boucle
            </tbody>
        </table>
    </div>

</body>
</html>
