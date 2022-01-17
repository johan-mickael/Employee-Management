<!DOCTYPE html>
<html lang="en">

<head>
    <title> Modifier employé </title>
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
                                                    <span>Mettre à jour les informations d'un employé.</span>
                                                </div>
                                            </div>
                                            <div class="card-block text-center">
                                                <form method="POST" action="<?= base_url('Employee/modifier') ?>">
                                                    <input type="hidden" name="id_employee" value="<?= $emp['id_employee'] ?>">
                                                    <?php if (isset($this->session->message)) { ?>
                                                        <p class="text-danger"><?= $this->session->message ?></p>
                                                    <?php } ?>

                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Nom et Prénoms</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="nom" value="<?= $emp['nom_employee'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Catégorie</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="categorie">
                                                                <?php foreach ($categorie as $cat) { ?>
                                                                    <?php $selected = (strcmp($cat['id_categorie'], $emp['categorie_emp']) == 0) ? 'selected' : ''; ?>
                                                                    <option <?= $selected ?> value="<?= $cat['id_categorie'] ?>"><?= $cat['nom_categorie'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Naissance</label>
                                                        <div class="col-sm-10">
                                                            <input type="date" class="form-control" name="naissance" value="<?= $emp['dt_naissance'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Embauche</label>
                                                        <div class="col-sm-10">
                                                            <input type="date" class="form-control" name="embauche" value="<?= $emp['dt_embauche'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Durée contrat</label>
                                                        <div class="col-sm-10">
                                                            <input type="number" min="1" class="form-control" name="contrat" value="<?= month_diff($emp['dt_embauche'], $emp['dt_fin_contrat']) ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Mot de passe</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="mot_de_passe" value="<?= $emp['mot_de_passe'] ?>">
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-mat btn-primary "><i class="icofont icofont-edit"></i>Modifier</button>

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