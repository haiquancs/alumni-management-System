<?php
/**
 * Created by PhpStorm.
 * User: Lenh Ho Xung
 * Date: 7/27/2018
 * Time: 1:36 PM
 */

namespace App\Http\Controllers\Web;


use Illuminate\Http\Request;
use App\Models\Grade;
use App\Http\Requests\GradeRequest;

class GradesController extends AppController
{
    protected $dirView = 'Web.Grade.';

    public function index(Request $request)
    {
        $grades = Grade::getGrade();
        return view($this->dirView . 'index', compact('grades'));
    }
    public function store(Request $request)
    {
        $error = Grade::uniqueCreateCheck($request->all());
        if($error)
        {
            return view($this->dirView . 'create', compact('error'));
        }
        else
        {
            $grades = Grade::createGrade($request->all());
            return redirect()->route('web.grades.index');
        }
    }
    public function create(){
        return view($this->dirView . 'create', compact('error'));
    }

    public function edit($id)
    {
        $grade = Grade::find($id);
        return view($this->dirView . 'edit', compact('grade'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $error = Grade::uniqueEditCheck($request, $id);
        if($error)
        {
            $grades = Grade::find($id);
            return json_encode(['status' => false, 'data' => $error]);
        }

        Grade::updateGrade($request->all(), $id);
        return json_encode(['status' => true, 'data' => $data]);

    }

    public function destroy($id)
    {
        $grades = Grade::find($id);
        $countGrade = Grade::destroyGrade($id);
        if ($countGrade) {
            $grades->delete();
        } else {
            $grade = Grade::where('id', $id)->select('grade')->first();
            flash( 'Grade '. $grade->grade.  ' đang có nhân viên!')->error();
        }
        return redirect()->route('web.grades.index');
    }
}