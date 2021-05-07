<?php require "inc/header.php";?>
<?php

$sqlCategory = 'SELECT * FROM categories';
$categories = $connect->query($sqlCategory)->fetchAll();


if(isset($_POST['submit_product']) && !empty($_POST['product_name']) && !empty($_POST['product_price']) && !empty($_POST['product_description']) && !empty($_POST['product_category'])){
    $name = strip_tags($_POST['product_name']);
    $price = intval(strip_tags($_POST['product_price']));
    $description = strip_tags($_POST['product_description']);
    $category = strip_tags($_POST['product_category']);
    $user_id = $_SESSION['id'];

    $image = $_FILES['product_image'];

    if($image['size'] > 0 ){
        if ($image['size'] <= 1000000){
            $valid_ext = ['jpg', 'jpeg', 'png'];
            $check_ext = strtolower(substr(strrchr($image['name'], '.'),1));
            if(in_array($check_ext, $valid_ext)){
                $image_name = uniqid() . '_' . $image['name'];
                $upload_dir = "./public/uploads/";
                $upload_name = $upload_dir . $image_name;
                $upload_result = move_uploaded_file($image['tmp_name'], $upload_name);
                if($upload_result){
                    if(is_int($price) && $price > 0){
                        try{
                            $sth = $connect->prepare("INSERT INTO products
                            (products_name, products_price, products_description, category, author, image)
                            VALUES
                            (:products_name, :products_price, :products_description, :category, :author, :image)");
                            $sth->bindValue(':products_name', $name);
                            $sth->bindValue(':products_description', $description);
                            $sth->bindValue(':products_price', $price);
                            $sth->bindValue(':author', $user_id);
                            $sth->bindValue(':category', $category);
                            $sth->bindValue(':image', $image_name);
                
                            $sth->execute();
                            echo "Votre article à été ajouter avec succès.";
                            // header('Location: annonce.php');
                
                        } catch(PDOException $error){
                            echo 'Erreur: '.$error->getMessage();
                        }
                    }
                    
                }
            }
        }
    }else{
        if(is_int($price) && $price > 0){
            try{
                $sth = $connect->prepare("INSERT INTO products
                (products_name, products_price, products_description, category, author)
                VALUES
                (:products_name, :products_price, :products_description, :category, :author)");
                $sth->bindValue(':products_name', $name);
                $sth->bindValue(':products_description', $description);
                $sth->bindValue(':products_price', $price);
                $sth->bindValue(':author', $user_id);
                $sth->bindValue(':category', $category);
    
                $sth->execute();
                echo "Votre article à été ajouter avec succès.";
                header('Location: annonce.php');
    
            } catch(PDOException $error){
                echo 'Erreur: '.$error->getMessage();
            }
        }
    }
}
?>

<section class="hero is-light is-medium">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="box">
                <form method ="POST" action ="#" enctype="multipart/form-data">
                    <div class="field">
                        <div class="control">
                            <input class="input is-large" type="text" name="product_name" placeholder="Nom de l'article" autofocus="" required>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <textarea class="input is-large" name="product_description" type="text" placeholder="Description" autofocus="" required></textarea>
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <input class="input is-large" min="1" max="999999999" type="number" name="product_price" placeholder="Prix" required>
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <input class="input is-large"  type="file" name="product_image" id="inputImage" accept=".png, .jpg, .jpeg">
                        </div>
                    </div>

                    <!-- <div class="file has-name is-fullwidth">
                        <label class="file-label">
                            <input class="file-input" type="file" name="product_image" accept=".png, .jpg, .jpeg">
                            <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Choose a file…
                            </span>
                            </span>
                            <span class="file-name">
                                <?php echo $image['name']; ?>
                            </span>
                        </label>
                    </div> -->

                    <div class="field">
                        <div class="control">
                        <label for="InputCategory">Catégorie</label>
                            <select class="input is-large" id ="InputCategory" name="product_category" required>

                            <?php
                            foreach ($categories as $category){
                            ?>

                                <option value="<?php echo $category['categories_id']; ?>">
                                    <?php echo $category['categories_name']; ?>
                                </option>

                            <?php
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="submit_product" placeholder="Catégories" class="button is-block is-success is-large">Enregister<i class="fa fa-sign-in"></i></button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require "inc/footer.php"; ?>