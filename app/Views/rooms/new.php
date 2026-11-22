<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h1 class="mb-4">Pridať učebňu</h1>

<form action="/rooms" method="post" class="col-md-6">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label for="code" class="form-label">Kód</label>
        <input type="text" class="form-control" id="code" name="code"
               value="<?= esc(old('code')) ?>" maxlength="20" required>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Názov</label>
        <input type="text" class="form-control" id="name" name="name"
               value="<?= esc(old('name')) ?>" maxlength="80" required>
    </div>

    <div class="mb-3">
        <label for="capacity" class="form-label">Kapacita</label>
        <input type="number" class="form-control" id="capacity" name="capacity"
               value="<?= esc(old('capacity')) ?>" min="1" max="300" required>
    </div>

    <div class="mb-3">
        <label for="type" class="form-label">Typ</label>
        <select class="form-select" id="type" name="type" required>
            <option value="">-- vyberte typ --</option>
            <?php foreach ($types as $value => $label): ?>
                <option value="<?= esc($value) ?>" <?= old('type') === $value ? 'selected' : '' ?>>
                    <?= esc($label) ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Uložiť</button>
    <a href="/rooms" class="btn btn-secondary">Späť na zoznam</a>
</form>

<?= $this->endSection() ?>