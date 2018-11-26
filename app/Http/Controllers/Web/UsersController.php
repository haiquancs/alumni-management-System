<?php
/**
 * Created by PhpStorm.
 * User: Lenh Ho Xung
 * Date: 7/10/2018
 * Time: 5:25 PM
 */

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Log;
use App\Models\Business;
use App\Models\Grade;
use App\Models\Rank;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Excel;
use Validator;
use Auth;
use Illuminate\Http\Response;


class UsersController extends AppController
{
    private $dirView = 'Web.User.';
    protected $staff;
    protected $statusLog;

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $users = User::getUser($request);
        $business = Business::all();
        return view($this->dirView . 'index', compact('users','business'))->with('dataSearch', $request->all());
    }

    public function create()
    {
        User::createUser();
    }

    public function store(StaffRequest $request)
    {
        try {
            dd($request->all());
            $staffs = Staff::createStaff($request->all());
        } catch (\Exception $e) {
            abort(500);
        }

        return redirect()->route('web.staffs.index');
    }
    public function show($userId)
    {
        $staff = Staff::showStaff($id);
        $reference_staff_id = Staff::where('id', $id)->select('reference_staff_id')->get()->toArray();
        $getName = Staff::where('id', $reference_staff_id)->select('id', 'first_name', 'last_name', 'full_name')->get()->toArray();
        return view($this->dirView . 'show', compact('staff', 'getName'));
    }

    public function edit($userId)
    {
        $user = User::showUser($userId);
        $business = Business::all();
        return view($this->dirView . 'edit', compact('user','business'));
    }

    public function update(UserRequest $request, $userId)
    {
        User::updateUser($request, $userId);
        return redirect()->route('web.surveys.index');
    }

    public function exportUser(){
        $users = User::select()->with(['business' => function ($qr) {
                $qr->select('id', 'business');
            }])->orderBy('code')->get();
        Excel::create('DS-sinh-vien', function ($excel) use ($users){
            $excel->sheet('Sheet 1', function ($sheet) use ($users){
                $sheet->loadview($this->dirView. 'exportUser', compact('users'));
            });
        })->export('xlsx');
    }
    public function destroy($id)
    {
        try {
            $staff = Staff::find($id);
            if ($staff == NULL) {
                abort(404);
            }
        } catch (\Exception $e) {
            abort(500);
        }
        $staff->delete();
        return redirect()->route('web.staffs.index');
    }

    public function changePassword(Request $request)
    {
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_new_password' => 'required',
        ];
        $messages = [
            'old_password.required' => 'Chưa điền mật khẩu cũ',
            'new_password.required' => 'Chưa điền mật khẩu mới',
            'confirm_new_password.required' => 'Chưa nhập lại mật khẩu mới',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return json_encode(['status' => false, 'message' => $validator->errors()->all(), 'data' => [], 'required' => false]);
        }
        $old = $request->input('old_password');
        $new = $request->input('new_password');
        $confirm = $request->input('confirm_new_password');
        $user = Auth::user();
        if (!Hash::check($old, $user->password)) {
            return json_encode(['status' => false, 'message' => ['old_password' => 'Mật khẩu cũ không đúng', 'confirm_new_password' => false], 'data' => [], 'required' => true]);
        }
        if ($new !== $confirm) {
            return json_encode(['status' => false, 'message' => ['old_password' => false, 'confirm_new_password' => 'Mật khẩu nhập lại không khớp'], 'data' => [], 'required' => true]);
        }
        //change pass
        $user->fill(['password' => Hash::make($new)]);
        $user->save();
        return json_encode(['status' => true, 'message' => ['Đổi mật khẩu thành công'], 'data' => route('web.auth.logout')]);
    }

}