<?php require 'inc/header.php';?>
<?php
$id = $_POST['id'];
$token = $_POST['csrf_token'];

    if(!empty($_SESSION)){
        $admin_id = $_SESSION['id'];
        $sqlAdmin = "SELECT * FROM users WHERE id = '{$admin_id}' && role ='ROLE_ADMIN'";
        $resultAdmin = $connect->query($sqlAdmin);

        if($admin = $resultAdmin->fetch(PDO::FETCH_ASSOC)){
            // $sqlDelete = "DELETE * FROM products WHERE products_id={$id}";
            if(isset($_POST['delete']) && hash_equals($_POST['csrf_token'], $token)){
                try{
                    $sth = $connect->prepare("DELETE * FROM products WHERE products_id=:product_id");
                    $sth->bindValue(':product_id',$id);
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
    
        }else{}
    }

    if(isset($_POST['delete']) && hash_equals($_POST['csrf_token'], $token)){
        try{
            $sth =$connect->prepare("DELETE * FROM users WHERE id =:id");
            $sth->bindValue(':id', $id);
            $sth->execute();
            if($sth->execute()){
                header('Location: admin.php');
            }else{
                echo "Il y a eu un probleme.";
            }
            
        } catch (PDOException $error) {
            echo 'Erreur: '. $error->getMessage();
        }
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