<?php

namespace App\Services;

use App\Contracts\CompanyContract;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyService implements CompanyContract
{
    public function __construct(
        private readonly Company $model,

    ) {}

    public function getAll(): LengthAwarePaginator|null
    {

        $objQuery = $this->model->newQuery();
        return $objQuery->latest()->paginate(10);
    }

    public function store(string $name, string $email, string $logo = null, string $website = null): Company
    {
        $objQuery = $this->model->newQuery();
        $objCompany = $objQuery->create([
            'name' => $name,
            'email' => $email,
            'logo' => $logo,
            'website' => $website
        ]);
        return $objCompany;
    }

    public function findById(string $id): Company
    {
        $objQuery = $this->model->newQuery();
        return $objQuery->find($id);
    }

    public function update(UpdateCompanyRequest $request, Company $objCompany): Company
    {
        if ($request->name && $objCompany->name !== $request->name) {
            $objCompany->name = $request->name;
        }
        if ($request->email && $objCompany->email !== $request->email) {
            $objCompany->email = $request->email;
        }
        if ($request->website && $objCompany->website !== $request->website) {
            $objCompany->website = $request->website;
        }

        $objCompany->save();
        return $objCompany;
    }
}
