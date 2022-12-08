<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= SITE_NAME ?></title>

<!--    favicon ICON-->
<!--    <link rel="icon" href="--><?//= $assets ?><!--../../uploads/logo.png" type="image/png" sizes="16x16">-->

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">


	<link href="<?= $assets ?>css/pages/login/login-1.css" rel="stylesheet" type="text/css" />
	<link href="<?= $assets ?>plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?= $assets ?>css/style.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?= $assets ?>css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
	<link href="<?= $assets ?>css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
	<link href="<?= $assets ?>css/skins/brand/dark.css" rel="stylesheet" type="text/css" />
	<link href="<?= $assets ?>css/skins/aside/dark.css" rel="stylesheet" type="text/css" />

    <link href="<?= $assets ?>css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?= $assets ?>css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
    <link href="<?= $assets ?>css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?= $assets ?>css/core.css" rel="stylesheet" type="text/css">
    <link href="<?= $assets ?>css/components.css" rel="stylesheet" type="text/css">
    <link href="<?= $assets ?>css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="<?= $assets ?>js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="<?= $assets ?>js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="<?= $assets ?>js/core/libraries/bootstrap.min.js"></script>

    <!-- /core JS files -->
	<script src="<?= $assets ?>plugins/global/plugins.bundle.js" type="text/javascript"></script>
	<script src="<?= $assets ?>js/scripts.bundle.js" type="text/javascript"></script>
	<script src="<?= $assets ?>js/pages/custom/login/login-1.js" type="text/javascript"></script>
    <!-- Theme JS files -->
    <script type="text/javascript" src="<?= $assets ?>js/core/app.js"></script>
    <script type="text/javascript" src="<?= $assets ?>js/plugins/ui/ripple.min.js"></script>
    <!-- /theme JS files -->


</head>
<script>
    $.ajaxSetup({
        data: { <?= $this->security->get_csrf_token_name() ?>:'<?= $this->security->get_csrf_hash() ?>'
    }
    });
</script>

<body class="login-container">

<!-- Main navbar -->
<!-- /main navbar -->

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Content area -->
            <div class="content">

            <?php echo $body;?>
            <!-- /advanced login -->

            <!-- Footer -->
            <div class="footer text-muted text-center">
                &copy; <?php echo date('Y');?>  <a href="#" target="_blank">CodeExpert Solution</a>

            </div>
            <!-- /footer -->
            </div>
        </div>

        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>

<!-- /page container -->


<?php
if(isset($extra_js)){
    foreach ($extra_js as $js){
        echo '<script src="'.$assets.$js.'"></script>';
        echo "\n";
    }
}
?>


</body>
<script>
    function Select2Init() {
        $('.select').each(function () {
            var select = $(this);
            $("#" + select.attr('id')).select2({}).on('change.select2', function () {
                if ($("#" + select.attr('id')).valid()) {
                    $("#" + select.attr('id')).removeClass('invalid').addClass('success');
                }
            });
        });
    }
</script>
</html>
