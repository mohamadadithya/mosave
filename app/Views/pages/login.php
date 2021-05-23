<?= $this->extend('/layouts/auth'); ?>
<?= $this->section('content'); ?>
<!-- Login -->
<section id="auth" class="d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="mb-4 text-center">
                    <img src="<?= base_url('/assets/photos/' . $user['photo']); ?>" alt="User photo" width="40%" class="rounded-circle p-1 mb-4 border border-3 border-primary">
                    <h4 class="fw-bolder"><?= $user['username']; ?></h4>
                </div>
                <form action="<?= base_url('/auth/login'); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <input type="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Enter your password" autocomplete="new-password">
                        <div class="invalid-feedback"><?= $validation->getError('password'); ?></div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End of Login -->
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
<?= $this->endSection(); ?>