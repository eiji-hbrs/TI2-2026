<?php
# public/index.php


/*
 * Front Controller de la gestion du livre d'or
 */

/*
 * Chargement des dépendances
 */
// chargement de configuration
require_once "../config.php";
// chargement du modèle de la table guestbook
require_once URL_BASE . "/model/guestbookModel.php";

/*
 * Connexion à la base de données en utilisant PDO
 * Avec un try catch pour gérer les erreurs de connexion
 * Utilisez les constantes de config.php
 * Activez le mode d'erreur de PDO à Exception et
 * le mode fetch à tableau associatif
 */
try {
    $connectDB = new PDO(
        dsn: MARIA_DSN,
        username: DB_LOGIN,
        password: DB_PWD,
        // tableau de paramètres de connexion, ici pour recevoir les
        // résultats des query en tableau associatif
        // ! seul endroit où on peut créer une connexion permanante
        options: [
            // connexion permanante seulement ici, pas avec setAttribute()
            // PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
    $connectDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {
    // arrêt et affichage de l'erreur (en dev)
    die($e->getMessage());
}

/*
 * Si le formulaire a été soumis
 */
if (isset($_POST['firstname'], $_POST['lastname'], $_POST['usermail'], $_POST['phone'], $_POST['postcode'], $_POST['message'])) {
    // tentative d'insertion (protections dans la fonction)
    $insert = addGuestbook(
        db: $connectDB,
        firstname: $_POST['firstname'],
        lastname: $_POST['lastname'],
        usermail: $_POST['usermail'],
        phone: $_POST['phone'],
        postcode: $_POST['postcode'],
        message: $_POST['message'],
    );

    // on appelle la fonction d'insertion dans la DB (addGuestbook())

    # chargement des commentaires de la page actuelle

    # formulaire envoyé au backend

    // si l'insertion a réussi
    $feedbackMessage = null;
if (isset($_SESSION['feedbackMessage'])) {
    $feedbackMessage = $_SESSION['feedbackMessage'];
    unset($_SESSION['feedbackMessage']);
}
/* Si le formulaire a été soumis*/
if (isset(
    $_POST['firstname'],
    $_POST['lastname'],
    $_POST['usermail'],
    $_POST['phone'],
    $_POST['postcode'],
    $_POST['message']
)) {
    // on appelle la fonction d'insertion dans la DB (addGuestbook())
    $insert = addGuestbook(
        db:        $connectDB,
        firstname: $_POST['firstname'],
        lastname:  $_POST['lastname'],
        usermail:  $_POST['usermail'],
        phone:     $_POST['phone'],
        postcode:  $_POST['postcode'],
        message:   $_POST['message']
    );
    // si l'insertion a réussi
        if ($insert === true) {
        // Succès : on stocke le message en session et on redirige 
        $_SESSION['feedbackMessage'] = ['type' => 'success', 'text' => 'Votre message a bien été enregistré !'];

    } else {
        // Échec de validation backend
        $feedbackMessage = ['type' => 'error', 'text' => 'Erreur : vérifiez vos données et réessayez.'];
    }
}}
// on appelle la fonction de récupération de la DB (getAllGuestbook())
$messages   = getAllGuestbook($connectDB);
$nbMessages = count($messages);
/*
 * On récupère les messages du livre d'or
 */

# Vue commentaires

/*********************
 * Ou Bonus Pagination
 *********************/

// on vérifie sur quelle page on est (et que c'est un string qui contient que des numériques sans "." ni "-" => ctype_digit) en utilisant la variable $_GET et les constantes de config.php

# on compte le nombre total de messages (SQL)

# on récupère la pagination

# pour obtenir le $offset pour les messages (calcul)

# on veut récupérer les messages de la page courante

/**************************
 * Fin du Bonus Pagination
 **************************/

// Appel de la vue

include URL_BASE . "/view/guestbookView.php";

// fermeture de la connexion (bonne pratique)
$connectDB = null;
