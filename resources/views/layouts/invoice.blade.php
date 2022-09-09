<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Facture | @yield('title') </title>
    @include('includes.invoice-css')
    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>
</head>

<body translate="no">


    @yield('table')

    <!--End Invoice-->
</body>

</html>
