<?php
namespace app\common\model;
use think\Model;

class AttendanceModel extends Model {
    /*关联表名*/
    protected $table  = 't_attendance';
    /*每页显示记录数目*/
    public $rows = 8;
    /*保存查询后总的页数*/
    public $totalPage;
    /*保存查询到的总记录数*/
    public $recordNumber;

    public function setRows($rows) {
        $this->rows = $rows;
    }

    //学生复合属性的获取: 多对一关系
    public function studentObjF(){
        return $this->belongsTo('StudentModel','studentObj');
    }

    //课程复合属性的获取: 多对一关系
    public function courseObjF(){
        return $this->belongsTo('CourseModel','courseObj');
    }

    //时间复合属性的获取: 多对一关系
    public function timeInfoObjF(){
        return $this->belongsTo('TimeInfoModel','timeInfoObj');
    }

    //状态复合属性的获取: 多对一关系
    public function attendanceStateObjF(){
        return $this->belongsTo('AttendanceStateModel','attendanceStateObj');
    }

    /*添加学生点名记录*/
    public function addAttendance($attendance) {
        $this->insert($attendance);
    }

    /*更新学生点名记录*/
    public function updateAttendance($attendance) {
        $this->update($attendance);
    }

    /*删除多条学生点名信息*/
    public function deleteAttendances($attendanceIds){
        $attendanceIdArray = explode(",",$attendanceIds);
        foreach ($attendanceIdArray as $attendanceId) {
            $this->attendanceId = $attendanceId;
            $this->delete();
        }
        return count($attendanceIdArray);
    }
    /*根据主键获取学生点名记录*/
    public function getAttendance($attendanceId) {
        $attendance = AttendanceModel::where("attendanceId",$attendanceId)->find();
        return $attendance;
    }

    /*按照查询条件分页查询学生点名信息*/
    public function queryAttendance($studentObj, $courseObj, $timeInfoObj, $attendanceStateObj, $currentPage) {
        $startIndex = ($currentPage-1) * $this->rows;
        $where = null;
        if($studentObj['studentNumber'] != 0) $where['studentObj'] = $studentObj['studentNumber'];
        if($courseObj['courseNo'] != 0) $where['courseObj'] = $courseObj['courseNo'];
        if($timeInfoObj['timeInfoId'] != 0) $where['timeInfoObj'] = $timeInfoObj['timeInfoId'];
        if($attendanceStateObj['stateId'] != 0) $where['attendanceStateObj'] = $attendanceStateObj['stateId'];
        $attendanceRs = AttendanceModel::where($where)->limit($startIndex,$this->rows)->select();
        /*计算总的页数和总的记录数*/
        $this->recordNumber = AttendanceModel::where($where)->count();
        $mod = $this->recordNumber % $this->rows;
        $this->totalPage = (int)($this->recordNumber / $this->rows);
        if($mod != 0) $this->totalPage++;
        return $attendanceRs;
    }

    /*按照查询条件查询所有学生点名记录*/
  public function queryOutputAttendance( $studentObj,  $courseObj,  $timeInfoObj,  $attendanceStateObj) {
        $where = null;
        if($studentObj['studentNumber'] != 0) $where['studentObj'] = $studentObj['studentNumber'];
        if($courseObj['courseNo'] != 0) $where['courseObj'] = $courseObj['courseNo'];
        if($timeInfoObj['timeInfoId'] != 0) $where['timeInfoObj'] = $timeInfoObj['timeInfoId'];
        if($attendanceStateObj['stateId'] != 0) $where['attendanceStateObj'] = $attendanceStateObj['stateId'];
        $attendanceRs = AttendanceModel::where($where)->select();
        return $attendanceRs;
    }

    /*查询所有学生点名记录*/
    public function queryAllAttendance(){
        $attendanceRs = AttendanceModel::where(null)->select();
        return $attendanceRs;

    }

}
