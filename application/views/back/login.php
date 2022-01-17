<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mandroso - Connection</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php include('./application/views/back/template/script_head.php') ?>
</head>

<body class="fix-menu">
    <?php include('./application/views/back/template/pre_loader.php') ?>

    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <form class="md-float-material" action="<?= base_url('Login_Administrateur/se_connecter') ?>" method="POST">
                            <div class="text-center">
                                <img src="<?= base_url('assets/template/images/auth/logo-dark.png') ?>" alt="logo.png">
                            </div>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="txt-primary">Se Connecter</h3>
                                    </div>
                                </div>
                                <hr />
                                <div class="input-group">
                                    <input name="nom_administrateur" type="text" class="form-control" placeholder="Nom d'utilisateur" required value="johan">
                                    <span class="md-line"></span>
                                </div>
                                <div class="input-group">
                                    <input name="mot_de_passe" type="password" class="form-control" placeholder="Mot de passe" required value="johan">
                                    <span class="md-line"></span>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Se Connecter</button>
                                    </div>
                                </div>
                                <?php if(!empty($error)) { ?>
                                    <p class="form-txt-danger"><?= $error ?></p>
                                <?php } ?>
                                <hr />
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Êtes-vous un <i>administrateur</i> ?</p>
                                        <p class="text-inverse text-left">Vous pouvez <b><a href="<?= base_url('utilisateur/inscription') ?>">ajouter un nouveau compte</a>.</b></p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="<?= base_url('assets/template/images/auth/Logo-small-bottom.png') ?>" alt="small-logo.png">
                                    </div>
                                </div>
                            </div>

                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    <?php include('./application/views/back/template/script_body.php') ?>
</body>

</html>