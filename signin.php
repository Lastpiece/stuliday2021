<?php require "inc/header.php"; ?>
<?php
if(!empty($_POST['email_signin']) AND !empty($_POST['password1_signin']) AND !empty($_POST['password2_signin']) AND !empty($_POST['username_signin']) AND isset($_POST['submit_signin'])){
    $email = htmlspecialchars($_POST['email_signin']);
    $password1 = htmlspecialchars($_POST['password1_signin']);
    $password2 = htmlspecialchars($_POST['password2_signin']);
    $username = htmlspecialchars($_POST['username_signin']);

    try{
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sqlMail = "SELECT * FROM users WHERE email = '{$email}'";
            $resultMail = $connect->query($sqlMail);
            $countMail = $resultMail->fetchColumn();
            if (!$countMail) {
                // echo "Etape 2 : Email BDD ok <br>";
                //? Etape 3 : Vérification de la disponibilité de l'username dans la BDD
                $sqlUsername = "SELECT * FROM users WHERE username = '{$username}'";
                $resultUsername = $connect->query($sqlUsername);
                $countUsername = $resultUsername->fetchColumn();
                if (!$countUsername) {
                    // echo "Etape 3 : Username BDD ok <br>";
                    //? Etape 4 : Vérification de la concordance des mots de passe
                    if ($password1 === $password2) {
                        // echo "Etape 4 : Concordance Mdp ok <br>";
                        //? Etape 5 : Hashage du mot de passe
                        $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
                        // echo "Etape 5 : Hashage Mdp ok <br>";
                        //? Etape 6 : Enregistrement des données utilisateur
                        $sth = $connect->prepare("INSERT INTO users (email,username,password) VALUES (:email,:username,:password)");
                        $sth->bindValue(':email', $email);
                        $sth->bindValue(':username', $username);
                        $sth->bindValue(':password', $hashedPassword);
                        $sth->execute();
                        echo "L'utilisateur a bien été enregistré !";
                        //? Etape 7 : Ajout de messages d'erreurs adaptés.
                    } else {
                        echo "Les mots de passe ne sont pas concordants.";
                        unset($_POST);
                    }
                } else {
                    echo " Ce nom d'utilisateur existe déja";
                    unset($_POST);
                }
            } else {
                echo "Un compte existe déja pour cette adresse mail";
                unset($_POST);
            }
        } else {
            echo "L'adresse email saisie n'est pas valide";
            unset($_POST);
        }
    } catch(PDOException $error){
        echo 'Error: ' . $error->getMessage();
    }
}
?>
    <section class="hero is-light is-medium">
        <div>
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-black">S'inscrire</h3>
                    <hr class="login-hr">
                    <p class="subtitle has-text-black">Entrez vos informations.</p>
                    <div class="box">
                        <form>
                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" type="text" name="username_signin" placeholder="Nom d'utilisateur" autofocus="">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" name="email_signin" type="email" placeholder="Email" autofocus="">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" type="password" id ="InputPassword1" name="password1_signin" placeholder="Mot de passe">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" name="submit_signin" type="password" id ="InputPassword2" name="password2_signin" placeholder="Confirmation" autofocus="">
                                </div>
                            </div>
                            <button type="submit" class="button is-block is-info is-large is-fullwidth">C'est parti !<i class="fa fa-sign-in" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php require "inc/footer.php"; ?>