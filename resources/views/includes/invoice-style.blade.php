<style>
    html,
    body,
    * {
        padding: 0;
        margin: 0;
    }

    #invoice-container {
        max-width: 80mm;
        border-collapse: collapse;
        margin-left: 7px;
    }

    #invoiceTable * {
        font-family: 'Courier New', Courier, monospace;
        font-size: .7rem;
    }

    table {
        border-collapse: collapse;
    }

    #invoiceTable td,
    #invoiceTable th {
        border-bottom: 1px dashed #ddd;
        padding: 3px;
        margin: 2px;
    }

    #invoiceTable th {
        border-bottom: 1px solid #ddd;
        font-size: .66rem;
    }
    #invoiceTable td {
        font-size: .7rem;
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
        /* font-size: .9rem!important; */
        margin: 0;
        font-family: 'Courier New', Courier, monospace;
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
        margin: 5px;
        font-size: 1.6rem;
    }

    .caption {
        margin: 5px;
        font-size: .9rem;
    }
    .print-text{
        font-size: .8rem;
        font-style: italic;
    }
</style>
