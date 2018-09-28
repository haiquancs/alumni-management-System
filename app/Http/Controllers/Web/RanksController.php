<?php
/**
 * Created by PhpStorm.
 * User: Lenh Ho Xung
 * Date: 7/27/2018
 * Time: 1:36 PM
 */

namespace App\Http\Controllers\Web;


use Illuminate\Http\Request;
use App\Models\Rank;

class RanksController extends AppController
{
    protected $dirView = 'Web.Rank.';

    public function index(Request $request)
    {
        $ranks = Rank::getRank();
        return view($this->dirView . 'index', compact('ranks'));
    }
    public function store(Request $request)
    {
        $error = Rank::uniqueCreateCheck($request->all());
        if($error)
        {
            return view($this->dirView . 'create', compact('error'));
        }
        else
        {
            $ranks = Rank::createRank($request->all());
            return redirect()->route('web.ranks.index');
        }
    }
    public function create(){
        return view($this->dirView . 'create');
    }
    public function edit($id)
    {
        $ranks = Rank::find($id);
        return view($this->dirView . 'edit', compact('ranks'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $error = Rank::uniqueEditCheck($request, $id);
        if($error)
        {
            $ranks = Rank::find($id);
            return json_encode(['status' => false, 'data' => $error]);
        }

        Rank::updateRank($request->all(), $id);
        return json_encode(['status' => true, 'data' => $data]);
}
    public function destroy($id)
    {
        $ranks = Rank::find($id);
        $countRank = Rank::destroyRank($id);
        if ($countRank){
            $ranks->delete();
        } else{
            $rank = Rank::where('id', $id)->select('rank')->first();
            flash('Rank ' . $rank->rank . ' đang có nhân viên!')->error();
        }
        return redirect()->route('web.ranks.index');
    }
}