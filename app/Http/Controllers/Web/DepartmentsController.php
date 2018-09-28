<?php
/**
 * Created by PhpStorm.
 * User: Lenh Ho Xung
 * Date: 7/27/2018
 * Time: 1:37 PM
 */

namespace App\Http\Controllers\Web;


use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentsController extends AppController
{
    private $dirView = 'Web.Department.';

    // Index departments
    public function index()
    {
        $departments = Department::getDepartment();
        return view($this->dirView . 'index', compact('departments'));
    }

    // Create departments
    public function create()
    {
        return view($this->dirView . 'create');
    }

    public function store(Request $request)
    {
        $error = Department::uniqueCreateCheck($request->all());
        if ($error) {
            return view($this->dirView . 'create', compact('error'));
        } else {
            $departments = Department::createDepartment($request->all());
            return redirect()->route('web.departments.index');
        }
    }


    // Edit departments
    public function edit($id)
    {
        $departments = Department::find($id);
        return view($this->dirView . 'edit', compact('departments'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $error = Department::uniqueEditCheck($request, $id);
        if ($error) {
            $departments = Department::find($id);
            return json_encode(['status' => false, 'data' => $error]);
        }
        Department::updateDepartment($request->all(), $id);
        return json_encode(['status' => true, 'data' => $data]);
    }

    // Delete departments
    public function destroy($id)
    {
        $department = Department::find($id);
        $countDepartment = Department::destroyDepartment($id);
        if ($countDepartment) {
            $department->delete();
        } else {
            $departmentName = Department::where('id', $id)->select('name')->first();
            flash('Phòng ban ' . $departmentName->name . ' đang có nhân viên!')->error();
        }
        return redirect()->route('web.departments.index');
    }
}