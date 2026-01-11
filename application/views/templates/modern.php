<link rel="stylesheet" href="<?= base_url('assets/css/cv.css') ?>">
<div class="cv-box">
    <?php if ($profile->photo): ?>
        <img src="<?= base_url('uploads/' . $profile->photo) ?>" width="120"
            style="border-radius:50%;border:3px solid white;margin-bottom:15px">
    <?php endif ?>

    <div style="display:flex;font-family:Segoe UI">

        <div style="width:30%;background:#222;color:white;padding:20px">
            <h3><?= $profile->full_name ?></h3>
            <p><?= $profile->job_title ?></p>
            <p><?= $profile->email ?></p>

            <h5>Skill</h5>
            <ul>
                <?php foreach ($skills as $s): ?>
                    <li><?= $s->skill_name ?></li>
                <?php endforeach ?>
            </ul>
        </div>

        <div style="width:70%;padding:20px">

            <h4>Profile</h4>
            <p><?= $profile->about ?></p>

            <h4>Experience</h4>
            <?php foreach ($exp as $x): ?>
                <b><?= $x->company ?></b>
                <p><?= $x->position ?> | <?= $x->year ?></p>
                <p><?= $x->description ?></p>
            <?php endforeach ?>

            <h4>Education</h4>
            <?php foreach ($edu as $e): ?>
                <p><?= $e->school ?> - <?= $e->major ?></p>
            <?php endforeach ?>

        </div>
        <a href="<?= base_url('pdf/modern?id=' . $profile->id) ?>">Download PDF</a>

    </div>
</div>