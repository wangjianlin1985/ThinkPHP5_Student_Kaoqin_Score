<?php
namespace app\common\model;
use think\Model;

class TermInfoModel extends Model {
    /*关联表名*/
    protected $table  = 't_termInfo';
    /*每页显示记录数目*/
    public $rows = 8;
    /*保存查询后总的页数*/
    public $totalPage;
    /*保存查询到的总记录数*/
    public $recordNumber;

    public function setRows($rows) {
        $this->rows = $rows;
    }

    /*添加学期信息记录*/
    public function addTermInfo($termInfo) {
        $this->insert($termInfo);
    }

    /*更新学期信息记录*/
    public function updateTermInfo($termInfo) {
        $this->update($termInfo);
    }

    /*删除多条学期信息信息*/
    public function deleteTermInfos($termIds){
        $termIdArray = explode(",",$termIds);
        foreach ($termIdArray as $termId) {
            $this->termId = $termId;
            $this->delete();
        }
        return count($termIdArray);
    }
    /*根据主键获取学期信息记录*/
    public function getTermInfo($termId) {
        $termInfo = TermInfoModel::where("termId",$termId)->find();
        return $termInfo;
    }

    /*按照查询条件分页查询学期信息信息*/
    public function queryTermInfo($currentPage) {
        $startIndex = ($currentPage-1) * $this->rows;
        $where = null;
        $termInfoRs = TermInfoModel::where($where)->limit($startIndex,$this->rows)->select();
        /*计算总的页数和总的记录数*/
        $this->recordNumber = TermInfoModel::where($where)->count();
        $mod = $this->recordNumber % $this->rows;
        $this->totalPage = (int)($this->recordNumber / $this->rows);
        if($mod != 0) $this->totalPage++;
        return $termInfoRs;
    }

    /*按照查询条件查询所有学期信息记录*/
  public function queryOutputTermInfo() {
        $where = null;
        $termInfoRs = TermInfoModel::where($where)->select();
        return $termInfoRs;
    }

    /*查询所有学期信息记录*/
    public function queryAllTermInfo(){
        $termInfoRs = TermInfoModel::where(null)->select();
        return $termInfoRs;

    }

}
