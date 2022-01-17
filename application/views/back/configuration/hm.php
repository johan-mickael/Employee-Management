<!DOCTYPE html>
<html lang="en">

<head>
    <title> Liste des Employés</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php include('./application/views/back/template/script_head.php') ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/css/jquery.mCustomScrollbar.css') ?>">
    <!-- Jquery -->
    <script type="text/javascript" src="<?= base_url('assets/template/js/jquery/jquery.min.js') ?>"></script>
    <style>
        .excelButton {
            background-color: green;
            text-transform: lowercase;
        }
    </style>
</head>

<body>
    <?php include('./application/views/back/template/pre_loader.php') ?>
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <?php include('./application/views/back/template/nav.php') ?>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <?php include('./application/views/back/template/side_nav.php') ?>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-header start -->
                                    <div class="page-header card">
                                        <div class="row align-items-end">
                                            <div class="col-lg-8">
                                                <div class="page-header-title">
                                                    <i class="icofont icofont-table bg-c-blue"></i>
                                                    <div class="d-inline">
                                                        <h4 style="text-transform: none;">Heures supplementaires</h4>
                                                        <span style="text-transform: none;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-header end -->

                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <!-- Basic table card start -->
                                        <div class="card">
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive p-3">
                                                    <table id="liste" class="table table-bordered">
                                                        <tr>
                                                            <th>Designation</th>
                                                            <th>pourcentage</th>
                                                            <th style="width:10rem"></th>
                                                        </tr>
                                                        <?php for($i=0; $i<count($hm); $i++) { ?>
                                                        <tr>
                                                            <td><?= $hm[$i]['designation'] ?></td>
                                                            <td><?= $hm[$i]['pourcentage'] ?> %</td>
                                                            <td><a href="<?= base_url('Configuration/f_modifier_hm/'.$hm[$i]['id_h_majoree']) ?>" class="btn btn-sm btn-primary">Modifier</a></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Basic table card end -->
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->

                            <div id="styleSelector">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Jquery -->

    <script type="text/javascript" src="<?= base_url('assets/template/js/jquery-ui/jquery-ui.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/template/js/popper.js/popper.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/template/js/bootstrap/js/bootstrap.min.js') ?>"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?= base_url('assets/template/js/jquery-slimscroll/jquery.slimscroll.js') ?>"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?= base_url('assets/template/js/modernizr/modernizr.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/template/js/modernizr/css-scrollbars.js') ?>"></script>
    <!-- classie js -->
    <script type="text/javascript" src="<?= base_url('assets/template/js/classie/classie.js') ?>"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="<?= base_url('assets/template/js/script.js') ?>"></script>
    <script src="<?= base_url('assets/template/js/pcoded.min.js') ?>"></script>
    <script src="<?= base_url('assets/template/js/demo-12.js') ?>"></script>
    <script src="<?= base_url('assets/template/js/jquery.mCustomScrollbar.concat.min.js') ?>"></script>
    <!-- Datatables -->
    <script src="<?= base_url('assets/DataTables/datatables.min.js') ?>"></script>
</body>

</html>