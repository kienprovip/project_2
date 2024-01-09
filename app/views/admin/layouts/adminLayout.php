<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="http://localhost/project_2/public/assets/admin/css/responsive.css" />
    <link rel="stylesheet" href="http://localhost/project_2/public/assets/admin/css/style.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?php echo (!empty($page_title)) ? $page_title : 'Dashboard'; ?></title>
</head>

<body>
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === 'allow login') { ?>
        <div class="d-flex" id="wrapper">
            <!-- sidebar -->
            <?php require_once './app/views/admin/blocks/header.php'; ?>
            <?php $this->render($content, $sub_content); ?>
        </div>
    <?php } else {
        header('Location: /project_2/admin/login');
    } ?>
    <!-- /#page-content-wrapper -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="http://localhost/project_2/public/assets/admin/js/script.js"></script>
</body>

</html>