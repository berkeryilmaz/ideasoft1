<?php

namespace App\Services\Helpers;

use App\Exceptions\BusinessRuleException;
use App\Models\Product;

class OrderServiceHelper
{
    private static function chechItemTotal($items)
    {
        foreach ($items as $item) {
            if (bccomp($item['quantity'] * $item['unitPrice'], $item['total'], 2) !== 0) {
                return false;
            }
        }
        return true;
    }

    private static function chechOrderTotal($order)
    {
        $calculatedTotal = 0.0;
        foreach ($order['items'] as $item) {
            $calculatedTotal += $item['quantity'] * $item['unitPrice'];
        }
        return bccomp($calculatedTotal, $order['total'], 2) === 0;
    }

    public static function checkTotals($validatedOrderData)
    {
        if (!self::chechItemTotal($validatedOrderData['items'])) {
            throw new BusinessRuleException('Sum of  each item price should be equal item total.');
        }

        if (!self::chechOrderTotal($validatedOrderData)) {
            throw new BusinessRuleException('Sum of all prices should be equal order total.');
        }
    }

    public static function checkProdcutStock($items)
    {
        foreach ($items as $item) {
            $product = Product::find($item['product_id']);
            if ($product->stock < $item['quantity']) {
                throw new BusinessRuleException("not enough stock for this product : {$product->name}");
            }
        }
        return true;
    }
}
