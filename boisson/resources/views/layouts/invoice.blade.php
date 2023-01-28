<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Facture | @yield('title') </title>
    @include('includes.invoice-style')
    @yield('css')
</head>

<body translate="no">
    <div id="invoice-container">
        <h1 class="title">{{ getAppName() }}</h1>
        <div class="top">
            @yield('top')
        </div>

        <h3 class="invoice-title">@yield('invoice-title')</h3>

        <div class="header">
            @yield('header')
        </div>

        @yield('table')

        <div class="footer">
            @yield('footer')
        </div>
    </div>

    <!--End Invoice-->
</body>

</html>
