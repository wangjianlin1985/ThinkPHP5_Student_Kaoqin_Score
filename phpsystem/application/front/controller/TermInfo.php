<?php
namespace app\front\controller;
use think\Request;
use think\Exception;
use app\common\model\TermInfoModel;

class TermInfo extends Base {
    protected $termInfoModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->termInfoModel = new TermInfoModel();
    }

    /*添加学期信息信息*/
    public function frontAdd(){
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $termInfo = $this->getTermInfoForm(true);
            try {
                $this->termInfoModel->addTermInfo($termInfo);
                $message = "学期信息添加成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "学期信息添加失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            return $this->fetch('termInfo/termInfo_frontAdd');
        }
    }

    /*前台修改学期信息信息*/
    public function frontModify() {
        $this->assign("termId",input("termId"));
        return $this->fetch("termInfo/termInfo_frontModify");
    }

    /*前台按照查询条件分页查询学期信息信息*/
    public function frontlist() {
        if($this->request->param("currentPage") != null)
            $this->currentPage = $this->request->param("currentPage");
        $termInfoRs = $this->termInfoModel->queryTermInfo($this->currentPage);
        $this->assign("termInfoRs",$termInfoRs);
        /*获取到总的页码数目*/
        $this->assign("totalPage",$this->termInfoModel->totalPage);
        /*当前查询条件下总记录数*/
        $this->assign("recordNumber",$this->termInfoModel->recordNumber);
        $this->assign("currentPage",$this->currentPage);
        $this->assign("rows",$this->termInfoModel->rows);
        return $this->fetch('termInfo/termInfo_frontlist');
    }

    /*ajax方式查询学期信息信息*/
    public function listAll() {
        $termInfoRs = $this->termInfoModel->queryAllTermInfo();
        echo json_encode($termInfoRs);
    }
    /*前台查询根据主键查询一条学期信息信息*/
    public function frontshow() {
        $termId = input("termId");
        $termInfo = $this->termInfoModel->getTermInfo($termId);
       $this->assign("termInfo",$termInfo);
        return $this->fetch("termInfo/termInfo_frontshow");
    }

    /*更新学期信息信息*/
    public function update() {
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $termInfo = $this->getTermInfoForm(false);
            try {
                $this->termInfoModel->updateTermInfo($termInfo);
                $message = "学期信息更新成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "学期信息更新失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            /*根据主键获取学期信息对象*/
            $termId = input("termId");
            $termInfo = $this->termInfoModel->getTermInfo($termId);
            echo json_encode($termInfo);
        }
    }

    /*删除多条学期信息记录*/
    public function deletes() {
        $message = "";
        $success = false;
        $termIds = input("termIds");
        try {
            $count = $this->termInfoModel->deleteTermInfos($termIds);
            $success = true;
            $message = $count."条记录删除成功";
            $this->writeJsonResponse($success, $message);
        } catch (Exception $ex) {
            $message = "有记录存在外键约束,删除失败";
            $this->writeJsonResponse($success, $message);
        }
    }

}

