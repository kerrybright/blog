<?php
namespace Home\Controller;
use Common\Model\ArticleModel;
use Common\Model\WoListModel;
use Common\Model\WoUserModel;
use Think\Controller;
class WoDetailController extends Controller {
    public function detailApiAction(){
	    header('Access-Control-Allow-Origin:*');
	    $id = $_REQUEST['id']?$_REQUEST['id']:1;
	    $condition['id'] = $id;
	    $result = WoListModel::instance()->where($condition)->find();

	    $userList = WoUserModel::instance()->where($condition)->find();
	    $result['bidder'] = $userList;
	    if(!$result){
		    $res = array(
			    'code' =>'400',
			    'msg' => 'error',
			    'data' => $result
		    );
	    }else{
		    $res = array(
			    'code' =>'200',
			    'msg' => 'success',
			    'data' => $result
		    );
	    }

	    $this->ajaxReturn($res);
    }
}