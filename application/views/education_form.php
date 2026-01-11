<div class="container mt-5">
    <h4>Form Pendidikan</h4>

    <form method="post">
        <input class="form-control mb-2" name="school" placeholder="Nama Sekolah"
            value="<?= isset($row) ? $row->school : '' ?>">

        <input class="form-control mb-2" name="major" placeholder="Jurusan"
            value="<?= isset($row) ? $row->major : '' ?>">

        <input class="form-control mb-2" name="year" placeholder="Tahun"
            value="<?= isset($row) ? $row->year : '' ?>">

        <button class="btn btn-success">Simpan</button>
        <a href="<?= base_url('education') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>