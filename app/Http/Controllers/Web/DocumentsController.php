<?php
/**
 * Created by PhpStorm.
 * User: Lenh Ho Xung
 * Date: 7/27/2018
 * Time: 1:36 PM
 */

namespace App\Http\Controllers\Web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Auth;



class DocumentsController extends AppController
{
	protected $dirView = 'Web.Document.';


    public function index()
    {
        $path = public_path('upload');
        $listFile = array_diff(scandir($path), ['.', '..']);
        // dd($listFile);
        return view($this->dirView . 'index', compact('listFile'));
    }


        public function create(Request $request)
    {
        return view($this->dirView . 'create');

    }

    public function destroy($fileName)
    {
        $path = public_path('upload').'/'.$fileName;
        unlink($path);
        return redirect()->route('web.document.index');
        
    }

    public function store(Request $request)
    {
        $file = $request->filesTest; 
        $file->move('upload', $file->getClientOriginalName());
        return redirect()->route('web.document.index');
    }

    // public function doUpload(Request $request)
    // {
    //     $file = $request->filesTest;

    //     $file->move('upload', $file->getClientOriginalName());

    //     return view($this->dirView . 'create',compact('file'));



    //     //hàm sẽ trả về đường dẫn mới của file trên server
    // }

}