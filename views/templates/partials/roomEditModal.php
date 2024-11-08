<!-- Edit Modals -->
<?php use services\Utils;

foreach ($rooms as $room): ?>
    <div class="modal fade" id="editModal<?= $room->getId(); ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title d-flex flex-column">
                        <h2 class="fs-2" id="showModalLabel">Modifier une réservation</h2>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column align-items-center justify-content-center my-5">
                    <form id="editRoom<?= $room->getId(); ?>" class="my-3 d-flex flex-column align-items-center justify-content-center w-100" action="index.php?action=updateRoom&id=<?= $room->getId(); ?>" method="post">
                        <div class="my-3 w-50">
                            <label for="name" hidden="hidden">Nom de la salle</label>
                            <input type="text" class="form-control" id="name" aria-describedby="textHelp" placeholder="Nom de la salle" name="name" value="<?= $room->getName(); ?>" required>
                        </div>
                        <div class="my-3 w-50">
                            <label for="place" hidden="hidden">Lieu</label>
                            <input type="text" class="form-control" id="lieu" aria-describedby="textHelp" placeholder="Lieu" name="lieu" value="<?= $room->getPlace(); ?>" required>
                        </div>
                        <div class="my-3 form-outline" data-mdb-input-init>
                            <label class="form-label" for="capacity">Capacité</label>
                            <input type="number" id="capacity" name="capacity" class="form-control" value="<?= $room->getCapacity(); ?>" required/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#showModal<?= $room->getId(); ?>">Annuler</button>
                    <input type="submit" form="editRoom<?= $room->getId(); ?>" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>