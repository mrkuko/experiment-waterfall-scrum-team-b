<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h1 class="mb-4">Zoznam učební</h1>

<?php if (empty($rooms)): ?>
    <div class="alert alert-info">
        Zatiaľ nie je evidovaná žiadna učebňa.
    </div>
<?php else: ?>
    <table class="table table-striped table-hover align-middle">
        <thead>
            <tr>
                <th>Kód</th>
                <th>Názov</th>
                <th>Kapacita</th>
                <th>Typ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rooms as $room): ?>
                <tr>
                    <td><?= esc($room['code']) ?></td>
                    <td><?= esc($room['name']) ?></td>
                    <td><?= esc($room['capacity']) ?></td>
                    <td><?= esc(\App\Models\RoomModel::typeLabel($room['type'])) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>

<?= $this->endSection() ?>