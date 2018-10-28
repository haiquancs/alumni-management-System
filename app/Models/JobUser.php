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

    const TIME_JOB1 = 1;
    const TIME_JOB2 = 2;
    const TIME_JOB3 = 3;
    const TIME_JOB4 = 4;
    const TIME_JOB5 = 5;

    const INTRODUCE_SOURCE1 = 1;
    const INTRODUCE_SOURCE2 = 2;

    public static $job = [
        self::JOB => 'Có',
        self::UN_JOB => 'Không',
    ];

    public static $timeHaveJob = [
        self::TIME_JOB1 => 'Có việc làm ngay',
        self::TIME_JOB2 => 'Sau 1-6 tháng',
        self::TIME_JOB3 => 'Sau 6-12 tháng',
        self::TIME_JOB4 => 'Sau 12 tháng',
        self::TIME_JOB5 => 'Hơn 12 tháng',
    ];

    public static $introduceSource = [
        self::INTRODUCE_SOURCE1 => 'Quảng cáo việc làm',
        self::INTRODUCE_SOURCE2 => 'Bạn bè, người quen giới thiệu',
    ];

    protected $table = 'job_users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'job',
        'name_job',
        'roll_job_id',
        'type_company_detail_id',
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
//        dd($data['time_have_job']);
//        $getIdTypeCompany = TypeCompany::select('id')->get();
//        dd($getIdTypeCompany->toArray());
        if ($data['job'] == self::UN_JOB) {
            $job = array('job' => self::UN_JOB);
            $getIdJob = self::create($job)->id;
        }
        if ($data['job'] == self::JOB) {
            $job = array(
                'job' => self::JOB,
                'name_job' => $data['name_job'],
            );
//            Tiếp tục các trường
            if ($data['time_have_job'] == self::TIME_JOB5) {
                $job['time_have_job'] = $data['time_have_job_else'];
            } else {
                $job['time_have_job'] = $data['time_have_job'];
            }
            if(empty(TypeCompany::where('id',$data['type_company'])->get()->toArray())){
                $getIdNewTypeCompany = TypeCompany::create(array('type'=>$data['type_company_else']))->id;
                $getIdNewTypeDetailCompany = TypeDetailCompany::create(array('type_company_id'=>$getIdNewTypeCompany))->id;
                $job['type_company_detail_id'] = $getIdNewTypeDetailCompany;
            }elseif($data['type_company']==1){
                $job['type_company_detail_id'] = $data['agencies'];
            }elseif($data['type_company']==2){
                $job['type_company_detail_id'] = $data['enterprise'];
            }elseif($data['type_company']==3){
                $job['type_company_detail_id'] = $data['non_organizations'];
            }
            if(empty(RollJob::where('id',$data['roll_job'])->get()->toArray())){
                $getIdNewRollJob = RollJob::create(array('roll'=>$data['roll_job_else']))->id;
                $job['roll_job_id'] = $getIdNewRollJob;
            }else{
                $job['roll_job_id'] = $data['roll_job'];
            }
            if(@$data['introduce_source']){
                $job['introduce_source'] = $data['introduce_source'];
            }
            if(@$data['salary']){
                $job['salary_id'] = $data['salary'];
            }
            if(@$data['traning']){
                $job['traning'] = implode(",", $data['traning']);
            }
            $getIdJob = self::create($job)->id;
        }
        User::where('id', $userId)->update(['job_id' => $getIdJob]);
    }

    public static function getJobInfoUsers($jobIdUser)
    {
        return self::where('id', $jobIdUser)
            ->with(['typeDetailCompany' => function ($query){
                $query->with(['typeCompany']);
            }])->with(['rollJob'])->with(['salary'])->first();
    }

    public static function checkCreateSurvey($data)
    {
        $errors = array();
        if ($data['name_job'] == NULL) {
            $errors['name_job'] = 'Bạn chưa điền tên công việc của bạn';
        }
        if (!@$data['time_have_job']) {
            $errors['time_have_job'] = 'Bạn chưa chọn trường này';
        }
        if (!@$data['type_company']) {
            $errors['type_company'] = 'Bạn chưa chọn trường này';
        }
        if ($data['type_company'] == 1 && !@$data['agencies']) {
            $errors['type_company'] = 'Bạn chưa chọn Loại hình cơ quan Nhà nước';
        }
        if ($data['type_company'] == 2 && !@$data['enterprise']) {
            $errors['type_company'] = 'Bạn chưa chọn Cơ quan/Doanh nghiệp';
        }
        if ($data['type_company'] == 3 && !@$data['non_organizations']) {
            $errors['type_company'] = 'Bạn chưa chọn Tổ chức phi chính phủ';
        }
        if ($data['type_company'] == 9999999999999999999 && $data['type_company_else'] == NUll) {
            $errors['type_company'] = 'Bạn chưa điền loại hình khác';
        }
        if (!@$data['roll_job']) {
            $errors['roll_job'] = 'Bạn chưa chọn trường này';
        }
        if ($data['roll_job'] == 99999999999999 && $data['roll_job_else'] == NUll) {
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

    public static function createOpes($evaluationCriteriaId, $opesStaffId, array $data, $mark, $noteForReviewer, $noteForCreater)
    {
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

    public function typeDetailCompany(){
        return $this->belongsTo(TypeDetailCompany::class, 'type_company_detail_id', 'id');
    }

    public function rollJob(){
        return $this->belongsTo(RollJob::class, 'roll_job_id', 'id');
    }

    public function salary(){
        return $this->belongsTo(Salary::class, 'salary_id', 'id');
    }
}

