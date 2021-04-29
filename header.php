<?php
    require "inc/config.php";
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=3">

        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->

        <!-- dart-sass/sass scss/style.scss css/style.css --watch -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
        <!-- <link rel="stylesheet" href="assets/css/lib/bootstrap.min.css"> -->
        <link rel="stylesheet" href="/assets/css/style.css">

        <title>Stuliday</title>

    </head>

    <body>
        <header>
            <nav class="navbar" role="navigation" aria-label="main navigation">
                <div class="navbar-brand">
                    <a class="navbar-item" href="index.php">
                        STULIDAY
                    </a>

                    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                    </a>
                </div>

                <div id="navbarBasicExample" class="navbar-menu">
                    <div class="navbar-start">
                        <a class="navbar-item">ACCEUIL</a>

                        <a class="navbar-item">ANNONCE</a>

                        <a class="navbar-item">PROFIL</a>

                        <a class="navbar-item">ANNONCE</a>

                    </div>
                </div>

                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <?php
                            //? Vérification des variables des sessions : si elle n'existent pas, alors afficher un bouton se connecter
                            if (empty($_SESSION)) {
                            ?>
                                <a href="./signin.php" class="button is-primary">
                                    <strong>INCRIPTION</strong>
                                </a>
                                <a href="./login.php" class="button is-light">
                                    CONNEXION
                                </a>
                            <?php
                                }else{
                            ?>
                                <a href="./profil.php" class="button is-light">
                                    <strong><?php echo $_SESSION['username']; ?></strong>
                                </a>
                                <a href="?logout" class="button is-primary">
                                    DECONNEXION
                                </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <!-- <nav>
            <div>
                <p>STULIDAY</p>
            </div>
            <div>
                <p><a href="">ACCEUIL</a></p>
                <p><a href="">ANNONCE</a></p>
                <p><a href="">PROFIL</a></p>
                <p><a href="./sign_in_login.php">CONNEXION</a></p>
            </div>
        </nav>  -->
