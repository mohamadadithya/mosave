<!doctype html>
<html lang="en">

<!-- Copyright 2021 by Mohamad Adithya -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;600&display=swap" rel="stylesheet">

    <title><?= $title; ?></title>

    <!-- Login CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        #auth,
        #welcome {
            height: 100vh;
        }

        .welcome-illustration {
            display: none;
        }

        .col-2-welcome {
            text-align: center;
        }

        @media (min-width: 768px) {
            .welcome-illustration {
                display: unset;
            }

            .col-2-welcome {
                text-align: left;
            }
        }

        @media (min-width: 992px) {
            .welcome-illustration {
                display: unset;
            }

            .col-2-welcome {
                text-align: left;
            }
        }
    </style>
</head>

<body class="text-primary">
    <?= $this->renderSection('content'); ?>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>