<?php

namespace App\Services;

use App\Models\Customer;

class CustomerService
{
    public function createCustomer($validatedCustomerData)
    {
        return Customer::create($validatedCustomerData);
    }

    public function getAllCustomers()
    {
        return Customer::all();
    }

    public function getCustomer(Customer $customer)
    {
        return $customer->load('orders');
    }

    public function updateCustomer($validatedCustomerData, Customer $customer)
    {
        $customer->fill($validatedCustomerData);
        $customer->save();
        return $customer;
    }

    public function destroyCustomer(Customer $customer)
    {
        return $customer->delete();
    }
}
