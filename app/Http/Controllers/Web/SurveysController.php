<?php
/**
 * Created by PhpStorm.
 * User: Lenh Ho Xung
 * Date: 7/27/2018
 * Time: 11:27 AM
 */

namespace App\Http\Controllers\Web;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\JobUser;
use App\Models\TypeCompany;
use App\Models\User;
use App\Models\Business;
use App\Models\RollJob;
use App\Models\Salary;
use Illuminate\Http\Request;
use App\Models\RequestStaffs;
use phpDocumentor\Reflection\DocBlock;
use Excel;
use Alert;

class SurveysController extends AppController
{
    protected $dirView = 'Web.Survey.';

    public function index()
    {
        $user = User::showUser(Auth::id());
        $jobInfoUsers = JobUser::getJobInfoUsers($user['job_id']);
        // dd($jobInfoUsers->toArray());
        return view($this->dirView . 'index',compact('user','jobInfoUsers'));
    }

    public function create()
    {
        $user = User::showUser(Auth::id());
        $typeDetailCompany = TypeCompany::getTypeDetailFollowType();
        $rollJob = RollJob::all();
        $salary = Salary::all();
        $business = Business::all();
        if(!empty($users['job_id'])) abort(404);
        return view($this->dirView . 'create', compact('user','business','typeDetailCompany','rollJob','salary')); 
    }   

    public function store(Request $request)
    {
        User::updateUser($request['info'], Auth::id());
        if($request['job']==JobUser::JOB){
            $error = JobUser::checkCreateSurvey($request);
            if(!empty($error)){
                $user = User::showUser(Auth::id());
                $typeDetailCompany = TypeCompany::getTypeDetailFollowType();
                $rollJob = RollJob::all();
                $salary = Salary::all();
                $business = Business::all();
                if(!empty($users['job_id'])) abort(404);
                return view($this->dirView . 'create', compact('user','business','typeDetailCompany','rollJob','salary','error','request')); 
            }
        }
        JobUser::updateJobUser($request, Auth::id());
        return redirect()->route('web.surveys.index');
    }

    // Màn index của nhân viên dưới quyền
    public function manageOpes(Request $request)
    {
        // Lấy danh sách năm để tìm kiếm
        for ($i = 2013; $i <= Carbon::now()->year; $i++) {
            $years[] = $i;
        }
        // Lấy danh sách opes của người dưới quyền
        $mySuborOpesStaffs = array();
        if (Auth::user()->role == Staff::ROLE_GM || Auth::user()->role == Staff::ROLE_BOM) {
            $mySuborOpesStaffs = Staff::getMySuborOpesStaff($request);
        }
        $timeNow = OpesStaff::getTimeNow();
        return view($this->dirView . 'index1', compact('mySuborOpesStaffs', 'timeNow', 'checkOpesSave', 'years'))
            ->with('dataSearch', $request->all());
    }

    // Màn index của tổng nhân viên
    public function opesStaff(Request $request)
    {
        // Lấy danh sách năm để tìm kiếm
        for ($i = 2013; $i <= Carbon::now()->year; $i++) {
            $years[] = $i;
        }
        // Lấy danh sách opes của toàn bộ nhân viên
        $departments = Department::orderBy('name')->pluck('name', 'id');
        $opesStaff = Department::getAllOpesStaffs($request);
        $timeNow = OpesStaff::getTimeNow();
        return view($this->dirView . 'index2', compact('opesStaff', 'timeNow', 'departments', 'years'))
            ->with('dataSearch', $request->all());
    }

    public function show($id)
    {
        $opesDetails = OpesDetail::showOpesDetail($id);
        $opesStaffs = OpesStaff::showOpesStaff($id);
        return view($this->dirView . 'show', compact('id', 'opesDetails', 'opesStaffs'));
    }

    public function update(Request $request, $idOpesStaff)
    {
        // Lưu lại comment
        if ($_POST['action'] == 'save') {
            OpesDetail::updateCommentFromRefer($request, $idOpesStaff);
        } // Xử lý Yêu cầu tạo mới & Gửi yêu cầu Update
        elseif ($_POST['action'] == 'ask') {
            OpesDetail::updateCommentFromRefer($request, $idOpesStaff);
            RequestStaffs::confirmSendToReview($idOpesStaff);
            RequestStaffs::makeNewUpdateOpes($idOpesStaff);
            OpesStaff::confirmUpdateStatus($idOpesStaff);
        }
        return $this->manageOpes($request);
    }

    public function edit($idOpesStaff)
    {
        $mark = OpesDetail::$mark;
        $evaluationFollowStaffId = Staff::getListEvaluationFollowStaffId(Auth::user()->id);
        $request = OpesStaff::getRequestOpesHaveToUpdate(Auth::user()->id);
        $countTitle = array();
        foreach ($request['opes'] as $key => $value) {
            $countTitle[$key] = count($value);
        }
        return view($this->dirView . 'create', compact('mark', 'evaluationFollowStaffId', 'request', 'countTitle'));
    }

    public function approval($idOpesStaff, $idStaff, Request $request)
    {
        OpesStaff::resolve($idOpesStaff, OpesStaff::STATUS_APPROVAL);
        RequestStaffs::confirmSendToReview($idOpesStaff);
        RequestStaffs::makeNewEmail(RequestStaffs::NOTE_APPROVAL_OPES,$idStaff);
        return $this->manageOpes($request);
    }

    public function rejected($idOpesStaff, $idStaff, Request $request)
    {
        OpesStaff::resolve($idOpesStaff, OpesStaff::STATUS_REJECTED);
        RequestStaffs::confirmSendToReview($idOpesStaff);
        RequestStaffs::requestCreateNewOpes($idStaff);
        return $this->manageOpes($request);
    }

    public function exportOpes($idOpesStaff)
    {
        $opesDetails = OpesDetail::showOpesDetail($idOpesStaff);
        $opesStaffs = OpesStaff::showOpesStaff($idOpesStaff);
        Excel::create('opes',function($excel)use($idOpesStaff, $opesDetails, $opesStaffs){
            $excel->sheet('sheet1',function($sheet1)use($idOpesStaff, $opesDetails, $opesStaffs){
                $sheet1->loadview($this->dirView . 'exportOpes',compact('idOpesStaff','opesDetails','opesStaffs'));
            });
        })->export('xlsx');
    }

    public function exportManageOpesStaff(Request $request){
        $mySuborOpesStaffs = Staff::getMySuborOpesStaff($request);
        Excel::create('DS opes', function ($excel) use ($mySuborOpesStaffs){
            $excel->sheet('Sheet1', function ($sheet) use ($mySuborOpesStaffs){
                $sheet->loadview($this->dirView . 'exportManageOpesStaff', compact('mySuborOpesStaffs'));
            });
        })->export('xlsx');
    }

    public function exportAllOpesStaff(Request $request){
        $allOpesStaff = Department::getAllOpesStaffs($request);
        Excel::create('DS opes nhân viên', function ($excel) use ($allOpesStaff){
            $excel->sheet('Sheet1', function ($sheet) use ($allOpesStaff){
                $sheet->loadview($this->dirView . 'exportAllOpesStaff', compact('allOpesStaff'));
            });
        })->export('xlsx');
    }

    public function destroy($idOpesStaff){
        $opesStaff = OpesStaff::find($idOpesStaff);
        $opesStaff->delete();
        return redirect()->route('web.opes.index');
    }
}