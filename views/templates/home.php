<table class="table table-striped table-hover table-borderless position-relative" style="top: -100px">
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
                <th scope="row"><?= $booking->getRoom()->getName(); ?></th>
                <td><?= $booking->getFormatedDate(); ?></td>
                <td><?= $booking->getUser()->getName(); ?></td>
                <td><?= $booking->getName(); ?></td>
                <td><?= $booking->getParticipantsCount(); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>