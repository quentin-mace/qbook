<section class="d-flex align-items-center justify-content-center vh-100 flex-column" xmlns="http://www.w3.org/1999/html">
    <?php if(isset($errorMessage)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $errorMessage ?>
        </div>
    <?php endif; ?>

    <h1 class="my-5 text-center">Connectez-vous à votre compte</h1>
    <form class="my-3 d-flex flex-column align-items-center justify-content-center w-100" action="index.php?action=confirmLogin" method="post">
        <div class="my-3 w-50">
            <label for="email" hidden="hidden">E-mail</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Adresse email" name="email" required>
        </div>
        <div class="my-3 w-50">
            <label for="password" hidden="hidden">Mot de passe</label>
            <input type="password" class="form-control" id="password" aria-describedby="passwordHelp" placeholder="Mot de passe" name="password" required>
        </div>
        <p class="my-3 text-center">Pas encore de compte ?</p>
        <a href="index.php?action=signin" class="text-center">S'inscrire</a>
        <br>
        <button class="btn btn-primary my-5">Se connecter</button>
    </form>
</section>