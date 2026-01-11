<div style="max-width:800px;margin:auto;font-family:Arial">

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