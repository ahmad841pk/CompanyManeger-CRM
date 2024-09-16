<?php

namespace App\Http\Controllers\Employee;

use App\Contracts\EmployeeContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeTransformer;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function __construct(
        private readonly EmployeeContract $objEmployeeService,

    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $objEmployees = $this->objEmployeeService->getAll();
        return apiResponse()->pagination($objEmployees)->success(EmployeeTransformer::collection($objEmployees));
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
    public function store(EmployeeRequest $request)
    {
        $objEmployee = $this->objEmployeeService->store($request->first_name, $request->last_name, $request->email, $request->phone, $request->Employee);

        return apiResponse()->success(new EmployeeTransformer($objEmployee));
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $Employee)
    {
        return apiResponse()->success(new EmployeeTransformer($Employee));
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
    public function update(UpdateEmployeeRequest $request, Employee $Employee)
    {
        $objEmployee = $this->objEmployeeService->update($request, $Employee);

        return apiResponse()->success(new EmployeeTransformer($objEmployee));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $Employee)
    {
        if ($Employee->delete()) {

            return apiResponse()->success(['message' => 'Deleted the data successfully!']);
        }

        return apiResponse()->error(['message' => 'Something Went Wrong!']);
    }
}
