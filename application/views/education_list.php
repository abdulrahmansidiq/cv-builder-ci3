<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h4>Data Pendidikan</h4>
    <a href="<?= base_url('education/add') ?>" class="btn btn-primary mb-3">Tambah</a>

    <table class="table table-bordered">
        <tr>
            <th>Sekolah</th>
            <th>Jurusan</th>
            <th>Tahun</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($edu as $e): ?>
            <tr>
                <td><?= $e->school ?></td>
                <td><?= $e->major ?></td>
                <td><?= $e->year ?></td>
                <td>
                    <a href="<?= base_url('education/edit/' . $e->id) ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= base_url('education/delete/' . $e->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>