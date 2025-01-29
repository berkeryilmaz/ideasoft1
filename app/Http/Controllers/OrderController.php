<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use App\Models\Order;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->orderService->getAllOrders());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        try {
            $validatedData = $request->validated();
            return response()->json($this->orderService->createOrder($validatedData));
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()->json($this->orderService->getOrder($order));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        return response()->json($this->orderService->destroyOrder($order));
    }
}
