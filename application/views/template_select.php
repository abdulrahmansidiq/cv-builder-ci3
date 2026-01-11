<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h3>Pilih Template CV</h3>

    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <img src="https://via.placeholder.com/300x200">
                <div class="card-body text-center">
                    <h5>Simple</h5>
                    <a href="<?= base_url('preview/simple') ?>" class="btn btn-primary">Pilih</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <img src="https://via.placeholder.com/300x200">
                <div class="card-body text-center">
                    <h5>Modern</h5>
                    <a href="<?= base_url('preview/modern') ?>" class="btn btn-primary">Pilih</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <img src="https://via.placeholder.com/300x200">
                <div class="card-body text-center">
                    <h5>Creative</h5>
                    <a href="<?= base_url('preview/creative') ?>" class="btn btn-primary">Pilih</a>
                </div>
            </div>
        </div>

    </div>
</div>