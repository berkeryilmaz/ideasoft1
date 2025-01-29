<?php

namespace App\Services;

use App\Models\Customer;

class CustomerService
{
    public function createCustomer($data)
    {
        return Customer::create($data);
    }

    public function getAllCustomers()
    {
        return Customer::all();
    }

    public function getCustomer(Customer $customer)
    {
        return $customer->load('orders');
    }

    public function updateCustomer($newCustomer, Customer $customer)
    {
        $customer->fill($newCustomer);
        $customer->save();
        return $customer;
    }

    public function destroyCustomer(Customer $customer)
    {
        return $customer->delete();
    }
}
