<?php require "inc/header.php"; ?>
    <section class="hero is-light is-medium">
        <div>
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-black">S'inscrire</h3>
                    <hr class="login-hr">
                    <p class="subtitle has-text-black">Entrez vos informations.</p>
                    <div class="box">
                        <form>
                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" type="text" placeholder="Nom d'utilisateur" autofocus="">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" type="email" placeholder="Email" autofocus="">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" type="password" id ="InputPassword1" name="password1_signin" placeholder="Mot de passe">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" type="password" id ="InputPassword2" name="password2_signin" placeholder="Confirmation" autofocus="">
                                </div>
                            </div>
                            <button class="button is-block is-info is-large is-fullwidth">C'est parti !<i class="fa fa-sign-in" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php require "inc/footer.php"; ?>