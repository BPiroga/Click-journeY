<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CY Portugal</title>
</head>
<body>
    <header class="navbar">
        <a class="logo" href="index.php"><img src="src/Logo CY Portugal.png" alt="Logo CY Portugal" width="210px"></a>
        <p class="titre">CY Portugal</p>
    </header>
    <div class="container">
        <div class="connexion">
            <form type="traitement_incription.php" method="post">
                <table>
                    <tr>
                        <td class="titre-connexion">Inscription</td>
                    </tr>
                    <tr>
                        <td>Prénom :</td>
                        <td>
                            <input type="text" name="prenom" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Nom :</td>
                        <td>
                            <input type="text" name="nom" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Date de naissance :</td>
                        <td>
                            <input type="date">
                        </td>
                    </tr>
                    <tr>
                        <td>Adresse email :</td>
                        <td>
                            <input type="email" name="email" placeholder="exemple@email.com" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Créer mot de passe :</td>
                        <td>
                            <input type="password" name="code" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Confirmer mot de passe :</td>
                        <td> 
                            <input type="password" name="code" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            
                        </td>
                    </tr>
                </table>
                <div class="form-buttons">
                    <a class="button-link-connexion" href="profil.php">SOUMMETTRE</a>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <p>&copy; 2025 CY Portugal</p>
        <a href="profil.php">Compte</a>
        <a href="admin.php">Administration</a>
        <p>Contact : CY Tech</p>
    </footer>
</body>
</html>