<?php
namespace Admin\Controller;
use Common\Enum\IndexDisplayEnum;
use Common\Model\IndexDisplayModel;
use Think\Controller;
class IndexDisplayController extends BaseController {
    public function lists(){
        $model = IndexDisplayModel::instance();
        $condition = array(
            'deleted' => 0,
        );
        $indexDisplayList = $model->where($condition)->select();

        $this->assign('indexDisplayList', $indexDisplayList);
        $this->display();
    }

    public function add(){
        $displayList = IndexDisplayEnum::instance()->getSelectionList();
        $this->assign('displayList', $displayList);

        $this->display();
    }

    public function addPost(){
        $positionId = I('position_id');
        $desc = I('desc');
        $articleIds = I('article_ids');

        $data = array(
            'position_id' => $positionId,
            'desc' => $desc,
            'article_ids' => $articleIds,
            'created_time' => date('Y-m-d H:i:s'),
        );

        $model = D('index_display');
        $res = $model->add($data);
        if($res){
            $this->refreshParentPage();
        }else{
            $this->error('操作失败！请稍后重试,,,,');
        }
    }
}