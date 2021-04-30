<?php require "inc/header.php"; ?>
<section class="hero is-light is-medium">
        <div>
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-black">Se connecter</h3>
                    <hr class="login-hr">
                    <p class="subtitle has-text-black">Entrez vos identifiants.</p>
                    <div class="box">
                        <form>
                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" name="email" type="email" placeholder="Email" autofocus="" required>
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" name="password" type="password" placeholder="Mot de passe" required>
                                </div>
                            </div>
                            <button type="submit" name="login_submit" class="button is-block is-info is-large is-fullwidth">C'est parti !<i class="fa fa-sign-in" aria-hidden="true"></i></button>
                        </form>
                    </div>
                    <p class="has-text-grey">
                        <a href="signin.php">S'inscrire</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    

<?php require "inc/footer.php"; ?>
