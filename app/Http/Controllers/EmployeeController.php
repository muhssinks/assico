<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees.index');
    }

    public function getData()
    {
        $employees = Employee::with('company')->get();
        return DataTables::of($employees)
        ->addColumn('action', function($employee) {
            $editUrl = route('employees.edit', $employee->id);
            $deleteUrl = route('employees.destroy', $employee->id);
            $buttons = '<a href="' . $editUrl . '" class="btn btn-primary">Edit</a>';
            $buttons .= '<form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>';
            return $buttons;
        })
        ->make(true);
    }

    public function create()
    {
        $obj = new Employee;
        $companies = Company::all();
        return view('employees.form')
                ->with("obj", $obj)
                ->with("companies", $companies)
                ->with("edit", 0);
    }

    public function store(CreateEmployeeRequest  $request)
    {
        $employee = new Employee();
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->company_id = $request->company_id;

        $employee->save();
        return redirect()->route('employees.index');
    }

    public function show($employee_id)
    {
        $obj = Employee::where('id', $employee_id)->first();
        $companies = Company::all();
        return view('employees.form')
            ->with("companies", $companies)
            ->with("edit", 1)
            ->with("obj", $obj);
    }

    public function edit($employee_id)
    {
        $obj = Employee::where('id', $employee_id)->first();
        $companies = Company::all();
        return view('employees.form')
            ->with("edit", 2)
            ->with("companies", $companies)
            ->with("obj", $obj);
    }

    public function update($employee_id,UpdateEmployeeRequest $request)
    {
        $employee = Employee::findOrFail($employee_id);

        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->company_id = $request->company_id;

        $employee->save();
        return redirect()->route('employees.index');
    }

    public function destroy($employee_id)
    {
        Employee::where('id',$employee_id)->delete();
        return redirect()->route('employees.index');
    }
}
