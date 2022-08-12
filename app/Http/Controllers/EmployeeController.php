<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class EmployeeController
 * @package App\Http\Controllers
 */
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $employees = Employee::query()->where('id', '!=', auth()->user()->id);
            if($request->company) {
                $employees->where('company_id', $request->company);
            }
            return datatables($employees->get())
                ->addIndexColumn()
                ->addColumn('avatar', function ($row) {
                    return '<img src="'. Storage::url($row->avatar) .'" alt="'. $row->name .'" class="img-thumbnail" width="100">';
                })
                ->addColumn('company', function ($row) {
                    return '<a href="'. route('companies.show',$row->id) .'">'.$row->company?->name.'</a>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<form action="'. route('employees.destroy',$row->id) .'" method="POST">'.
                    '<input type="hidden" name="_token" value="'.csrf_token().'" />' . method_field('DELETE') .
                    '<a class="btn btn-sm btn-primary m-2" href="'. route('employees.show',$row->id) .'">Show</a>'.
                    '<a class="btn btn-sm btn-success m-2" href="'. route('employees.edit',$row->id) .'">Edit</a>'.
                    '<button type="submit" onclick="return confirm("Are you sure?")" class="btn btn-danger m-2 btn-sm">Delete</button>'.
                    '</form>';
                    return $btn;
                })
                
                ->rawColumns(['action', 'avatar', 'company'])
                ->make(true);
        }
        return view('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = new Employee();
        return view('employee.create', compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {

        $employee = Employee::create($request->validated());

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);

        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);

        return view('employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $employee = Employee::find($id)->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully');
    }
}
