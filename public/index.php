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
try{
    $connectDB = new PDO(
        dsn: MARIA_DSN,
        username: DB_HOST,
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

        }catch(Exception $e){
        // arrêt et affichage de l'erreur (en dev)
        die($e->getMessage());
    }

    /*
     * Si le formulaire a été soumis
     */
    # chargement des commentaires
    $commentaires = getAllGuestbook($connectDB);
    # on compte les commentaires
    $nbCommentaires = count($commentaires);
    # Vue commentaires
    include URL_BASE."/view/guestbookView.php";

    // on appelle la fonction d'insertion dans la DB (addGuestbook())
    $offset = ($page-1)*PAGINATION_NB;
    # chargement des commentaires de la page actuelle
    $commentaires = getAllGuestbook($connectDB, $offset, PAGINATION_NB);

if ($section === 'ajouter') {

    # formulaire envoyé au backend
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
        // si l'insertion a réussi
        header("Location: ./?section=commentaires");
    }

    // on redirige vers la page actuelle (ou on affiche un message de succès)
    include URL_BASE."/view/./";
    // sinon, on affiche un message d'erreur
} else {
    print ("Une erreur est survenue");
}

/*
 * On récupère les messages du livre d'or
 */
# chargement des commentaires
    $commentaires = getAllGuestbook($connectDB);
    # on compte les commentaires
    $nbCommentaires = count($commentaires);
    # Vue commentaires
    include URL_BASE."/view/guestbookView.php";
// on appelle la fonction de récupération de la DB (getAllGuestbook())
    $recup = getAllGuestbook($connectDB);

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
