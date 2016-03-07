<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
        $header=A('Public'); 
        $header->header();
    	$this->display();
    }
    public function register(){
        $header=A('Public'); 
        $header->header();
    	$this->display();
    }
    // 处理登录
    public function dologin(){
    	$username=$_POST['username'];
    	$password=$_POST['password'];
    	$data=null;
    	if($username==""){
    		$data="你还没有输入帐号！";
    	}else if($password==""){
    		$data="你还没有输入密码！";
    	}else{
    		$con=M('user');
    		$where1['username']=$username;
    		$where1['password']=$password;
            $result1=$con->where($where1)->count();
    		$name1=$con->where($where1)->getField('username');

			$where2['email']=$username;
    		$where2['password']=$password;
    		$result2=$con->where($where2)->count();
            $name2=$con->where($where2)->getField('username');

    		if($result1==0&&$result2==0){
    			$data="您输入的帐号或者密码不正确，请重新输入。";
    		}else{

                session('username',$name1.$name2);  //设置session username
    			$data="pass";
    		}
    	}
    	$this->ajaxReturn($data);
    }
    // 判断用户名和邮箱是否已存在
    public function check(){
        $kind=$_POST['kind'];
        $value=$_POST['value'];
        $data=null;
        if($value==""){
            $data='空';
        }else{
            $con=M('user');
            $where["$kind"]=$value;
            $result=$con->where($where)->find();
            if($result>=1){
                $data="已注册";
            }
        }
        $this->ajaxReturn($data);
    }
    // 处理注册
    public function doregister(){
        $con=M('user');
        $data['username']=$_POST['username'];
        $data['password']=$_POST['password'];
        $data['sex']=$_POST['sex'];
        $data['email']=$_POST['email'];
        $data['qq']=$_POST['qq'];
        $result=$con->data($data)->add();
        if($result){
            // cookie('username',$data['username']);  //设置cookie
            // cookie('password',$data['password']);  //设置cookie
            session('username',$data['username']);  //设置cookie
            $this->redirect('Index/index');//登陆成功
        }else{
            $this->redirect('Index/default');//登陆失败
        }
    }
    public function do_logout(){
        session('username',null); // 删除name
        $this->redirect('Login/login');
    }
}