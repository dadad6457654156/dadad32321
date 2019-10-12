<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;
/**
 * 收入记录
 *
 * @icon fa fa-circle-o
 */
class Incomerecord extends Backend
{
    
    /**
     * Incomerecord模型对象
     * @var \app\admin\model\Incomerecord
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Incomerecord;
        $this->view->assign("sourceList", $this->model->getSourceList());
        $this->view->assign("statusList", $this->model->getStatusList());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    

    /**
     * 查看
     */
    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = false;
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax())
        {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField'))
            {
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

            foreach ($list as $row) {
                $row->visible(['id','Redeemintotheaccount','Amount','Redeemintotheaccountqmoney','dingdanhao','Redeemintotheaccounthmoney','source','beizhu','huiyuanzhanghao','pingtaidingdan','status','createtime','updatetime','operator']);
                
            }
            $list = collection($list)->toArray();
            
                 $money = array_sum(array_map(function($val){return $val['Amount'];}, $list));
             
		        if(!count($list)){
             $price = 0;	
             }else{
		    $price = $money/count($list);
             }
            
            $result = array("total" => $total, "rows" => $list, "extend" => ['money' =>$money, 'price' => $price]);

            return json($result);
        }
        return $this->view->fetch();
    }
	
	
	
	    public function add()
    {
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);
				$params['Redeemintotheaccountid'] = $this->bankid($params['Redeemintotheaccount']);
				$params['Redeemintotheaccountqmoney'] = $this->zhuanchuqianjieyue($params['Redeemintotheaccountid']);
				$params['Redeemintotheaccounthmoney'] = $params['Redeemintotheaccountqmoney'] + $params['Amount'];
			//	var_dump($params['Redeemintotheaccountqmoney']);
			//	var_dump($this->zhangbianhou($params['Redeemintotheaccountid']));
			//	var_dump(round($params['Redeemintotheaccountqmoney'],2));exit;
				//round($this->zhangbianhou($params['Redeemintotheaccountid']),2)
				if(round($this->zhangbianhou($params['Redeemintotheaccountid']),2) != round($params['Redeemintotheaccountqmoney'],2)){
					 $this->error(__('账变前资金不符，请核对！', ''));
					
				} 
				//var_dump($params);exit;
				
				 $dingdanhao = $this->dingdanhao();  
				    $this->model = new \app\admin\model\Incomerecord;
              //var_dump($params);exit;
                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->id;
                }
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                        $this->model->validateFailException(true)->validate($validate);
                    }
                    $params["dingdanhao"] = $dingdanhao;
                    if(!$params["createtime"]){
                     $params["createtime"] = time();
                     $result = $this->model->allowField(true)->save($params);	
                    }else{
                    if(!$this->isDatetime($params["createtime"])){
                    	 $this->error(__('时间格式输入有误！'));
                    }
                    	
                    //var_dump($params);exit;	
                    $params["createtime"] = strtotime($params["createtime"]);
                    //var_dump($params["createtime"]);exit;
                    $result = $this->model->allowField(true)->save($params);	
                    }
                    
                    
                    Db::commit();
                } catch (ValidateException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (PDOException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
					$data = [];
					if($params["status"] == 0){
						$data["status"] = 1;
					}else if($params["status"] == 1){
						$data["status"] = 3;
					}else if($params["status"] == 2){
						$data["status"] = 2;
					}
				$data['zhangbianqian'] = $params['Redeemintotheaccountqmoney'];
				$data['zhangbianhou'] = $params['Redeemintotheaccounthmoney'] ;			
				$data['dingdanhao'] = $dingdanhao;
				$data['name'] = $params['Redeemintotheaccount'];
				$data['nameid'] = $params['Redeemintotheaccountid'];
				$data['Amount'] = $params['Amount'];
				$data['operator'] = $params['operator'];
				$data['time'] = $params['createtime'];
				 
				//$this->zhangbianhou($params['Redeemintotheaccountid']);
	
				
					$money = [];
					
					$money['id'] = $params['Redeemintotheaccountid'];
					$money['money'] = $params['Redeemintotheaccounthmoney'];
					
					$this->zhangbianruku($data);
				$this->xiugaiyue($money);
					
                    $this->success();
                } else {
                    $this->error(__('No rows were inserted'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        return $this->view->fetch();
    }
	
	
	public function dingdanhao(){ //取订单号
	
	$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
$orderSn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
  return $orderSn ;
 
	}
	
	public function bankid($str){ //取账户ID
		$linshi = explode('|',$str);
		if(count($linshi) != 2){
		$this->error(__('账户有误，请重新选择！', ''));		
		}
	 $this->model = new \app\admin\model\Accountmanagement;	//实例化账户模型
	 $where = [];
	 $where['name'] = $linshi[0];
	 $where['type'] = $linshi[1];
	 $bankid = $this->model->where($where)->value('id');
	 if(!$bankid){
	 $this->error(__('账户不存在！', ''));exit;		  
	 }
	 return $bankid;	
	}
	
	
	public function zhuanchuqianjieyue($bankid){ //取初始余额
     $Amount = $this->choushi($bankid) +  
	 $this->shouru($bankid) - 
	 $this->zhuanchu($bankid) + 
	 $this->zhuanru($bankid) - 
	 $this->zhuongzhuanshouxufei($bankid) - 
	 $this->huanlvhuanchu($bankid) + 
	 $this->huilvhuanru($bankid) - 
	 $this->huilvshouxufei($bankid) -  
	 $this->zhichu($bankid) - 
	 $this->zhichushouxufei($bankid)- $this->chukuan($bankid) - $this->chukuanshouxufei($bankid);
	// echo '初始化余额:'.$this->choushi($bankid).'收入金额:'.$this->shouru($bankid).'转出金额:'.$this->zhuanchu($bankid).'转入金额:'.
	 //$this->zhuanru($bankid).'中转手续费:'.$this->zhuongzhuanshouxufei($bankid).'汇率转出金额:'.$this->huanlvhuanchu($bankid).'外汇转入金额:'.$this->huilvhuanru($bankid).'外汇手续费:'.$this->huilvshouxufei($bankid).'支出:'.$this->zhichu($bankid).'支出手续费:'.$this->zhichushouxufei($bankid);
	 
	 
	 
	 
	 
	 
	 //初始化余额 + 收入金额 - 转出金额 + 转入金额 - 中转手续费  - 汇率转出金额 + 外汇转入金额 - 外汇手续费 - 支出  - 支出手续费
	 return $Amount;	
	}	
	

	public function choushi($bankid){ //取初始余额
	 $this->model = new \app\admin\model\Accountmanagement;	//实例化账户模型
	 $where = [];
	 $where['id'] = $bankid;
	 $Amount = $this->model->where($where)->value('Initialbalance'); //取初始余额
	// var_dump($Amount);exit;
	 return $Amount;	
	}
	
	//收入相关表
	public function shouru($bankid){ //取收入金额
	 $this->model = new \app\admin\model\Incomerecord;	//实例化账户模型
	 $where = [];
	 $where['Redeemintotheaccountid'] = $bankid;
	 $Amount = $this->model->where($where)->sum('Amount'); //取初始余额
	  //var_dump($Amount);exit;
	 return $Amount;	
	}	
	
	
	

     //中转表相关	
	public function zhuanchu($bankid){ //取转出金额
	 $this->model = new \app\admin\model\Transferoffunds;	//实例化中转模型
	 $where = [];
	 $where['Redeemtheaccouid'] = $bankid;
	 $Amount = $this->model->where($where)->sum('Amount'); //取转出金额
	 //var_dump($Amount);exit;
	 return $Amount;	
	}		
	public function zhuanru($bankid){ //取转入金额
	 $this->model = new \app\admin\model\Transferoffunds;	//实例化中转模型
	 $where = [];
	 $where['Redeemintotheaccountid'] = $bankid;
	 $Amount = $this->model->where($where)->sum('Amount'); //取转入金额
	 //var_dump($Amount);exit;
	 return $Amount;	
	}		
	public function zhuongzhuanshouxufei($bankid){ //取中转手续费
	 $this->model = new \app\admin\model\Transferoffunds;	//取中转手续费
	 $where = [];
	 $where['Redeemtheaccouid'] = $bankid;
	 $Amount = $this->model->where($where)->sum('Handlingee'); //取中转手续费
	 //var_dump($Amount);exit;
	 return $Amount;	
	}
	
	
	//外汇表相关
	public function huanlvhuanchu($bankid){ //取汇率换出
	 $this->model = new \app\admin\model\Exchangeshuanhui;	//初始化外汇模型
	 $where = [];
	 $where['Redeemtheaccouid'] = $bankid;
	 $Amount = $this->model->where($where)->sum('CashoutAmount'); //取汇率换出
	 //var_dump($Amount);exit;
	 return $Amount;	
	}
	public function huilvhuanru($bankid){ //取外汇换入
	 $this->model = new \app\admin\model\Exchangeshuanhui;	//初始化外汇模型
	 $where = [];
	 $where['Redeemintotheaccountid'] = $bankid;
	 $Amount = $this->model->where($where)->sum('Redemptioamount'); //取初始余额
	 
	 return $Amount;	
	}
	public function huilvshouxufei($bankid){ //取汇率手续费
	 $this->model = new \app\admin\model\Exchangeshuanhui;	//初始化外汇模型
	 $where = [];
	 $where['Redeemtheaccouid'] = $bankid;
	 $Amount = $this->model->where($where)->sum('Handlingee'); //取汇率手续费
	
	 return $Amount;	
	}	
    //支出表相关
	public function zhichu($bankid){ //取支出总额
	 $this->model = new \app\admin\model\Expenditurerecord;	//初始支出模型
	 $where = [];
	 $where['Redeemtheaccouid'] = $bankid;
	 $Amount = $this->model->where($where)->sum('Amount'); //取支出总额
	  
	 return $Amount;	
	}
	public function zhichushouxufei($bankid){ //取支出手续费
	 $this->model = new \app\admin\model\Expenditurerecord;	//初始支出模型
	 $where = [];
	 $where['Redeemtheaccouid'] = $bankid;
	 $Amount = $this->model->where($where)->sum('Handlingee'); //取支出手续费
	 
	 return $Amount;	
	}		
	
	//出款表相关
	public function chukuan($bankid){ //取出款金额
	 $this->model = new \app\admin\model\Paymentmanagement;	//初始出款模型
	 $where = [];
	 $where['Redeemtheaccouid'] = $bankid;
	 $Amount = $this->model->where($where)->sum('Amount'); //取出款金额
	 
	 return $Amount;	
	}	
	
		public function chukuanshouxufei($bankid){ //取出款手续费
	 $this->model = new \app\admin\model\Paymentmanagement;	//初始出款模型
	 $where = [];
	 $where['Redeemtheaccouid'] = $bankid;
	 $Amount = $this->model->where($where)->sum('Handlingee'); //取出款手续费
	 
	 return $Amount;	
	}	
	
	
  public function zhangbianruku($datas){ //账变入库
	 $this->model = new \app\admin\model\Zhangbian;	//初始账变模型
	  
	 			//	$data['zhangbianqian'] = $params['Redeemintotheaccountqmoney'];
				//$data['zhangbianhou'] = $params['Redeemintotheaccounthmoney'] ;			
				//$data['dingdanhao'] = $dingdanhao;
				//$data['name'] = $params['Redeemintotheaccount'];
				//$data['nameid'] = $params['Redeemintotheaccountid'];
				//$data['Amount'] = $params['Amount'];
	  $time = time();
      $this->model->data([
     'dingdan'  =>  $datas['dingdanhao'],
     'name' => $datas['name'],
	 'nameid'  =>  $datas['nameid'],
	 'status'  =>  $datas['status'],
	 'Amount'  =>  $datas['Amount'],
	 'zhangbianq'  =>  $datas['zhangbianqian'],
	 'zhangbianh'  =>  $datas['zhangbianhou'],
	 'createtime'  =>   $datas['time'],
	 'operator'  =>  $datas['operator']                  
     ]);
     $int = $this->model->save();
	// var_dump($int);exit;
	 
	 
	 if(!$int){
	  $this->error(__('账变入库失败，请核查原因！', ''));	 
		 
	 }
	 return  1 ;	
	}		
	
  public function xiugaiyue($datas){ //修改实时余额  
	 $this->model = new \app\admin\model\Accountmanagement;	//初实化账户管理

       $int = $this->model->where('id',  $datas['id'])
    ->update(['balance' => $datas['money'] ]);
     
	 
	 
	// if(!$int){
	//  $this->error(__('修改实时余额失败，请核查原因！', ''));	 
		 
//	 }
	 return  1 ;	
	}			
  public function zhangbianhou($bankid){ //取账变前资金 
     
	 $this->model = new \app\admin\model\Zhangbian;	//实例化账变记录
	 $where = [];
	 $where['nameid'] = $bankid;
	 $zhangbianhou = $this->model->where($where)->order('id desc')->value('zhangbianh');
	 if(is_null($zhangbianhou)){
     $this->model = new \app\admin\model\Accountmanagement;	//实例化账户模型
	 $where = [];
	 $where['id'] = $bankid;
	 $zhangbianhou = $this->model->where($where)->value('Initialbalance'); //取初始余额
	 }
	 
	 
      
 
     $zhangbianhou = floatval($zhangbianhou);
	 
	 
	  
	 return  $zhangbianhou;	
	}	
	
public function isDatetime($param = '', $format = 'Y-m-d H:i:s') 
{ 
    return date($format, strtotime($param)) === $param; 
} 	
	
	
	
}
