<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;
use  think\Request;

/**
 * 账户核对
 *
 * @icon fa fa-circle-o
 */
class Zhanghujiaodui extends Backend
{
    
    /**
     * Zhanghujiaodui模型对象
     * @var \app\admin\model\Zhanghujiaodui
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Zhanghujiaodui;
        $this->view->assign("sourceList", $this->model->getSourceList());
        $this->view->assign("statusList", $this->model->getStatusList());
    }
    
    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            
            
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->where($where)
                ->order($sort, $order)
                ->count();

            $list = $this->model
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();

            $list = collection($list)->toArray();
            $all  = Request::instance()->param();
            $shijian =$all["filter"];
            $filter = [];
            $obj = json_decode($shijian);
            //var_dump($obj->status );exit;
            if (!isset($obj->status)) {
                $filter['status'] = -1;
            } else {
                $filter['status'] = $obj->status;
            }
            if (!isset($obj->source)) {
                $filter['source'] = -1;
            } else {
                $filter['source'] = $obj->source;
            }
			if (!isset($obj->createtime)) {
				 $filter['createtime'] = [];
                 $createtime = '1999-01-01 00:00:00 - '.date('Y-m-d H:i:s');
            } else {
                $filter['createtime'] = $obj->createtime;
                $createtime = $obj->createtime;
                $filter['createtime']  = explode(' - ',$filter['createtime']);
                 $filter['createtime'][0]= strtotime($filter['createtime'][0]); 
                 $filter['createtime'][1]= strtotime($filter['createtime'][1]); 
            }
            			if (!isset($obj->name)) {
                $filter['name'] = [];
            } else {
                $filter['name'] = $obj->name;
          
                
               
                
            }
            $num = 0;
            if(!isset($obj->zhichutuihui)) { //支出退回间隔
                
            } else {
                $cxjg = explode(',',$obj->zhichutuihui);
                $cxtj = 'zhichutuihui';
                $num+=1;
            } 
            
            if(!isset($obj->qitashouru)) {//其它收入查询间隔
                
            } else {
                $cxjg =  explode(',',$obj->qitashouru);
                $cxtj = 'qitashouru';
                $num+=1;
            } 
            
            if(!isset($obj->kehulaikuan)) {//客户来款查询间隔
                 
            } else {
                $cxjg =  explode(',',$obj->kehulaikuan);
                $cxtj = 'kehulaikuan';
                $num+=1;
            } 
            
             if(!isset($obj->huanhuizhuanru)) {//换辉转入查询间隔
               
            } else {
                $cxjg =  explode(',',$obj->huanhuizhuanru);
                $cxtj = 'huanhuizhuanru';
                $num+=1;
            } 
            
            if(!isset($obj->huanhuizhuanchu)) {//换汇转出间隔
                 
            } else {
                $cxjg =  explode(',',$obj->huanhuizhuanchu);
                $cxtj = 'huanhuizhuanchu';
                $num+=1;
            } 
            
            
            if(!isset($obj->zhuanru)) {//转入间隔
               
            } else {
                $cxjg =  explode(',',$obj->zhuanru);
                $cxtj = 'zhuanru';
                $num+=1;
            } 
            
            
 
            if(!isset($obj->zhuanchu)) {//转出间隔
                
            } else {
                $cxjg =  explode(',',$obj->zhuanchu);
                $cxtj = 'zhuanchu';
                $num+=1;
            } 
            
            if(!isset($obj->Handlingee)) { //手续费间隔
                
            } else {
                $cxjg =  explode(',',$obj->Handlingee);
                $cxtj = 'Handlingee';
                $num+=1;
            }  
            
            if(!isset($obj->chukuan)) { //出款间隔
                
            } else {
                $cxjg =  explode(',',$obj->chukuan);
                $cxtj = 'chukuan';
                $num+=1;
            }  
            
            
            if(!isset($obj->zhichu)) {//支出间隔
                
            } else {
                $cxjg =  explode(',',$obj->zhichu);
                $cxtj = 'zhichu';
                $num+=1;
            }              
            
            
            
            $banklist = $this->quzhanghu($filter); 
         $banklist = collection($banklist)->toArray();
  
             
			$data2 = [];
	 
			$sjdqye = 0;//初实化余额
			$zhichutuihui = 0;
			$qitashouru = 0;
			$kehulaikuan = 0;
			$huanhuizhuanru = 0;
			$huanhunzhuanchu = 0;
			$chukuan = 0;
			$zhichu = 0;
			$zhuanru = 0;
			$zhuanchu = 0;
			$shouxufei = 0;
			$shishiyue = 0;
			$zhglssye = 0;
			foreach ($banklist as $key => $value) {
		    $data = [];
			$data['name'] = $banklist[$key]['name'].'|'.$banklist[$key]['type'];
			$data['status'] = $banklist[$key]['status'];
			$data['status_text'] = $this->quzhuangtai($banklist[$key]['status']);
			$data['source'] = $banklist[$key]['source'];
			$data['source_text'] = $this->qubizhong($banklist[$key]['source']);			
            $data['id'] = $banklist[$key]['id'];
			$data['Initialbalance'] = $banklist[$key]['Initialbalance'];
			$bank = [];
			$bank['id'] = $banklist[$key]['id'];
			$bank['time'] = $filter['createtime'];
			$data['soushoshijianduanqianyue'] = $this->qushijianduanqianmoney($bank); //取时间段前余额
			$bank = [];
			$bank['id'] = $banklist[$key]['id'];
			$bank['time'] = $filter['createtime'];
			$bank['type'] = 1;
			$data['zhichutuihui'] = $this->qushouru($bank);//取支出退回
			$bank = [];
			$bank['id'] = $banklist[$key]['id'];
			$bank['time'] = $filter['createtime'];
			$bank['type'] = 2;
			$data['qitashouru'] = $this->qushouru($bank);//取其它收入
			$bank = [];
			$bank['id'] = $banklist[$key]['id'];
			$bank['time'] = $filter['createtime'];
			$bank['type'] = 0;
			$data['kehulaikuan'] = $this->qushouru($bank);//取客户来款
			$bank = [];
			$bank['id'] = $banklist[$key]['id'];
			$bank['time'] = $filter['createtime'];
			$bank['type'] = 0;
			$data['huanhuizhuanru'] = $this->huanhui($bank);//取换汇转入
			$bank = [];
			$bank['id'] = $banklist[$key]['id'];
			$bank['time'] = $filter['createtime'];
			$bank['type'] = 1;
			$data['huanhuizhuanchu'] = $this->huanhui($bank);//取换汇转入			
			$bank = [];
			$bank['id'] = $banklist[$key]['id'];
			$bank['time'] = $filter['createtime'];
			$bank['type'] = 1;
			$data['huanhuizhuanchu'] = $this->huanhui($bank);//取换汇转出			
			$bank = [];
			$bank['id'] = $banklist[$key]['id'];
			$bank['time'] = $filter['createtime'];
			$data['chukuan'] = $this->chukuan($bank);//取出款
			$bank = [];
			$bank['id'] = $banklist[$key]['id'];
			$bank['time'] = $filter['createtime'];
			$data['zhichu'] = $this->zhichu($bank);//取支出	
			$bank = [];
			$bank['id'] = $banklist[$key]['id'];
			$bank['time'] = $filter['createtime'];
			$bank['type'] = 0;
			$data['zhuanru'] = $this->zhongzhuan($bank);//取转入
			$bank = [];
			$bank['id'] = $banklist[$key]['id'];
			$bank['time'] = $filter['createtime'];
			$bank['type'] = 1;
			$data['zhuanchu'] = $this->zhongzhuan($bank);//取转出		
			$bank = [];
			$bank['id'] = $banklist[$key]['id'];
			$bank['time'] = $filter['createtime'];
			$data['Handlingee'] = $this->shouxufei($bank);//取手续费
			$data['shishijueyu'] = $data['soushoshijianduanqianyue'] + $data['zhichutuihui'] + $data['qitashouru'] +  $data['kehulaikuan']  + $data['huanhuizhuanru'] -$data['huanhuizhuanchu'] -$data['chukuan']- $data['zhichu']-$data['zhuanchu']+$data['zhuanru']-$data['Handlingee'];//取手续费
			$data['shishijueyu'] = 	round($data['shishijueyu'],2);
			$data['zhglssye'] = $banklist[$key]['balance'];
			
			$data['createtime'] = $createtime;
			
			if($num === 1){
            if($data[$cxtj] >= $cxjg[0]  and $data[$cxtj] <= $cxjg[1]){
            $data2[]= $data;
			$sjdqye+=$data['soushoshijianduanqianyue'];
			$zhichutuihui+=$data['zhichutuihui'];
			$qitashouru+=$data['qitashouru'];
			$kehulaikuan+=$data['kehulaikuan'];
			$huanhuizhuanru+=$data['huanhuizhuanru'];
			$huanhunzhuanchu+=$data['huanhuizhuanchu'];
			$chukuan+=$data['chukuan'];
			$zhichu +=$data['zhichu'];
			$zhuanru +=$data['zhuanru'];
			$zhuanchu +=$data['zhuanchu'] ;
			$shouxufei+=$data['Handlingee'];		
			$shishiyue +=$data['shishijueyu'];
			$zhglssye +=$data['zhglssye'];
              	
              	
              }	
            }else{
			$data2[]= $data;
			$sjdqye+=$data['soushoshijianduanqianyue'];
			$zhichutuihui+=$data['zhichutuihui'];
			$qitashouru+=$data['qitashouru'];
			$kehulaikuan+=$data['kehulaikuan'];
			$huanhuizhuanru+=$data['huanhuizhuanru'];
			$huanhunzhuanchu+=$data['huanhuizhuanchu'];
			$chukuan+=$data['chukuan'];
			$zhichu +=$data['zhichu'];
			$zhuanru +=$data['zhuanru'];
			$zhuanchu +=$data['zhuanchu'] ;
			$shouxufei+=$data['Handlingee'];		
			$shishiyue +=$data['shishijueyu'];
			$zhglssye +=$data['zhglssye'];	
            }
}



            if(!$num){
             $cxtj =''	;
            }
			if($num === 1  and $cxtj =='kehulaikuan'){
			$datass = [];
			if($filter['createtime']){
			$datass['kssj'] = $filter['createtime'][0];	
			}else{
			$datass['kssj'] = '';	
			}
			if($filter['createtime']){
			$datass['jssj'] = $filter['createtime'][1];	
			}else{
			$datass['jssj'] = '';	
			}
			$datass['url']='https://m.277192.com/Apijiekou.quzongcunkuan.do';
			$dafamoney  = $this->getapiquchongzhi($datass);
			$datass['url']='https://m.jzcp.io/Apijiekou.quzongcunkuan.do';
	 		$jzmoney  = $this->getapiquchongzhi($datass);	
	 		$ptmoney = round($dafamoney+$jzmoney,2);
			}else{
			 $ptmoney = 0;	
			}
       
             
            
            
            
            
            
            $result = array("total" => $total, "rows" => $data2,"extend" => ['sjdqye' => $sjdqye, 'zhichutuihui' => $zhichutuihui, 'qitashouru' => $qitashouru, 'kehulaikuan' => $kehulaikuan, 'huanhuizhuanru' => $huanhuizhuanru, 'huanhunzhuanchu' => $huanhunzhuanchu, 'chukuan' => $chukuan, 'zhichu' => $zhichu, 'zhuanru' => $zhuanru, 'zhuanchu' => $zhuanchu, 'shouxufei' => $shouxufei, 'shishiyue' => $shishiyue, 'zhglssye' => $zhglssye,'num'=>$num,'cxtj'=>$cxtj,'ptmoney'=>$ptmoney]);
            

            
            
            
            
            

            return json($result);
        }
        return $this->view->fetch();
    }








    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    
	
	public function qubizhong($type){
		if($type == 0){
			return '人民币';
		
		
		}else{
			
		return '美金';
			
		}
		
	}
public function quzhuangtai($type){
		//状态:0=正常使用,1=三方未结,2=临时停用,3=临时冻结,4=永久停用,5=永久冻结
	if($type == 0){
		
	 return '正常使用';
	}else if($type == 1){
		return '三方未结';
		
		
	}else if($type == 2){
		return '临时停用';
		
		
	}else if($type == 1){
		return '三方未结';
		
		
	}else if($type == 3){
		return '临时冻结';
		
		
	}else if($type == 4){
		return '永久停用';
		
		
	}else if($type == 5){
		return '永久冻结';
		
		
	}


	
		
	}

    //取时间段前余额
  
    public function qushijianduanqianmoney($bank)
    {
        //$bank['id']
        //$bank['time']
        $cxtj = [];
        if ($bank['time']) {
            $this->model = new \app\admin\model\Zhangbian;  //实例化账变记录表
            $cxtj['nameid'] = $bank['id'];
            $cxtj['createtime'] =  array('between', array(100,$bank['time'][0]));
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
   

    //取收入type = -1 全部  type =0 客户入款 type = 1 支出退回 type = 2 其它收入
    public function qushouru($bank)
    {
        //$bank['id']
        //$bank['time']
        //$bank['type']
        $cxtj = [];
        if ($bank['time']) {
            $cxtj['createtime'] =  array('between', $bank['time']);
        }
        if ($bank['type'] != -1) {
            $cxtj['status'] = $bank['type'];
        }
        $cxtj['Redeemintotheaccountid'] = $bank['id'];
        $this->model = new \app\admin\model\Incomerecord;  //实例化收入表
        return  $this->model->where($cxtj)->sum('Amount');
    }
    //中转表
    public function zhongzhuan($bank)
    {
        //$bank['id']
        //$bank['time']
        //$bank['type'] 0 转入  1转出
       
        $this->model = new \app\admin\model\Transferoffunds;  //实例化中转表
        $cxtj = [];
        if ($bank['time']) {
            $cxtj['createtime'] =  array('between', $bank['time']);
        }
        if ($bank['type'] == 0) {
            $cxtj['Redeemintotheaccountid'] = $bank['id'];
        } else {
            $cxtj['Redeemtheaccouid'] = $bank['id'];
        }
        return  $this->model->where($cxtj)->sum('Amount');
    }

    //支出
    public function zhichu($bank)
    {
	$this->model = new \app\admin\model\Expenditurerecord; 	//实例化支出表
	$cxtj = [];
	if ($bank['time']) {
            $cxtj['createtime'] =  array('between', $bank['time']);
    }	
	$cxtj['Redeemtheaccouid'] = $bank['id'];	
	 return  $this->model->where($cxtj)->sum('Amount');
    }
    //换汇
    public function huanhui($bank)
    {
	//type = 0 收入  type 1 = 支出
	$this->model = new \app\admin\model\Exchangeshuanhui; 	//实例化换汇表
	 if ($bank['time']) {
		   $cxtj['createtime'] =  array('between', $bank['time']); 
	 }
    if ($bank['type'] == 0) {
		$cxtj['Redeemintotheaccountid'] = $bank['id'];	
		return  $this->model->where($cxtj)->sum('Redemptioamount');
		
	}else{
		$cxtj['Redeemtheaccouid'] = $bank['id'];	
		return  $this->model->where($cxtj)->sum('CashoutAmount');	
		
	}
	 
		
    }
    //手续费
    public function shouxufei($bank)
    {
	 //支出手续费
     //中转手续费
     //换汇手续费
     //出款手续费
	 $this->model = new \app\admin\model\Expenditurerecord; 	//实例化支出表
	  $cxtj = [];
     if($bank['time']) {
      $cxtj['createtime'] =  array('between', $bank['time']);
     }	
	 $cxtj['Redeemtheaccouid'] = $bank['id'];	
	 $zhichushouxufei  = $this->model->where($cxtj)->sum('Handlingee');	
	$this->model = new \app\admin\model\Transferoffunds;  //实例化中转表
     $cxtj = [];
     if($bank['time']) {
      $cxtj['createtime'] =  array('between', $bank['time']);
     }	
	 $cxtj['Redeemtheaccouid'] = $bank['id'];	
	 $zhongzhuanshouxufei  = $this->model->where($cxtj)->sum('Handlingee');	
 	
	$this->model = new \app\admin\model\Exchangeshuanhui;  //实例化换汇表
     $cxtj = [];
     if($bank['time']) {
      $cxtj['createtime'] =  array('between', $bank['time']);
     }	
	 $cxtj['Redeemtheaccouid'] = $bank['id'];	
	$huanhuishouxufei =  $this->model->where($cxtj)->sum('Handlingee');		
	$this->model = new \app\admin\model\Paymentmanagement; 	//实例化出款表
     $cxtj = [];
     if($bank['time']) {
      $cxtj['createtime'] =  array('between', $bank['time']);
     }	
	 $cxtj['Redeemtheaccouid'] = $bank['id'];	
	$chukuanshouxufei =  $this->model->where($cxtj)->sum('Handlingee');
 
 
   return $zhichushouxufei + $zhongzhuanshouxufei +  $huanhuishouxufei + $chukuanshouxufei;

		
		
    }

//出款

public function chukuan( $bank){
$this->model = new \app\admin\model\Paymentmanagement; 	//实例化出款表
     $cxtj = [];
     if($bank['time']) {
      $cxtj['createtime'] =  array('between', $bank['time']);
     }	
	 $cxtj['Redeemtheaccouid'] = $bank['id'];	
	return $this->model->where($cxtj)->sum('Amount');	
}


//取平台重置金额

 public function getapiquchongzhi($data){
 //$data['kssj']
 //$data['jssj']
 $data['mima'] = 'czCTFOTzMFb30vCtwgz1wHv1tajJoo1gGnVWjT9';
  //$data['url'] 
  //https://m.277192.com/Apijiekou.quzongcunkuan.do?mima=czCTFOTzMFb30vCtwgz1wHv1tajJoo1gGnVWjT9&kssj=2019-09-17%2000:00:00&jssj=2019-09-18%2000:00:00
 
 $url = $data['url'].'?mima='.$data['mima'].'&kssj='.$data['kssj'].'&jssj='.$data['jssj'];
 $json = $this->http_request($url);
 $arr = json_decode($json, true);
 
 
 if(!$arr['code']){
 $money = 0;	
 }else{
 $money = $arr['Quantity'];
 
 	
 }
 
return $money;
 
 
 }

  public function http_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (! empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
 
}





    public function quzhanghu($data)
    {
        //$data['source']
        //$data['status']
        $cxtj = [];
        $this->model = new \app\admin\model\Accountmanagement;
        if ($data['source'] == -1  and $data['status'] == -1) {
            $bankelist = $this->model->where($cxtj)->select();
            return  $bankelist;
        }
        if($data['name']){
         $zhanghu = explode('|',$data['name']);	
         $cxtj['name'] = $zhanghu[0];
          $cxtj['type'] = $zhanghu[1];
        	
        }
        
        if ($data['source'] != -1) {
            $cxtj['source'] = $data['source'];
        }
        if ($data['status'] != -1) {
            $cxtj['status'] = $data['status'];
        }
        $bankelist = $this->model->where($cxtj)->select();
        return  $bankelist;
    }
}
