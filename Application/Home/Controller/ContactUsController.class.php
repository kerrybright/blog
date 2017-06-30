<?php
namespace Home\Controller;
use Common\Model\ArticleModel;
use Common\Model\EmailModel;
use Think\Controller;
class ContactUsController extends Controller {
    public function indexAction(){
        $this->display();
    }

    public function sendAction(){
        $email = I('email');
        $content = I('content');
        $title = I('title');
        $name = I('name');

        $data = array(
            'email' => $email,
            'content' => $content,
            'title'  => $title,
            'name' => $name
        );

        $addSend = EmailModel::instance()->add($data);
        //邮件发�?
        $toEmail = 'aiboms@163.com';
        $send = sendMail($toEmail,$title,$content,$name);
        if($send){
            $this->redirect("/Index/index");
        }
    }
}