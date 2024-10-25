<?php

use services\Utils;

?>
<section class="d-flex flex-row align-items-center justify-content-around gap-5 vh-100">
    <section class="d-flex flex-column align-items-center justify-content-center gap-2">
        <p class="fs-1 bg-primary text-light rounded-circle d-flex justify-content-center align-items-center" style="width: 100px; height: 100px;"><?= ucfirst(substr($user->getName(), 0, 1)) ?></p>
        <h2 class="fs-2"><?= $user->getName(); ?></h2>
        <p class="text-primary"><?= $user->getEmail(); ?></p>
        <button type="button" class="btn btn-primary" onclick="window.location.href='index.php?action=updateAccount'">Modifier le profil</button>
    </section>
    <section class="d-flex flex-column align-items-center justify-content-center">
        <div>
            <div class="h-100 d-flex align-items-center justify-content-center flex-column w-100">
                <table class="table table-striped table-hover table-borderless w-100">
                    <thead class="table-primary text-uppercase">
                    <tr>
                        <th scope="col">Salle</th>
                        <th scope="col">Date</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Participants</th>
                    </tr>
                    </thead>
                    <tbody class="">
                    <?php foreach ($bookings as $booking): ?>
                        <tr class="row-link" data-bs-toggle="modal" data-bs-target="#showModal<?= $booking->getId();?>">
                            <th scope="row"><?= ucfirst($booking->getRoomName()); ?></th>
                            <td><?= $booking->getFormatedStartDate(Utils::DATE_SHORT_FORMAT); ?></td>
                            <td><?= $booking->getTitle(); ?></td>
                            <td><?= $booking->getParticipantsCount(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
        </div>
    </section>
</section>


<?php require './views/templates/partials/bookingsShowModals.php' ?>
<?php require './views/templates/partials/bookingsEditModals.php' ?>
