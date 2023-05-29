<?php
namespace app\back\controller;
use think\Request;
use think\Exception;
use app\common\model\TermInfoModel;

class TermInfo extends BackBase {
    protected $termInfoModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->termInfoModel = new TermInfoModel();
    }

    /*添加学期信息信息*/
    public function add(){
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
            return view('termInfo/termInfo_add');
        }
    }

    /*跳转到更新界面*/
    public function modifyView() {
        $this->assign("termId",input("termId"));
        return view("termInfo/termInfo_modify");
    }

    /*ajax方式按照查询条件分页查询学期信息信息*/
    public function backList() {
        if($this->request->isPost()) {
            if($this->request->param("page") != null)
                $this->currentPage = $this->request->param("page");
            if($this->request->param("rows") != null)
                $this->termInfoModel->setRows($this->request->param("rows"));
            $termInfoRs = $this->termInfoModel->queryTermInfo($this->currentPage);
            $expTableData = [];
            foreach($termInfoRs as $termInfoRow) {
                $expTableData[] = $termInfoRow;
            }
            $data["rows"] = $termInfoRs;
            /*当前查询条件下总记录数*/
            $data["total"] = $this->termInfoModel->recordNumber;
            echo json_encode($data);
        } else {
            return view("termInfo/termInfo_query");
        }
    }

    /*ajax方式查询学期信息信息*/
    public function listAll() {
        $termInfoRs = $this->termInfoModel->queryAllTermInfo();
        echo json_encode($termInfoRs);
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

    /*按照查询条件导出学期信息信息到Excel*/
    public function outToExcel() {
        $termInfoRs = $this->termInfoModel->queryOutputTermInfo();
        $expTableData = [];
        foreach($termInfoRs as $termInfoRow) {
            $expTableData[] = $termInfoRow;
        }
        $xlsName = "TermInfo";
        $xlsCell = array(
            array('termId','学期编号','int'),
            array('termName','学期名称','string'),
        );//查出字段输出对应Excel对应的列名
        //公共方法调用
        $this->export_excel($xlsName,$xlsCell,$expTableData);
    }

}

