<?php
/**
 * Created by PhpStorm.
 * User: Lenh Ho Xung
 * Date: 7/27/2018
 * Time: 12:30 PM
 */

namespace App\Http\Controllers\Web;


use Illuminate\Http\Request;
use App\Models\EvaluationCriteria;
use App\Models\Rank;
use DB;

class EvaluationCriteriasController extends AppController
{
    protected $dirView = 'Web.EvaluationCriteria.';

    public function index(Request $request)
    {
        $listEvalFollowRank = Rank::getListRankWithEval();
        $rowRankNull = EvaluationCriteria::getRowRankNull();
        $ranks = Rank::getListRankNoEval($rowRankNull);
        return view($this->dirView . 'index', compact('listEvalFollowRank','ranks'));
    }

    public function show($id){
        $evalua = EvaluationCriteria::showOpesDetail($id);
        dd($evalua);
        return view($this->dirView . 'show', compact('evalua'));
    }

    public function destroy($id)
    {
        $idMaxEvaluation = EvaluationCriteria::idMaxEvaluation();
        EvaluationCriteria::deleteRankEvaluation($idMaxEvaluation,$id);
        return redirect()->route('web.evaluation-criterias.index');
    }
    
    public function create()
    {
        $rowRankNull = EvaluationCriteria::getRowRankNull();
        $ranks = Rank::getListRankNoEval($rowRankNull);
        return view($this->dirView . 'create',compact('ranks'));
    }

    public function store(Request $request)
    {
        $rowRankNull = EvaluationCriteria::getRowRankNull();
        $ranks = Rank::getListRankNoEval($rowRankNull);
        $count = count($request['evalua']);
        $error = EvaluationCriteria::totalPercentsCheck($request->all());
        if($error)
        {
            return view($this->dirView . 'create', compact('ranks','error','request','count'));
        }
        else
        {
            $EvaluationCriterias = EvaluationCriteria::createEvaluationCriteria($request->all());
            return redirect()->route('web.evaluation-criterias.index');
        }
    }
}