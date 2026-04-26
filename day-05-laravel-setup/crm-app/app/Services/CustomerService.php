<?php 

class CustomerService
{
    public function create(array $data, $user)
    {
        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'organization_id' => $user->organization_id
        ]);
    }

    public function list($user)
    {
        return Customer::where('organization_id', $user->organization_id)->get();
    }
}