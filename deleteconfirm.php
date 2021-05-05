<?php require 'inc/header.php';?>
<?php
$id = $_GET['id'];

    if(!empty($_SESSION)){
        $admin_id = $_SESSION['id'];
        $sqlAdmin = "SELECT * FROM users WHERE id = '{$admin_id}' && role ='ROLE_ADMIN'";
        $resultAdmin = $connect->query($sqlAdmin);

        if($admin = $resultAdmin->fetch(PDO::FETCH_ASSOC)){
            $sth = $connect->prepare("DELETE * FROM products WHERE products_id={$id}");
            // $sqlDelete = "DELETE * FROM products WHERE products_id={$id}";
            if(isset($_GET['delete'])){
                $sth->execute();
                header('Location: index.php');
                
            }
    
        }else{}
    }

?>

<div class='box'>
    <div class="is-flex is-justify-content-center">
        <p>Vous allez supprimer supprimer un article.</p>
    </div>
    <div class="is-flex is-justify-content-center">
        <a href="deleteconfirm.php?id=<?php echo $id ?>" class="button is-success">Confirmer</a>
        <a href="admin.php" class="button is-danger">Annuler</a>
    </div>
</div>

<?php require 'inc/footer.php';?>