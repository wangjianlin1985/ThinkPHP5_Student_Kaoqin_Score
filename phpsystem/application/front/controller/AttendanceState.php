<?php
namespace app\front\controller;
use think\Request;
use think\Exception;
use app\common\model\AttendanceStateModel;

class AttendanceState extends Base {
    protected $attendanceStateModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->attendanceStateModel = new AttendanceStateModel();
    }

    /*添加出勤状态信息*/
    public function frontAdd(){
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $attendanceState = $this->getAttendanceStateForm(true);
            try {
                $this->attendanceStateModel->addAttendanceState($attendanceState);
                $message = "出勤状态添加成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "出勤状态添加失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            return $this->fetch('attendanceState/attendanceState_frontAdd');
        }
    }

    /*前台修改出勤状态信息*/
    public function frontModify() {
        $this->assign("stateId",input("stateId"));
        return $this->fetch("attendanceState/attendanceState_frontModify");
    }

    /*前台按照查询条件分页查询出勤状态信息*/
    public function frontlist() {
        if($this->request->param("currentPage") != null)
            $this->currentPage = $this->request->param("currentPage");
        $attendanceStateRs = $this->attendanceStateModel->queryAttendanceState($this->currentPage);
        $this->assign("attendanceStateRs",$attendanceStateRs);
        /*获取到总的页码数目*/
        $this->assign("totalPage",$this->attendanceStateModel->totalPage);
        /*当前查询条件下总记录数*/
        $this->assign("recordNumber",$this->attendanceStateModel->recordNumber);
        $this->assign("currentPage",$this->currentPage);
        $this->assign("rows",$this->attendanceStateModel->rows);
        return $this->fetch('attendanceState/attendanceState_frontlist');
    }

    /*ajax方式查询出勤状态信息*/
    public function listAll() {
        $attendanceStateRs = $this->attendanceStateModel->queryAllAttendanceState();
        echo json_encode($attendanceStateRs);
    }
    /*前台查询根据主键查询一条出勤状态信息*/
    public function frontshow() {
        $stateId = input("stateId");
        $attendanceState = $this->attendanceStateModel->getAttendanceState($stateId);
       $this->assign("attendanceState",$attendanceState);
        return $this->fetch("attendanceState/attendanceState_frontshow");
    }

    /*更新出勤状态信息*/
    public function update() {
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $attendanceState = $this->getAttendanceStateForm(false);
            try {
                $this->attendanceStateModel->updateAttendanceState($attendanceState);
                $message = "出勤状态更新成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "出勤状态更新失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            /*根据主键获取出勤状态对象*/
            $stateId = input("stateId");
            $attendanceState = $this->attendanceStateModel->getAttendanceState($stateId);
            echo json_encode($attendanceState);
        }
    }

    /*删除多条出勤状态记录*/
    public function deletes() {
        $message = "";
        $success = false;
        $stateIds = input("stateIds");
        try {
            $count = $this->attendanceStateModel->deleteAttendanceStates($stateIds);
            $success = true;
            $message = $count."条记录删除成功";
            $this->writeJsonResponse($success, $message);
        } catch (Exception $ex) {
            $message = "有记录存在外键约束,删除失败";
            $this->writeJsonResponse($success, $message);
        }
    }

}

