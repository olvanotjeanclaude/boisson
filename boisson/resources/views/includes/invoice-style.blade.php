<style>
    html,
    body,
    * {
        padding: 0;
        margin: 0;
        font-family: Arial, Helvetica, sans-serif
    }

    .invoice-title {
        margin-top: 10px;
        /* font-size: 1.2rem; */
    }

    #invoice-container {
        max-width: 80mm;
        border-collapse: collapse;
        margin-left: 10px;
        text-transform: uppercase;
        font-size: 1.12rem;
        /* background: red; */
    }


    table {
        width: 100%;
        border-collapse: collapse;
    }

    #invoiceTable th {
        padding: 3px;
        margin: 2px;
    }

    #invoiceTable th,
    #invoiceTable td {
        padding: 7px 3px;
        text-align: start;
    }

    #invoiceTable th,
    #invoiceTable td {
        border: 1px solid black;
    }

    #invoiceTable tr:nth-child(even) {
        /* background-color: #f2f2f2; */
    }

    #invoiceTable tr:hover {
        /* background-color: #ddd; */
    }

    #invoiceTable th {
        text-align: left;
    }

    tfoot h6 {
        margin: 0;
        font-family: 'arial';
    }

    tfoot tr,
    tfoot td {
        padding: 0 !important;
        margin: 0 !important;
        background: none !important;
        border-bottom: none !important;
    }

    .title {
        text-align: center;
        margin-top: 15px;
        font-size: 1.4rem
    }

    .invoice-title,.top {
        text-align: center;
       /* margin-top: 10px; */
        /* margin: 10px auto; */
    }

    .caption {
        margin: 10px auto;
        /* font-size: 1rem; */
        font-family: 'arial';
        text-transform: uppercase;
    }

    .thank-text {
        margin-top: 15px;
        font-size: .8rem;
    }

    .print-text {
        font-style: italic;
        font-size: .6rem;
    }
</style>
