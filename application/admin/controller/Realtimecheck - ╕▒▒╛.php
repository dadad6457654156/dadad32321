<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;
use  think\Request;
/**
 * 实时核对
 *
 * @icon fa fa-circle-o
 */
class Realtimecheck extends Backend
{
    
    /**
     * Realtimecheck模型对象
     * @var \app\admin\model\Realtimecheck
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Realtimecheck;
        $this->view->assign("iszhengqueList", $this->model->getIszhengqueList());
        $this->view->assign("beiyongjinheduiList", $this->model->getBeiyongjinheduiList());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    
	
	    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
           if ($this->request->request('keyField')){
                return $this->selectpage();
           }
          list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->where($where)
              ->order($sort, $order)
             ->count();

            //$list = $this->model
                //->where($where)
               // ->order($sort, $order)
               // ->limit($offset, $limit)
               // ->select();

            // $list = collection($list)->toArray();
			$all = Request::instance()->param(); 
            $this->model = new \app\admin\model\Realtimecheckmeitian;
			$shangrilist = $this->model->order('id desc')->where('name','人民币')->find();
			
			$shijian =$all["filter"];
			$obj = json_decode($shijian);
			//var_dump($obj->status );exit;
			$status = $obj->status;
			$shijian = $this->times($status);
			//var_dump($shijian);exit;
			$shangrirenminbijieyu =$shangrilist['jinrijieyu'];
			$shangribeiyongjinjieyu = $shangrilist['beiyongjinjieyu'];
			$zhichutuihui = $this->model->order('id desc')->where('name','人民币')->find();
			$qitashuru = $this->model->order('id desc')->where('name','人民币')->find();
			$this->model = new \app\admin\model\Incomerecord;
			$where = [];
			$where['createtime'] =  array('between', array($shijian['kaishitime'],$shijian['jieshutime']));
			$where['source'] = 0;
			$kehulaikuan = $this->model->where($where)->sum('Amount');
			$this->model = new \app\admin\model\Incomerecord;
			$where = [];
			$where['createtime'] =  array('between', array($shijian['kaishitime'],$shijian['jieshutime']));
			$where['source'] = 1;			
			$zhichutuikuan = $this->model->where($where)->sum('Amount');			
			$where = [];
			$where['createtime'] =  array('between', array($shijian['kaishitime'],$shijian['jieshutime']));
			$where['source'] = 2;			
			$qitashuru = $this->model->where($where)->sum('Amount');			
			$this->model = new \app\admin\model\Exchange;	//美金兑入人民币		
			$where = [];
			$where['createtime'] =  array('between', array($shijian['kaishitime'],$shijian['jieshutime']));
			$where['status'] = 2;			
			$meijinduiru = $this->model->where($where)->sum('Redemptioamount');			
			$where = [];
			$where['createtime'] =  array('between', array($shijian['kaishitime'],$shijian['jieshutime']));
			$where['status'] = 1;			
			$meijinduichu = $this->model->where($where)->sum('CashoutAmount');				
			$this->model = new \app\admin\model\Paymentmanagement;	//实例化出款模型	
 			$where = [];
			$where['createtime'] =  array('between', array($shijian['kaishitime'],$shijian['jieshutime']));
			$kehuchukuan = $this->model->where($where)->sum('Amount');				
			$this->model = new \app\admin\model\Expenditurerecord;	//实例化支出模型	
 			$where = [];
			$where['source'] = 0;		
			$where['createtime'] =  array('between', array($shijian['kaishitime'],$shijian['jieshutime']));
			$zhichu = $this->model->where($where)->sum('Amount');	
			
			
			
			
			
			
			
			
			
			
			//var_dump($kehuchukuan);exit;
			$data = [];
			$linshi = [];
			$linshi['id'] = '1';
		    $linshi['name'] = '人民币';
            $linshi['shangrijieyu'] = $shangrirenminbijieyu;
			$linshi['kehulaikuan'] = $kehulaikuan;
		    $linshi['zhichutuihui'] = $zhichutuikuan;
            $linshi['qitashouru'] = $qitashuru;			 
		    $linshi['meijinduiru'] = $meijinduiru;
            $linshi['meijinduichu'] = $meijinduichu;    
 			$linshi['kehuchukuan'] = $kehuchukuan;
		    $linshi['zhichu'] = $zhichu;
            $linshi['shouxufei'] = '人民币';
			$linshi['jingyingkui'] = '1';
		    $linshi['jinrijieyu'] = '人民币';
            $linshi['iszhengque'] = '人民币';			 
		    $linshi['beiyongjinshangrijieyu'] = $shangribeiyongjinjieyu;
            $linshi['beiyongjinzhuanru'] = '人民币';   
            $linshi['beiyonghjinzhuanchu'] = '人民币';  
            $linshi['beiyongjinjieyu'] = '人民币';  
            $linshi['beiyongjinhedui'] = '人民币';  			
			$linshi['linshidongjie'] = '1';
		    $linshi['sanfangweijie'] = '人民币';
            $linshi['houtailiudongzijin'] = '人民币';		 
		    $linshi['iszhengque_text'] = '人民币';
            $linshi['beiyongjinhedui_text'] = '人民币';   
         
			$list[] = $linshi;
			
			
           $result = array("total" => $total, "rows" => $list);
			
			
			
           // var_dump( $list);exit;
            return json($result);
        }
		
		
		
        return $this->view->fetch();
    }
	
	
	
	
	
	
	
	
	
	
	public function times($status){
		
		//今天开始结束时间戳
		$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		//昨天开始结束时间戳
		$beginYesterday=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
        $endYesterday=mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
		//上周开始结束时间戳
		$beginLastweek=mktime(0,0,0,date('m'),date('d')-date('w')+1-7,date('Y'));
        $endLastweek=mktime(23,59,59,date('m'),date('d')-date('w')+7-7,date('Y'));
		//本月开始结束时间戳
		$beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
		
		
		if($status == 0){
		  $data['kaishitime'] = $beginToday;
		  $data['jieshutime'] = $endToday;		  	
		 return($data);exit;
		}
		if($status == 1){
		  $data['kaishitime'] = $beginYesterday;
		  $data['jieshutime'] = $endYesterday;		  	
		 return($data);exit;
		}
		if($status == 2){
		  $data['kaishitime'] = $beginToday;
		  $data['jieshutime'] = $endToday;		  	
		 return($data);exit;
		}
		if($status == 3){
		  $data['kaishitime'] = $beginToday;
		  $data['jieshutime'] = $endToday;		  	
		 return($data);exit;
		}
		if($status == 4){
		  $data['kaishitime'] = $beginToday;
		  $data['jieshutime'] = $endToday;		  	
		 return($data);exit;
		}
		if($status == 5){
		  $data['kaishitime'] = $beginToday;
		  $data['jieshutime'] = $endToday;		  	
		 return($data);exit;
		}		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	

}
