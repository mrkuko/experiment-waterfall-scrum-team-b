<?php
use App\Models\RoomModel;

// v databáze je čas v UTC, zobrazujeme slovenský čas
function formatDate(?string $date): string
{
    if (! $date) {
        return '-';
    }

    return (new DateTime($date, new DateTimeZone('UTC')))
        ->setTimezone(new DateTimeZone('Europe/Bratislava'))
        ->format('d.m.Y H:i');
}
?>
<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php if ($room === null): ?>

    <div class="bg-white border rounded-4 p-4 p-md-5">
        <h1 class="h3 mb-3">Učebňa neexistuje</h1>
        <p class="fs-5 mb-4">Učebňa s týmto ID neexistuje.</p>
        <a href="/rooms" class="btn btn-light border rounded-3 px-4 py-2">Späť na zoznam</a>
    </div>

<?php else: ?>

    <h1 class="h2 mb-1">Detail učebne</h1>
    <p class="text-secondary mb-4"><?= esc($room['code']) ?></p>

    <div class="bg-white border rounded-4 p-4 p-md-5">
        <div class="row g-4 mb-4">
            <div class="col-md-7">
                <div class="fw-semibold mb-2">Názov učebne</div>
                <div class="border rounded-4 px-4 py-2"><?= esc($room['name']) ?></div>
            </div>
            <div class="col-md-5">
                <div class="fw-semibold mb-2">Kód učebne</div>
                <div class="border rounded-4 px-4 py-2"><?= esc($room['code']) ?></div>
            </div>
            <div class="col-md-7">
                <div class="fw-semibold mb-2">Typ učebne</div>
                <div class="border rounded-4 px-4 py-2"><?= esc(RoomModel::typeLabel($room['type'])) ?></div>
            </div>
            <div class="col-md-5">
                <div class="fw-semibold mb-2">Kapacita</div>
                <div class="border rounded-4 px-4 py-2"><?= esc($room['capacity']) ?></div>
            </div>
        </div>

        <p class="text-secondary small mb-4">
            Pridaná <?= esc(formatDate($room['created_at'])) ?>,
            naposledy upravená <?= esc(formatDate($room['updated_at'])) ?>
        </p>

        <a href="/rooms" class="btn btn-light border rounded-3 px-4 py-2">Späť na zoznam</a>
    </div>

<?php endif; ?>

<?= $this->endSection() ?>
