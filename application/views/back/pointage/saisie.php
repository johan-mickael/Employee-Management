<?php
$jours = jours_de_la_semaine();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Ajout Employé </title>
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
                                        <div class="page-header card">
                                            <div class="row align-items-end">
                                                <div class="col-lg-8">
                                                    <div class="page-header-title">
                                                        <i class="icofont icofont-table bg-c-blue"></i>
                                                        <div class="d-inline">
                                                            <h4 style="text-transform: none;">Saisie de pointage</h4>
                                                            <span style="text-transform: none;">Entrez les jours fériés, les heures de travail de l'employé et puis valider.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card p-5">
                                            <table class="table table-bordered">
                                                <form action="<?= base_url('Pointage/valider') ?>" method="POST">

                                                    <input type="hidden" name="id_employee" value="<?= $employee['id_employee'] ?>">
                                                    <tr>
                                                        <th style="width:15em"><?= $employee['nom_employee'] ?></th>
                                                        <th style="vertical-align: middle;" class="text-center" colspan="7" rowspan="3">
                                                            <h1>POINTAGE</h1>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th><?= $employee['matricule'] ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th><?= $employee['categorie_emp'] ?></th>
                                                        <th style="width:10em; vertical-align: middle;" class="text-center p-1">
                                                            <a onClick="window.location.href=window.location.href" class="text-light btn btn-secondary btn-sm w-100 btn-mat">Tout Effacer</a>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <?php for ($i = 0; $i < count($jours); $i++) { ?>
                                                            <th class="text-center" style="width:7rem"><?= $jours[$i] ?></th>
                                                        <?php } ?>
                                                    </tr>
                                                    <tr>
                                                        <td>Jour (5h-22h)</td>
                                                        <?php for ($i = 0; $i < count($jours); $i++) { ?>
                                                            <td style="width:7rem"><input type="number" step=".01" name="h_jour<?= $i ?>" min="0" max="24" value="0"></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <tr>
                                                        <td>Nuit (0h-5h / 22h-0h)</td>
                                                        <?php for ($i = 0; $i < count($jours); $i++) { ?>
                                                            <td style="width:7rem"><input type="number" step=".01" name="h_nuit<?= $i ?>" min="0" max="24" value="0"></td>
                                                        <?php } ?>

                                                    </tr>
                                                    <tr>
                                                        <td>Férié</td>
                                                        <?php for ($i = 0; $i < count($jours); $i++) { ?>
                                                            <td class="text-center"><input type="number" step=".01" name="h_ferie<?= $i ?>" min="0" max="24" value="0"></td>
                                                        <?php } ?>
                                                        <td class="p-1" style="vertical-align: middle;"><button class="btn btn-mat btn-primary w-100 btn-sm">Valider</button></td>
                                                    </tr>

                                                </form>
                                            </table>
                                            <?php if (isset($this->session->message)) { ?>
                                                <p class="text-danger text-center"><?= $this->session->message ?></p>
                                            <?php } ?>
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