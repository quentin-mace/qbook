<!-- Show Modals -->
<?php use lib\models\User;
use services\Utils;

foreach ($bookings as $booking): ?>
    <div class="modal fade" id="showModal<?= $booking->getId(); ?>" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title d-flex flex-column">
                        <h2 class="fs-2" id="showModalLabel"><?= $booking->getTitle(); ?></h2>
                        <h3 class="fs-4 text-primary"><?= ucfirst($booking->getRoomName()); ?></h3>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column align-items-center justify-content-center my-5">
                    <p class="fs-5"><strong class="fs-4 text-primary"><?= $booking->getParticipantsCount(); ?></strong> Participants</p>
                    <div class="d-flex flex-row gap-5">
                        <div>
                            <p>Du <strong class="fs-4 text-primary"><?= $booking->getFormatedStartDate(Utils::DATE_FULL_FORMAT); ?></strong></p>
                            <p>A <strong class="fs-4 text-primary"><?= $booking->getFormatedStartHour(); ?></strong></p>
                        </div>
                        <div>
                            <p>Au <strong class="fs-4 text-primary"><?= $booking->getFormatedEndDate(Utils::DATE_FULL_FORMAT); ?></strong></p>
                            <p>A <strong class="fs-4 text-primary"><?= $booking->getFormatedEndHour(); ?></strong></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <?php if($user->getRoleId() === User::ADMIN || $booking->getUserId() === $user->getId()): ?>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $booking->getId(); ?>">Modifier</button>
                        <a type="submit" href="index.php?action=deleteBooking&id=<?= $booking->getId(); ?>" class="btn btn-danger" <?= Utils::askConfirmation("Êtes vous sûr de vouloir supprimer cette réservation ?"); ?>>Supprimer</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>