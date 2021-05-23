<?= $this->extend('/layouts/main'); ?>
<?= $this->section('content'); ?>
<!-- Make Target -->
<section id="make-target">
    <div class="container mb-5">
        <h2 class="fw-bolder mb-4">Make Target</h2>
        <form action="<?= base_url('/target/save_target'); ?>" method="POST">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="target-name" class="form-label">Target Name</label>
                        <input type="text" class="form-control <?= ($validation->hasError('target-name')) ? 'is-invalid' : ''; ?>" id="target-name" name="target-name" placeholder="Enter target name" value="<?= old('target-name'); ?>">
                        <div class="invalid-feedback"><?= $validation->getError('target-name'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nominal')) ? 'is-invalid' : ''; ?>" id="nominal" name="nominal" placeholder="0" value="<?= old('nominal'); ?>">
                        <div class="invalid-feedback"><?= $validation->getError('nominal'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration (Months)</label>
                        <input type="number" class="form-control <?= ($validation->hasError('duration')) ? 'is-invalid' : ''; ?>" id="duration" name="duration" placeholder="0" value="<?= old('duration'); ?>">
                        <div class="invalid-feedback"><?= $validation->getError('duration'); ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <select class="form-select" id="target" name="priority">
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control <?= ($validation->hasError('description')) ? 'is-invalid' : ''; ?>" id="description" name="description" rows="4" placeholder="Enter description"><?= old('description'); ?></textarea>
                        <div class="invalid-feedback"><?= $validation->getError('description'); ?></div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</section>
<!-- End of Make Target -->
<?= $this->endSection(); ?>