<?php require "inc/header.php"; ?>
<?php
    if(!empty($_SESSION)){
        $user_id = $_SESSION["id"];
        $sqlProfilInfo = "SELECT * FROM  users WHERE id = '{$user_id}'";

        
        if($profilInfo = $connect->query($sqlProfilInfo)->fetch(PDO::FETCH_ASSOC)){
?>
        <section class="hero is-light is-medium">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h2 class="is-size-4">Bienvenue <?php echo $profilInfo["username"];?></h2>
                    <h3 class="subtitle">
                        Vous avez le <?php echo $profilInfo['role']; ?>
                    </h3>
                    <button type="button" name="btn_lookArt" class="button is-block is-info is-large"> Voir mes articles publiés.</button>
                    <a href="addproducts.php" class="button is-block is-info is-large">Ajouter un article.</a>
                    <?php
                    if($profilInfo['role'] === 'ROLE_ADMIN'){
                        echo '<a href="admin.php" class="button is-block is-success is-large is-fullwidth">Accéder à l\'espace administrateur.</a>';
                    }
                    ?>
                </div>
            </div>
        </section>
<?php
                }else{
                    echo "erreur, veuillez vous connecter";
                    session_destroy();
                }
        }else{
?>
    <section class="hero is-light is-medium">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h2 class="is-size-4">Vous devez vous connectez afin d'acceder à votre profil.</h2>
                    <a href="login.php" class="button is-block is-info is-large is-fullwidth">Se connecter !</a>
                </div>
            </div>
        </section>
<?php
    }
?>
<?php require "inc/footer.php"; ?>