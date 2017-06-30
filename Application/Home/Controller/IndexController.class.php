<?php
namespace Home\Controller;
use Common\Enum\IndexDisplayEnum;
use Common\Model\ArticleModel;
use Common\Model\IndexDisplayModel;
use Think\Controller;
class IndexController extends Controller {
    public function indexAction(){
        //文章列
        $condition = array(
            'deleted' => 0,
            'disabled' => 0,
        );
        $articleList = ArticleModel::instance()->getArticleList();
        $this->assign('articleList', $articleList);

        //top-left
        $articleCategoryList = ArticleModel::instance()->totalArticelCategoryList();
        $this->assign('articleCategoryList', $articleCategoryList);
        $this->display();
    }

    //日志
    public function journalAction(){
        $this->display();
    }

    //输出系统信息
    public function getInfoAction(){
        S("test","成功了");
        var_dump(S("test"));
    }

}