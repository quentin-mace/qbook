<!-- Edit Modals -->
<?php use services\Utils;

foreach ($bookings as $booking): ?>
    <div class="modal fade" id="editModal<?= $booking->getId(); ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title d-flex flex-column">
                        <h2 class="fs-2">Modifier une réservation</h2>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column align-items-center justify-content-center my-5">
                    <form id="editBooking<?= $booking->getId(); ?>" class="my-3 d-flex flex-column align-items-center justify-content-center w-100" action="index.php?action=updateBooking&id=<?= $booking->getId(); ?>" method="post">
                        <div class="my-3 w-50">
                            <label for="title<?= $booking->getId(); ?>" hidden="hidden">Nom de la réservation</label>
                            <input type="text" class="form-control" id="title<?= $booking->getId(); ?>" placeholder="Nom de la réservation" name="title" value="<?= $booking->getTitle(); ?>" aria-labelledby="title<?= $booking->getId(); ?>" required>
                        </div>
                        <div class="my-3 w-50">
                            <label for="roomSelected<?= $booking->getId(); ?>" hidden="hidden">Salle</label>
                            <select id="roomSelected<?= $booking->getId(); ?>" name="roomSelected" class="form-select" aria-label="Select room" required>
                                    <option value="">Sélectionnez la salle</option>
                                <?php foreach ($rooms as $room): ?>
                                    <option value="<?= $room->getId(); ?>" <?= $booking->getRoomId() === $room->getId() ? 'selected' : ''; ?>><?= ucfirst($room->getName()); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="my-3 form-outline" data-mdb-input-init>
                            <label class="form-label" for="participantCount<?= $booking->getId(); ?>">Nombre de participants</label>
                            <input type="number" id="participantCount<?= $booking->getId(); ?>" name="participantCount" class="form-control" value="<?= $booking->getParticipantsCount(); ?>" required/>
                        </div>
                        <div class="my-3 d-flex flex-row justify-content-center align-items-center gap-4">
                            <div class="my-3">
                                <label for="startDate<?= $booking->getId(); ?>">Début</label>
                                <input type="datetime-local" id="startDate<?= $booking->getId(); ?>" name="startDate" class="form-control" value="<?= $booking->getFormatedStartDate(Utils::DATETIME_FORMAT); ?>" required>
                            </div>
                            <div class="my-3">
                                <label for="endDate<?= $booking->getId(); ?>">Fin</label>
                                <input type="datetime-local" id="endDate<?= $booking->getId(); ?>" name="endDate" class="form-control" value="<?= $booking->getFormatedEndDate(Utils::DATETIME_FORMAT); ?>" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#showModal<?= $booking->getId(); ?>">Annuler</button>
                    <input type="submit" value="Modifier" form="editBooking<?= $booking->getId(); ?>" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
