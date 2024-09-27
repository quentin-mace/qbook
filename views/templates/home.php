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
                    <tr class="row-link" onclick="window.location='index.php?action=home';">
                        <th scope="row"><?= ucfirst($booking->getRoomName()); ?></th>
                        <td><?= $booking->getFormatedStartDate(); ?></td>
                        <td><?= $booking->getUserName(); ?></td>
                        <td><?= $booking->getTitle(); ?></td>
                        <td><?= $booking->getParticipantsCount(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>