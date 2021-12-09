<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Mockery\Exception;

class EmployeeController extends Controller
{
    public function index(){
        return Employee::all();
    }

    public function managerEmployees($id){
        return Employee::where('superior', $id)->get();
    }

    public function employeesByPosition($position){
        return Employee::where('position', $position)->get();
    }

    public function create(Request $request){
        try {
            $employee = new Employee();
            $employee->name = $request->name;
            $employee->position = $request->position;
            $employee->superior = $request->superior;
            $employee->startDate = $request->startDate;
            $employee->endDate = $request->endDate;

            if($employee->save()){
                return response()->json(['status' => 'success', 'message' => 'Employee created']);
            }
        } catch (\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id){
        try {
            $employee = Employee::findOrFail($id);
            $employee->name = $request->name;
            $employee->position = $request->position ?? 'worker';
            $employee->superior = $request->superior;
            $employee->startDate = $request->startDate;
            $employee->endDate = $request->endDate;

            if($employee->save()){
                return response()->json(['status' => 'success', 'message' => 'Employee updated']);
            }
        } catch (\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }


    public function delete(Request $request, $id){
        try {
            $employee = Employee::findOrFail($id);

            if($employee->delete()){
                return response()->json(['status' => 'success', 'message' => 'Employee deleted']);
            }
        } catch (\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
