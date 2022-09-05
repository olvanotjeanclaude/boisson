<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Facture | {{ Str::ucfirst($invoice->customer->identification) }}</title>
    @include('includes.invoice-css')
    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>
</head>

<body translate="no">


    @include('admin.vente.includes.invoice-table', [
        'sales' => $invoice->sales,
        'reste' => $reste,
        "paid" =>$paid,
        "amount" =>$amount
    ])
    
    <!--End Invoice-->
</body>

</html>
