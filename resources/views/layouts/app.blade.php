<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Olvanot Jean Claude Rakotonirina">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico') }}">
    {{-- <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet"> --}}
    {{-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> --}}


    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/material-icon/material_icon.css') }}">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/material-vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">
    @yield('vendor')
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/material.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/material-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/material-colors.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/core/menu/menu-types/material-vertical-menu-modern.css') }}">
    @yield('page-css')
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/forms/selects/select2.custom.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern material-vertical-layout material-layout 2-columns   fixed-navbar"
    data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('includes.header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->

    @include('includes.sidebar')

    <!-- END: Main Menu-->

    {{-- Snackbar --}}
    <div id="snackbar-container">
        <button class="btn btn-primary snackbar-toggler d-none">Right-aligned snackbar</button>
        <div class="snackbar snackbar-right">
            <div class="snackbar-body">
            </div>
            <button class="snackbar-btn" type="button">Fermer</button>
        </div>
    </div>

    <!-- BEGIN: Content-->
    <div class="app-content content">
        @yield('content-header')
        <div class="content-wrapper">
            <div class="content-body">
                <div class="col-xxl-9 mx-auto">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


    <!-- BEGIN: Footer-->
    @include('includes.footer')
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/material-vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.min.js') }}"></script>

    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/pages/material-app.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/snackbar.js') }}"></script>
    @yield('page-js')
    <!-- END: Page JS-->

    {{-- Axios link --}}
    <script src="{{ asset('app-assets/js/axios/axios.min.js') }}"></script>

    {{-- Custom js --}}
    <script src="{{ asset('app-assets/js/custom/validation.js') }}"></script>
    <script src="{{ asset('app-assets/js/custom/dataController.js') }}"></script>
    <script src="{{ asset('app-assets/js/custom/index.js') }}"></script>
    @yield('script')
    <script>
        $(document).ready(function() {})

        function loadDatatableAjax(tableElement = ".ajax-datatable", method = "post") {
            const url = $(tableElement).data("url");
            const table = $(tableElement);
            const columns = $(tableElement).data("columns");

            if (table.length && url && columns) {
                // console.log(columns)
                // return;
                let exportColumns = columns[columns.length - 1].name == "action" ? columns.slice(0, columns.length - 1) :
                    columns;
                exportColumns = exportColumns.map((col, index) => index);

                const datatable = table.DataTable({
                    serverSide: true,
                    processing: true,
                    // deferRender: true,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "Tout"]
                    ],
                    ajax: {
                        url: url,
                        type: method,
                        data: function(params) {
                            params._token = "{{ csrf_token() }}";
                            params.searchInput = $("input[type='search']").val();
                        }
                    },
                    columns: columns,
                    ordering: false,
                    dom: 'lBfrtip',
                    buttons: [{
                        extend: 'collection',
                        text: 'Exporter',
                        buttons: [{
                                extend: 'copyHtml5',
                                exportOptions: {
                                    columns: exportColumns
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: exportColumns
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                exportOptions: {
                                    columns: exportColumns
                                }
                            },
                            {
                                extend: 'csvHtml5',
                                exportOptions: {
                                    columns: exportColumns
                                }
                            },
                            // 'copy',
                            // 'excel',
                            // 'csv',
                            // 'pdf',
                            // 'print'
                        ]
                    }],
                    language: {
                        "sDecimal": ",",
                        "sEmptyTable": "Aucune donnée disponible dans le tableau",
                        "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                        "sInfoEmpty": "Aucun enregistrement",
                        "sInfoFiltered": "",
                        "sInfoPostFix": "",
                        "sInfoThousands": ".",
                        "sLengthMenu": "Afficher _MENU_ entrées",
                        "sLoadingRecords": "chargement...",
                        "sProcessing": "En cours de traitement...",
                        "sSearch": "Chercher:",
                        "sZeroRecords": "Aucun enregistrements correspondants trouvés",
                        "oPaginate": {
                            "sFirst": "Première",
                            "sLast": "Fin",
                            "sNext": "Prochain",
                            "sPrevious": "Avant"
                        },
                        "oAria": {
                            "sSortAscending": ": Activer le tri croissant des colonnes",
                            "sSortDescending": ": Activer le tri par colonne décroissante"
                        },
                        "select": {
                            "rows": {
                                "_": "%d enregistrement sélectionné",
                                "0": "",
                                "1": "1 enregistrement sélectionné"
                            }
                        }
                    },
                });

                return datatable;
            }
        }
    </script>
</body>
<!-- END: Body-->

</html>
