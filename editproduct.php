<?php require "inc/header.php";?>
<?php
$id = $_GET['id'];
$sqlProduct = "SELECT p.*, u.username, c.categories_name FROM products AS p LEFT JOIN users AS u ON p.author = u.id LEFT JOIN categories AS c ON p.category = c.categories_id WHERE p.products_id ={$id}";
$product = $connect->query($sqlProduct)->fetch(PDO::FETCH_ASSOC);
?>
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
            $sth = $connect->prepare("UPDATE products SET
            products_name=:products_name,products_description=:products_description,products_price=:products_price, category=:category WHERE products_id = :id");
            $sth->bindValue(':products_name', $name);
            $sth->bindValue(':products_description', $description);
            $sth->bindValue(':products_price', $price);
            $sth->bindValue(':id', $id);
            $sth->bindValue(':category', $category);

            $sth->execute();

            echo "Votre article à été modifier avec succès.";
            header('Location: product.php?id='.$id);

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
                            <input class="input is-large" type="text" name="product_name" value="<?php echo $product['products_name']; ?>" placeholder="Nom de l'article" autofocus="" required>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <textarea class="input is-large" name="product_description" type="text" placeholder="Description" autofocus="" required>
                            <?php echo $product['products_description']; ?> </textarea>
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <input class="input is-large" min="1" max="999999999" type="number" value="<?php echo $product['products_price']; ?>" name="product_price" placeholder="Prix" required>
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                        <label for="InputCategory">Catégorie</label>
                            <select class="input is-large" id ="InputCategory" value=" " name="product_category" required>

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