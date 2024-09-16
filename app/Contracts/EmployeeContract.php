<?php

namespace App\Contracts;

use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;

interface EmployeeContract
{
        public function getAll();

        public function store(string $first_name, string $last_name, string $email, string |null $phone, string|null $company_id): Employee;

        public function update(UpdateEmployeeRequest $request, Employee $objEmployee): Employee;

        public function findById(string $id):Employee;

}
