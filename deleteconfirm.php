<?php require 'inc/header.php';?>
<?php
if(isset($_POST['submit_deleteUser'])){
    $id = $_POST['id'];
    $table = 'users';
    $column = 'id';
}elseif(isset($_POST['submit_deleteProduct'])){
    $id = $_POST['product_id'];
    $table = 'products';
    $column = 'products_id';
}else{
    $id = $_POST['id'];
    $table = $_POST['table'];
    $column = $_POST['column'];
}
$token = $_POST['csrf_token'];
// var_dump($_POST, $table, $column);
    if(!empty($_SESSION['id'])){
        $admin_id = $_SESSION['id'];
        $sqlAdmin = "SELECT * FROM users WHERE id = '{$admin_id}' && role ='ROLE_ADMIN'";
        $resultAdmin = $connect->query($sqlAdmin);

        if($admin = $resultAdmin->fetch(PDO::FETCH_ASSOC)){
            // if((isset($_POST['submit_deleteUser']) || isset($_POST['submit_deleteProduct'])) && hash_equals($_POST['csrf_token'], $token)){
            if(isset($_POST['submit_deleteConfirm']) && hash_equals($_POST['csrf_token'], $token)){
                try{
                    $sth = $connect->prepare("DELETE FROM {$table} WHERE {$column}=:id");
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
        <form action="#" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="hidden" name="column" value="<?php echo $column;?>">
            <input type="hidden" name="table" value="<?php echo $table;?>">
            <input type="submit" name="submit_deleteConfirm" value="confirmer">
            
        </form>
        <!-- <a href="deleteconfirm.php?id=<?php echo $id ?>" class="button is-success">Confirmer</a> -->
        <a href="admin.php" class="button is-danger">Annuler</a>
    </div>
</div>

<?php require 'inc/footer.php';?>