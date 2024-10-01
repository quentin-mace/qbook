<section  class="d-flex align-items-center justify-content-start vh-100 flex-column" xmlns="http://www.w3.org/1999/html">
    <?php if(isset($infoMessage)): ?>
        <div class="alert alert-primary mt-4 mb-4" role="alert">
            <?= $infoMessage ?>
        </div>
    <?php endif; ?>
    <div class="h-100 d-flex align-items-center justify-content-center flex-column w-100">
        <table class="table table-striped table-hover table-borderless w-100 position-relative" style="top: -100px">
            <thead class="table-secondary text-uppercase">
                <tr>
                    <th scope="col">Salle</th>
                    <th scope="col">Date</th>
                    <th scope="col">Organisateur</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Nombre de Participants</th>
                </tr>
            </thead>
            <tbody class="">
                <?php foreach ($bookings as $booking): ?>
                    <tr class="row-link" data-bs-toggle="modal" data-bs-target="#showModal<?= $booking->getId(); ?>";">
                        <th scope="row"><?= ucfirst($booking->getRoomName()); ?></th>
                        <td><?= $booking->getFormatedStartDate(\services\Utils::DATE_SHORT_FORMAT); ?></td>
                        <td><?= $booking->getUserName(); ?></td>
                        <td><?= $booking->getTitle(); ?></td>
                        <td><?= $booking->getParticipantsCount(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<!-- Show Modals -->
<?php foreach ($bookings as $booking): ?>
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
                            <p>Du <strong class="fs-4 text-primary"><?= $booking->getFormatedStartDate(\services\Utils::DATE_FULL_FORMAT); ?></strong></p>
                            <p>A <strong class="fs-4 text-primary"><?= $booking->getFormatedStartHour(); ?></strong></p>
                        </div>
                        <div>
                            <p>Au <strong class="fs-4 text-primary"><?= $booking->getFormatedEndDate(\services\Utils::DATE_FULL_FORMAT); ?></strong></p>
                            <p>A <strong class="fs-4 text-primary"><?= $booking->getFormatedEndHour(); ?></strong></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <?php if($user->getRoleId() === \lib\models\User::ADMIN || $booking->getUserId() === $user->getId()): ?>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $booking->getId(); ?>">Modifier</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>