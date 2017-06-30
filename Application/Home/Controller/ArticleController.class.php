<?php
namespace Home\Controller;
use Common\Model\ArticleModel;
use Think\Controller;
class ArticleController extends Controller {
    public function detailAction(){
        $articleId = I('article_id');

        $key = 'article_detail_'.$articleId;
        if(S($key)){
            $articleDetail = S($key);
        }else{
            $articleDetail = ArticleModel::instance()->where('article_id ='.$articleId)->find();
            S($key,$articleDetail,60);
        }
        $this->assign('articleDetail', $articleDetail);

        $this->display();
    }

    //分类信息中所有的文章
    public function listAction(){
        $categoryId = I("category_id");

        if($categoryId){
            $articleList = ArticleModel::instance()->getArticleListById($categoryId);
            $this->assign("articleList", $articleList);
            $this->assign("typeId", $categoryId);
            $this->assign("type", 'article_category');

            $categorys = ArticleModel::instance()->totalArticelCategoryList($categoryId);
            $categoryInfo = $categorys[0];
            $this->assign("categoryInfo", $categoryInfo);
        }

        $this->display("list");
    }
}