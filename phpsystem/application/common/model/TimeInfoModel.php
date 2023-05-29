<?php
namespace app\common\model;
use think\Model;

class TimeInfoModel extends Model {
    /*关联表名*/
    protected $table  = 't_timeInfo';
    /*每页显示记录数目*/
    public $rows = 8;
    /*保存查询后总的页数*/
    public $totalPage;
    /*保存查询到的总记录数*/
    public $recordNumber;

    public function setRows($rows) {
        $this->rows = $rows;
    }

    /*添加学时信息记录*/
    public function addTimeInfo($timeInfo) {
        $this->insert($timeInfo);
    }

    /*更新学时信息记录*/
    public function updateTimeInfo($timeInfo) {
        $this->update($timeInfo);
    }

    /*删除多条学时信息信息*/
    public function deleteTimeInfos($timeInfoIds){
        $timeInfoIdArray = explode(",",$timeInfoIds);
        foreach ($timeInfoIdArray as $timeInfoId) {
            $this->timeInfoId = $timeInfoId;
            $this->delete();
        }
        return count($timeInfoIdArray);
    }
    /*根据主键获取学时信息记录*/
    public function getTimeInfo($timeInfoId) {
        $timeInfo = TimeInfoModel::where("timeInfoId",$timeInfoId)->find();
        return $timeInfo;
    }

    /*按照查询条件分页查询学时信息信息*/
    public function queryTimeInfo($currentPage) {
        $startIndex = ($currentPage-1) * $this->rows;
        $where = null;
        $timeInfoRs = TimeInfoModel::where($where)->limit($startIndex,$this->rows)->select();
        /*计算总的页数和总的记录数*/
        $this->recordNumber = TimeInfoModel::where($where)->count();
        $mod = $this->recordNumber % $this->rows;
        $this->totalPage = (int)($this->recordNumber / $this->rows);
        if($mod != 0) $this->totalPage++;
        return $timeInfoRs;
    }

    /*按照查询条件查询所有学时信息记录*/
  public function queryOutputTimeInfo() {
        $where = null;
        $timeInfoRs = TimeInfoModel::where($where)->select();
        return $timeInfoRs;
    }

    /*查询所有学时信息记录*/
    public function queryAllTimeInfo(){
        $timeInfoRs = TimeInfoModel::where(null)->select();
        return $timeInfoRs;

    }

}
