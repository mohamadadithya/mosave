<?= $this->extend('/layouts/main'); ?>
<?= $this->section('content'); ?>
<!-- Save Money -->
<section id="save-money">
    <div class="container">
        <h2 class="fw-bolder mb-4">Save Money</h2>
        <div class="row">
            <div class="col-md-6">
                <form action="<?= base_url('/saving/save_money'); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal</label>
                        <input type="number" class="form-control <?= ($validation->hasError('nominal')) ? 'is-invalid' : ''; ?>" id="nominal" name="nominal" placeholder="0" value="<?= old('nominal'); ?>">
                        <div class="invalid-feedback"><?= $validation->getError('nominal'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="target" class="form-label">Target</label>
                        <select class="form-select" id="target" name="target">
                            <?php if ($targets) : ?>
                                <?php foreach ($targets as $target) : ?>
                                    <option <?= ($target['id'] == $target_id) ? 'selected' : ''; ?> value="<?= $target['id']; ?>"><?= $target['target_name']; ?></option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option selected disabled>Your target still empty...</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description"><?= old('description'); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" <?= ($targets == null) ? 'disabled' : ''; ?>>Save</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End of Save Money -->
<?= $this->endSection(); ?>