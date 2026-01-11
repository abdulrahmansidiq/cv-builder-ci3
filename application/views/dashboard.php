<div class="container mt-5">
    <h3>CV Saya</h3>

    <a href="<?= base_url('/') ?>" class="btn btn-primary">Buat CV Baru</a>
    <a href="<?= base_url('logout') ?>" class="btn btn-danger float-end">Logout</a>

    <table class="table mt-3">
        <tr>
            <th>Nama</th>
            <th>Job</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($cv as $c): ?>
            <tr>
                <td><?= $c->full_name ?></td>
                <td><?= $c->job_title ?></td>
                <td>
                    <a href="<?= base_url('preview/simple?id=' . $c->id) ?>" class="btn btn-info btn-sm">View</a>
                </td>
            </tr>
            <tr>
                <th>Nama</th>
                <th>Job</th>
                <th>Template</th>
                <th>Aksi</th>
            </tr>

            <td><?= ucfirst($c->template) ?></td>
            <td>
                <a href="<?= base_url('cv/edit/' . $c->id) ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="<?= base_url('preview?id=' . $c->id) ?>" class="btn btn-info btn-sm">Preview</a>
                <a href="<?= base_url('pdf?id=' . $c->id) ?>" class="btn btn-danger btn-sm">PDF</a>
            </td>
        <?php endforeach ?>
    </table>
</div>