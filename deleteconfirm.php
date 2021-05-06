<?php require 'inc/header.php';?>
<?php
if(isset($_POST['submit_deleteUser'])){
    $id = $_POST['id'];
}elseif(isset($_POST['submit_deleteProduct'])){
    $id = $_POST['product_id'];
}
$token = $_POST['csrf_token'];

    if(!empty($_SESSION['id'])){
        $admin_id = $_SESSION['id'];
        $sqlAdmin = "SELECT * FROM users WHERE id = '{$admin_id}' && role ='ROLE_ADMIN'";
        $resultAdmin = $connect->query($sqlAdmin);

        if($admin = $resultAdmin->fetch(PDO::FETCH_ASSOC)){
            if((isset($_POST['submit_deleteUser']) || isset($_POST['submit_deleteProduct'])) && hash_equals($_POST['csrf_token'], $token)){
                try{
                    $sth = $connect->prepare("DELETE FROM products WHERE products_id=:id");
                    $sth->bindValue(':id',$id);
                    $sth->execute();
                    if($sth->execute()){
                        header('Location: admin.php');
                    }else{
                        echo "Error";
                    }
                } catch (PDOException $error) {
                    echo 'Erreur: '. $error->getMessage();
                }
            }
    
        }
        // else{}
    }

    // if(isset($_POST['submit_deleteConf']) && hash_equals($_POST['csrf_token'], $token)){
    //     try{
    //         $sth =$connect->prepare("DELETE FROM users WHERE id =:id");
    //         $sth->bindValue(':id', $id);
    //         $sth->execute();
    //         if($sth->execute()){
    //             header('Location: admin.php');
    //         }else{
    //             echo "Il y a eu un probleme.";
    //         }
            
    //     } catch (PDOException $error) {
    //         echo 'Erreur: '. $error->getMessage();
    //     }
    // }

?>

<div class='box'>
    <div class="is-flex is-justify-content-center">
        <h3>Vous allez supprimer supprimer un article.</h3>
    </div>
    <div class="is-flex is-justify-content-center">
        <form action="deleteconfirm.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?php $token; ?>">
            <input type="hidden" name="product_id" value="<?php $id;?>">
            <input type="submit" name="submit_deleteConfirm" value="confirmer">
            
        </form>
        <!-- <a href="deleteconfirm.php?id=<?php echo $id ?>" class="button is-success">Confirmer</a> -->
        <a href="admin.php" class="button is-danger">Annuler</a>
    </div>
</div>

<?php require 'inc/footer.php';?>