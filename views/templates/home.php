<section  class="d-flex align-items-center justify-content-start vh-100 flex-column" xmlns="http://www.w3.org/1999/html">
    <?php if(isset($infoMessage)): ?>
        <div class="alert alert-primary mt-4 mb-4" role="alert">
            <?= $infoMessage ?>
        </div>
    <?php endif; ?>
    <?php if(isset($errorMessage)): ?>
        <div class="alert alert-danger mt-4 mb-4" role="alert">
            <?= $errorMessage ?>
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


<!-- Edit Modals -->
<?php foreach ($bookings as $booking): ?>
    <div class="modal fade" id="editModal<?= $booking->getId(); ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title d-flex flex-column">
                        <h2 class="fs-2" id="showModalLabel">Modifier une réservation</h2>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column align-items-center justify-content-center my-5">
                    <form id="editBooking<?= $booking->getId(); ?>" class="my-3 d-flex flex-column align-items-center justify-content-center w-100" action="index.php?action=updateBooking&id=<?= $booking->getId(); ?>" method="post">
                        <div class="my-3 w-50">
                            <label for="title" hidden="hidden">Nom de la réservation</label>
                            <input type="text" class="form-control" id="title" aria-describedby="textHelp" placeholder="Nom de la réservation" name="title" value="<?= $booking->getTitle(); ?>" required>
                        </div>
                        <div class="my-3 w-50">
                            <label for="roomSelected" hidden="hidden">Salle</label>
                            <select id="roomSelected" name="roomSelected" class="form-select" aria-label="Select room" required>
                                <?php foreach ($rooms as $room): ?>
                                    <option value="<?= $room->getId(); ?>" <?= $booking->getRoomId() === $room->getId() ? 'selected' : ''; ?>><?= ucfirst($room->getName()); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="my-3 form-outline" data-mdb-input-init>
                            <label class="form-label" for="participantCount">Nombre de participants</label>
                            <input type="number" id="participantCount" name="participantCount" class="form-control" value="<?= $booking->getParticipantsCount(); ?>" required/>
                        </div>
                        <div class="my-3 d-flex flex-row justify-content-center align-items-center gap-4">
                            <div class="my-3">
                                <label for="startDate">Début</label>
                                <input type="datetime-local" id="startDate" name="startDate" class="form-control" value="<?= $booking->getFormatedStartDate(\services\Utils::DATETIME_FORMAT); ?>" required>
                            </div>
                            <div class="my-3">
                                <label for="endDate">Fin</label>
                                <input type="datetime-local" id="endDate" name="endDate" class="form-control" value="<?= $booking->getFormatedStartDate(\services\Utils::DATETIME_FORMAT); ?>" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#showModal<?= $booking->getId(); ?>">Annuler</button>
                    <input type="submit" form="editBooking<?= $booking->getId(); ?>" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title d-flex flex-column">
                    <h2 class="fs-2" id="showModalLabel">Nouvelle réservation</h2>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column align-items-center justify-content-center my-5">
                <form id="createBooking" class="my-3 d-flex flex-column align-items-center justify-content-center w-100" action="index.php?action=createBooking" method="post">
                    <div class="my-3 w-50">
                        <label for="title" hidden="hidden">Nom de la réservation</label>
                        <input type="text" class="form-control" id="title" aria-describedby="textHelp" placeholder="Nom de la réservation" name="title" required>
                    </div>
                    <div class="my-3 w-50">
                        <label for="roomSelected" hidden="hidden">Salle</label>
                        <select id="roomSelected" name="roomSelected" class="form-select" aria-label="Select room" required>
                            <option value="" disabled selected>Choisir une salle</option>
                            <?php foreach ($rooms as $room): ?>
                                <option value="<?= $room->getId(); ?>"><?= ucfirst($room->getName()); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="my-3 form-outline" data-mdb-input-init>
                        <label class="form-label" for="participantCount">Nombre de participants</label>
                        <input type="number" id="participantCount" name="participantCount" class="form-control" required/>
                    </div>
                    <div class="my-3 d-flex flex-row justify-content-center align-items-center gap-4">
                        <div class="my-3">
                            <label for="startDate">Début</label>
                            <input type="datetime-local" id="startDate" name="startDate" class="form-control" required>
                        </div>
                        <div class="my-3">
                            <label for="endDate">Fin</label>
                            <input type="datetime-local" id="endDate" name="endDate" class="form-control" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <input type="submit" form="createBooking" class="btn btn-primary">
            </div>
        </div>
    </div>
</div>