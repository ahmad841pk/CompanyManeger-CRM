<?php

namespace App\Services;

use App\Contracts\EmployeeContract;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeeService implements EmployeeContract
{
    public function __construct(
        private readonly Employee $model,

    ) {}

    public function getAll(): LengthAwarePaginator|null
    {

        $objQuery = $this->model->newQuery();
        return $objQuery->latest()->paginate(10);
    }

    public function store(string $first_name, string $last_name, string $email, string |null $phone, string|null $company_id): Employee
    {
        $objQuery = $this->model->newQuery();
        $objEmployee = $objQuery->create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'company_id' => $company_id
        ]);
        $objEmployee->refresh();
        return $objEmployee;
    }

    public function findById(string $id): Employee
    {
        $objQuery = $this->model->newQuery();
        return $objQuery->find($id);
    }

    public function update(UpdateEmployeeRequest $request, Employee $objEmployee): Employee
    {
        if ($request->first_name && $objEmployee->first_name !== $request->first_name) {
            $objEmployee->first_name = $request->first_name;
        }
        if ($request->last_name && $objEmployee->last_name !== $request->last_name) {
            $objEmployee->last_name = $request->last_name;
        }
        if ($request->email && $objEmployee->email !== $request->email) {
            $objEmployee->email = $request->email;
        }
        if ($request->phone && $objEmployee->phone !== $request->phone) {
            $objEmployee->phone = $request->phone;
        }
        if ($request->website && $objEmployee->website !== $request->website) {
            $objEmployee->website = $request->website;
        }
        if ($request->company_id) {
            $objEmployee->company()->associate($request->company_id);
        }

        $objEmployee->save();
        return $objEmployee;
    }
}
