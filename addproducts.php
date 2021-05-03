<?php require "inc/header.php";?>
<?php

$sqlCategory = 'SELECT * FROM categories';
$categories = $connect->query($sqlCategory)->fetchAll();

// var_dump($_POST);

if(isset($_POST['submit_product']) && !empty($_POST['product_name']) && !empty($_POST['product_price']) && !empty($_POST['product_description']) && !empty($_POST['product_category'])){
    $name = strip_tags($_POST['product_name']);
    $price = intval(strip_tags($_POST['product_price']));
    $description = strip_tags($_POST['product_description']);
    $category = strip_tags($_POST['product_category']);
    $user_id = $_SESSION['id'];

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
?>

<section class="hero is-light is-medium">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="box">
                <form method ="POST" action ="#">
                    <div class="field">
                        <div class="control">
                            <input class="input is-large" type="text" name="product_name" placeholder="Nom de l'article" autofocus="">
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input class="input is-large" name="product_description" type="text" placeholder="Description" autofocus="">
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <input class="input is-large" min="1" max="999999999" type="number" name="product_price" placeholder="Prix">
                        </div>
                    </div>

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