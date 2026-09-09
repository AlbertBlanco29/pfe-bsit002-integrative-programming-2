<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->has('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        if ($request->has('department')) {
            $query->where('department', $request->department);
        }

        return response()->json($query->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email',
            'department' => 'required|string|max:100',
            'position' => 'required|string|max:100',
        ]);

        $employee = Employee::create($validated);

        return response()->json($employee, 201);
    }

    public function show(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found'
            ], 404);
        }

        return response()->json($employee, 200);
    }

    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found'
            ], 404);
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        $employee->update($validated);

        return response()->json($employee, 200);
    }

    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found'
            ], 404);
        }

        $employee->delete();

        return response()->json([
            'message' => 'Employee deleted successfully'
        ], 200);
    }
}