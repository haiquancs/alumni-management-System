<?php
/**
 * Created by Duoctv
 * Date 7/25/2018
 * Time 5:00 pm
 */

namespace App\Models;

use Auth;

class JobUser extends AppModel
{
    const JOB = 1;
    const UN_JOB = 2;

    public static $job = [
        self::JOB => 'Có',
        self::UN_JOB => 'Không',
    ];

    protected $table = 'job_users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'job',
        'name_job',
        'roll_job_id',
        'type_company_id',
        'traning',
        'introduce_source',
        'time_have_job',
        'salary_id',
        'job_business',
        'created_id',
        'updated_id',
        'deleted_id'];

    public static function updateJobUser($data, $userId)
    {
        dd($data->toArray());
        if($data['job']==self::UN_JOB){
            $job = array('job' => self::UN_JOB);
            $getIdJob = self::create($job)->pluck('id')->first();
        }
        if($data['job']==self::JOB){
            $job = array(
                'job' => self::JOB,
                'name_job' => $data['name_job'],
            );
            $getIdJob = self::create($job)->pluck('id')->first();
        }
        User::where('id',$userId)->update(['job_id' => $getIdJob]);
    }

    public static function getJobInfoUsers($jobIdUser){
        return self::where('id',$jobIdUser)->first();
    }

    public static function checkCreateSurvey($data){
        $errors = array();
        if($data['name_job']==NULL){
            $errors['name_job'] = 'Bạn chưa điền tên công việc của bạn';
        }
        if(!@$data['time_have_job']){
            $errors['time_have_job'] = 'Bạn chưa chọn trường này';
        }
        if($data['time_have_job']==5&&$data['time_have_job_else']==NUll){
            $errors['time_have_job'] = 'Bạn chưa điền thời gian khác';
        }
        if(!@$data['type_company']){
            $errors['type_company'] = 'Bạn chưa chọn trường này';
        }
        if($data['type_company']==1&&!@$data['agencies']){
            $errors['type_company'] = 'Bạn chưa chọn Loại hình cơ quan Nhà nước';
        }
        if($data['type_company']==2&&!@$data['enterprise']){
            $errors['type_company'] = 'Bạn chưa chọn Cơ quan/Doanh nghiệp';
        }
        if($data['type_company']==3&&!@$data['non_organizations']){
            $errors['type_company'] = 'Bạn chưa chọn Tổ chức phi chính phủ';
        }
        if($data['type_company']==4&&$data['type_company_else']==NUll){
            $errors['type_company'] = 'Bạn chưa điền loại hình khác';
        }
        if(!@$data['roll_job']){
            $errors['roll_job'] = 'Bạn chưa chọn trường này';
        }
        if($data['roll_job']==5&&$data['roll_job_else']==NUll){
            $errors['roll_job'] = 'Bạn chưa điền vị trí khác';
        }
        return $errors;
    }

    public static function getOpesDetail()
    {
        return self::with('opesStaff.staff')->get();
    }

    public static function showOpesDetail($idOpesStaff)
    {
        if (empty($idOpesStaff)) {
            return [];
        }

        $opesStaff = OpesStaff::select('staffs.rank_id')
            ->where('opes_staffs.id', $idOpesStaff)
            ->join('staffs', 'staffs.id', '=', 'opes_staffs.staff_id')
            ->first();
        if (empty($opesStaff)) {
            return [];
        }

        $opesStaff = $opesStaff->toArray();
        $arrSelectField = [
            'id',
            'evaluation_criteria_id',
            'opes_staff_id',
            'title',
            'content',
            'percents',
            's', 'a', 'b',
            'c', 'd',
            'mark',
            'note_for_reviewer',
            'note_for_creater'
        ];

        $listEval = EvaluationCriteria::where('rank_id', $opesStaff['rank_id'])
            ->pluck('name', 'id')
            ->toArray();
        $opesDetail = self::select($arrSelectField)
            ->where('opes_staff_id', $idOpesStaff)
            ->with(['evaluationCriteria' => function ($q) {
                $q->select('id',
                    'rank_id',
                    'name',
                    'comment',
                    'total_percents');
            }])
            ->get()
            ->toArray();

        $opesDetailGroup = [];
        if (!empty($opesDetail)) {
            foreach ($opesDetail as $item) {
                $opesDetailGroup[$item['evaluation_criteria_id']]['eval'] = @$item['evaluation_criteria']['name'];
                $opesDetailGroup[$item['evaluation_criteria_id']]['items'][] = $item;
            }
        }
        foreach ($listEval as $key => $value) {
            $listEval[$key] = isset($opesDetailGroup[$key]) ? $opesDetailGroup[$key] : ['eval' => $value, 'items' => []];
        }
        return $listEval;

    }

    public static function createNewOpes($data, $opesStaffId, $staff_id)
    {
        $evaluationFollowStaffId = Staff::getListEvaluationFollowStaffId($staff_id);
        foreach ($evaluationFollowStaffId as $key => $value) {
            $listIdEvaluationFollowStaffId[] = $value['id'];
        }
        $getOpesSave = self::where('opes_staff_id', '=', $opesStaffId)
            ->get()->toArray();
        if (empty($getOpesSave)) {
            foreach ($data['opes'] as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    self::createOpes($listIdEvaluationFollowStaffId[$key], $opesStaffId, $value1, self::MARK_NULL, NULL, NULL);
                }
            }
        } else {
            self::where('opes_staff_id', '=', $opesStaffId)->delete();
            if (isset($data['status'])) {
                if ($data['status'] == OpesStaff::STATUS_UPDATE_REVIEW_COMMENT) {
                    foreach ($data['opes'] as $key => $value) {
                        foreach ($value as $value1) {
                            self::createOpes($listIdEvaluationFollowStaffId[$key], $opesStaffId, $value1, self::MARK_NULL, $value1['note_for_reviewer'], $value1['note_for_creater']);
                        }
                    }
                } elseif ($data['status'] == OpesStaff::STATUS_CREATE_NEW_OPES) {
                    foreach ($data['opes'] as $key => $value) {
                        foreach ($value as $key1 => $value1) {
                            self::createOpes($listIdEvaluationFollowStaffId[$key], $opesStaffId, $value1, self::MARK_NULL, NULL, NULL);
                        }
                    }
                }
            } else {
                foreach ($data['opes'] as $key => $value) {
                    foreach ($value as $key1 => $value1) {
                        self::createOpes($listIdEvaluationFollowStaffId[$key], $opesStaffId, $value1, self::MARK_NULL, NULL, NULL);
                    }
                }
            }
        }
    }

    public static function updateCommentFromRefer($data, $idOpesStaff)
    {
        $i = 0;
        $listIdOpesDetail = self::where('opes_staff_id', '=', $idOpesStaff)->pluck('id');
        foreach ($data['opes'] as $key => $value) {
            foreach ($value as $key1 => $value1) {
                self::where('id', $listIdOpesDetail[$i++])->update(['note_for_creater' => $value1['note_for_creater']]);
            }
        }
    }

    public static function evaluaIssetCheck(array $data)
    {
        $countEvalua = EvaluationCriteria::countEvaluaWithOneRank(Staff::getRankId(Auth::id()));
        $errorsIssetEvalua = array();
        for ($i = 0; $i < $countEvalua; $i++) {
            if (!isset($data['opes'][$i])) {
                $errorsIssetEvalua[$i] = 'Chưa có bất kỳ dữ liệu nào cho tiêu chí này';
            }
        }
        if (empty($errorsIssetEvalua)) {
            return 0;
        }
        return $errorsIssetEvalua;
    }

    public static function evaluaNullCheck(array $data)
    {
        // dd($data['opes']);
        $errorsNullEvalua = array();
        foreach ($data['opes'] as $key => $value) {
            foreach ($value as $key1 => $value1) {
                foreach ($value1 as $key2 => $value2) {
                    if ($key2 == 'note_for_reviewer' || $key2 == 'note_for_creater') {
                        continue;
                    } else {
                        if ($value2 == NULL)
                            $errorsNullEvalua[$key] = 'Chưa nhập đủ dữ liệu cho một dòng';
                    }
                }
            }
        }
        if (empty($errorsNullEvalua)) {
            return 0;
        }
        return $errorsNullEvalua;
    }

    public static function totalPercentsCheck(array $data, array $data1)
    {
        $errors = array();
        $countTotalPercents = array();
        foreach ($data['opes'] as $key => $value) {
            foreach ($value as $key1 => $value1) {
                if (!isset($countTotalPercents[$key])) {
                    $countTotalPercents[$key] = $value1['percents'];
                } else {
                    $countTotalPercents[$key] += $value1['percents'];
                }
            }
        }
        foreach ($countTotalPercents as $key => $value) {
            if ($value < $data1[$key]['total_percents']) {
                $errors[$key] = 'Tổng trọng số chưa đủ ' . $data1[$key]['total_percents'] . '%';
            } elseif ($value > $data1[$key]['total_percents']) {
                $errors[$key] = 'Tổng trọng số vượt quá ' . $data1[$key]['total_percents'] . '%';
            }
        }
        if (empty($errors)) {
            return 0;
        } else {
            return $errors;
        }
    }

    public static function createOpes($evaluationCriteriaId, $opesStaffId, array $data, $mark, $noteForReviewer, $noteForCreater){
        $oneTitleOneEvaluaStaffId = array(
            'evaluation_criteria_id' => $evaluationCriteriaId,
            'opes_staff_id' => $opesStaffId,
            'title' => $data['Title'],
            'content' => $data['Content'],
            'percents' => $data['percents'],
            's' => $data['s'],
            'a' => $data['a'],
            'b' => $data['b'],
            'c' => $data['c'],
            'd' => $data['d'],
            'note_for_reviewer' => $noteForReviewer,
            'note_for_creater' => $noteForCreater,
            'mark' => $mark);
        OpesDetail::create($oneTitleOneEvaluaStaffId);
    }

    public function opesStaff()
    {
        return $this->belongsTo(OpesStaff::class, 'opes_staff_id', 'id');
    }

    public function evaluationCriteria()
    {
        return $this->belongsTo(EvaluationCriteria::class, 'evaluation_criteria_id', 'id');
    }
}

