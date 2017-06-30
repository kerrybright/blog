<?php
namespace Common\Model;

use Think\Model;

class ArticleModel extends BaseModel
{
    public function totalArticelCategoryList($categoryId){
        $condition = array(
            'zl_article.deleted' => 0,
            'zl_article.disabled' => 0,
        );
        if($categoryId){
            $condition['zl_article.category_id'] = $categoryId;
        }
        $result = ArticleModel::instance()->field('count(*) as article_num, zl_article_category.category_name, zl_article_category.category_id')
            ->join("left join zl_article_category on zl_article_category.category_id = zl_article.category_id")
            ->group("zl_article.category_id")
            ->select();
        return $result;
    }

    public function getArticleList(){
        $condition = array(
            'zl_article.deleted' => 0,
            'zl_article.disabled' => 0,
        );
        $articleList = ArticleModel::instance()->where($condition)
            ->join("left join zl_article_category on zl_article_category.category_id = zl_article.category_id")
            ->order('zl_article.created_time')
            ->select();
        return $articleList;
    }

    public function getArticleListById($categoryId){
        $condition = array(
            'zl_article.deleted' => 0,
            'zl_article.disabled' => 0,
            'zl_article.category_id' => $categoryId,
        );
        $articleList = ArticleModel::instance()->where($condition)
            ->join("left join zl_article_category on zl_article_category.category_id = zl_article.category_id")
            ->order('zl_article.created_time')
            ->select();
        return $articleList;
    }
}