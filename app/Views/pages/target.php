<?= $this->extend('/layouts/main'); ?>
<?= $this->section('content'); ?>
<!-- Target Detail -->
<section id="target-detail">
    <div class="container mb-5">
        <h2 class="fw-bolder mb-3"><?= $target['target_name']; ?></h2>
        <span class="text-secondary fw-bold fs-5">Rp <?= number_format($target['target_nominal']); ?></span>
        <div class="row mt-4">
            <div class="col-md-6">
                <ul class="list-unstyled">
                    <li class="mb-3 fw-bold">Target Remaining</li>
                    <li class="mb-3 text-secondary">Rp <?= number_format($target['target_nominal'] - $target['saving_nominal']); ?></li>
                    <li class="mb-3 fw-bold">Months Duration</li>
                    <li class="mb-3 text-secondary"><?= $target['duration']; ?> Months</li>
                    <li class="mb-3 fw-bold">Monthly Saving</li>
                    <li class="mb-3 text-secondary">Rp <?= monthlySaving($target['target_nominal'], $target['duration']); ?></li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-unstyled">
                    <li class="mb-3 fw-bold">Daily Saving</li>
                    <li class="mb-3 text-secondary">Rp <?= dailySaving($target['target_nominal'], $target['duration']); ?></li>
                    <li class="mb-3 fw-bold">Description</li>
                    <li class="mb-3 text-secondary"><?= ($target['target_description']) ? $target['target_description'] : 'No Description'; ?></li>
                </ul>
            </div>
        </div>
        <div class="text-end mt-5">
            <form action="<?= base_url('/save-money'); ?>" method="POST" class="d-inline">
                <?= csrf_field(); ?>
                <input type="hidden" name="target_id" value="<?= $target['target_id']; ?>">
                <button type="submit" class="btn btn-success me-2"><i class="bi bi-box-arrow-in-down"></i> Save Money</button>
            </form>
            <form action="<?= base_url('/targets/' . $target['target_id']); ?>" method="POST" class="d-inline" id="form-delete">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="DELETE">
                <button type="button" class="btn btn-danger" onclick="deleteTargetAlert()"><i class="bi bi-trash"></i> Delete</button>
            </form>
        </div>
        <?php if ($settings) : ?>
            <?php if ($settings['history_in_target'] == 1) : ?>
                <hr>
                <div class="row" id="history">
                    <div class="mb-3 d-flex justify-content-between">
                        <h5 class="fw-bold">History</h5>
                        <span class="text-success fw-bold">Rp <?= number_format($target['saving_nominal']); ?></span>
                    </div>
                    <?php if ($histories) : ?>
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
                    <?php else : ?>
                        <span>You haven't saved for this target.</span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>
<!-- End of Target Detail -->
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

    function deleteTargetAlert() {
        const formDelete = document.getElementById('form-delete');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                formDelete.submit();
            }
        })
    }
</script>
<?= $this->endSection(); ?>