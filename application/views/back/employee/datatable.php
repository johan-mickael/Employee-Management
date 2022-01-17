
<script>
    $(document).ready(function() {
        var table = $('#liste').DataTable({
            "pageLength": 6,
            "lengthChange": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?= base_url('Employee/datatable') ?>",
                type: "post"
            },
            "columns": [{
                    'data': 'numero',
                    'orderable': false
                },
                {
                    'data': 'matricule'
                },
                {
                    'data': 'nom_employee'
                },
                {
                    'data': 'categorie_emp',
                    'orderable': false
                },
                {
                    'data': 'age',
                    'render': function(data, type, row) {
                        return data+" ans";
                    },
                },
                {
                    'data': 'dt_embauche'
                },
                {
                    'data': 'dt_fin_contrat'
                },
                {
                    'render': function(data, type, row) {
                        var url_pointage = '<?= base_url("Pointage/index") ?>/'+row.id_employee;
                        var url_heure = '<?= base_url("Pointage/calcul_heure") ?>/'+row.id_employee;
                        var url_fiche = '<?= base_url("Fiche/get") ?>/'+row.id_employee;
                        var url_edit = '<?= base_url("Employee/f_modifier") ?>/'+row.id_employee;
                        var url_delete = '<?= base_url("Employee/supprimer") ?>/'+row.id_employee;
                        var btn_group = '<div class="btn-group " role="group">';
                        var btn_pointage = '<a href="'+url_pointage+'" class="btn btn-sm btn-primary waves-effect waves-light">Pointage</a>';
                        var btn_voir = '<a href="'+url_heure+'" class="btn btn-sm btn-primary waves-effect waves-light">Détail</a>';
                        var btn_fiche = '<a href="'+url_fiche+'" class="btn btn-sm btn-primary waves-effect waves-light">Fiche</a>';
                        var btn_modifier = '<a href="'+url_edit+'" class="ml-2 btn btn-sm btn-secondary waves-effect waves-light">Modifier</a>';
                        var btn_supprimer = '<a href="'+url_delete+'" onclick="return confirm(\'Voulez-vous vraiment supprimer cet employé?\')" class="ml-2 btn btn-sm btn-danger waves-effect waves-light">Supprimer</a>';
                        return btn_group + btn_pointage + btn_voir + btn_fiche + '</div>' + btn_modifier + btn_supprimer;
                    },
                    'searchable': false,
                    'orderable': false
                }
            ],
            "language": {
                "processing": "En attente du serveur...",
                "info": "_START_ sur _END_ lignes trouvées parmis _TOTAL_ résultats",
                "infoEmpty": "Pas de résultats",
                "infoFiltered": "(filtrés parmis _MAX_ résultats)",
                "zeroRecords": "Aucune donnée enregistrée.",
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                },
                "search": "Recherche",
                "searchPlaceholder": "ex: EMP0001",
                "lengthMenu": "Afficher _MENU_ lignes"
            },
            dom: 'Bfltrip',
            buttons: {
                buttons: [{
                    extend: 'excel',
                    text: 'Exporter en Excel',
                    title: 'Liste des employés',
                    className: 'excelButton',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    }
                }]
            }
        });
    });
</script>