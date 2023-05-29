<?php
namespace app\front\controller;
use think\Request;
use think\Exception;
use app\common\model\TimeInfoModel;

class TimeInfo extends Base {
    protected $timeInfoModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->timeInfoModel = new TimeInfoModel();
    }

    /*添加学时信息信息*/
    public function frontAdd(){
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
            return $this->fetch('timeInfo/timeInfo_frontAdd');
        }
    }

    /*前台修改学时信息信息*/
    public function frontModify() {
        $this->assign("timeInfoId",input("timeInfoId"));
        return $this->fetch("timeInfo/timeInfo_frontModify");
    }

    /*前台按照查询条件分页查询学时信息信息*/
    public function frontlist() {
        if($this->request->param("currentPage") != null)
            $this->currentPage = $this->request->param("currentPage");
        $timeInfoRs = $this->timeInfoModel->queryTimeInfo($this->currentPage);
        $this->assign("timeInfoRs",$timeInfoRs);
        /*获取到总的页码数目*/
        $this->assign("totalPage",$this->timeInfoModel->totalPage);
        /*当前查询条件下总记录数*/
        $this->assign("recordNumber",$this->timeInfoModel->recordNumber);
        $this->assign("currentPage",$this->currentPage);
        $this->assign("rows",$this->timeInfoModel->rows);
        return $this->fetch('timeInfo/timeInfo_frontlist');
    }

    /*ajax方式查询学时信息信息*/
    public function listAll() {
        $timeInfoRs = $this->timeInfoModel->queryAllTimeInfo();
        echo json_encode($timeInfoRs);
    }
    /*前台查询根据主键查询一条学时信息信息*/
    public function frontshow() {
        $timeInfoId = input("timeInfoId");
        $timeInfo = $this->timeInfoModel->getTimeInfo($timeInfoId);
       $this->assign("timeInfo",$timeInfo);
        return $this->fetch("timeInfo/timeInfo_frontshow");
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

}

