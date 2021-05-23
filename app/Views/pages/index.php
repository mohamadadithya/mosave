<?= $this->extend('/layouts/main'); ?>
<?= $this->section('content'); ?>
<!-- Card Info -->
<section id="card-info" class="mb-5">
    <div class="container">
        <div class="card p-3">
            <div class="card-body position-relative d-flex justify-content-between">
                <div>
                    <span class="text-uppercase fw-bolder">Total</span>
                    <h2 class="fw-bolder mt-2">Rp <?= number_format($totalSaving->nominal); ?></h2>
                    <?php if ($totalToday->nominal) : ?>
                        <span class="text-success">+Rp <?= number_format($totalToday->nominal); ?> today</span>
                    <?php endif; ?>
                </div>
                <div>
                    <a type="button" class="bi bi-three-dots-vertical fs-3 text-primary" data-bs-toggle="dropdown"></a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="/make-target">Make Target</a></li>
                        <li><a class="dropdown-item" href="/save-money">Save Money</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End of Card Info -->
<!-- Targets -->
<section id="targets">
    <div class="container">
        <h6 class="fw-bolder mb-3">Targets</h6>
        <?php if ($targets) : ?>
            <div class="row">
                <?php foreach ($targets as $target) : ?>
                    <div class="col-md-6 mb-3">
                        <a href="<?= base_url('/targets/' . $target['slug']); ?>" class="text-primary">
                            <div class="card p-3">
                                <div class="card-body d-flex justify-content-between">
                                    <div>
                                        <h5 class="fw-bolder"><?= $target['target_name']; ?></h5>
                                        <?php if ($target['saving_nominal'] < $target['target_nominal']) : ?>
                                            <span id="status" class="text-secondary"><span class="text-warning">On Progress</span> • <?= $target['duration']; ?> Months</span>
                                        <?php else : ?>
                                            <span id="status" class="text-secondary"><span class="text-success">Completed</span> • <?= $target['duration']; ?> Months</span>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <h6 class="fw-bolder text-success">Rp <?= number_format($target['target_nominal']); ?></h6>
                                        <small class="text-secondary text-end d-block">Rp <?= dailySaving($target['target_nominal'], $target['duration']); ?>/day</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <span>Your target still empty...</span>
        <?php endif; ?>
    </div>
</section>
<!-- End of Targets -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.7/dist/sweetalert2.all.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        <?php if (session()->getFlashdata('message')) : ?>
            Swal.fire(
                'Success',
                '<?= session()->getFlashdata('message'); ?>',
                'success'
            )
        <?php endif; ?>
    });
</script>
<?= $this->endSection(); ?>