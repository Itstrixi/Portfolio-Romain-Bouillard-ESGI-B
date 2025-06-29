<?php
session_start(); // demarre une session

define('BACKOFFICE_PASSWORD', '1234'); // mot de passe defini pour acceder au backoffice

// initialise l'etat de connexion si pas encore defini
if (!isset($_SESSION['authenticated'])) $_SESSION['authenticated'] = false;

// si l'utilisateur envoie le mot de passe via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    if ($_POST['password'] === BACKOFFICE_PASSWORD) {
        $_SESSION['authenticated'] = true; // connexion valide
        header("Location: backoffice.php"); // recharge la page pour afficher le backoffice
        exit();
    } else $error = "Mot de passe incorrect."; // mot de passe faux
}

// si utilisateur connecte et ajoute une competence
if ($_SESSION['authenticated'] && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom']) && isset($_POST['niveau'])) {
    $nom = trim($_POST['nom']);
    $niveau = (int)$_POST['niveau'];
    if (!empty($nom) && $niveau >= 1 && $niveau <= 5) {
        if (!isset($_SESSION['competences'])) $_SESSION['competences'] = [];
        $_SESSION['competences'][] = ['nom' => $nom, 'niveau' => $niveau]; // ajoute la competence
        $success = "Compétence ajoutée avec succès.";
    } else $error = "Veuillez fournir un nom valide et un niveau entre 1 et 5.";
}

// si l'utilisateur supprime une competence
if (isset($_GET['delete'])) {
    $index = (int)$_GET['delete'];
    if (isset($_SESSION['competences'][$index])) {
        unset($_SESSION['competences'][$index]); // supprime l'entree
        $_SESSION['competences'] = array_values($_SESSION['competences']); // reindexe le tableau
        $success = "Compétence supprimée avec succès.";
    }
}

// si l'utilisateur modifie une competence
if (isset($_POST['edit']) && isset($_POST['new_nom']) && isset($_POST['new_niveau'])) {
    $index = (int)$_POST['edit'];
    if (isset($_SESSION['competences'][$index])) {
        $new_nom = trim($_POST['new_nom']);
        $new_niveau = (int)$_POST['new_niveau'];
        if (!empty($new_nom) && $new_niveau >= 1 && $new_niveau <= 5) {
            $_SESSION['competences'][$index] = ['nom' => $new_nom, 'niveau' => $new_niveau]; // met a jour
            $success = "Compétence modifiée avec succès.";
        } else $error = "Nom ou niveau invalides.";
    }
}

// deconnexion de l'utilisateur
if (isset($_GET['logout'])) {
    $_SESSION['authenticated'] = false;
    header("Location: backoffice.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="backoffice.css"> // style de la page
    <title>Backoffice - Gestion des Compétences</title>
</head>
<body>
    <div class="container">
        <?php if (!$_SESSION['authenticated']): ?> 
            // formulaire de connexion au backoffice
            <h1>Connexion au Backoffice</h1>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            <form method="POST">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Se connecter</button>
            </form>
            <div class="navigation">
                <a href="index.php">Retour a l'accueil</a>
                <a href="competences.php">Voir les competences</a>
            </div>
        <?php else: ?>
            // interface de gestion des competences
            <h1>Gestion des Compétences</h1>
            <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            
            // formulaire pour ajouter une competence
            <form method="POST">
                <h2>Ajouter une compétence</h2>
                <label for="nom">Nom de la compétence :</label>
                <input type="text" id="nom" name="nom" required>
                <label for="niveau">Niveau de maîtrise :</label>
                <select id="niveau" name="niveau" required>
                    <option value="1">1 - Débutant</option>
                    <option value="2">2 - Intermédiaire</option>
                    <option value="3">3 - Bon</option>
                    <option value="4">4 - Avancé</option>
                    <option value="5">5 - Expert</option>
                </select>
                <button type="submit">Ajouter</button>
            </form>

            // affichage de la liste des competences
            <div class="competence-list">
                <h2>Liste des Compétences</h2>
                <table>
                    <thead>
                        <tr><th>Nom</th><th>Niveau</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        <?php if (isset($_SESSION['competences']) && count($_SESSION['competences']) > 0): ?>
                            <?php foreach ($_SESSION['competences'] as $index => $competence): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($competence['nom']); ?></td>
                                    <td><?php echo $competence['niveau']; ?></td>
                                    <td class="actions">
                                        <a href="?edit=<?php echo $index; ?>">Modifier</a>
                                        <a href="?delete=<?php echo $index; ?>">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="3">Aucune compétence ajoutée.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            // lien pour se deconnecter
            <div class="logout"><a href="?logout=1">Se déconnecter</a></div>

            // navigation vers les autres pages
            <div class="navigation">
                <a href="index.php">Retour a l'accueil</a>
                <a href="competences.php">Voir les competences</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
