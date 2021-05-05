<?php require "inc/header.php";?>
<?php
$id = $_GET['id'];
$sqlUser = "SELECT u.*, u.username FROM users AS u  WHERE u.id ={$id}";
$user = $connect->query($sqlUser)->fetch(PDO::FETCH_ASSOC);
?>
<?php

// var_dump($_POST);

if(isset($_POST['submit_user']) && !empty($_POST['username']) && !empty($_POST['user_email']) && !empty($_POST['user_role'])){
    $username = strip_tags($_POST['username']);
    $email = strip_tags($_POST['user_email']);
    $role = strip_tags($_POST['user_role']);
    $user_id = $_SESSION['id'];

        try{
            $sth = $connect->prepare("UPDATE users SET username=:username, email=:email, role=:role WHERE id = :id");
            $sth->bindValue(':username', $username);
            $sth->bindValue(':email', $email);
            $sth->bindValue(':role', $role);
            $sth->bindValue(':id', $id);

            $sth->execute();

            echo "Les informations utilisateur ont été modifier avec succès.";
            header('Location: admin.php');

        } catch(PDOException $error){
            echo 'Erreur: '.$error->getMessage();
        }
    
}
?>

<section class="hero is-light is-medium">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="box">
                <form method ="POST" action ="#">
                    <div class="field">
                        <div class="control">
                            <input class="input is-large" type="text" name="username" value="<?php echo $user['username']; ?>" placeholder="Nom de l'utilisateur" autofocus="" required>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input class="input is-large" name="user_email" value="<?php echo $user['email']; ?>" type="email" placeholder="Email" autofocus="" required>
                            
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <input class="input is-large" name="user_role" value="<?php echo $user['role']; ?>" type="text" placeholder="Role" autofocus="" required>
                        </div>
                    </div>

                    <button type="submit" name="submit_user" placeholder="Catégories" class="button is-block is-success is-large">Enregister<i class="fa fa-sign-in"></i></button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require "inc/footer.php"; ?>