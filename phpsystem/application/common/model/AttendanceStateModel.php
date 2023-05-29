<?php
namespace app\common\model;
use think\Model;

class AttendanceStateModel extends Model {
    /*关联表名*/
    protected $table  = 't_attendanceState';
    /*每页显示记录数目*/
    public $rows = 8;
    /*保存查询后总的页数*/
    public $totalPage;
    /*保存查询到的总记录数*/
    public $recordNumber;

    public function setRows($rows) {
        $this->rows = $rows;
    }

    /*添加出勤状态记录*/
    public function addAttendanceState($attendanceState) {
        $this->insert($attendanceState);
    }

    /*更新出勤状态记录*/
    public function updateAttendanceState($attendanceState) {
        $this->update($attendanceState);
    }

    /*删除多条出勤状态信息*/
    public function deleteAttendanceStates($stateIds){
        $stateIdArray = explode(",",$stateIds);
        foreach ($stateIdArray as $stateId) {
            $this->stateId = $stateId;
            $this->delete();
        }
        return count($stateIdArray);
    }
    /*根据主键获取出勤状态记录*/
    public function getAttendanceState($stateId) {
        $attendanceState = AttendanceStateModel::where("stateId",$stateId)->find();
        return $attendanceState;
    }

    /*按照查询条件分页查询出勤状态信息*/
    public function queryAttendanceState($currentPage) {
        $startIndex = ($currentPage-1) * $this->rows;
        $where = null;
        $attendanceStateRs = AttendanceStateModel::where($where)->limit($startIndex,$this->rows)->select();
        /*计算总的页数和总的记录数*/
        $this->recordNumber = AttendanceStateModel::where($where)->count();
        $mod = $this->recordNumber % $this->rows;
        $this->totalPage = (int)($this->recordNumber / $this->rows);
        if($mod != 0) $this->totalPage++;
        return $attendanceStateRs;
    }

    /*按照查询条件查询所有出勤状态记录*/
  public function queryOutputAttendanceState() {
        $where = null;
        $attendanceStateRs = AttendanceStateModel::where($where)->select();
        return $attendanceStateRs;
    }

    /*查询所有出勤状态记录*/
    public function queryAllAttendanceState(){
        $attendanceStateRs = AttendanceStateModel::where(null)->select();
        return $attendanceStateRs;

    }

}
