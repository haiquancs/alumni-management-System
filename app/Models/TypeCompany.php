<?php
/**
 * Created by Duoctv
 * Date 7/25/2018
 * Time 5:00 pm
 */
namespace App\Models;

class TypeCompany extends AppModel
{
    protected $table = 'type_companys';
    protected $primaryKey ='id';
    protected $fillable = ['type','created_id','updated_id','deleted_id'];

    public static function getTypeDetailFollowType(){
        return self::select('id','type')
        ->with(['typeDetailCompany'])
        ->get();
    }

    public static function getTypeCompany(){
        $ranks = self::select('id', 'rank')
            ->orderBy('rank', 'ASC')
            ->get();
        if (empty($ranks)){
            return [];
        }
        return $ranks;
    }

    public static function updateRank($request, $id){
        $rank = Rank::find($id);
        return $rank->update($request);
    }
    
    public static function createRank(array $data)
    {
        $rank = $data['newrank'];
        foreach ($rank as $value) {
            $data = array(
                'rank' => $value
            );
            Rank::create($data);
        }
    }

    public static function uniqueCreateCheck(array $data)
    {
        $rankAlreadyExist = self::select('rank')
                    ->where('deleted_at',NUll)
                    ->get()->toArray();
        foreach ($data['newrank'] as $value) {
            foreach ($rankAlreadyExist as $value1) {
                if($value==$value1['rank'])
                    return 'Rank đã tồn tại';
            }
        }
        return 0;
    }

    public static function uniqueEditCheck($data, $id)
    {
        $rankAlreadyExist = self::select('id', 'rank')
                    ->where('deleted_at',NUll)
                    ->where('id', '<>', $id)
                    ->get()->toArray();
//        dd($rankAlreadyExist);
        foreach ($rankAlreadyExist as $value) {
            if ($data['rank'] == $value['rank'])
                return 'Rank đã tồn tại';
        }
        return 0;
    }
    
    public static function getListRankWithEval(){
        $listRank = self::select('*')
        ->with(['evaluationCriteria'])
        ->get();
        return $listRank;
    }

    public static function getListRankNoEval($rowRankNull){
        $ranks = self::pluck('rank', 'id');
        foreach ($ranks as $key => $value) {
            foreach ($rowRankNull as $key1 => $value1) {
                if($value == $value1['ranks']['rank']){
                    unset($ranks[$key]);
                }         
            }
        }
        return $ranks;
    }

    public static function destroyRank($id){
        $rank = Staff::where('rank_id', $id)->count();
        if ($rank > 0){
            return false;
        }
        return true;
    }

    public function typeDetailCompany(){
        return $this->hasMany('App\Models\TypeDetailCompany', 'type_company_id', 'id');
    }
}