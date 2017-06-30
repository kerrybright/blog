<?php
namespace Home\Controller;
use Common\Model\ArticleModel;
use Common\Model\WoListModel;
use Think\Controller;
class WoListController extends Controller {
    public function listApiAction(){
	    header('Access-Control-Allow-Origin:*');
	    $result = WoListModel::instance()->select();
	    $res = array(
		    'code' =>'200',
		    'msg' => 'success',
		    'data' => $result
	    );
	    $this->ajaxReturn($res);
    }
}