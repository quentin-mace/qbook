<section  class="d-flex align-items-center justify-content-start vh-100 flex-column">
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
                    <td>
                        <?php if($user->getRoleId() === 1) : ?>
                            <a href="index.php?action=upgradeUser&id=<?= $user->getId() ?>" title="Promouvoir" <?= Utils::askConfirmation("Êtes vous sûr de vouloir promouvoir cet utilisateur ?") ?>><i class="fa-solid fa-bolt" style="color: #6f42c1;"></i></a>
                        <?php else: ?>
                            <a href="index.php?action=downgradeUser&id=<?= $user->getId() ?>" title="Déchoir" <?= Utils::askConfirmation("Êtes vous sûr de vouloir déchoir cet utilisateur ?") ?>><i class="fa-solid fa-user-minus" style="color: #6f42c1;"></i></a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
