<?php
/**
 * Created by PhpStorm.
 * User: Lenh Ho Xung
 * Date: 7/27/2018
 * Time: 1:36 PM
 */

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\RequestStaffs;
use App\Models\Staff;
use App\Http\Requests\requestRequest;
use Auth;

class RequestsController extends AppController
{
    protected $dirView = 'Web.Request.';
    
    public function index()
    {
        $requestStaff = RequestStaffs::getListRequest();
        $allRequest = RequestStaffs::getAllRequest();
        return view($this->dirView . 'index', compact('requestStaff', 'allRequest'));
    }


    public function create(Request $request)
    {
        $staff = Auth::user();
        $staffs = Staff::getStaff($request);
        $referenceStaff = Staff::getStaffWithNoOpesByReference();
        $type = RequestStaffs::$type;
        $request = RequestStaffs::all();

        return view($this->dirView . 'create', compact('request', 'staffs', 'type', 'referenceStaff'))->with('staff', $staff);
    }

    public function destroy($id)
    {
        $request = RequestStaffs::find($id);
        $request->delete();
        return redirect()->route('web.request.index');
    }

    public function store(requestRequest $request)
    {
        $requests = RequestStaffs::createRequest($request->all());
        return redirect()->route('web.request.index');
    }

}