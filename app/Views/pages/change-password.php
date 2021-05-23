<?= $this->extend('/layouts/main'); ?>
<?= $this->section('content'); ?>
<!-- Change Password -->
<section id="change-password">
    <div class="container">
        <h2 class="fw-bolder mb-4">Change Password</h2>
        <div class="row">
            <div class="col-md-6">
                <form action="<?= base_url('/settings/update_password'); ?>" method="POST">
                    <div class="mb-3">
                        <label for="current-password" class="form-label">Current Password</label>
                        <input type="password" class="form-control <?= ($validation->hasError('current-password')) ? 'is-invalid' : ''; ?>" id="current-password" name="current-password" placeholder="Enter your current password" autocomplete="new-password">
                        <div class="invalid-feedback"><?= $validation->getError('current-password'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="new-password" class="form-label">New Password</label>
                        <input type="password" class="form-control <?= ($validation->hasError('new-password')) ? 'is-invalid' : ''; ?>" id="new-password" name="new-password" placeholder="Enter your new password" autocomplete="new-password">
                        <div class="invalid-feedback"><?= $validation->getError('new-password'); ?></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.7/dist/sweetalert2.all.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // If session error
        <?php if (session()->getFlashdata('error')) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?= session()->getFlashdata('error'); ?>',
            })
        <?php endif; ?>
    });
</script>
<!-- End of Change Password -->
<?= $this->endSection(); ?>