<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container mt-4">

        <h3>Edit CV: <?= $profile->full_name ?></h3>

        <a href="<?= base_url('education/add?cv=' . $profile->id) ?>" class="btn btn-primary btn-sm">+ Pendidikan</a>
        <a href="<?= base_url('experience/add?cv=' . $profile->id) ?>" class="btn btn-primary btn-sm">+ Pengalaman</a>
        <a href="<?= base_url('skills/add?cv=' . $profile->id) ?>" class="btn btn-primary btn-sm">+ Skill</a>

        <hr>

        <h5>Pendidikan</h5>
        <?php foreach ($edu as $e): ?>
            <?= $e->school ?>
            <a href="<?= base_url('education/delete/' . $e->id . '?cv=' . $profile->id) ?>">hapus</a><br>
        <?php endforeach ?>

        <h5>Pengalaman</h5>
        <?php foreach ($exp as $x): ?>
            <?= $x->company ?>
            <a href="<?= base_url('experience/delete/' . $x->id . '?cv=' . $profile->id) ?>">hapus</a><br>
        <?php endforeach ?>

        <h5>Skill</h5>
        <?php foreach ($skills as $s): ?>
            <?= $s->skill_name ?>
            <a href="<?= base_url('skills/delete/' . $s->id . '?cv=' . $profile->id) ?>">hapus</a><br>
        <?php endforeach ?>

    </div>

</body>

</html>