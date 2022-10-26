<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
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
        <h2 class="title">{{ getAppName() }}</h2>
        <h3 class="invoice-title">@yield('invoice-title')</h3>
        <div class="caption">
            @yield('header')
        </div>

        @yield('table')
        <div class="caption">
            @yield('footer')
        </div>
        <p class="thank-text">Merci beaucoup !</p>
        <br>
        <h6 class="print-text">Imprimé le {{ format_date_time(now()->toDateTimeString()) }}</h6>
    </div>

    <!--End Invoice-->
</body>

</html>
