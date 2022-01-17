<!DOCTYPE html>
<html lang="en">

<head>
    <title> Calcul heure </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php include('./application/views/back/template/script_head.php') ?>
    <script src="<?= base_url('assets/pdf/html2pdf.bundle.js') ?>"></script>
    <script>
        function generatePDF() {
            console.log("ok")
            var element = document.getElementById('content');
            html2pdf()
                .from(element)
                .set({
                    margin: [10, 10, 10, 10]
                })
                .save('FP_' + '<?= strtolower(str_replace(' ', '_', $emp['nom_employee'])) ?>');
        }
    </script>
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
                                <div class="page-wrapper p-0">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <div id="" class="card widget-card-1 p-3">

                                            <button style="align-self: flex-end;" onclick="generatePDF()" class="mb-3 btn btn-sm btn-mat btn-secondary w-25" sty>exporter PDF</button>
                                            <table id="content" class="table table-bordered">
                                                <tr>
                                                    <th><?= $emp['nom_employee'] ?><span class="float-right"><?= number_format($fiche['total']['salaire'], 2, ',', '.') ?> AR</span></th>
                                                    <th style="vertical-align: middle;" class="text-center" rowspan="3" colspan="3">
                                                        <h1>Fiche de Paie</h1>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th><?= $emp['matricule'] ?></th>
                                                </tr>
                                                <tr>
                                                    <th class="text-uppercase"><?= $emp['categorie_emp'] ?><span class="float-right"><?= $fiche['total']['heure'] ?> h</span></th>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"></td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Désignation</th>
                                                    <th class="text-center">Total heure</th>
                                                    <th class="text-center">Taux horaire</th>
                                                    <th class="text-center">Montant</th>
                                                </tr>
                                                <?php foreach ($fiche['detail'] as $f) { ?>
                                                    <tr>
                                                        <td class="text-left text-bold"><?= $f['designation'] ?> <small class="float-right"><?= $f['pourcentage'] ?>%</small></td>
                                                        <td class="text-right"><?= $f['total_heure'] ?></td>
                                                        <td class="text-right"><?= number_format($f['taux_horaire'], 2, ',', '.') ?></td>
                                                        <td class="text-right"><?= number_format($f['montant'], 2, ',', '.') ?></td>
                                                    </tr>

                                                <?php } ?>
                                                <tr>
                                                    <td colspan="4" height="50"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td><i>Indemnite</i></td>
                                                    <td><i><?= number_format($fiche['total']['montant_indemnite'], 2, ',', '.') ?></i></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td><b>Total à payer</b></td>
                                                    <td><b><?= number_format($fiche['total']['total_a_payer_impot'], 2, ',', '.') ?></b></td>
                                                </tr>
                                            </table>
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