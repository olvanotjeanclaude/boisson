<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
        content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/material-vendors.min.css') }}">
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
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('(assets/css/style.css') }}"> --}}
    <!-- END: Custom CSS-->
    <style>
        .card-title {
            font-weight: 500 !important;
            text-transform: capitalize;
        }

        th{
            text-transform: capitalize;
        }
        .card-image {
            object-fit: cover;
            width: auto;
            height: 200px
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>

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
                @yield('content')
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
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/pages/material-app.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/snackbar.js') }}"></script>
    @yield('page-js')
    <!-- END: Page JS-->

    {{-- Axios link --}}
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    {{-- Custom js --}}
    <script src="{{ asset('app-assets/js/custom/index.js') }}"></script>
    @yield('script')

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        $(".delete-btn").click(function() {
            const url = $(this).data("url");
            const id = $(this).data("id");

            if(url && id){
                $("#confirmDelete").attr("data-url", url);
                $("#confirmDelete").attr("row-id", id);
                $("#deleteModal").modal("show");
            }

        })

        $("button#confirmDelete").click(function() {
            $(this).html(`<i class="la la-refresh spinner"></i>`);
            const url = $(this).attr("data-url");
            const rowId = $(this).attr("row-id");

            if(url && rowId){
                axios.delete(url)
                    .then((response) => {
                        const data = response.data;
                        if (data.type == "success") {
                            $("#deleteModal").modal("hide");
                            alertSnackbar(data.success);
                            $(`#row_${rowId}`).remove();
    
                            if (data.reload) {
                                setTimeout(function() {
                                    window.location.reload();
                                }, 3000);
                            }
                        }
                        //console.log(data);
                    });
                $(this).html("oui");
            }
        })

        function alertSnackbar(message) {
            $(".snackbar-body").text(message);
            $(".snackbar-toggler").trigger("click")
        }
    </script>
</body>
<!-- END: Body-->

</html>
