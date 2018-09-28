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
use App\Models\OpesDetail;
use App\Models\OpesStaff;
use App\Models\User;
use App\Models\Department;
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
        $users = User::showUser(Auth::id());
        return view($this->dirView . 'index',compact('users'));
    }

    public function create()
    {
        $users = User::showUser(Auth::id());
        if(!empty($users['job_id'])) abort(404);
        return view($this->dirView . 'create'); 
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

    

    public function store(Request $request)
    {
        // Check Opes không có bất kỳ dữ liệu gì
        if ($request['opes'] == NULL) dd('Không có dữ liệu Opes');
        //Lưu lại Opes chưa gửi
        if ($_POST['action'] == 'save') {
            if ($request['status'] == OpesStaff::STATUS_UPDATE_REVIEW_COMMENT) {
                $idOpesStaffSaveNewest = $request['id'];
                $checkOpesSave = 3;
            } else {
                $getIdOpesStaffSaveNewest = OpesStaff::saveAndCreateAndGetIdNewOpesStaff(OpesStaff::STATUS_CREATE_NEW_OPES, Auth::user()->id);
                $idOpesStaffSaveNewest = $getIdOpesStaffSaveNewest[0]['id'];
                $checkOpesSave = 1;
            }
            OpesDetail::createNewOpes($request, $idOpesStaffSaveNewest, Auth::user()->id);
            // Lưu lại đổi trạng thái và gửi đi
        } elseif ($_POST['action'] == 'create') {
            $countTitle = array();
            foreach ($request['opes'] as $key => $value) {
                $countTitle[$key] = count($value);
            }
            $mark = OpesDetail::$mark;
            // Check lỗi không có dữ liệu tiêu chí
            $errorsIssetEval = OpesDetail::evaluaIssetCheck($request->all());
            // Check dữ liệu để trống
            $errorsNullEval = OpesDetail::evaluaNullCheck($request->all());
            // Check lỗi trọng số
            $evaluationFollowStaffId = Staff::getListEvaluationFollowStaffId(Auth::user()->id);
            $error = OpesDetail::totalPercentsCheck($request->all(), $evaluationFollowStaffId);
            if ($error || $errorsIssetEval || $errorsNullEval) {
                if ($error == 0) {
                    if ($errorsIssetEval == 0) {
                        return view($this->dirView . 'create', compact('errorsNullEval', 'request', 'mark', 'evaluationFollowStaffId', 'countTitle'));
                    } elseif ($errorsNullEval == 0) {
                        return view($this->dirView . 'create', compact('errorsIssetEval', 'request', 'mark', 'evaluationFollowStaffId', 'countTitle'));
                    } else {
                        return view($this->dirView . 'create', compact('errorsNullEval', 'errorsIssetEval', 'request', 'mark', 'evaluationFollowStaffId', 'countTitle'));
                    }
                } elseif ($errorsIssetEval == 0) {
                    if ($errorsNullEval == 0) {
                        return view($this->dirView . 'create', compact('error', 'request', 'mark', 'evaluationFollowStaffId', 'countTitle'));
                    } else {
                        return view($this->dirView . 'create', compact('error', 'errorsNullEval', 'request', 'mark', 'evaluationFollowStaffId', 'countTitle'));
                    }
                } elseif ($errorsNullEval == 0) {
                    return view($this->dirView . 'create', compact('error', 'errorsIssetEval', 'request', 'mark', 'evaluationFollowStaffId', 'countTitle'));
                } else {
                    return view($this->dirView . 'create', compact('error', 'errorsIssetEval', 'errorsNullEval', 'request', 'mark', 'evaluationFollowStaffId', 'countTitle'));
                }
            } else {
                if ($request['status'] == OpesStaff::STATUS_UPDATE_REVIEW_COMMENT) {
                    $getIdOpesStaffCreateNewest = OpesStaff::saveAndCreateAndGetIdNewOpesStaff($request['status'], Auth::user()->id);
                    RequestStaffs::confirmUpdateOpes($request['id']);
                    RequestStaffs::makeNewCreateOpesRequest(Auth::user()->id,$getIdOpesStaffCreateNewest[0]['id'],RequestStaffs::NOTE_RE_UPDATE_OPES);
                    OpesDetail::createNewOpes($request, $getIdOpesStaffCreateNewest[0]['id'], Auth::user()->id);
                } else {
                    $getIdOpesStaffCreateNewest = OpesStaff::saveAndCreateAndGetIdNewOpesStaff(OpesStaff::STATUS_SEND_TO_REVIEW, Auth::user()->id);
                    RequestStaffs::confirmRequestCreateNewOpes(Auth::user()->id);
                    RequestStaffs::makeNewCreateOpesRequest(Auth::user()->id,$getIdOpesStaffCreateNewest[0]['id'],RequestStaffs::NOTE_CREATE_OPES);
                    OpesDetail::createNewOpes($request, $getIdOpesStaffCreateNewest[0]['id'], Auth::user()->id);
                }
                $checkOpesSave = 0;
            }
        }
        // Lấy danh sách opes của người đăng nhập
        $request = array();
        $myOpesStaffs = OpesStaff::getMyOpesStaff($request);
        $timeNow = OpesStaff::getTimeNow();
        // Lấy danh sách năm để tìm kiếm
        for ($i = 2013; $i <= Carbon::now()->year; $i++) {
            $years[] = $i;
        }
        Alert::success('Tạo Opes Thành Công');
        return view($this->dirView . 'index', compact('checkOpesSave', 'myOpesStaffs', 'timeNow','years'));
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