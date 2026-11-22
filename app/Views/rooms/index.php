<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Zoznam učební</h1>
    <a href="/rooms/new" class="btn btn-primary">Pridať učebňu</a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= esc(session()->getFlashdata('success')) ?>
    </div>
<?php endif ?>

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