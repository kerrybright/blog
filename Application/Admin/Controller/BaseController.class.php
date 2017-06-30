<?php
namespace Admin\Controller;
use Common\Common\BEDefine;
use Common\Common\FileUpload;
use Think\Controller;
class BaseController extends Controller {
    protected $userAccount;

    public function __construct()
    {
        parent::__construct();
        $isLogin = $this->checkUser();
        if(!$isLogin){
            $this->error('登录已超时，请重新登录', U('User/login'));
        }else{
            $this->userAccount = $isLogin;
        }
    }

    public function checkUser(){
        $userAccount = session('user_account');
        return $userAccount;
    }

    /*
     * @param   $refreshAction   页面刷新方式
     *          BEDefine::PAGE_RELOAD，为重新加载，保持之前提交的值，默认值；
     *          BEDefine::PAGE_REFRESH，为刷新页面，不保持之前提交的值；
     *          BEDefine::PAGE_NO_REFRESH，为不刷新页面
     */
    protected function refreshParentPage($refreshAction = BEDefine::PAGE_RELOAD){
        $html = '操作成功!';
        switch ($refreshAction) {
            case BEDefine::PAGE_RELOAD:
                $html .= '正在刷新页面...<script type="text/javascript">window.parent.location.reload();</script>';
                break;
            case BEDefine::PAGE_REFRESH:
                $html .= '正在刷新页面...<script type="text/javascript">window.parent.location.replace(window.parent.location.href);</script>';
                break;
            default:
                break;
        }
        $this->show($html, 'utf-8');
    }

    public function uploadFile(){
        if (!empty($_FILES)) {
            $up = new FileUpload();
            //设置上传目录,各项参数
            $up->set('path','/Upload/images/') //保存的目录
            ->set('allowtype',array('jpg','gif','png'))
                ->set('maxsize',2000000);
            $re = $up->upload("Filedata");
            if($re){
                $filename = '/data/images/'.$up->getFileName();
                die($filename);
            }else{
                die('error|'.$up->getErrorMsg());
            }
        }
        die('error|上传失败');
    }
}