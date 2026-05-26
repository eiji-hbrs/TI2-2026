<?php
# view/guestbookView.php
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TI2 | Livre d'or</title>
    <link rel="icon" type="image/png" href="img/favicon.png">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <img class="logo" src="./img/logo.png" alt="armoiries">
        <h1>TI2 | Livre d'or</h1>
        <p>Laissez une trace de passage !</p>
        <img class="settings" src="./img/settings.png" alt="armoiries">

    </header>
    <!-- Formulaire d'ajout d'un message -->

    <img class="book" src="./img/book.png" alt="armoiries">

    <h2>Votre message</h2>
    <div>
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" placeholder="Ex: Smith">
    </div>
    <div class="email-tel">
        <div>
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" placeholder="Ex: John">
        </div>
        <div>
            <label for="email">E-mail</label>
            <input type="text" name="email" id="email" placeholder="johnsmith@example.com">
        </div>
        <div>
            <label for="codePostal">Code Postal</label>
            <input type="text" name="codePostal" id="codePostal" placeholder="Ex: 1234">
        </div>
        <div>
            <label for="tel">Téléphone</label>
            <input type="text" name="telephone" id="tel" placeholder="Ex: 0102030405">
        </div>
        <div>
            <label for="commentaire">Message</label>
            <input type="text" name="commentaire" id="commentaire" placeholder="Un petit mot...">
        </div>
        <div>
            <label for="condition"></label>
            <input type="checkbox" name="condition" id="condition">
            <p>J'accepte le stockage de mes données personelles.</p>
        </div>
                
        <button class="submit-btn" id="signupBtn">Envoyer le message</button>

    <?php
    // on a tenté d'envoyé le formulaire et
    // il a passé les protections frontend
    if (isset($insert)):
        // échec de l'insertion
        if ($insert === false):
            ?>
            <div class="not-insert-message">
                échec lors d'un l'insertion <a href="javascript:history.go(-1);">Vérifiez votre formulaire</a>
            </div>
            <?php
            // réussite de l'insertion
        else:
            ?>
            <div class="insert-message">
                Merci pour votre message, vous allez être redirigé
                <script> setTimeout(
                        function () {
                            window.location.href = "./";
                        }, 2000
                    );
                </script>
            </div>
            <?php
        endif;
    endif;
    ?>
    <section class="messages-section">
                <?php
                // on compte le nombre de message
                $nbMessage = count($messages);

                // pas de message
                if(empty($nbMessage)):
                ?>
               <h2>Il n'y a pas encore de message</h2>
                <?php
                // il y a au moins un message
                else:
                    // préparation du pluriel si on a plus d'un message
                    $pluriel = $nbMessage>1 ? "s" :"";
                ?>
            
                <h2>Message<?= $pluriel ?> récent<?= $pluriel ?> (<?= $nbMessage ?>)</h2>
                <?php
                    foreach($messages as $message):
                ?>
                <div class="message-card">
                    <h3>Ecrit par <?= htmlspecialchars($message['email_message']) ?> le <?= htmlspecialchars($message['date_message']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($message['texte_message'])) ?></p>

                </div>
                <?php
                    endforeach;
                endif;
                ?>
            </section>
    <!-- Pagination (BONUS) -->

    <!-- Liste des messages -->
    <!-- <section class="messages-section">
        <?php
        // on compte le nombre de message
        $messages= getAllGuestbook($connectDB);
        $nbMessage = count($messages);

        // pas de message
        if (empty($nbMessage)):
            ?>
            <h2>Il n'y a pas encore de message</h2>
            <?php
            // il y a au moins un message
        else:
            // préparation du pluriel si on a plus d'un message
            $pluriel = $nbMessage > 1 ? "s" : "";
            ?>

            <h2>Message<?= $pluriel ?> récent<?= $pluriel ?> (<?= $nbMessage ?>)</h2>
            <?php
            foreach ($messages as $message):
                ?>
                <div class="message-card">
                    <h3>Ecrit par <?= htmlspecialchars($message['email_message']) ?> le
                        <?= htmlspecialchars($message['date_message']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($message['texte_message'])) ?></p>

                </div>
                <?php
            endforeach;
        endif;
        ?> -->
    </section>
    <!-- Pagination (BONUS) -->
    <?php
    // À commenter quand on a fini de tester
    echo "<h3>Nos var_dump() pour le débugage</h3>";
    echo '<p>$_POST</p>';
    var_dump($_POST);
    echo '<p>$_GET</p>';
    var_dump($_GET);
    ?>

    <script src="js/validation.js"></script>
</body>

</html>