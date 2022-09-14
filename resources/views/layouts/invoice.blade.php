<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Facture | @yield('title') </title>
    @include('includes.invoice-style')
    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>
</head>

<body translate="no">
    <div id="invoice-container">
        <h4 class="title">{{ getAppName() }}</h4>
        <br>
        <div class="caption">
            @yield('header')
        </div>
        @yield('table')
    </div>

    <!--End Invoice-->
</body>

</html>
