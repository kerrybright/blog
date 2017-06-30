<?php
namespace Admin\Controller;
use Common\Model\ArticleCategoryModel;
use Common\Model\ArticleModel;
use Think\Controller;
class ArticleController extends BaseController {
    public function lists(){
        $model = D('article');
        $condition = array(
            'deleted' => 0,
        );
        $articleList = $model->where($condition)->select();

        $this->assign('articleList', $articleList);
        $this->display();
    }

    public function add(){
        //文章类别
        $categoryCondition = array(
            'disabled' => 0,
            'deleted'  => 0,
        );
        $categoryList = ArticleCategoryModel::instance()->where($categoryCondition)->select();
        $this->assign('categoryList', $categoryList);

        $this->display();
    }

    public function addPost(){
        $categoryId = I('category_id');
        $title = I('title');
        $content = I('content');
        $author = I('author');

        $data = array(
            'category_id' => $categoryId,
            'title' => $title,
            'content' => $content,
            'author' => $author,
            'created_time' => date('Y-m-d H:i:s'),
        );

        $model = D('article');
        $res = $model->add($data);
        if($res){
            $this->refreshParentPage();
        }else{
            $this->error('操作失败！请稍后重试,,,,');
        }
    }

    public function delete(){
        $articleId = I("id");
        $where['article_id'] = $articleId;
        if($articleId){
            $data['deleted'] = 1;
            ArticleModel::instance()->where($where)->save($data);
            $this->ajaxReturn("success");
        }else{
            $this->ajaxReturn("error");
        }
    }
}