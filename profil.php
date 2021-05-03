<?php require "inc/header.php"; ?>
<?php
$sqlProfilInfo = "SELECT * FROM  USER AS u ";
$profilInfo = $connect->query($sqlProfilInfo)->fetchAll(PDO::FETCH_ASSOC);
    if(isset($_SESSION)){

    }else{
        echo "veuillez vous connecter";
    }
?>
    <div class="columns">
        <div class="column is-offset-2">

        </div>
        <div class="column">

        </div>
        <div class="column">

        </div>
        <div class="column">

        </div>
    </div>
<?php require "inc/footer.php"; ?>