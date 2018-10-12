<?php
/**
 * Created by Duoctv
 * Date 7/25/2018
 * Time 5:00 pm
 */
namespace App\Models;

class TypeDetailCompany extends AppModel
{
    protected $table = 'type_detail_companys';
    protected $primaryKey ='id';
    protected $fillable = ['type_detail','type_company_id','created_id','updated_id','deleted_id'];

    public static function getGrade(){
        $grades = self::select('id', 'grade')
            ->orderBy('grade', 'ASC')
            ->get();
        if (empty($grades)){
            return [];
        }
        return $grades;
    }

    public static function updateGrade($request, $id)
    {
        $grade = Grade::find($id);
        return $grade->update($request);
    }

    public static function createGrade(array $data)
    {
        $grade = $data['newgrade'];
        foreach ($grade as $value) {
            $data = array(
                'grade' => $value
            );
            Grade::create($data);
        }
    }

    public static function uniqueCreateCheck(array $data)
    {
        $rankAlreadyExist = self::select('grade')
                    ->where('deleted_at',NUll)
                    ->get()->toArray();
        foreach ($data['newgrade'] as $value) {
            foreach ($rankAlreadyExist as $value1) {
                if($value==$value1['grade'])
                    return 'Grade đã tồn tại';
            }
        }
        return 0;
    }
    public static function uniqueEditCheck($data, $id)
    {
        $gradeAlreadyExist = self::select('grade')
                    ->where('deleted_at',NUll)
                    ->where('id', '<>', $id)
                    ->get()->toArray();
        foreach ($gradeAlreadyExist as $value) {
            if($data['grade']==$value['grade'])
                return 'Grade đã tồn tại';
        }
        return 0;
    }

    public static function destroyGrade($id){
        $grade = Staff::where('grade_id', $id)->count();
        if ($grade > 0) {
            return false;
        }
        return true;
    }
}