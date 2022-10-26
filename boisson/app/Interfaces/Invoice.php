<?php

namespace App\Interfaces;

interface Invoice {
    public function print($invoiceNumber);
    public function download($invoiceNumber);
    public function cancel($invoiceNumber);
    public function delete($invoiceNumber);
}