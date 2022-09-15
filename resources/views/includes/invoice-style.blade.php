<style>
    html,
    body,
    * {
        padding: 0;
        margin: 0;
    }

    #invoiceTable h1,
    #invoiceTable h2,
    #invoiceTable h3,
    #invoiceTable h4,
    #invoiceTable h5,
    #invoiceTable h6{
        font-family: 'arial';
        font-weight: 100!important;
    }

    #invoice-container {
        font-size: 1.5rem;
        max-width: 80mm;
        border-collapse: collapse;
        margin-left: 7px;
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
        /* background-color: #424242;
        color: white; */
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
        font-size: 1.8rem;
    }

    .caption {
        margin: 5px auto;
        font-size: 1.2rem;
        font-family: 'arial';
    }

    .print-text {
        font-style: italic;
        font-size: .77rem
    }
</style>
