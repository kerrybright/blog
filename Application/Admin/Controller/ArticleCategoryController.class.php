<?php
namespace Admin\Controller;
use Common\Model\ArticleCategoryModel;
use Think\Controller;
class ArticleCategoryController extends BaseController {
    public function lists(){
        $model = D('article_category');
        $condition = array(
            'deleted' => 0,
        );
        $articleList = $model->where($condition)->select();

        $this->assign('articleList', $articleList);
        $this->display();
    }

    public function add(){
        $this->display();
    }



    public function addPost(){
        $categoryName = I('category_name');
        $desc = I('desc');
        $displayOrder = I('display_order');

        $data = array(
            'category_name' => $categoryName,
            'desc' => $desc,
            'display_order' => $displayOrder,
            'created_time' => date('Y-m-d H:i:s'),
        );

        $model = D('article_category');
        $res = $model->add($data);
        if($res){
            $this->refreshParentPage();
        }else{
            $this->error('操作失败！请稍后重试,,,,');
        }
    }

    public function delete(){
        $categoryId = I("id");
        $where['category_id'] = $categoryId;
        if($categoryId){
            $data['deleted'] = 1;
            ArticleCategoryModel::instance()->where($where)->save($data);
            $this->ajaxReturn("success");
        }else{
            $this->ajaxReturn("error");
        }
    }
}