<?php require "inc/header.php"; ?>
<div class="container">
      <div class="section">
        <div id="app" class="row columns is-multiline">
          <div v-for="card in cardData" key="card.id" class="column is-4">
            <div class="card large">
              <div class="card-image">
                <figure class="image is-16by9">
                  <img :src="card.image" alt="Image">
                </figure>
              </div>
              <div class="card-content">
                <div class="media">
                  <div class="media-content">
                    <p class="title is-4 no-padding">{{card.user.title}}</p>
                    <p>
                      <span class="title is-4 no padding">
                        <a href="product.php"> Nom du produit</a> </span> </p>
                    <p class="subtitle is-6">Categorie</p>
                  </div>
                </div>
                <div class="content">
                  {{card.content}}
                  <div class="background-icon"><span class="icon-twitter"></span></div>
                </div>
              </div>
            </div>
          </div>
          <div v-for="card in cardData" key="card.id" class="column is-4">
            <div class="card large">
              <div class="card-image">
                <figure class="image is-16by9">
                  <img :src="card.image" alt="Image">
                </figure>
              </div>
              <div class="card-content">
                <div class="media">
                  <div class="media-content">
                    <p class="title is-4 no-padding">{{card.user.title}}</p>
                    <p>
                      <span class="title is-4 no padding">
                        <a href="Produit?"> Nom du produit</a> </span> </p>
                    <p class="subtitle is-6">Categorie</p>
                  </div>
                </div>
                <div class="content">
                  {{card.content}}
                  <div class="background-icon"><span class="icon-twitter"></span></div>
                </div>
              </div>
            </div>
          </div>
          <div v-for="card in cardData" key="card.id" class="column is-4">
            <div class="card large">
              <div class="card-image">
                <figure class="image is-16by9">
                  <img :src="card.image" alt="Image">
                </figure>
              </div>
              <div class="card-content">
                <div class="media">
                  <div class="media-content">
                    <p class="title is-4 no-padding">{{card.user.title}}</p>
                    <p>
                      <span class="title is-4 no padding">
                        <a href="Produit?"> Nom du produit</a> </span> </p>
                    <p class="subtitle is-6">Categorie</p>
                  </div>
                </div>
                <div class="content">
                  {{card.content}}
                  <div class="background-icon"><span class="icon-twitter"></span></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php require "inc/footer.php"; ?>