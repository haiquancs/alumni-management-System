<?php
/**
 * Created by Duoctv
 * Date 7/25/2018
 * Time 5:00 pm
 */

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Auth;
use Mail;
use App\Models\Staff;
use Carbon\Carbon;

class RequestStaffs extends AppModel

{

    const TYPE_REQUEST_CREATE_NEW = 1;
    const TYPE_REQUEST_WAITING = 2;
    const TYPE_REQUEST_EDIT = 3;
    const TYPE_REQUEST_RECREATE = 4;

    public static $type = [
        self::TYPE_REQUEST_CREATE_NEW => "TẠO MỚI OPES",
        self::TYPE_REQUEST_WAITING => "ĐANG CHỜ REVIEW",
        self::TYPE_REQUEST_EDIT => "CHỈNH SỬA OPES",
        self::TYPE_REQUEST_RECREATE => "TẠO LẠI OPES",
    ];

    const STATUS_NOT_COMPLETED = 1;
    const STATUS_COMPLETED = 2;

    public static $status = [
        self::STATUS_NOT_COMPLETED => "CHƯA GIẢI QUYẾT",
        self::STATUS_COMPLETED => "ĐÃ GIẢI QUYẾT",
    ];

    const NOTE_CREATE_OPES = 'Tôi đã tạo mới OPES';
    const NOTE_CREATE_OPES_DEFAULT = 'Bạn cần tạo mới OPES';
    const NOTE_UPDATE_OPES = 'Bản OPES này của bạn cần hoàn thiện đầy đủ';
    const NOTE_RE_UPDATE_OPES = 'Tôi đã update lại OPES';
    const NOTE_REJECTED_OPES = 'Bản OPES này đã từ chối, bạn cần tạo mới lại OPES';
    const NOTE_APPROVAL_OPES = 'Chúc mừng bạn, bản OPES của bạn đã được chấp nhận';


    protected $table = 'requests';
    protected $primaryKey = 'id';
    protected $fillable = ['opes_staff_id', 'request_staff_id1', 'request_staff_id2', 'type', 'status', 'note', 'created_id', 'updated_id', 'deleted_id'];

    public static function requestCounting($staffId)
    {
        $countRequest = self::where('status', self::STATUS_NOT_COMPLETED)
            ->where('request_staff_id2', $staffId)
            ->count();
        return $countRequest;
    }

    public static function getAllRequest()
    {
        $allRequest = self::where('status', self::STATUS_NOT_COMPLETED)
        ->with(['sendStaff' => function ($query) {
            $query->select('id', 'code', 'full_name as sendStaff');
        }])
            ->with(['receiveStaff' => function ($query) {
                $query->select('id', 'code', 'full_name as receiveStaff');
            }])
            ->paginate(10);
        return $allRequest;


    }

    public static function getListRequest($id = null)
    {
        if (empty($id)) {
            $id = Auth::id();
        }
        $listRequest = self::where('status', self::STATUS_NOT_COMPLETED)
            ->where(function ($query) use ($id) {
            $query->where('request_staff_id2', '=', $id)
                ->orwhere('request_staff_id1', '=', $id)
                ->orderBy('id', 'ASC');
        })
            ->with(['sendStaff' => function ($query) {
                $query->select('id', 'code', 'full_name as sStaff');
            }])
            ->with(['receiveStaff' => function ($query) {
                $query->select('id', 'code', 'full_name as rStaff');

            }])
            ->orderBy('requests.id', 'DESC')
            ->paginate(10);
        return $listRequest;
    }

    public static function getNameID($id)
    {
        $nameID = Staff::find($id);
        return $nameID;

    }

    public static function createRequest(array $data)
    {
        if (empty($data['request_note'])) {
            $data['request_note'] = self::NOTE_CREATE_OPES_DEFAULT;
        }
        foreach ($data['request_name'] as $value) {
            self::makeRequest(auth::id(), $value, $data['request_type'], self::STATUS_NOT_COMPLETED, $data['request_note'], NULL);
            RequestStaffs::makeNewEmail($data['request_note'],$value);
        }
    }

    public static function makeNewCreateOpesRequest($staffId, $opesStaffId, $note)
    {
        if (!isset($staffId)) {
            return dd('Tài khoản này đã bị xóa');
        }
        $reference_id = Staff::getReferId($staffId);
        self::makeRequest($staffId, $reference_id, self::TYPE_REQUEST_WAITING, self::STATUS_NOT_COMPLETED, $note, $opesStaffId);
        self::makeNewEmail($note,$reference_id);
    }

