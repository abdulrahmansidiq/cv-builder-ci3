<div class="container mt-5">
    <h2><?= $profile->full_name ?></h2>
    <h5><?= $profile->job_title ?></h5>

    <p><?= $profile->about ?></p>

    <hr>
    <h4>Pendidikan</h4>
    <?php foreach ($edu as $e): ?>
        <p><?= $e->school ?> - <?= $e->year ?></p>
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