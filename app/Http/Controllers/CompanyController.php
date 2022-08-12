<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CompanyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class CompanyController
 * @package App\Http\Controllers
 */
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        if($request->ajax()) {
            
            return datatables(Company::query())
                ->addIndexColumn()
                ->addColumn('logo', function ($row) {
                    return '<img src="'. Storage::url($row->logo) .'" alt="'. $row->name .'" class="img-thumbnail" width="100">';
                })
                ->addColumn('employees', function ($row) {
                    return '<a href="'.route('employees.index', ['company' => $row->id]).'" class="btn btn-primary btn-sm">'. $row->employees->count() .'</a>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<form action="'. route('companies.destroy',$row->id) .'" method="POST">'.
                    '<input type="hidden" name="_token" value="'.csrf_token().'" />' . method_field('DELETE') .
                    '<a class="btn btn-sm btn-primary m-2" href="'. route('companies.show',$row->id) .'">Show</a>'.
                    '<a class="btn btn-sm btn-success m-2" href="'. route('companies.edit',$row->id) .'">Edit</a>'.
                    '<button type="submit" onclick="return confirm("Are you sure?")" class="btn btn-danger m-2 btn-sm">Delete</button>'.
                    '</form>';
                    return $btn;
                })
                
                ->rawColumns(['action', 'logo', 'employees'])
                ->make(true);
        }
        return view('company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = new Company();
        return view('company.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {

        $company = Company::create($request->validated());

        return redirect()->route('companies.index')
            ->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);

        return view('company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);

        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->validated());

        return redirect()->route('companies.index')
            ->with('success', 'Company updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $company = Company::find($id)->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully');
    }
}
