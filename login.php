<?php require "inc/header.php"; ?>
<?php
$alert = false;

if(!empty($_POST['email_login']) && !empty($_POST['password_login']) && isset($_POST['submit_login'])){
    $email = htmlspecialchars($_POST['email_login']);
    $password = htmlspecialchars($_POST['password_login']);
    
    try{
        $sqlMail ="SELECT * FROM users WHERE email ='{$email}'";
        $resultMail = $connect->query($sqlMail);
        $user = $resultMail->fetch(PDO::FETCH_ASSOC);
        if($user) {
            $dbpassword = $user['password'];
            if(password_verify($password, $dbpassword)){
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['username'] = $user['username'];
                $alert = true;
                $type = 'success';
                $message = 'Vous êtes connectés!';
                unset($_POST);
                header('Location: profil.php');
            } else{
                $alert = true;
                $type = 'danger';
                $message = "Le mot de passe est erroné";
                unset($_POST);
                } 
        }else{
            $alert = true;
            $type = 'warning';
            $message = "Ce compte n'existe pas";
            unset($_POST);
            }
    }catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}

?>
<section class="hero is-light is-medium">
        <div>
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-black">Se connecter</h3>
                    <hr class="login-hr">
                    <p class="subtitle has-text-black">Entrez vos identifiants.</p>
                    <div class="box">
                        <form>
                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" name="email_login" type="email" placeholder="Email" autofocus="" required>
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" name="password_login" type="password" placeholder="Mot de passe" required>
                                </div>
                            </div>
                            <button type="submit" name="submit_login" class="button is-block is-info is-large is-fullwidth">C'est parti !<i class="fa fa-sign-in" aria-hidden="true"></i></button>
                        </form>
                    </div>
                    <p class="has-text-grey">
                        <a href="signin.php">S'inscrire</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    

<?php require "inc/footer.php"; ?>
