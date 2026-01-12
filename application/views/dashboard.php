<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

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
                    <a href="<?= base_url('cv/duplicate/' . $c->id) ?>" class="btn btn-secondary btn-sm" onclick="return confirm('Duplikat CV ini?')">Duplicate</a>
                    <a target="_blank" href="<?= base_url('cv/view/' . $c->share_token) ?>">Open</a>
                </td>
            <?php endforeach ?>
        </table>
    </div>

</body>

</html>