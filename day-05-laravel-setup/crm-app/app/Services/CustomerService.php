<?php 

use Illuminate\Support\Facades\Log;

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

        Log::info('Customer created', ['user_id' => $user->id]);
    }

    public function update($id, array $data, $user)
    {
        $customer = Customer::where('id', $id)
            ->where('organization_id', $user->organization_id)
            ->firstOrFail();

        $customer->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $customer
        ]);
    }

    public function delete($id, $user)
    {
        if ($user->role !== 'admin') {
            abort(403);
        }

        $customer = Customer::where('id', $id)
            ->where('organization_id', $user->organization_id)
            ->firstOrFail();

        $customer->delete();
    }

    public function list($user, $filters)
    {
        $query = Customer::where('organization_id', $user->organization_id);

        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        return response()->json([
            'status' => 'success',
            'data' => $$query->paginate(10)
        ]);
    }
}