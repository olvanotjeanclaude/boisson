<div class="card" id="invoiceTableTemplateContainer">
    <div class="card-body">
        <h4 class="title text-center">{{ getAppName() }}</h4>
        <h3 class="text-center text-capitalize">@yield('invoice-title')</h3>
        <br>
        @yield('header')
        <br>
        <table id="invoiceTableTemplate">
            <thead>
                <tr>
                    <th style="width: 150px">Désignation</th>
                    <th style="width: 40px">Qté</th>
                    <th style="min-width: 40px">@yield('prix-title')</th>
                    <th style="text-align: right">Total</th>
                </tr>
            </thead>
            <tbody>
                @yield('tbody')
            </tbody>
        </table>
        <br>
        @yield('footer')
        <p style="margin-top: 15px">Merci beaucoup !</p>
        <br>
        <h6>Imprimé le {{ format_date_time(now()->toDateTimeString()) }}</h6>
    </div>
    
</div>