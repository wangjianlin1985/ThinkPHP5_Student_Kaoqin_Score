<?php
namespace app\back\controller;
use think\Request;
use think\Exception;
use app\common\model\AttendanceStateModel;

class AttendanceState extends BackBase {
    protected $attendanceStateModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->attendanceStateModel = new AttendanceStateModel();
    }

    /*添加出勤状态信息*/
    public function add(){
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
            return view('attendanceState/attendanceState_add');
        }
    }

    /*跳转到更新界面*/
    public function modifyView() {
        $this->assign("stateId",input("stateId"));
        return view("attendanceState/attendanceState_modify");
    }

    /*ajax方式按照查询条件分页查询出勤状态信息*/
    public function backList() {
        if($this->request->isPost()) {
            if($this->request->param("page") != null)
                $this->currentPage = $this->request->param("page");
            if($this->request->param("rows") != null)
                $this->attendanceStateModel->setRows($this->request->param("rows"));
            $attendanceStateRs = $this->attendanceStateModel->queryAttendanceState($this->currentPage);
            $expTableData = [];
            foreach($attendanceStateRs as $attendanceStateRow) {
                $expTableData[] = $attendanceStateRow;
            }
            $data["rows"] = $attendanceStateRs;
            /*当前查询条件下总记录数*/
            $data["total"] = $this->attendanceStateModel->recordNumber;
            echo json_encode($data);
        } else {
            return view("attendanceState/attendanceState_query");
        }
    }

    /*ajax方式查询出勤状态信息*/
    public function listAll() {
        $attendanceStateRs = $this->attendanceStateModel->queryAllAttendanceState();
        echo json_encode($attendanceStateRs);
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

    /*按照查询条件导出出勤状态信息到Excel*/
    public function outToExcel() {
        $attendanceStateRs = $this->attendanceStateModel->queryOutputAttendanceState();
        $expTableData = [];
        foreach($attendanceStateRs as $attendanceStateRow) {
            $expTableData[] = $attendanceStateRow;
        }
        $xlsName = "AttendanceState";
        $xlsCell = array(
            array('stateId','状态编号','string'),
            array('stateName','状态名称','string'),
        );//查出字段输出对应Excel对应的列名
        //公共方法调用
        $this->export_excel($xlsName,$xlsCell,$expTableData);
    }

}

