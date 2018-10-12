<?php
/**
 * Created by Duoctv
 * Date 7/25/2018
 * Time 5:00 pm
 */

namespace App\Models;

use Carbon\Carbon;
use Auth;

class RollJob extends AppModel
{
    const MONTH_START_SEMESTER_1 = 5;
    const MONTH_START_SEMESTER_2 = 10;

    const STATUS_CREATE_NEW_OPES = 1;
    const STATUS_SEND_TO_REVIEW = 2;
    const STATUS_UPDATE_REVIEW_COMMENT = 3;
    const STATUS_APPROVAL = 4;
    const STATUS_REJECTED = 5;

    public static $status = [
        self::STATUS_CREATE_NEW_OPES => 'Chưa gửi',
        self::STATUS_SEND_TO_REVIEW => 'Chờ Review',
        self::STATUS_UPDATE_REVIEW_COMMENT => 'Yêu cầu chỉnh sửa',
        self::STATUS_APPROVAL => 'Chấp nhận',
        self::STATUS_REJECTED => 'Từ chối',
    ];

    const TYPE_BUTTON_FINISH = 1;
    const TYPE_BUTTON_CREATE = 2;
    const TYPE_BUTTON_FINISH_OPES_UPDATE = 3;

    protected $table = 'roll_jobs';
    protected $primaryKey = 'id';
    protected $fillable = ['roll',
        'created_id',
        'updated_id',
        'deleted_id'
    ];

    public static function getMyOpesStaff($request)
    {
        if (empty(auth::id())) {
            return [];
        }
        $myOpesStaff = self::select('id',
            'staff_id',
            'rank_id',
            'year',
            'semester',
            'status')
            ->orderBy('id', 'desc')
            ->with(['staff' => function ($query) {
                $query->select('id',
                    'code',
                    'first_name',
                    'last_name',
                    'full_name',
                    'rank_id',
                    'department_id',
                    'role');
            }])
            ->where('staff_id', auth::id());

        if (!empty($request['year'])) {
            $myOpesStaff->where('year', $request['year']);
        }
        if (!empty($request['semester'])) {
            $myOpesStaff->where('semester', $request['semester']);
        }
        if (!empty($request['status'])) {
            $myOpesStaff->where('status', $request['status']);
        }
        $myOpesStaff = $myOpesStaff->paginate(10);
        return $myOpesStaff;
    }

    public static function showOpesStaff($id)
    {
        if (empty($id)) {
            return [];
        }

        $opesStaff = self::select('id', 'staff_id', 'year', 'semester', 'status')
            ->with(['staff' => function ($q) {
                $q->select('id', 'code', 'first_name', 'last_name', 'full_name', 'department_id', 'role');
            }])->find($id);


        if (empty($opesStaff)) {
            return [];
        }
        return $opesStaff;
    }

    public static function getTimeNow()
    {
        $yearNow = Carbon::now()->year;
        $monthNow = Carbon::now()->month;
        if ($monthNow >= self::MONTH_START_SEMESTER_1 && $monthNow < self::MONTH_START_SEMESTER_2) {
            $semester = 1;
        } else $semester = 2;
        $timeNow = array();
        $timeNow['year'] = $yearNow;
        $timeNow['semester'] = $semester;
        return $timeNow;
    }

    public static function getRequestOpesStillSave($staff_id)
    {
        $statusUnsent = self::select('id', 'status')->where('status', self::STATUS_CREATE_NEW_OPES)->where('staff_id', $staff_id)->get();
        $statusHaveToUpdate = self::select('id', 'status')->where('status', self::STATUS_UPDATE_REVIEW_COMMENT)->where('staff_id', $staff_id)->get();
        $evaluationFollowStaffId = Staff::getListEvaluationFollowStaffId($staff_id);
        if ($evaluationFollowStaffId == NULL) $evaluationFollowStaffId = array();
        foreach ($evaluationFollowStaffId as $key => $value) {
            $listIdEvaluationFollowStaffId[] = $value['id'];
        }
        $request = array();
        if (!empty($statusUnsent->toArray())) {
            foreach ($listIdEvaluationFollowStaffId as $key => $value) {
                $listEval = EvaluationCriteria::getListEval($value, $statusUnsent[0]['id']);
                foreach ($listEval as $key1 => $value1) {
                    $request['opes'][$key][$key1] = self::assignValueForRequest($value1);
                }
            }
            $request['id'] = $statusUnsent[0]['id'];
            $request['status'] = $statusUnsent[0]['status'];
        } elseif (!empty($statusHaveToUpdate->toArray())) {
            foreach ($listIdEvaluationFollowStaffId as $key => $value) {
                $listEval = EvaluationCriteria::getListEval($value, $statusHaveToUpdate[0]['id']);
                foreach ($listEval as $key1 => $value1) {
                    $request['opes'][$key][$key1] = self::assignValueForRequest($value1);
                }
            }
            $request['id'] = $statusHaveToUpdate[0]['id'];
            $request['status'] = $statusHaveToUpdate[0]['status'];
        }
        return $request;
    }

