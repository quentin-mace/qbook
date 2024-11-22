<!-- Show Modals -->
<?php use lib\models\User;
use services\Utils;

foreach ($rooms as $room): ?>
    <div class="modal fade" id="showModal<?= $room->getId(); ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title d-flex flex-column">
                        <h2 class="fs-2"><?= ucfirst($room->getName()); ?></h2>
                        <h3 class="fs-4 text-primary"><?= ucfirst($room->getPlace() ?? ""); ?></h3>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column align-items-center justify-content-center my-5">
                    <p class="fs-5">Capacité : <strong class="fs-4 text-primary"><?= $room->getCapacity(); ?></strong> Personnes</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $room->getId(); ?>">Modifier</button>
                    <a href="index.php?action=deleteRoom&id=<?= $room->getId(); ?>" class="btn btn-danger" <?= Utils::askConfirmation("Êtes vous sûr de vouloir supprimer cette salle ?"); ?>>Supprimer</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>