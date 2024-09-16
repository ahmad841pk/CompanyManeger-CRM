<?php

namespace App\Contracts;

use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;

interface CompanyContract
{
    public function getAll();

    public function store(string $name, string $email, string|null $logo, string|null $website): Company;

    public function findById(string $id): Company;

    public function update(UpdateCompanyRequest $request, Company $objCompany): Company;
}
