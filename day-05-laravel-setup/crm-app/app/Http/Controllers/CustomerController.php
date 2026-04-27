<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
     public function __construct(
        private CustomerService $customerService
    ) {}

    public function store(StoreCustomerRequest $request)
    {
        return $this->customerService->create(
            $request->validated(),
            $request->user()
        );
    }

  public function index(Request $request)
    {
        return $this->customerService->list(
            $request->user(),
            $request->all()
        );
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|required',
            'email' => 'nullable|email',
            'phone' => 'nullable'
        ]);

        return $this->customerService->update($id, $data, $request->user());
    }

    public function destroy(Request $request, $id)
    {
        $this->customerService->delete($id, $request->user());

        return response()->json(['message' => 'Deleted']);
    }
}