    public static function getRequestOpesCreated($staff_id)
    {
        $yearNow = Carbon::now()->year;
        $monthNow = Carbon::now()->month;
        if ($monthNow >= self::MONTH_START_SEMESTER_1 && $monthNow < self::MONTH_START_SEMESTER_2) {
            $semester = 1;
        } else $semester = 2;
        $getOpes = self::where('staff_id', '=', $staff_id)
            ->where('year', '=', $yearNow)
            ->where('semester', '=', $semester)
            ->get()->toArray();
        if (empty($getOpes)) {
            return 2;
        } else {
            $lastOpes = count($getOpes) - 1;
            if ($getOpes[$lastOpes]['status'] == self::STATUS_REJECTED) {
                return 2;
            }
        }
        return 0;
    }

    public static function saveAndCreateAndGetIdNewOpesStaff($status, $staff_id)
    {
        $monthNow = Carbon::now()->month;
        if ($monthNow >= self::MONTH_START_SEMESTER_1 && $monthNow < self::MONTH_START_SEMESTER_2) {
            $semester = 1;
        } else $semester = 2;
        $rankId = Staff::getRankId($staff_id);
        if ($status == self::STATUS_UPDATE_REVIEW_COMMENT) {
            $getIdThisOpesStaff = self::getIdOpesStaffWithStatus($staff_id, $status);
            self::updateOpesStaff($getIdThisOpesStaff, $staff_id, $rankId, Carbon::now()->year, $semester, self::STATUS_SEND_TO_REVIEW);
            return $getIdThisOpesStaff;
        } else {
            $getIdThisOpesStaff = self::getIdOpesStaffWithStatus($staff_id, self::STATUS_CREATE_NEW_OPES);
            if ($getIdThisOpesStaff == Null) {
                self::createOpesStaff($staff_id, $rankId, Carbon::now()->year, $semester, $status);
            } else {
                self::updateOpesStaff($getIdThisOpesStaff, $staff_id, $rankId, Carbon::now()->year, $semester, $status);
            }
            $getIdThisOpesStaff = self::getIdOpesStaffWithStatus($staff_id, $status);
            return $getIdThisOpesStaff;
        }
    }

    public static function getRequestOpesHaveToUpdate($staff_id)
    {
        $idOpesStaff = self::select('id', 'status')->where('status', self::STATUS_UPDATE_REVIEW_COMMENT)->where('staff_id', $staff_id)->get();
        $evaluationFollowStaffId = Staff::getListEvaluationFollowStaffId($staff_id);
        if ($evaluationFollowStaffId == NULL) $evaluationFollowStaffId = array();
        foreach ($evaluationFollowStaffId as $key => $value) {
            $listIdEvaluationFollowStaffId[] = $value['id'];
        }
        $request = array();
        if (!empty($idOpesStaff->toArray())) {
            foreach ($listIdEvaluationFollowStaffId as $key => $value) {
                $listEval = EvaluationCriteria::getListEval($value, $idOpesStaff[0]['id']);
                foreach ($listEval as $key1 => $value1) {
                    $request['opes'][$key][$key1] = self::assignValueForRequest($value1);
                }
            }
            $request['id'] = $idOpesStaff[0]['id'];
            $request['status'] = $idOpesStaff[0]['status'];
        }
        return $request;
    }

    // public static function checkOpesApproval()
    // {
    //     $timeNow = self::getTimeNow();
    //     $opesApprovalNow = self::where('year', $timeNow['year'])
    //         ->where('semester', $timeNow['semester'])
    //         ->where('status', self::STATUS_APPROVAL)
    //         ->get()->toArray();
    //     if (!empty($opesApprovalNow)) {
    //         self::where('year', $timeNow['year'])
    //             ->where('semester', $timeNow['semester'])
    //             ->where('status', self::STATUS_APPROVAL)
    //             ->update(['status' => self::STATUS_UPDATE_REVIEW_COMMENT]);
    //     }
    // }

    public static function assignValueForRequest($data){
        return array(
                'Title' => $data['title'],
                'Content' => $data['content'],
                'percents' => $data['percents'],
                's' => $data['s'],
                'a' => $data['a'],
                'b' => $data['b'],
                'c' => $data['c'],
                'd' => $data['d'],
                'mark' => $data['mark'],
                'note_for_reviewer' => $data['note_for_reviewer'],
                'note_for_creater' => $data['note_for_creater']);
    }

    public static function getIdOpesStaffWithStatus($staff_id, $status){
        return self::select('id')
                ->where('staff_id', $staff_id)
                ->where('status', $status)
                ->get()->toArray();
    }

    public static function createOpesStaff($staff_id, $rank_id, $year, $semester, $status){
        $data = array(
                    'staff_id' => $staff_id,
                    'rank_id' => $rank_id,
                    'year' => $year,
                    'semester' => $semester,
                    'status' => $status);
                self::create($data);
    }

    public static function updateOpesStaff($id, $staff_id, $rank_id, $year, $semester, $status){
        self::where('id', $id)
                    ->update([
                        'staff_id' => $staff_id,
                        'rank_id' => $rank_id,
                        'year' => $year,
                        'semester' => $semester,
                        'status' => $status]);
    }

    public static function resolve($idOpesStaff, $status)
    {
        self::where('id', $idOpesStaff)->update(['status' => $status]);
    }

    public static function confirmUpdateStatus($idOpesStaff)
    {
        self::where('id', '=', $idOpesStaff)->update(['status' => self::STATUS_UPDATE_REVIEW_COMMENT]);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    public function opesDetail()
    {
        return $this->hasMany(OpesDetail::class, 'opes_staff_id', 'id');
    }
}