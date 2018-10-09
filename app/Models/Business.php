<?php
/**
 * Created by Duoctv
 * Date 7/25/2018
 * Time 5:00 pm
 */

namespace App\Models;

class Business extends AppModel
{
    protected $table = 'business';
    protected $primaryKey = 'id';
    protected $fillable = ['business',
        'created_id',
        'updated_id',
        'deleted_id'
    ];

    public static function getDepartment()
    {
        $departments = self::select('id', 'name')
            ->orderBy('name', 'ASC')
            ->paginate(10);
        if (empty($departments)) {
            return [];
        }
        return $departments;
    }

    public static function getNameBusiness($businessId){
        return self::select('business')->where('id',$businessId)->first();
    }

    public static function createDepartment(array $data)
    {
        $dataSave['name'] = $data['name'];
        return Department::create($dataSave);
    }

    public static function uniqueCreateCheck(array $data)
    {
        $departmentAlreadyExist = self::select('name')
            ->where('deleted_at', NUll)
            ->get()->toArray();

        foreach ($departmentAlreadyExist as $value) {
            if ($data['name'] == $value['name'])
                return 'Phòng ban đã tồn tại';
        }
        return 0;
    }

    public static function updateDepartment($request, $id)
    {
        $department = Department::find($id);
        return $department->update($request);
    }

    public static function uniqueEditCheck($data, $id)
    {
        $departmentAlreadyExist = self::select('id', 'name')
            ->where('deleted_at', NUll)
            ->where('id', '<>', $id)
            ->get()->toArray();
        foreach ($departmentAlreadyExist as $value) {
            if ($data['name'] == $value['name'])
                return 'Phòng ban đã tồn tại';
        }
        return 0;
    }

    public static function destroyDepartment($id)
    {
        $department = Staff::where('department_id', $id)->count();

        if ($department > 0) {
            return false;
        }
        return true;
    }

    public static function getAllOpesStaffs($request)
    {
        \DB::enableQueryLog();
        $allOpesStaffs = self::select('id', 'name')
            ->whereHas('staff')
            ->with(['staff' => function ($qr) use ($request) {
                $qr->select('*')
                    ->whereHas('opesStaff')
                    ->with(['opesStaff' => function ($query) use ($request) {
                        if (isset($request->year) || isset($request->semester) || isset($request->status)) {
                            if (!empty($request['year'])) {
                                $query->where('year', $request['year']);
                            }
                            if (!empty($request['semester'])) {
                                $query->where('semester', $request['semester']);
                            }
                            if (!empty($request['status'])) {
                                $query->where('status', $request['status']);
                            }
                        }
                    }]);
                if (isset($request->code) || isset($request->full_name) || $request->role) {
                    if (!empty($request['code'])) {
                        $qr->where('code', 'like', '%' . $request['code'] . '%');
                    }
                    if (!empty($request['full_name'])) {
                        $qr->where('full_name', 'LIKE', '%' . $request['full_name'] . '%');
                    }
                    if (!empty($request['role'])) {
                        $qr->where('role', $request['role']);
                    }
                }
            }])
            ->orderBy('id', 'desc');

        if (!empty($request['name'])) {
            $allOpesStaffs->where('name', 'like', '%' . $request['name'] . '%');
        }

        $result = $allOpesStaffs->get()->toArray();
//        dd(\DB::getQueryLog());
//        dd($result);
        return $result;
    }

    public function user()
    {
        return $this->hasMany(User::class, 'graduation_business', 'id');
    }
}


