<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h3>Buat CV</h3>

    <form method="post" action="<?= base_url('cv/save_profile') ?>">
        <input class="form-control mb-2" name="full_name" placeholder="Nama Lengkap">
        <input class="form-control mb-2" name="job_title" placeholder="Job Title">
        <input class="form-control mb-2" name="email">
        <input class="form-control mb-2" name="phone">
        <textarea class="form-control mb-2" name="address"></textarea>
        <textarea class="form-control mb-2" name="about"></textarea>
        <button class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('preview') ?>" class="btn btn-success">Preview CV</a>
    </form>
</div>