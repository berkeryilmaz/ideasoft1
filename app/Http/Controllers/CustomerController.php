<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Services\CustomerService;
use App\Models\Customer;

class CustomerController extends Controller
{
    protected CustomerService $customerService;

    public function __construct(CustomerService $customerService){
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->customerService->getAllCustomers());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $validatedCustomerData = $request->validated();
        return response()->json($this->customerService->createCustomer($validatedCustomerData));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return response()->json($this->customerService->getCustomer($customer));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $validatedCustomerData = $request->validated();
        return response()->json($this->customerService->updateCustomer($validatedCustomerData, $customer));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        return response()->json($this->customerService->destroyCustomer($customer));
    }
}
