<?php
/**
 * Created by Duoctv
 * Date 7/25/2018
 * Time 5:00 pm
 */

namespace App\Models;

use App\Models\Rank;
use DB;

class Salary extends AppModel
{
    protected $table = 'salarys';
    protected $primaryKey = 'id';
    protected $fillable = ['salary', 'created_id', 'updated_id', 'deleted_id'];

    public function ranks()
    {
        return $this->belongsTo('App\Models\Rank', 'rank_id', 'id');
    }

    public static function createEvaluationCriteria(array $data)
    {
        $rank_id = $data['rank_id'];
        foreach ($data['evalua'] as $value) {
            $array = array(
                'rank_id' => $rank_id,
                'name' => $value['new_name'],
                'comment' => $value['new_comment'],
                'total_percents' => $value['new_total_percent']
            );
            self::create($array);
        }
    }

    public static function getRowRankNull()
    {
        return self::select('rank_id')
            ->whereNull('deleted_at')
            ->groupBy('rank_id')
            ->with(['ranks' => function ($query) {
                $query
                    ->select('id', 'rank');
            }])
            ->get()->toArray();
    }

    public static function idMaxEvaluation()
    {
        return DB::table('evaluation_criterias')->max('id');
    }

    public static function deleteRankEvaluation($max, $id)
    {
        for ($i = 1; $i <= $max; $i++) {
            $rankIdEvaluation = self::select('rank_id')->where('id', '=', $i)->get()->toArray();
            $a = isset($rankIdEvaluation[0]['rank_id']) ? $rankIdEvaluation[0]['rank_id'] : 0;
            if ($a == (int)$id) {
                $evaluationCriteria = self::find($i);
                $evaluationCriteria->delete();
            }
        }
    }

    public static function totalPercentsCheck(array $data)
    {
        $countTotalPercents = 0;
        foreach ($data['evalua'] as $value) {
            $countTotalPercents += $value['new_total_percent'];
        }
        if ($countTotalPercents < 100) {
            return 'Tổng trọng số chưa đủ 100%';
        } elseif ($countTotalPercents > 100) {
            return 'Tổng trọng số vượt quá 100%';
        }
        return 0;
    }
    public static function getListEval($evaluation,$status){
        return self::select('*')
            ->with(['opesDetail'=>function($q)use($status){
                $q->select('*')
                ->where('opes_staff_id',$status);
            }])
            ->find($evaluation)->opesDetail;
    }

    public static function countEvaluaWithOneRank($rankId){
        return self::where('rank_id',$rankId)->count();
    }

    public function opesDetail(){
        return $this->hasMany('App\Models\OpesDetail', 'evaluation_criteria_id', 'id');
    }
}