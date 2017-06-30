<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function login(){
        $this->display('login');
    }

    public function checkLogin(){
        $userAccount = I('user_account');
        $userPwd = md5(I('user_pwd'));

        $condition['user_account'] = $userAccount;
        $list = D('user')->where($condition)->find();

        if($userPwd == $list['user_pwd']){
            $_SESSION['user_account'] = $list['user_account'];
            $this->redirect("/Index/index");
        }else{
            $this->error('用户名或密码错误！','/User/login');
        }
    }

    public function logout(){
        session(null);
        $this->redirect("/User/login");
    }
}