<?php require "inc/header.php";?>
<?php

$sqlCategory = 'SELECT * FROM categories';
$categories = $connect->query($sqlCategory)->fecthAll();

// var_dump($categories);

if(isset($_POST['submit_product']) AND !empty($_POST['product_name']) AND !empty($_POST['product_price']) AND !empty($_POST['product_description']) AND !empty($_POST['product_category'])){
    $name = strip_tags($_POST['product_name']);
    $price = strip_tags($_POST['product_price']);
    $description = strip_tags($_POST['product_description']);
    $category = strip_tags($_POST['product_category']);
    $user_id = $_SESSION['id'];
    // if(){

    // }
}
?>

<section class="hero is-light is-medium">
    <div class="hero-body">
        <div class="container has-text-centered">
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
                        <input class="input is-large" min="1" max="999999999" type="number" id ="InputPassword1" name="prdocut_price" placeholder="Prix">
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                    <label for="InputCategory">Catégorie</label>
                        <select class="input is-large" id ="InputCategory" name="product_category" required>

                        <?php
                        foreach ($categories as $category){
                        ?>

                            <option value="">
                                <?php echo $category['categories_id']; ?>
                                <?php echo $category['categories_name']; ?>
                            </option>

                        <?php
                        }
                        ?>

                    </div>
                </div>
                <button type="submit" name="submit_product" class="button is-block is-info is-large is-fullwidth">Enregister<i class="fa fa-sign-in" aria-hidden="true"></i></button>
            </form>
        </div>
    </div>
</section>

<?php require "inc/footer.php"; ?>