<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
     public function __construct(
        private CustomerService $customerService
    ) {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable'
        ]);

        return $this->customerService->create($data, $request->user());
    }

    public function index(Request $request)
    {
        return $this->customerService->list($request->user());
    }
}
