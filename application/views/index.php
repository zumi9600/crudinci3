<!DOCTYPE html>

<head>
    <title><?= $title; ?></title>
    <?= $this->load->view('/layout/metadata.php', '', true); ?>

</head>
<html>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Header -->
            <?= $this->load->view('/layout/header.php', '', true); ?>
            <!-- /.header -->

            <!-- Main Sidebar Container -->
            <?= $this->load->view('/layout/sidebar.php', '', true); ?>
            <!-- /.main-siderbar-container -->

            <!-- Content Wrapper. Contains page content -->
            <?php echo include(APPPATH . 'views/' . $page_name . '.php'); ?>
            <!-- /.content-wrapper -->

            <!-- Footer -->
            <footer class="main-footer">
                <?= $this->load->view('/layout/footer.php', '', true); ?>
            </footer>
            <!-- /.footer -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->




</body>

</html>