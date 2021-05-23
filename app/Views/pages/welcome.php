<?= $this->extend('/layouts/auth'); ?>
<?= $this->section('content'); ?>
<!-- Welcome -->
<section id="welcome" class="d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <img src="/assets/welcome-illustration.svg" class="welcome-illustration" width="80%" alt="Welcome Illustration">
            </div>
            <div class="col-md-6 col-2-welcome">
                <h1 class="fw-bolder mb-4">Welcome to <span class="text-uppercase text-decoration-underline">MoSave</span></h1>
                <p class="text-secondary mb-4">MOSAVE is a web-based open-source savings application that has useful
                    features such as creating a savings target and keeping track of after saving.</p>
                <a href="/register" class="btn btn-primary">Get Started <i class="bi bi-arrow-right-circle"></i></a>
            </div>
        </div>
    </div>
</section>
<!-- End of Welcome -->
<?= $this->endSection(); ?>