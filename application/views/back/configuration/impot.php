<!DOCTYPE html>
<html lang="en">

<head>
    <title> Modifier categorie </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php include('./application/views/back/template/script_head.php') ?>
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
                                <div class="page-wrapper ">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <!-- Basic table card start -->
                                        <div class="card fb-card">
                                            <div class="card-header">
                                                <i class="ti-user"></i>
                                                <div class="d-inline-block">
                                                    <h5>Formulaire</h5>
                                                    <span>Mettre à jour HS.</span>
                                                </div>
                                            </div>
                                            <div class="card-block text-center">
                                                <form method="POST" action="<?= base_url('Configuration/modifier_impot') ?>">
                                                    <input type="hidden" name="id_h_majoree" value="<?= $impot['id'] ?>">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">pourcentage</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="pourcentage" value="<?= $impot['pourcentage'] ?>">
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-mat btn-primary "><i class="icofont icofont-edit"></i>Modifier</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Basic table card end -->
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('./application/views/back/template/script_body.php') ?>
</body>

</html>