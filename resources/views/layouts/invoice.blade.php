<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Facture | @yield('title') </title>
    @include('includes.invoice-style')
    @yield('css')
    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>
</head>

<body translate="no">
    <div id="invoice-container">
        <h4 class="title">{{ getAppName() }}</h4>
        <h3 class="invoice-title">@yield('invoice-title')</h3>
        <div class="caption">
            @yield('header')
        </div>

        @yield('table')
        <div class="caption">
            @yield('footer')
        </div>
        <p style="margin-top: 15px">Merci beaucoup !</p>
        <br>
        <h6 class="print-text">Imprimé le {{ format_date_time(now()->toDateTimeString()) }}</h6>
    </div>

    <!--End Invoice-->
</body>

</html>
