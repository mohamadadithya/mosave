<?= $this->extend('/layouts/auth'); ?>
<?= $this->section('content'); ?>
<!-- Register -->
<section id="auth" class="d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <h2 class="fw-bolder mb-2">Register for Once</h2>
                <p class="mb-4 text-secondary">Mosave uses an authentication system for security, so please register and set a password first.</p>
                <form action="<?= base_url('/auth/save_user'); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" placeholder="Enter your name" value="<?= old('username'); ?>">
                        <div class="invalid-feedback"><?= $validation->getError('username'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Enter your password" autocomplete="new-password">
                        <div class="invalid-feedback"><?= $validation->getError('password'); ?></div>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="show-password" onclick="showPassword()">
                        <label class="form-check-label" for="show-password">
                            Show password
                        </label>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.7/dist/sweetalert2.all.min.js"></script>
<script>
    function showPassword() {
        const passwordInput = document.getElementById('password');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    }
</script>
<!-- End of Register -->
<?= $this->endSection(); ?>