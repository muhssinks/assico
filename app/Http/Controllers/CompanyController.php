<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Storage;

class CompanyController extends Controller
{
    public function index()
    {
        return view('companies.index');
    }

    public function getData()
    {
        $companies = Company::all();
        return DataTables::of($companies)
        ->addColumn('action', function($company) {
            $editUrl = route('companies.edit', $company->id);
            $deleteUrl = route('companies.destroy', $company->id);
            $buttons = '<a href="' . $editUrl . '" class="btn btn-primary">Edit</a>';
            $buttons .= '<form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>';
            return $buttons;
        })
        ->addColumn('image', function ($company) {
            if($company->logo !=""){
                $img = Storage::url($company->logo);
                
            } else {
                $img = '-';
            }
            return $img;
            })
        ->make(true);
    }

    public function create()
    {
        $obj = new Company;
        return view('companies.form')
                ->with("obj", $obj)
                ->with("edit", 0);
    }

    public function store(CreateCompanyRequest  $request)
    {
        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos');
            $company->logo = $logoPath;
        }

        $company->save();
        return redirect()->route('companies.index');
    }

    public function show($company_id)
    {
        $obj = Company::where('id', $company_id)->first();
        return view('companies.form')
            ->with("edit", 1)
            ->with("obj", $obj);
    }

    public function edit($company_id)
    {
        $obj = Company::where('id', $company_id)->first();
        return view('companies.form')
            ->with("edit", 2)
            ->with("obj", $obj);
    }

    public function update($company_id,UpdateCompanyRequest $request)
    {
        $company = Company::findOrFail($company_id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos');
            $company->logo = $logoPath;
        }
        $company->save();
        return redirect()->route('companies.index');
    }

    public function destroy($company_id)
    {
        Company::where('id',$company_id)->delete();
        return redirect()->route('companies.index');
    }
}
