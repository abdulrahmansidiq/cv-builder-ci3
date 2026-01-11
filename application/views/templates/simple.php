<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/pdf.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/cv.css') ?>">
</head>

<body>

    <div class="cv-box">
        <?php if ($profile->photo): ?>
            <img src="<?= FCPATH . 'uploads/' . $profile->photo ?>" width="120">
        <?php endif ?>

        <div class="page-break" style="max-width:800px;margin:auto;font-family:Arial">

            <h2><?= $profile->full_name ?></h2>
            <p><?= $profile->job_title ?></p>
            <hr>

            <h4>About</h4>
            <p><?= $profile->about ?></p>

            <h4>Pendidikan</h4>
            <?php foreach ($edu as $e): ?>
                <p><?= $e->school ?> (<?= $e->year ?>)</p>
            <?php endforeach ?>

            <h4>Pengalaman</h4>
            <?php foreach ($exp as $x): ?>
                <p><?= $x->company ?> - <?= $x->position ?></p>
            <?php endforeach ?>

            <h4>Skill</h4>
            <ul>
                <?php foreach ($skills as $s): ?>
                    <li><?= $s->skill_name ?></li>
                <?php endforeach ?>
            </ul>

        </div>

        <a href="<?= base_url('pdf/simple?id=' . $profile->id) ?>"
            class="btn btn-danger mb-3">Download PDF</a>

    </div>

</body>

</html>