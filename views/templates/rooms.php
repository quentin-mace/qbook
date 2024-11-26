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

    <h2 class="mt-5 fs-1">Salles</h2>

    <div class="h-100 d-flex align-items-center justify-content-center flex-column w-100">
        <table class="table table-striped table-hover table-borderless w-100 position-relative" style="top: -100px">
            <thead class="table-secondary text-uppercase">
            <tr>
                <th scope="col">Salle</th>
                <th scope="col">Lieu</th>
                <th scope="col">Capacité</th>
            </tr>
            </thead>
            <tbody class="">
            <?php foreach ($rooms as $room): ?>
                <tr class="row-link" data-bs-toggle="modal" data-bs-target="#showModal<?= $room->getId();?>">
                    <th scope="row"><?= ucfirst($room->getName()); ?></th>
                    <td><?= ucfirst($room->getPlace() ?? "Aucun"); ?></td>
                    <td><?= $room->getCapacity(); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require './views/templates/partials/roomShowModal.php' ?>
<?php require './views/templates/partials/roomEditModal.php' ?>


<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title d-flex flex-column">
                    <h2 class="fs-2" id="createModalLabel">Nouvelle Salle</h2>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column align-items-center justify-content-center my-5">
                <form id="createRoom" class="my-3 d-flex flex-column align-items-center justify-content-center w-100" action="index.php?action=createRoom" method="post">
                    <div class="my-3 w-50">
                        <label for="name" hidden="hidden">Nom de la Salle</label>
                        <input type="text" class="form-control" id="name" placeholder="Nom de la salle" name="name" required>
                    </div>
                    <div class="my-3 w-50">
                        <label for="place" hidden="hidden">Lieu</label>
                        <input type="text" class="form-control" id="place" placeholder="Lieu" name="place" required>
                    </div>
                    <div class="my-3 form-outline" data-mdb-input-init>
                        <label class="form-label" for="capacity">Capacité</label>
                        <input type="number" id="capacity" name="capacity" class="form-control" required/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <input type="submit" value="Ajouter" form="createRoom" class="btn btn-primary">
            </div>
        </div>
    </div>
</div>
