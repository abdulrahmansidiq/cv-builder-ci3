<div style="font-family:Poppins;background:#f8f9fa;padding:30px">

    <div style="text-align:center">
        <h1><?= $profile->full_name ?></h1>
        <span style="color:#0d6efd"><?= $profile->job_title ?></span>
    </div>

    <hr>

    <div class="row">

        <h4>Experience</h4>
        <?php foreach ($exp as $x): ?>
            <div style="background:white;padding:10px;margin-bottom:10px;border-radius:10px">
                <b><?= $x->company ?></b>
                <p><?= $x->position ?></p>
            </div>
        <?php endforeach ?>

        <h4>Skills</h4>
        <?php foreach ($skills as $s): ?>
            <span style="background:#0d6efd;color:white;padding:5px 10px;border-radius:20px">
                <?= $s->skill_name ?>
            </span>
        <?php endforeach ?>

    </div>
</div>