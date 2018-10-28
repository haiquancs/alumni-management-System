<?php
/**
 * Created by Duoctv
 * Date 7/25/2018
 * Time 5:00 pm
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Auth;
use phpDocumentor\Reflection\Types\Null_;

class User extends AppModel
{
    const ROLE_ADMIN = 1;
    const ROLE_STUDENT = 2;

    const SEX_MALE = 1;
    const SEX_FEMALE = 2;

    public static $role = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_STUDENT => 'Student',
    ];

    public static $sex = [
        self::SEX_MALE => 'Nam',
        self::SEX_FEMALE => 'Nữ',
    ];

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'code',
        'first_name',
        'last_name',
        'full_name',
        'sex',
        'email',
        'phone',
        'graduation_year',
        'graduation_business',
        'job_id',
        'role',
        'last_access_at',
        'remember_token',
        'password',
        'created_id',
        'updated_id',
        'deleted_id'
    ];

    public static function getUser($request)
    {
        // dd($request->toArray());
        $user = self::select()->with(['business' => function ($qr) {
                $qr->select('id', 'business');
            }])->orderBy('code');
        if (!empty($request['code'])) {
            $user->where('code', 'like', '%' . $request['code'] . '%');
        }
        if (!empty($request['full_name'])) {
            $user->where('full_name', 'like', '%' . $request['full_name'] . '%');
        }
        if (!empty($request['graduation_year'])) {
            $user = $user->where('graduation_year', $request['graduation_year']);
        }
        if (!empty($request['graduation_business'])) {
            $user = $user->where('graduation_business', $request['graduation_business']);
        }
        $user = $user->paginate(10);
        if (empty($user)) {
            return [];
        }
        return $user;
    }

    public static function getListSurvey($request){
        $listSurveys = self::where('job_id','<>', NULL)
            ->with('jobusers')
            ->orderBy('id');
        if (!empty($request['code'])) {
            $listSurveys->where('code', 'like', '%' . $request['code'] . '%');
        }
        if (!empty($request['full_name'])) {
            $listSurveys->where('full_name', 'like', '%' . $request['full_name'] . '%');
        }
        $listSurveys = $listSurveys->paginate(10);
        return $listSurveys;
    }

    public static function showSurveyDetail($idUser){
        $surveyDetails = self::where('id', $idUser)
            ->with('jobusers')
            ->get();
        return $surveyDetails;
    }

    public static function getAllInfoListSurvey(){
        $allListSurvey = self::where('job_id','<>', NULL)
            ->with('jobusers')
            ->orderBy('id')
            ->get();
        $allInfoListSurvey['job']['job'] = 0;
        $allInfoListSurvey['job']['un_job'] = 0;
        foreach ($allListSurvey as $value){
            if ($value['jobusers']['job'] == JobUser::JOB){
                $allInfoListSurvey['job']['job']++;
            }else{
                $allInfoListSurvey['job']['un_job']++;
            }
        }
        return $allInfoListSurvey;
    }

    public static function getListManager()
    {
        $listBom = self::where('role', self::ROLE_BOM)
            ->select('id', 'role', 'department_id', 'first_name', 'last_name', 'full_name')
            ->get()
            ->toArray();
        $listGm = self::where('role', self::ROLE_GM)
            ->select('id', 'role', 'department_id', 'first_name', 'last_name', 'full_name')
            ->get()
            ->toArray();
        $mappingRole = [Staff::ROLE_GM => Staff::ROLE_STAFF, Staff::ROLE_BOM => Staff::ROLE_GM];
        foreach ($listGm as $value) {
            $listManager['Staff'][$value['department_id']][$mappingRole[$value['role']]][] = $value;
        }
        $listManager['Gm'] = $listBom;
        return $listManager;
    }

    public static function getStaffWithNoOpesByReference()
    {
        $staffByReference = self::select('id')
            ->where('reference_staff_id', auth::user()->id)
            ->get();
        $timeNow = OpesStaff::getTimeNow();
        $staffByReferenceHaveToCreate = array();
        foreach ($staffByReference as $key => $value) {
            $data = OpesStaff::where('staff_id', '=', $value['id'])
                ->where('year', '=', $timeNow['year'])
                ->where('semester', '=', $timeNow['semester'])
                ->get();
            if (empty($data->toArray())) {
                $staffByReferenceHaveToCreate[] = $value['id'];
            } else {
                $data1 = OpesStaff::where('staff_id', '=', $value['id'])
                    ->where('year', '=', $timeNow['year'])
                    ->where('semester', '=', $timeNow['semester'])
                    ->orderBy('id', 'desc')
                    ->first();
                if ($data1['status'] == OpesStaff::STATUS_CREATE_NEW_OPES || $data1['status'] == OpesStaff::STATUS_REJECTED) {
                    $staffByReferenceHaveToCreate[] = $value['id'];
                }
            }
        }
        $staffWithNoOpesByReference = array();
        foreach ($staffByReferenceHaveToCreate as $key => $value) {
            $staffWithNoOpesByReference[$key] = self::select('id', 'reference_staff_id', 'code', 'first_name', 'last_name', 'full_name', 'department_id', 'role')
                ->where('id', '=', $value)
                ->where('reference_staff_id', auth::user()->id)
                ->first()->toArray();
        }
        return $staffWithNoOpesByReference;
    }

    public static function getReferId($staffId)
    {
        $roleFollowStaffId = self::find($staffId);
        if (empty($roleFollowStaffId)) {
            return dd('Không tìm thấy tài khoản này');
        }

        if ($roleFollowStaffId->role == self::ROLE_STAFF || $roleFollowStaffId->role == self::ROLE_GM) {
            return $roleFollowStaffId->reference_staff_id;
        }

        return dd('Đang đăng nhập với quyền Admin hoặc Bom, không cần gửi Opes');
    }

    public static function showUser($userId)
    {
        $user = self::where('id',$userId)
            ->with(['business' => function ($qr) {
                $qr->select('id', 'business');
            }])->first();
        return $user;
    }

    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public static function updateUser($data, $userId)
    {
        $user = self::find($userId);
        if (empty($user)) {
            abort(404);
        }
        $updateUser = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'full_name' => $data['first_name'] . ' ' . $data['last_name'],
            'sex' => $data['sex'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'graduation_year' => $data['graduation_year'],
            'graduation_business' => $data['graduation_business'],
        );
        $user->update($updateUser);
    }

    public static function uniqueEditCheck($data, $id)
    {
        $staffAlreadyExist = self::select('id', 'code', 'email')
            ->where('deleted_at', Null)
            ->where('id', '<>', $id)
            ->get();
        foreach ($staffAlreadyExist as $value) {
            if ($data['code'] == $value['code'])
                return 'Mã nhân viên đã tồn tại';
            if ($data['email'] == $value['email'])
                return 'Email đã tồn tại';
        }
        return 0;
    }

    public static function createUser()
    {
        for ($i=14020000; $i < 14020020; $i++) { 
            $newUser = array(
                'code' => $i, 
                'first_name' => NULL,
                'last_name' => NULL,
                'full_name' => NULL,
                'sex' => NULL,
                'email' => NULL,
                'graduation_year' => NULL,
                'graduation_business' => NULL,
                'role' => self::ROLE_STUDENT,
                'last_access_at' => date('Y-m-d H:i:s', time()),
                'password' => Hash::make($i),
            );
            self::create($newUser);
        }
    }

    public static function getListEvaluationFollowStaffId($staff_id)
    {
        $listEvaluationFollowStaffId = self::select('*')
            ->with(['rank' => function ($query) {
                $query->select('*')
                    ->with(['evaluationCriteria' => function ($q) {
                        $q->select('*');
                    }]);
            }])
            ->find($staff_id)->toArray();
        if (empty($listEvaluationFollowStaffId['rank'])) {
            return dd('Rank của tài khoản này đã bị xóa');
        }
        if (empty($listEvaluationFollowStaffId['rank']['evaluation_criteria'])) {
            return dd('Tiêu chí theo ranh của tài khoản này đã bị xóa');
        }
        return $listEvaluationFollowStaffId['rank']['evaluation_criteria'];
    }

    public static function getMySuborOpesStaff($request)
    {
        if (empty(auth::id())) {
            return [];
        }
        $mySuborOpesStaff = self::select('id', 'code', 'first_name', 'last_name', 'full_name')
            ->where('reference_staff_id', '=', Auth::user()->id)
            ->with('opesStaff')->orderBy('id', 'desc');

        if (!empty($request['code'])) {
            $mySuborOpesStaff->where('code', 'like', '%' . $request['code'] . '%');
        }
        if (!empty($request['full_name'])) {
            $mySuborOpesStaff->where('full_name', 'like', '%' . $request['full_name'] . '%');
        }

        if (isset($request->semester) || isset($request->year) || isset($request->status)) {
            $mySuborOpesStaff = $mySuborOpesStaff->whereHas('opesStaff', function ($query) use ($request) {
                if (!empty($request['semester'])) {
                    $query->where('semester', $request['semester']);
                }
                if (!empty($request['year'])) {
                    $query->where('year', $request['year']);
                }
                if (!empty($request['status'])) {
                    $query->where('status', $request['status']);
                }
            });
        }

        return $mySuborOpesStaff->get()->toArray();
    }

    public static function getRankId($staffId)
    {
        return self::where('id', '=', $staffId)->pluck('rank_id')->first();
    }

    // ham goi hien thi cap duoi
    public static function getStaffByReference()
    {
        return self::select('id', 'reference_staff_id', 'code', 'first_name', 'last_name', 'full_name', 'department_id', 'role')
            ->where('reference_staff_id', auth::user()->id)
            ->get();
    }

    public static function getDepartmentByStaffId($StaffId)
    {
        $getNameOfDepartment = self::select('id', 'department_id')
            ->where('id', $StaffId)
            ->with(['department' => function ($query) {
                $query->select('id', 'name');
            }])->first();
        return $getNameOfDepartment['department']['name'];
    }

    public static function getEmailStaffId($StaffId)
    {
        $email = self::where('id', $StaffId)->select('email')->first();
        return $email['email'];
    }

    public static function getNameStaffId($StaffId)
    {
        $fullName = self::where('id', $StaffId)->select('full_name')->first();
        return $fullName['full_name'];
    }

    // *

    public function business()
    {
        return $this->belongsTo(Business::class, 'graduation_business', 'id');
    }

    public function jobusers(){
        return $this->belongsTo(JobUser::class, 'job_id', 'id');
    }

    public function opesStaff()
    {
        return $this->hasMany(OpesStaff::class, 'staff_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id', 'id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }
}
