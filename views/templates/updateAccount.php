<section class="d-flex align-items-center justify-content-center vh-100 flex-column">
    <?php if(isset($errorMessage)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $errorMessage ?>
        </div>
    <?php endif; ?>
    <?php if(isset($infoMessage)): ?>
        <div class="alert alert-primary" role="alert">
            <?= $infoMessage ?>
        </div>
    <?php endif; ?>

    <h2 class="my-5 text-center">Mettre à jour mon compte</h2>
    <form class="my-1 d-flex flex-column align-items-center justify-content-center w-100" action="index.php?action=updateAccountInfo" method="post">
        <div class="my-3 w-50">
            <label for="name" hidden="hidden">Name</label>
            <input type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Nom" name="name" value="<?= $user->getName(); ?>" required>
        </div>
        <div class="my-3 w-50">
            <label for="email" hidden="hidden">E-mail</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Adresse email" name="email" value="<?= $user->getEmail(); ?>" required>
        </div>
        <button class="btn btn-primary my-5">Mettre à jour</button>
    </form>

    <form class="my-1 d-flex flex-column align-items-center justify-content-center w-100" action="index.php?action=updatePassword" method="post">
        <div class="my-3 w-50">
            <label for="oldPassword" hidden="hidden">Old Password</label>
            <input type="password" class="form-control" id="oldPassword" aria-describedby="oldPasswordHelp" placeholder="Ancien mot de passe" name="oldPassword" required>
        </div>
        <div class="my-3 w-50">
            <label for="newPassword" hidden="hidden">New Password</label>
            <input type="password" class="form-control" id="newPassword" aria-describedby="newPasswordHelp" placeholder="Nouveau mot de passe" name="newPasswordHelp" required>
        </div>
        <div class="my-3 w-50">
            <label for="confirmPassword" hidden="hidden">Confirm New Password</label>
            <input type="password" class="form-control" id="confirmPassword" aria-describedby="confirmPasswordHelp" placeholder="Confirmer nouveau mot de passe" name="confirmPassword" required>
        </div>
        <button class="btn btn-danger my-5">Changer le mot de passe</button>
    </form>
</section>