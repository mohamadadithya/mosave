<!doctype html>
<html lang="en">

<!-- Copyright 2021 by Mohamad Adithya -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Own CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/style.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;600&display=swap" rel="stylesheet">

    <title><?= $title; ?></title>
</head>

<body class="text-primary mb-4">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bolder text-uppercase" href="/"><?= ($settings) ? $settings['web_title'] : 'MoSave'; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <?php if ($histories) : ?>
                        <li class="nav-item">
                            <a class="nav-link fs-5" href="<?= base_url('/history'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="History"><i class="bi bi-clock-history"></i></a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a href="<?= base_url('/settings'); ?>" class="nav-link fs-5" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Settings"><i class="bi bi-gear"></i></a>
                    </li>
                    <li class="nav-item">
                        <form action="<?= base_url('/auth/logout'); ?>" method="post" class="d-inline">
                            <button type="submit" class="btn nav-link fs-5" id="btn-lock" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lock"><i class="bi bi-lock"></i></button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of Navbar -->
    <?= $this->renderSection('content'); ?>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>

</html>