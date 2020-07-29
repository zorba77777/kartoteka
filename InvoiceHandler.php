<?php

class InvoiceHandler
{
    private const VAT_RATE = 0.2;

    public static function getPriceWithoutVat(Invoice $invoice) {

        return $invoice->price / (self::VAT_RATE + 1);

    }

}