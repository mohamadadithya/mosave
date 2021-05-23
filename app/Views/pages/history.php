<?= $this->extend('/layouts/main'); ?>
<?= $this->section('content'); ?>
<!-- History -->
<section id="history">
    <div class="container">
        <h2 class="fw-bolder mb-4">History</h2>
        <?php if ($histories) : ?>
            <div class="row mb-3">
                <?php foreach ($histories as $history) : ?>
                    <div class="col-md-6 mb-3">
                        <div class="card p-3">
                            <div class="card-body d-flex justify-content-between">
                                <div>
                                    <h5 class="fw-bolder"><?= $history['description']; ?></h5>
                                    <span id="status" class="text-secondary"><?= humanTime($history['time']); ?></span>
                                </div>
                                <h6 class="fw-bolder text-success">+Rp <?= number_format($history['nominal']); ?></h6>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <span>Your history still empty...</span>
        <?php endif; ?>
        <?= $pager->links('histories', 'histories_pagination'); ?>
    </div>
</section>
<!-- End of History -->
<?= $this->endSection(); ?>