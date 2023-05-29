<?php
namespace app\back\controller;
use think\Request;
use think\Exception;
use app\common\model\TimeInfoModel;

class TimeInfo extends BackBase {
    protected $timeInfoModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->timeInfoModel = new TimeInfoModel();
    }

    /*添加学时信息信息*/
    public function add(){
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $timeInfo = $this->getTimeInfoForm(true);
            try {
                $this->timeInfoModel->addTimeInfo($timeInfo);
                $message = "学时信息添加成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "学时信息添加失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            return view('timeInfo/timeInfo_add');
        }
    }

    /*跳转到更新界面*/
    public function modifyView() {
        $this->assign("timeInfoId",input("timeInfoId"));
        return view("timeInfo/timeInfo_modify");
    }

    /*ajax方式按照查询条件分页查询学时信息信息*/
    public function backList() {
        if($this->request->isPost()) {
            if($this->request->param("page") != null)
                $this->currentPage = $this->request->param("page");
            if($this->request->param("rows") != null)
                $this->timeInfoModel->setRows($this->request->param("rows"));
            $timeInfoRs = $this->timeInfoModel->queryTimeInfo($this->currentPage);
            $expTableData = [];
            foreach($timeInfoRs as $timeInfoRow) {
                $expTableData[] = $timeInfoRow;
            }
            $data["rows"] = $timeInfoRs;
            /*当前查询条件下总记录数*/
            $data["total"] = $this->timeInfoModel->recordNumber;
            echo json_encode($data);
        } else {
            return view("timeInfo/timeInfo_query");
        }
    }

    /*ajax方式查询学时信息信息*/
    public function listAll() {
        $timeInfoRs = $this->timeInfoModel->queryAllTimeInfo();
        echo json_encode($timeInfoRs);
    }
    /*更新学时信息信息*/
    public function update() {
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $timeInfo = $this->getTimeInfoForm(false);
            try {
                $this->timeInfoModel->updateTimeInfo($timeInfo);
                $message = "学时信息更新成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "学时信息更新失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            /*根据主键获取学时信息对象*/
            $timeInfoId = input("timeInfoId");
            $timeInfo = $this->timeInfoModel->getTimeInfo($timeInfoId);
            echo json_encode($timeInfo);
        }
    }

    /*删除多条学时信息记录*/
    public function deletes() {
        $message = "";
        $success = false;
        $timeInfoIds = input("timeInfoIds");
        try {
            $count = $this->timeInfoModel->deleteTimeInfos($timeInfoIds);
            $success = true;
            $message = $count."条记录删除成功";
            $this->writeJsonResponse($success, $message);
        } catch (Exception $ex) {
            $message = "有记录存在外键约束,删除失败";
            $this->writeJsonResponse($success, $message);
        }
    }

    /*按照查询条件导出学时信息信息到Excel*/
    public function outToExcel() {
        $timeInfoRs = $this->timeInfoModel->queryOutputTimeInfo();
        $expTableData = [];
        foreach($timeInfoRs as $timeInfoRow) {
            $expTableData[] = $timeInfoRow;
        }
        $xlsName = "TimeInfo";
        $xlsCell = array(
            array('timeInfoId','记录编号','int'),
            array('timeInfoName','学时名称','string'),
        );//查出字段输出对应Excel对应的列名
        //公共方法调用
        $this->export_excel($xlsName,$xlsCell,$expTableData);
    }

}

