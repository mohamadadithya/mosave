<?= $this->extend('/layouts/main'); ?>
<?= $this->section('content'); ?>
<!-- Settings -->
<section id="settings">
    <div class="container">
        <h2 class="fw-bolder mb-4">Settings</h2>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header fw-bold">User Setting</div>
                    <form action="<?= base_url('/settings/update_user'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <img src="<?= base_url('/assets/photos/' . $user['photo']); ?>" class="me-4 rounded-circle border border-2 border-primary p-1" id="user-photo" width="150" alt="User Profile">
                                <div class="flex-column">
                                    <div class="input-group mb-2">
                                        <input type="file" onchange="changePhoto()" class="form-control <?= ($validation->hasError('photo-input')) ? 'is-invalid' : ''; ?>" id="photo-input" name="photo-input" aria-label="Upload">
                                    </div>
                                    <small>Acceptable formats: jpg and png only <br> Max file size is 1 mb</small>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" placeholder="Enter your username" value="<?= ($validation->hasError('username')) ? old('username') : $user['username']; ?>">
                                <div class="invalid-feedback"><?= $validation->getError('username'); ?></div>
                            </div>
                            <button type="submit" class="btn btn-primary mb-3">Update</button>
                            <a href="<?= base_url('/user/change-password'); ?>" class="d-block">Wanna change your password?</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header fw-bolder">Web Setting</div>
                    <div class="card-body">
                        <form action="<?= base_url('/settings/save'); ?>" method="POST">
                            <div class="mb-3">
                                <label for="web-title" class="form-label">Web Title</label>
                                <input type="text" class="form-control <?= ($validation->hasError('web-title')) ? 'is-invalid' : ''; ?>" id="web-title" name="web-title" value="<?= ($settings) ? $settings['web_title'] : 'MoSave'; ?>">
                                <div class="invalid-feedback"><?= $validation->getError('web-title'); ?></div>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <?php if ($settings) : ?>
                                    <input class="form-check-input" <?= ($settings['history_in_target'] == 1) ? 'checked' : ''; ?> type="checkbox" id="history-in-target" name="history-in-target" value="1">
                                    <label class="form-check-label" for="history-in-target">History in Target</label>
                                <?php else : ?>
                                    <input class="form-check-input" type="checkbox" id="history-in-target" name="history-in-target" value="1">
                                    <label class="form-check-label" for="history-in-target">History in Target</label>
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.7/dist/sweetalert2.all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        <?php if (session()->getFlashdata('message')) : ?>
            Swal.fire(
                'Success',
                '<?= session()->getFlashdata('message'); ?>',
                'success'
            )
        <?php endif; ?>
    });

    function changePhoto() {
        const userPhoto = document.getElementById('user-photo');
        const photoInput = document.getElementById('photo-input');
        const photoFile = new FileReader();

        photoFile.readAsDataURL(photoInput.files[0]);
        photoFile.onload = (e) => {
            userPhoto.src = e.target.result;
        }
    }
</script>
<!-- End of Settings -->
<?= $this->endSection(); ?>