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
    <script src="./js/jquery-3.7.1.min.js"></script>

    <title>TI2 | Livre d'or</title>
    <link rel="icon" type="image/png" href="img/favicon.png">
    <link rel="stylesheet" href="css/style.css">
</head>


<body>
    <header>
        <div class="logo"></div>
        <h1 class="titre">TI2 | Livre d'or</h1>

        <div class="rouage">
            <button id="dm" class="dm">Mode sombre</button>
            <div class="settings"></div>
            <span id="admin">Administion</span>
        </div>

    </header>
    <!-- Formulaire d'ajout d'un message -->
    <div class="livre">
        <img class="book" src="./img/livre-ouvert.png" alt="livre">
    </div>

    <div class="formulaire">
        <h2>Votre message</h2>
        <form method="POST" action="">

            <div class="form-group" id="f-lastname">
                <label for="lastname">Nom</label>
                <span class="hint"></span>

                <input type="text" name="lastname" id="lastname"
                    value="<?= htmlspecialchars($_POST['lastname'] ?? '') ?>" required>
            </div>
            <div class="form-group" id="f-firstname">
                <label for="firstname">Prénom</label>
                <span class="hint"></span>

                <input type="text" name="firstname" id="firstname"
                    value="<?= htmlspecialchars($_POST['firstname'] ?? '') ?>" required>
            </div>
            <div class="form-group" id="f-usermail">
                <label for="usermail">E-mail</label>
                <span class="hint"></span>
                <input type="email" name="usermail" id="usermail"
                    value="<?= htmlspecialchars($_POST['usermail'] ?? '') ?>" required>
            </div>

            <div class="form-group" id="f-postcode">
                <label for="postcode">Code Postal</label>
                <span class="hint"></span>
                <input type="text" name="postcode" id="postcode"
                    value="<?= htmlspecialchars($_POST['postcode'] ?? '') ?>" required>
            </div>

            <div class="form-group" id="f-phone">
                <label for="phone">Téléphone</label>
                <span class="hint"></span>
                <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"
                    required>
            </div>

            <div class="form-group" id="f-message">
                <label for="message">Message</label>
                <span class="hint"></span>
                <textarea name="message" id="message"
                    required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
            </div>
            <span id="charCount" class="char-count">0 / 300 </span>

            <div class="condition">
                <input type="checkbox" name="condition" id="condition">
                <p>J'accepte le stockage de mes données personnelles.</p>
            </div>

            <button type="submit" class="submit-btn" id="signupBtn">Envoyer le message</button>
        </form>
    </div>
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

        // pas de message
        if (0 == $nbMessages):
            ?>
            <h2>Il n'y a pas encore de message</h2>
            <?php
            // il y a au moins un message
        elseif (1 == $nbMessages):
            ?>
            // préparation du pluriel si on a plus d'un message
            <h2>Il y a 1 message</h2>

            <?php
        else:
            ?>
            <h2>Messages récents - il y a actuellement <?= $nbMessages ?> messages</h2>
            <?php
            foreach ($messages as $message):
                ?>
                <div class="message-card">
                    <h3>Ecrit par <?= htmlspecialchars($message['firstname']) ?>         <?= htmlspecialchars($message['lastname']) ?>
                        le
                        <?= htmlspecialchars($message['datemessage']) ?>
                    </h3>
                    <p><?= nl2br(htmlspecialchars($message['message'])) ?></p>

                </div>
                <?php
            endforeach;
            ?>
            <div class="pagination">
                <?php
            if(!empty($paginationHtml)){
                echo $paginationHtml; 
            }
            ?>
            </div>
            <?php
        endif;
        ?>
    </section>
    <!-- Pagination (BONUS) -->

    <!-- Liste des messages -->
    <!-- Pagination (BONUS) -->
    <?php
    // À commenter quand on a fini de tester
    // echo "<h3>Nos var_dump() pour le débugage</h3>";
    // echo '<p>$_POST</p>';
    // var_dump($_POST);
    // echo '<p>$_GET</p>';
    // var_dump($_GET);
    // ?>
<script src="./js/validation.js"></script>

</body>

</html>