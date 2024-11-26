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
                    <tr class="row-link" data-bs-toggle="modal" data-bs-target="#showModal<?= $booking->getId();?>">
                        <th scope="row"><?= ucfirst($booking->getRoomName()); ?></th>
                        <td><?= $booking->getFormatedStartDate(Utils::DATE_SHORT_FORMAT); ?></td>
                        <td><?= $booking->getUserName(); ?></td>
                        <td><?= $booking->getTitle(); ?></td>
                        <td><?= $booking->getParticipantsCount(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require './views/templates/partials/bookingsShowModals.php' ?>
<?php require './views/templates/partials/bookingsEditModals.php' ?>


<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
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
                        <input type="text" class="form-control" id="title" placeholder="Nom de la réservation" name="title" required>
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
                <input type="submit" value="Réserver" form="createBooking" class="btn btn-primary">
            </div>
        </div>
    </div>
</div>
