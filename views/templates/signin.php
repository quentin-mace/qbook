<section class="d-flex align-items-center justify-content-center vh-100 flex-column">
    <?php if(isset($errorMessage)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $errorMessage ?>
        </div>
    <?php endif; ?>

    <h1 class="my-5 text-center">Créez un compte</h1>
    <form class="my-3 d-flex flex-column align-items-center justify-content-center w-100" action="index.php?action=confirmSignin" method="post">
        <div class="my-3 w-50">
            <label for="name" hidden="hidden">Nom</label>
            <input type="text" class="form-control" id="name" placeholder="Nom" name="name" required>
        </div>
        <div class="my-3 w-50">
            <label for="email" hidden="hidden">E-mail</label>
            <input type="email" class="form-control" id="email" placeholder="Adresse email" name="email" required>
        </div>
        <div class="my-3 w-50">
            <label for="password" hidden="hidden">Mot de passe</label>
            <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password" required>
        </div>
        <div class="my-3 w-50">
            <label for="confirmPassword" hidden="hidden">Mot de passe</label>
            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirmez le mot de passe" name="confirmPassword" required>
        </div>
        <p class="my-3 text-center">Déja un compte ?</p>
        <a href="index.php?action=login" class="text-center">Connectez-vous</a>
        <br>
        <button class="btn btn-primary my-5">Créer mon compte</button>
    </form>
</section>