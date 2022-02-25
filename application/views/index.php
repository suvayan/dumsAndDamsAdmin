<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <!-- Meta data -->
        <meta charset="UTF-8">
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <!-- Title -->
        <title>DudeAndDamsels</title>
        <!--Favicon -->
        <link rel="icon" href="<?= base_url();?>assets/images/common/favicon.ico" type="image/x-icon"/>
        <!--Bootstrap css -->
        <link href="<?= base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Style css -->
        <link href="<?= base_url();?>assets/css/style.css" rel="stylesheet" />
        <!--Sidemenu css -->
        <link href="<?= base_url();?>assets/css/sidemenu.css" rel="stylesheet">
        <!-- P-scroll bar css-->
        <link href="<?= base_url();?>assets/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet" />
        <!---Icons css-->
        <link href="<?= base_url();?>assets/plugins/icons/icons.css" rel="stylesheet" />
        <!-- Simplebar css -->
        <link rel="stylesheet" href="<?= base_url();?>assets/plugins/simplebar/css/simplebar.css">
        <!-- INTERNAL Select2 css -->
        <link href="<?= base_url();?>assets/plugins/select2/select2.min.css" rel="stylesheet" />
        <link id="theme" href="<?= base_url(); ?>assets/colors/color1.css" rel="stylesheet" type="text/css"/>
        <!---Icons css-->
        <link href="<?= base_url(); ?>assets/plugins/icons/icons.css" rel="stylesheet" />
        <!-- toastr css -->
        <link href="<?= base_url();?>assets/plugins/toastr/toastr.min.css" rel="stylesheet" />
        <!-- INTERNAL Mutipleselect css-->
		<link rel="stylesheet" href="<?= base_url();?>assets/plugins/multipleselect/multiple-select.css">
        <!-- Data table css -->
        <link href="<?= base_url();?>assets/plugins/datatables/DataTables/css/dataTables.bootstrap5.css" rel="stylesheet" />
        <link href="<?= base_url(); ?>assets/plugins/datatables/Buttons/css/buttons.bootstrap5.min.css"  rel="stylesheet">
        <link href="<?= base_url();?>assets/plugins/datatables/Responsive/css/responsive.bootstrap5.min.css" rel="stylesheet" />
        <style>
            .error{
                color: #ff0000;
            }
        </style>
        <!-- Jquery js-->
        <script src="<?= base_url();?>assets/plugins/jquery/jquery.min.js"></script>
        <!-- Sweetalert2 JS -->
        <script src="<?= base_url();?>assets/plugins/sweetalert2/sweetalert2.js"></script>
        <!-- validate js-->
        <script src="<?= base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
        <!-- toastr js-->
        <script src="<?= base_url();?>assets/plugins/toastr/toastr.min.js"></script>
        <script>let baseURL = "<?= base_url(); ?>";</script>
    </head>
    <body class="app sidebar-mini">

        <!---Global-loader-->
        <div id="global-loader" >
            <img src="<?= base_url();?>assets/images/common/loader.svg" alt="loader">
        </div>
        <!--- End Global-loader-->
        <!-- PAGE -->
        <div class="page">
            <div class="page-main">
                <!--aside open-->
                <?= @$aside; ?>
                <!--aside closed-->
                <!--app header-->
                <?= @$header; ?>
                <!--/app header-->
                <!--app-content open-->
                <?php include_once("{$content}.php");?>
                <!-- app-content end -->
            </div>
            <!--Footer-->
            <?= @$footer; ?>
            <!-- End Footer-->
        </div>
        <!-- Back to top -->
        <a href="#top" id="back-to-top"><i class="fe fe-chevron-up"></i></a>

        <!-- Bootstrap5 js-->
        <script src="<?= base_url();?>assets/plugins/bootstrap/popper.min.js"></script>
        <script src="<?= base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <!--Sidemenu js-->
        <script src="<?= base_url();?>assets/plugins/sidemenu/sidemenu.js"></script>
        <!-- P-scroll js-->
        <script src="<?= base_url();?>assets/plugins/p-scrollbar/p-scrollbar.js"></script>
        <script src="<?= base_url();?>assets/plugins/p-scrollbar/p-scroll1.js"></script>
        <script src="<?= base_url();?>assets/plugins/p-scrollbar/p-scroll.js"></script>
        <!--INTERNAL Index js-->
        <script src="<?= base_url();?>assets/js/index1.js"></script>
        <!-- INTERNAL Data tables -->
        <script src="<?= base_url();?>assets/plugins/datatables/DataTables/js/jquery.dataTables.js"></script>
        <script src="<?= base_url();?>assets/plugins/datatables/DataTables/js/dataTables.bootstrap5.js"></script>
        <script src="<?= base_url();?>assets/plugins/datatables/Responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url();?>assets/plugins/datatables/Responsive/js/responsive.bootstrap5.min.js"></script>
        <!-- INTERNAL Select2 js -->
        <script src="<?= base_url();?>assets/plugins/select2/select2.full.min.js"></script>
        <script src="<?= base_url();?>assets/plugins/select2/select2.js"></script>
        <!-- Simplebar JS -->
        <script src="<?= base_url();?>assets/plugins/simplebar/js/simplebar.min.js"></script>
        <!-- Custom js-->
        <script src="<?= base_url();?>assets/js/custom.js"></script>
		<!-- INTERNAL Multipleselect js -->
		<script src="<?= base_url();?>assets/plugins/multipleselect/multiple-select.js"></script>
		<script src="<?= base_url();?>assets/plugins/multipleselect/multi-select.js"></script>
    </body>
    <!-- Mirrored from laravel.spruko.com/azea/ltr/index by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Sep 2021 11:39:44 GMT -->
</html>
