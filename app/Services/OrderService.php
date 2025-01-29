<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\Helpers\OrderServiceHelper;
use Illuminate\Support\Facades\DB;
use App\Exceptions\BusinessRuleException;

class OrderService
{
    private function insertOrder(array $data): Order
    {
        return Order::create($data);
    }

    private function insertOrderItems(array $items, Order $order): Order
    {
        $order->orderItems()->createMany($items);
        return $order;
    }

    private function updateProductStock(array $items)
    {
        foreach ($items as $item) {
            $product = Product::find($item['product_id']);
            $product->stock -= $item['quantity'];
            $product->save();
        }
    }

    public function createOrder($data)
    {
        OrderServiceHelper::checkTotals($data);
        OrderServiceHelper::checkProdcutStock($data['items']);
        DB::beginTransaction();
        try {
            $order = $this->insertOrder($data);
            $this->insertOrderItems($data['items'], $order);
            $this->updateProductStock($data['items']);
            DB::commit();
            return $order->load(['customer', 'orderItems']);
        } catch (\Exception $e) {
            DB::rollBack();
        }

        throw new BusinessRuleException('An error has occurred creating order.');;
    }

    public function getAllOrders()
    {
        return Order::all()->load('customer');
    }

    public function getOrder(Order $order)
    {
        return $order->load(['customer', 'orderItems']);
    }

    public function updateOrder($newOrder, Order $order)
    {
        $order->fill($newOrder);
        $order->save();
        return $order;
    }

    public function destroyOrder(Order $order)
    {
        DB::beginTransaction();
        try {
            $order->orderItems()->delete();
            $order->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return false;
    }
}
