<?php

namespace App\Http\Controllers\Company;

use App\Contracts\CompanyContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyTransformer;
use App\Models\Company;

class CompanyController extends Controller
{
    public function __construct(
        private readonly CompanyContract $objCompanyService,

    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $objCompanies = $this->objCompanyService->getAll();
        return apiResponse()->pagination($objCompanies)->success(CompanyTransformer::collection($objCompanies));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        $path = null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->store('/logos','public');
        }

        $objCompany = $this->objCompanyService->store($request->name, $request->email, $path, $request->website);

        return apiResponse()->success(new CompanyTransformer($objCompany));
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return apiResponse()->success(new CompanyTransformer($company));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        if ($request->hasFile('logo')) {
            if($company->logo){
                $lastLogo = storage_path('app/public').'/'.$company->logo;
                if (file_exists($lastLogo)) {
                    unlink($lastLogo);
                }
            }
            $file = $request->file('logo');
            $path = $file->store('/logos','public');

            $company->logo = $path;
        }

        $objCompany = $this->objCompanyService->update($request, $company);

        return apiResponse()->success(new CompanyTransformer($objCompany));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        if ($company->delete()) {

            return apiResponse()->success(['message' => 'Deleted the data successfully!']);
        }

        return apiResponse()->error(['message' => 'Something Went Wrong!']);
    }
}