    public static function confirmSendToReview($idOpesStaff)
    {
        $staffId = OpesStaff::find($idOpesStaff);
        if (empty($staffId)) {
            return dd('Không tìm thấy bản opes để xác nhận yêu cầu chờ review');
        }
        self::confirmRequest($staffId->staff_id, Auth::id(), self::TYPE_REQUEST_WAITING);
    }

    public static function makeNewUpdateOpes($idOpesStaff)
    {
        $staffId = OpesStaff::find($idOpesStaff);
        if (empty($staffId)) {
            return dd('Không tìm thấy bản opes này để gửi yêu cầu Update');
        }
        self::makeRequest(Auth::id(), $staffId->staff_id, self::TYPE_REQUEST_EDIT, self::STATUS_NOT_COMPLETED, self::NOTE_UPDATE_OPES, NULL);
        self::makeNewEmail(self::NOTE_UPDATE_OPES,$staffId->staff_id);
    }

    public static function confirmUpdateOpes($idOpesStaff)
    {
        $staffId = OpesStaff::find($idOpesStaff);
        if (empty($staffId)) {
            return dd('Không tìm thấy bản opes này để xác nhận yêu cầu update');
        }
        $referendeThisStaffId = Staff::find($staffId->staff_id);
        if (empty($referendeThisStaffId)) {
            return dd('Không tìm thấy người gửi yêu cầu update này');
        }
        self::confirmRequest($referendeThisStaffId->reference_staff_id, $staffId->staff_id, self::TYPE_REQUEST_EDIT);
    }

    public static function requestCreateNewOpes($staffId)
    {
        if (!isset($staffId)) {
            return dd('Tài khoản này đã bị xóa');
        }
        self::makeRequest(Auth::id(), $staffId, self::TYPE_REQUEST_CREATE_NEW, self::STATUS_NOT_COMPLETED, self::NOTE_REJECTED_OPES, NULL);
        self::makeNewEmail(self::NOTE_REJECTED_OPES,$staffId);
    }

    public static function confirmRequestCreateNewOpes($staffId)
    {
        if (!isset($staffId)) {
            return dd('Tài khoản này đã bị xóa');
        }
        $chief_id = Staff::getReferId($staffId);
        $requestCreateNewOpes = self::where('request_staff_id1', $chief_id)
            ->where('request_staff_id2', Auth::user()->id)
            ->where('type', self::TYPE_REQUEST_CREATE_NEW)
            ->where('status', self::STATUS_NOT_COMPLETED);
        if (!empty($requestCreateNewOpes)) {
            self::confirmRequest($chief_id, Auth::id(), self::TYPE_REQUEST_CREATE_NEW);
        }
    }

    public static function makeNewEmail($content,$receiver){
        $receiverMail = Staff::getEmailStaffId($receiver);
        $info = [
            'sender' => Auth::user()->full_name,
            'senderDePartMent' => Staff::getDepartmentByStaffId(Auth::user()->id),
            'receiverName' => Staff::getNameStaffId($receiver),
            'content' => $content,
            'time' => Carbon::now()
        ];
        Mail::send('Web.Emails.blanks',$info, function($message)use($receiverMail){
            $message->from('noreply@talent.ominext.com');
            $message->to($receiverMail)->subject('OPES'); 
        });
    }

    public static function confirmRequest($sender, $receiver, $type){
        self::where('request_staff_id1', $sender)
            ->where('request_staff_id2', $receiver)
            ->where('type', $type)
            ->where('status', self::STATUS_NOT_COMPLETED)
            ->update(['status' => self::STATUS_COMPLETED]);
    }

    public static function makeRequest($sender, $receiver, $type, $status, $note, $opes_staff_id){
        $data = array(
            'opes_staff_id' => $opes_staff_id,
            'request_staff_id1' => $sender,
            'request_staff_id2' => $receiver,
            'type' => $type,
            'status' => $status,
            'note' => $note);
        self::create($data);
    }

    public function sendStaff()
    {
        return $this->hasOne('App\Models\Staff', 'id', 'request_staff_id1');
    }

    public function receiveStaff()
    {
        return $this->hasOne('App\Models\Staff', 'id', 'request_staff_id2');
    }
}