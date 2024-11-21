<section  class="d-flex align-items-center justify-content-start vh-100 flex-column" xmlns="http://www.w3.org/1999/html">
    <?php use lib\models\User;
    use services\Utils;

    if(isset($infoMessage)): ?>
        <div class="alert alert-primary mt-4 mb-4" role="alert">
            <?= $infoMessage ?>
        </div>
    <?php endif; ?>
    <?php if(isset($errorMessage)): ?>
        <div class="alert alert-danger mt-4 mb-4" role="alert">
            <?= $errorMessage ?>
        </div>
    <?php endif; ?>

    <h2 class="mt-5 fs-1">Utilisateurs</h2>

    <div class="h-100 d-flex align-items-center justify-content-center flex-column w-100">
        <table class="table table-striped table-hover table-borderless w-100 position-relative" style="top: -100px">
            <thead class="table-secondary text-uppercase">
            <tr>
                <th scope="col">Utilisateur</th>
                <th scope="col">Role</th>
                <th scope="col">Promotion</th>
            </tr>
            </thead>
            <tbody class="">
            <?php foreach ($users as $user): ?>
                <tr class="">
                    <th scope="row"><?= ucfirst($user->getName()); ?></th>
                    <td><?= $user->getRoleId() === 1 ? "Utilisateur" : "Administrateur"; ?></td>
                    <td><?= $user->getRoleId() === 1 ? '<a href="#"><i class="fa-solid fa-bolt" style="color: #6f42c1;"></i></a>' : ""; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
