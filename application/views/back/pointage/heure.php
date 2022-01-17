<!DOCTYPE html>
<html lang="en">

<head>
    <title> Calcul heure </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php include('./application/views/back/template/script_head.php') ?>
</head>

<style>
    input {
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        /* padding: 10px; */
        width: 100%;
        border: 1px solid lightgray;
    }
</style>

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
                                        <div class="card widget-card-1 w-50">
                                            <div class="card-block-small">
                                                <i class="icofont icofont-time bg-c-blue card1-icon"></i>
                                                <p class="text-c-blue f-w-600"><?= $employee['nom_employee'] ?></p>
                                                <h2><?= $employee['matricule'] ?></h2>
                                                <h5><?= $employee['categorie_emp'] ?></h5>
                                                <div class="form-group row">
                                                    <label class=" col-sm-3 col-form-label">HeuresJour</label>
                                                    <div class="col-sm">
                                                        <input type="text" class="text-right form-control" readonly="" value="<?= $calcul['HN'] ?> h">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class=" col-sm-3 col-form-label">Heure Nuit</label>
                                                    <div class="col-sm">
                                                        <input type="text" class="text-right form-control" readonly="" value="<?= $calcul['HM30'] ?> h">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class=" col-sm-3 col-form-label">Heure Dimanche</label>
                                                    <div class="col-sm">
                                                        <input type="text" class="text-right form-control" readonly="" value="<?= $calcul['HM40'] ?> h">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class=" col-sm-3 col-form-label">Heure jour férié travaillé</label>
                                                    <div class="col-sm">
                                                        <input type="text" class="text-right form-control" readonly="" value="<?= $calcul['HM50'] ?> h">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class=" col-sm-3 col-form-label">Heure jour férié</label>
                                                    <div class="col-sm">
                                                        <input type="text" class="text-right form-control" readonly="" value="<?= $calcul['HF'] ?> h">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class=" col-sm-3 col-form-label">Heures supp 30%</label>
                                                    <div class="col-sm">
                                                        <input type="text" class="text-right form-control" readonly="" value="<?= $calcul['hs30'] ?> h">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class=" col-sm-3 col-form-label">Heures supp 50%</label>
                                                    <div class="col-sm">
                                                        <input type="text" class="text-right form-control" readonly="" value="<?= $calcul['hs50'] ?> h">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class=" col-sm-3 col-form-label">Total heures travaillées</label>
                                                    <div class="col-sm">
                                                        <input type="text" class="text-right form-control text-bold" readonly="" value="<?= $calcul['total_heure_travail'] ?> h">
                                                    </div>
                                                </div>
                                                <a href="<?= base_url('Fiche/get/'.$calcul['id_employee']) ?>" style="text-transform: none;" class="btn btn-mat btn-primary">Fiche de paie</a>
                                            </div>
                                        </div>

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