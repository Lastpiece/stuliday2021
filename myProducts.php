<?php require "inc/header.php"; ?>
<?php
$userId = $_SESSION['id'];
$sqlProducts = "SELECT p.*, u.username, c.categories_name FROM products AS p LEFT JOIN users AS u ON p.author = u.id LEFT JOIN categories AS c ON p.category = c.categories_id WHERE p.author = {$userId}";
$products = $connect->query($sqlProducts)->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
      <div class="section is-flex is-flex-wrap-wrap is-justify-content-center">
        <div id="app" class="row columns is-multiline">
        
          <?php
          foreach ($products as $product) {
          ?>

          <div class="column is-4">
            <div class="card large">
              <div class="card-image">
                <figure class="image is-16by9">
                  <img src="noImage" alt="Image_product">
                </figure>
              </div>
              <div class="card-content">
                <div class="media">
                  <div class="media-content">
                    <p>
                      <span class="title is-4 no padding">
                        <a href="product.php?id=<?php echo $product['products_id']; ?>"><?php echo $product['products_name']; ?></a> </span> </p>
                      <p class="subtitle is-6"><?php echo $product['categories_name']; ?></p>
                      <p class="subtitle is-8"><?php echo $product['products_price']; ?>€</p>
                      <p class="subtitle is-8"><?php echo $product['created_at']; ?></p>
                      <a href="editproduct.php?id=<?php echo $product['products_id']; ?>">Modifier</a>
                  </div>
                </div>
                <div class="content">
                  <?php echo $product['products_description']; ?>
                </div>
              </div>
            </div>
          </div>

          <?php
          }
          ?>

        </div> 
      </div>
    </div>
<?php require "inc/footer.php"; ?>