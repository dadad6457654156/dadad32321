<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Request;
use DB;
/**
 * 每日核对

 *
 * @icon fa fa-circle-o
 */
class Realtimecheckmeitian extends Backend
{
    
    /**
     * Realtimecheckmeitian模型对象
     * @var \app\admin\model\Realtimecheckmeitian
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Realtimecheckmeitian;
        $this->view->assign("shijianList", $this->model->getShijianList());
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
        
     
         
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            $filter = json_decode(input('param.filter'),true);
            if(!$filter){
              return json(['code'=>0,'msg'=>'查询失败,请输入搜索条件！']);	
            }
                  
            if (!isset($filter["createtime"]))
            {
            return json(['code'=>0,'msg'=>'查询时间段不可为空！']);	
            }
            if (!isset($filter["bizhong"]))
            {
            return json(['code'=>0,'msg'=>'币种不能为空！']);	
            }
            $starttime = explode(' - ',$filter["createtime"])[0];
            $Endtime =explode(' - ',$filter["createtime"])[1];
            if (!isset($filter["chaxunqianjieyu"]))
            {
            $choushizijin = 0;	
            $data = [];
            $data['source'] = $filter["bizhong"];
            $data['time'] = strtotime($starttime);            
            $bankidlist = $this->qzhid($data);
            $choushizijin = 0;
            foreach($bankidlist as $k=>$v){
            	$data = [];
            $data['id'] = $v;
            $data['time'] = strtotime($starttime);
             $linshimoney = $this->qushijianduanqianmoney($data);
             
            // echo 'ID：'.$data['id'] .'-----'.$linshimoney.'</br>';
             $choushizijin+=$linshimoney;
            }
            //exit;
            }else{
            $choushizijin = $filter["chaxunqianjieyu"];	
                        $data = [];
            $data['source'] = $filter["bizhong"];
            $data['time'] = strtotime($starttime);            
            $bankidlist = $this->qzhid($data);
        	
            	
            }
            $ts = (strtotime($Endtime)+1-strtotime($starttime))/86400;
            $cstime = strtotime($starttime)-86400;
            $timearr = [];
            
          for($i=0;$i<$ts;++$i){
           	$linshitime = [];
           	$linshitime['starttime'] = $cstime  +86400 ;
           	$linshitime['Endtime'] = $cstime +86400+86400-1;
           	$cstime = $linshitime['Endtime']-86400+1;
           	$timearr[] =$linshitime; 
           }  
            
            //var_dump($timearr);exit;
            $dataxin = [];
            $sum['leijizhichutuihui']=0;
            $sum['leijiqitashuru']=0;
            $sum['leijichongzhi']=0;
            $sum['leijihuanru']=0;
            $sum['leijihuanchu']=0;
            $sum['leijichouxufei']=0;
            $sum['leijichongtiyingkui']=0;
            foreach($timearr as $k=>$v){
            $linshishuzu = [];	
            $time =  [];
            $time['kaishitime'] = $timearr[$k]['starttime'];
            $time['jieshutime'] = $timearr[$k]['Endtime'];
            $data = [];
            $data['source'] = $filter["bizhong"];
            $data['status'] = 0;
            $chongzhi = $this->shuru($data,$time);//充值
            $data['status'] = 1;
            $zhichutuihui = $this->shuru($data,$time);//支出退回 
            $data['status'] = 2;
            $qitashouru = $this->shuru($data,$time);//其它收入  	
            
            $linshishuzu['id'] =$k;
            $linshishuzu['Shijian'] = date('Y-m-d', $time['kaishitime']);
            $linshishuzu['bizhong'] = $filter["bizhong"];
            
            if($filter["bizhong"] == 0){
            $linshishuzu['bizhong_text'] = '人民币';	
            }else if($filter["bizhong"] == 1){
            $linshishuzu['bizhong_text'] = '美金';	
            	
            	
            }
            $linshishuzu['chaxunqianjieyu'] = $choushizijin;
            $linshishuzu['chaxunqianjieyu'] = $choushizijin;
            $linshishuzu['kehulaikuan'] = $chongzhi;
            $linshishuzu['zhichutuihui'] = $zhichutuihui;  
            $linshishuzu['qitashouru'] = $qitashouru;
            $data = [];
            $data['id'] =  $bankidlist;
            $data['type'] =  0;
            $data['source']  =  $filter["bizhong"];
            $huanhuishouru = $this->huanhui($data,$time);//换汇转入
            $data['type'] =  1;
            $huanhuizhuanchu = $this->huanhui($data,$time);//换汇转入
            
            $linshishuzu['meijinduiru'] = $huanhuishouru;
            $linshishuzu['meijinduichu'] = $huanhuizhuanchu;
          if(!$filter["bizhong"]){
          $data = [];
          $data['id'] = $bankidlist;
          
            $chukuan = $this->chukuan($data,$time);//取出款
            }else{
            $chukuan =0;	
            	
            }
  	
            $linshishuzu['kehuchukuan'] = $chukuan;	
            
           
            $data = [];
            $data['id'] = $bankidlist;
            $data ['source'] = $filter["bizhong"];
             $zhichu = $this->zhichu($data,$time);
                  
               $linshishuzu['zhichu'] = $zhichu;   
                  
            $linshishuzu['jinrijieyu'] = $choushizijin;	
             $data = [];
            $data['id'] = $bankidlist;
            $data ['source'] = $filter["bizhong"];
             $zhichu = $this->zhichu($data,$time);
             if(!$filter["bizhong"]){
            $shouxufei = $this->shouxufei($data,$time);
             }else{
             $shouxufei =0;	
             	
             }   //  echo date('Y-m-d H:i:s', $time['kaishitime']).'------'.date('Y-m-d H:i:s', $time['jieshutime']).'======='.$shouxufei.'</br>';
           
            $linshishuzu['shouxufei'] = $shouxufei;
            $linshishuzu['chongtiyingkui'] = number_format($chongzhi-$chukuan ,2,".","") ;	
              
            $linshishuzu['chaxunqianjieyu'] = $choushizijin;
            $linshishuzu['shangrijieyu'] = $choushizijin;
            $linshishuzu['jinrijieyu'] = $zhichutuihui+$qitashouru+$huanhuishouru-$huanhuizhuanchu-$zhichu+$linshishuzu['chongtiyingkui']+$choushizijin-$shouxufei;
            if(!$filter["bizhong"]){
            $linshishuzu['linshidongjiekuan'] = $this->linshidongjiekuan($time['jieshutime']);	
            }else{
            $linshishuzu['linshidongjiekuan'] = 0;	
            	
            }
            $linshishuzu['zhengchangzichan'] = $linshishuzu['jinrijieyu']-$linshishuzu['linshidongjiekuan'] ;
            
            if(!$filter["bizhong"]){
            	$data = [];
            	$data['time'] = $time['jieshutime'];
            	$data['id'] = 33;
             $linshishuzu['beiyongjinjieyu'] = $this->qushijianduanqianmoney($data);	
            }else{
           
            	$data = [];
            	$data['time'] = $time['jieshutime'];
            	$data['id'] = 32;            	
             $linshishuzu['beiyongjinjieyu'] = $this->qushijianduanqianmoney($data);
            	
            }
             $linshishuzu['houtaikeyong'] = number_format($linshishuzu['zhengchangzichan'] - $linshishuzu['beiyongjinjieyu'],2,".","") ;
            
            $choushizijin = $linshishuzu['jinrijieyu'];
            $sum['leijizhichutuihui']+=$zhichutuihui;
            $sum['leijiqitashuru']+=$qitashouru;
            $sum['leijichongzhi']+=$chongzhi;
            $sum['leijihuanru']+=$huanhuishouru;
            $sum['leijihuanchu']+=$huanhuizhuanchu;
            $sum['leijichouxufei']+=$shouxufei;
            $sum['leijichongtiyingkui']+=$linshishuzu['chongtiyingkui'];
            $dataxin[] = $linshishuzu;
            } 
  
         
            
     
           
       // "extend" => ['money' => mt_rand(100000, 999999), 'price' => 200]);
        
         $total = count($dataxin);
      
            $result = array("total" => $total, "rows" => $dataxin, "sum" => $sum);

            return json($result);
        }
        return $this->view->fetch();
    }   
     
public function shuru($data,$time = []){//收入表
// type = 0 客户来款，1= 支出退回 2等于其它收入  

//$data['starttime']
//$data['Endtime']	
		$this->model = new \app\admin\model\Incomerecord;	//初始收入模型
		$where = [];
		$where['source'] = $data['source'];
        $where['status'] = $data['status'];
		if(count($time)){
	    $where['createtime'] =  array('between', array($time['kaishitime'],$time['jieshutime']));	
		}
		return number_format($this->model->where($where)->sum('Amount'),2,".","") ;	
	
}     
     
    




public function choushizijin($data){//出款表  -1 =取开始资金
// type = 0 客户来款，1= 支出退回 2等于其它收入
//$data['source'] 
//$data['time']
	
	
	
} 
     
      
public function cszc($num) //取初始资产
{
$this->model = new \app\admin\model\Accountmanagement;	//初始账户模型
$where = [];
$where['source'] = $num; 	
return $this->model->where($where)->sum('Initialbalance');
}     
     
public function qzhid($data) //取账户ID
{
//$data['source']
//$data['source']
//$data['time']
$this->model = new \app\admin\model\Accountmanagement;	//初始账户模型
$where = [];  //->column("title"); 
$where['createtime'] = ['<',$data['time']];
$where['source'] = $data['source'];
return $this->model->where($where)->column("id"); 
}         
 
  
public function qushijianduanqianmoney($bank)
    {
        //$bank['id']
        //$bank['time']
        $cxtj = [];
        if ($bank['time']) {
            $this->model = new \app\admin\model\Zhangbian;  //实例化账变记录表
            $cxtj['nameid'] = $bank['id'];
            $cxtj['createtime'] =  array('between', array(100,$bank['time']));
            $money = $this->model->where($cxtj)->order('id desc')->limit(1)->select();
            $money = collection($money)->toArray();
            if (count($money)) {
                return $money[0]["zhangbianh"];
            } else {
                $this->model = new \app\admin\model\Accountmanagement; //实例化账户管理
                $cxtj	 = [];
                $cxtj['id'] = $bank['id'];
                $csmoney = $this->model->where($cxtj)->value('Initialbalance');
                return $csmoney;
            }
        } else {
            $this->model = new \app\admin\model\Accountmanagement; //实例化账户管理
			                $cxtj	 = [];
            $cxtj['id'] = $bank['id'];
            $csmoney = $this->model->where($cxtj)->value('Initialbalance');
            return $csmoney;
        }
    } 
 
 
 public function chukuan( $bank,$time=[]){
$this->model = new \app\admin\model\Paymentmanagement; 	//实例化出款表
     $cxtj = [];
   
      $cxtj['createtime'] =  array('between', array($time['kaishitime'],$time['jieshutime']));
 
 	
	return $this->model->where($cxtj)->sum('Amount');	
}


public function linshidongjiekuan($time){
$this->model = new \app\admin\model\Accountmanagement;	//初始账户模型
$where = [];  //->column("title"); 
$where['createtime'] = ['<',$time];
 
 
$where['status'] = 3;
$bankidlist  =  $this->model->where($where)->column("id");
 
$linshidongjiekuan  = 0;
foreach($bankidlist as $k=>$v){
$data = [];
$data['id'] = $v;
$data['time'] = $time;
$linshimoney = $this->qushijianduanqianmoney($data);	
$linshidongjiekuan+=$linshimoney;	
}
 
return $linshidongjiekuan; 	
}
     public function huanhui($bank,$time = [])
    {   // $time['kaishitime'] = $timearr[$k]['starttime'];
           // $time['jieshutime']            $time['kaishitime'] = $timearr[$k]['starttime'];
           // $time['jieshutime'] = $timearr[$k]['Endtime'];
	//type = 0 收入  type 1 = 支出
	$this->model = new \app\admin\model\Exchangeshuanhui; 	//实例化换汇表
 
    
	if($bank['source'] == 0){
	$cxtj = [];	
	$cxtj['createtime'] =  array('between',array($time['kaishitime'],$time['jieshutime']) ); 
    if ($bank['type'] == 0) {
    	$cxtj['status'] = 2;
	 
		return  $this->model->where($cxtj)->sum('Redemptioamount');
		
	}else{
		$cxtj['status'] = 1;
	   	return  $this->model->where($cxtj)->sum('CashoutAmount');
 
		
	}	
		
	}else{
		
	$cxtj = [];	
	$cxtj['createtime'] =  array('between',array($time['kaishitime'],$time['jieshutime']) ); 
    if ($bank['type'] == 0) {
    	$cxtj['status'] = 1;
	 
		return  $this->model->where($cxtj)->sum('Redemptioamount');
		
	}else{
		$cxtj['status'] = 2;
	   	return  $this->model->where($cxtj)->sum('CashoutAmount');
 
		
	}			
		
		
		
		
		
	}













		
    }
 
 
    //支出
    public function zhichu($bank,$time=[])
    {
   
	$this->model = new \app\admin\model\Expenditurerecord; 	//实例化支出表
	$cxtj = [];
    $cxtj['source'] =   $bank['source'];
    $cxtj['createtime'] =  array('between', array($time['kaishitime'],$time['jieshutime']));
 
	return  $this->model->where($cxtj)->sum('Amount');
    }
    //换汇
  
 
     public function shouxufei($bank,$time=[])
    {
	 //支出手续费
     //中转手续费
     //换汇手续费
     //出款手续费
	 $this->model = new \app\admin\model\Expenditurerecord; 	//实例化支出表
	  $cxtj = [];
     
      $cxtj['createtime'] =  array('between', array($time['kaishitime'],$time['jieshutime']));
   
		
	 $zhichushouxufei  = $this->model->where($cxtj)->sum('Handlingee');	
	$this->model = new \app\admin\model\Transferoffunds;  //实例化中转表
     $cxtj = [];
    
      $cxtj['createtime'] =  array('between',array($time['kaishitime'],$time['jieshutime']));
   
	
	 $zhongzhuanshouxufei  = $this->model->where($cxtj)->sum('Handlingee');	
 	
	$this->model = new \app\admin\model\Exchangeshuanhui;  //实例化换汇表
     $cxtj = [];
    
      $cxtj['createtime'] =  array('between',array($time['kaishitime'],$time['jieshutime']));
   
	
	$huanhuishouxufei =  $this->model->where($cxtj)->sum('Handlingee');		
	$this->model = new \app\admin\model\Paymentmanagement; 	//实例化出款表
     $cxtj = [];
     
      $cxtj['createtime'] =  array('between', array($time['kaishitime'],$time['jieshutime']));
    
	$chukuanshouxufei =  $this->model->where($cxtj)->sum('Handlingee');
 
 
   return $zhichushouxufei + $zhongzhuanshouxufei +  $huanhuishouxufei + $chukuanshouxufei;

		
		
    }

 
    

}
