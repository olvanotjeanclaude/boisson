<style>
    html,
    body,
    * {
        padding: 0;
        margin: 0;
        font-family: Arial, Helvetica, sans-serif
    }

    .invoice-title{
        font-size: 1.3rem;
    }

    #invoice-container {
        font-size: 1rem;
        max-width: 80mm;
        border-collapse: collapse;
        margin-left: 15px;
        text-transform: uppercase;
        /* background: #000; */
        /* background: red; */
    }

    #invoiceTable * {
        font-size: 1rem;
    }

    table {
        border-collapse: collapse;
    }

    #invoiceTable td,
    #invoiceTable th {
        border-bottom: 1px dashed rgb(201, 195, 195);
        padding: 3px;
        margin: 2px;
    }

    #invoiceTable th {
        border-bottom: 1px solid rgb(201, 195, 195);
        font-size: 1rem;
    }

    #invoiceTable td {
        font-size: 1rem;
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
        font-size: .9rem!important;
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
        margin-top: 35px;
        font-size: 1.5rem;
    }
    .invoice-title{
        text-align: center;
        margin: 10px auto;
    }

    .caption {
        margin: 10px auto;
        font-size: 1rem;
        font-family: 'arial';
        text-transform: uppercase;
    }

    p{
        font-size: 1rem;
    }

    .print-text {
        font-style: italic;
        font-size: .77rem
    }
</style>
