<?php require "inc/header.php"; ?>
<?php

$id = $_GET['id'];
$sqlProduct = "SELECT p.*, u.username, c.categories_name FROM products AS p LEFT JOIN users AS u ON p.author = u.id LEFT JOIN categories AS c ON p.category = c.categories_id WHERE p.products_id ={$id}";
$product = $connect->query($sqlProduct)->fetch(PDO::FETCH_ASSOC);
?>

    <section class="hero is-light">
        <div class="container"> 
        <div class="column">
            <div class="card large">
              <div class="card-image">
                <figure class="image is-16by9">
                  <img src="card.image" alt="Image">
                </figure>
              </div>
              <div class="card-content">
                <div class="media">
                  <div class="media-content">
                    <p>
                      <span class="title is-4 no padding">
                        <a href=""><?php echo $product['products_name']; ?></a> </span> </p>
                    <p class="subtitle is-6">Catégorie :<?php echo $product['categories_name']; ?></p>
                  </div>
                </div>
                <div class="content">
                  <p class="subtitle is-8"><?php echo $product['products_description']; ?></p>
                  <p class="subtitle is-8"><?php echo $product['products_price']; ?>€</p>
                  <p class="subtitle is-8">Fait le :<?php echo $product['created_at']; ?></p>
                  <a href="editproduct.php?id=<?php echo $product['products_id']; ?>">Modifier</a>
                </div>
              </div>
            </div>
          </div>
    </section>

<?php require "inc/footer.php"; ?>
