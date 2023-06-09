<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Inscription</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <header>
            <img  id="madeli" src="images/madeleine_pdp.png" alt="Logo de notre réseau social"/>
            <?php include 'header.php';
            ?>
        </header>

        <div id="wrapper" >

            <aside>
                <h2 id="pres_amongus">Présentation</h2>
                <p id="pres_para">Bienvenu sur notre réseau social.</p>
            </aside>
            <main>
                <article>
                    <h2>Inscription</h2>
                    <?php
                    /**
                     * TRAITEMENT DU FORMULAIRE
                     */
                    // Etape 1 : vérifier si on est en train d'afficher ou de traiter le formulaire
                    // si on recoit un champs email rempli il y a une chance que ce soit un traitement
                    $enCoursDeTraitement = isset($_POST['email']);
                    if ($enCoursDeTraitement)
                    {
                        // echo "<pre>" . print_r($_POST, 1) . "</pre>";
                        $new_email = $_POST['email'];
                        $new_alias = $_POST['pseudo'];
                        $new_passwd = $_POST['motpasse'];
                        include 'config.php';
                        $new_email = $mysqli->real_escape_string($new_email);
                        $new_alias = $mysqli->real_escape_string($new_alias);
                        $new_passwd = $mysqli->real_escape_string($new_passwd);
                        // on crypte le mot de passe pour éviter d'exposer notre utilisatrice en cas d'intrusion dans nos systèmes
                        $new_passwd = md5($new_passwd);
                        // NB: md5 est pédagogique mais n'est pas recommandée pour une vraies sécurité
                        //Etape 5 : construction de la requete
                        $lInstructionSql = "INSERT INTO users (id, email, password, alias) "
                                . "VALUES (NULL, "
                                . "'" . $new_email . "', "
                                . "'" . $new_passwd . "', "
                                . "'" . $new_alias . "'"
                                . ");";
                        // Etape 6: exécution de la requete
                        $ok = $mysqli->query($lInstructionSql);
                        if ( ! $ok)
                        {
                            echo "L'inscription a échouée : " . $mysqli->error;
                        } else
                        {
                            echo "Votre inscription est un succès : " . $new_alias;
                            echo " <a href='login.php'>Connectez-vous.</a>";
                        }
                    }
                    ?>                     
                    <form action="registration.php" method="post">
                        <input type='hidden'name='???' value='achanger'>
                        <dl>
                            <dt><label for='pseudo'>Pseudo</label></dt>
                            <dd><input id="text" type='text'name='pseudo'></dd>
                            <dt><label for='email'>E-Mail</label></dt>
                            <dd><input id="text" type='email'name='email'></dd>
                            <dt><label for='motpasse'>Mot de passe</label></dt>
                            <dd><input id="text" type='password'name='motpasse'></dd>
                        </dl>
                        <input id="auteur" type='submit'>
                    </form>
                </article>
            </main>
        </div>
    </body>
</html>
