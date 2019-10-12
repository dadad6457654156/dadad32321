<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;
/**
 * 支出记录
 *
 * @icon fa fa-circle-o
 */
class Expenditurerecord extends Backend
{
    
    /**
     * Expenditurerecord模型对象
     * @var \app\admin\model\Expenditurerecord
     */
    protected $model = null;  
  protected $fangfa = null;
    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Expenditurerecord;
        $this->view->assign("sourceList", $this->model->getSourceList());
        $this->view->assign("bumenList", $this->model->getbumenList());
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
                $row->visible(['id','Redeemtheaccount','Amount','Handlingee','dingdanhao','Redeemtheaccountqmoney','Redeemtheaccounthmoney','type','typeid','beizhu','pingzhengimages','bumen','source','createtime','updatetime','operator']);
                
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
		  
		
				$params["Redeemtheaccouid"] = action('Incomerecord/bankid',$params['Redeemtheaccount']);
				$params["Redeemtheaccountqmoney"] = action('Incomerecord/zhuanchuqianjieyue',$params["Redeemtheaccouid"]);
				$params["Redeemtheaccounthmoney"] = $params["Redeemtheaccountqmoney"] - $params["Amount"] - $params["Handlingee"];
				$dingdanhao = action('Incomerecord/dingdanhao');
			 
			 	if(round(action('Incomerecord/zhangbianhou',$params["Redeemtheaccouid"]),2) != round($params["Redeemtheaccountqmoney"],2)){
					 $this->error(__('账变前资金不符，请核对！', ''));
				}
				
				
   ///  $bankid =$this->fangfa->bankid($params['Redeemtheaccount']; 
				
				
		$params["typeid']"] =$this->zhichuid($params["type"]);
      
 $this->model = new \app\admin\model\Expenditurerecord;
 
 
 
 
				
				
				
				
				
				
				
				
				

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
                    	 $this->error(__('时间格式输入有误!'));
                    }	
                    	
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
					$datas= [];
				$datas['zhangbianqian'] = $params["Redeemtheaccountqmoney"];
				$datas['zhangbianhou'] = $params["Redeemtheaccounthmoney"]  + $params['Handlingee'];
				$datas['dingdanhao'] = $dingdanhao;
				$datas['name'] = $params['Redeemtheaccount'];
				$datas['nameid'] = $params['Redeemtheaccouid'];
				$datas['Amount'] = $params['Amount'];
				$datas['operator'] = $params['operator'];
				$datas['time'] = $params["createtime"];
				$datas['status']	= 6;
				
				
				
					$money = [];
					 
		//	$money['id'] = $params['Redeemintotheaccountid'];
			//$money['money'] = $params['Redeemintotheaccounthmoney'];
				$this->zhangbianruku($datas);
				$datas= [];
				$datas['zhangbianqian'] = $params["Redeemtheaccounthmoney"] + $params['Handlingee'];
				$datas['zhangbianhou'] = $params["Redeemtheaccounthmoney"] ;			
				$datas['dingdanhao'] = $dingdanhao;
				$datas['name'] = $params['Redeemtheaccount'];
				$datas['nameid'] = $params['Redeemtheaccouid'];
				$datas['Amount'] = $params['Handlingee'];
				$datas['status']	= 7;
				$datas['operator'] = $params['operator'];
				$datas['time'] = $params["createtime"];
				$this->zhangbianruku($datas);	 
				
				$money['id'] = $params['Redeemtheaccouid'];
				$money['money'] = $params["Redeemtheaccounthmoney"];
					 
				 	 
					 
					 
					 
					 
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
	 'createtime'  =>  $datas['time'],
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
     
	 
	 
	 //if(!$int){
	 // $this->error(__('修改实时余额失败，请核查原因！', ''));	 
//		 
	// }
	 return  1 ;	
	}		
	
	
	  public function zhichuid($str){ //  查询ID  
 

	 $this->model = new \app\admin\model\Zccategory;	//实例化支出类型模型
	 $where = [];
	 $where['type'] = "'".$str."'";
	  
	  
	 $typeid = $this->model->where('type', $str )->value('id');
	 if(!$typeid){
	 $this->error(__('支出类型不存在！', ''));exit;		  
	 }
	 return $typeid;  //支出类型不存在
	}	
	
	
public function isDatetime($param = '', $format = 'Y-m-d H:i:s') 
{ 
    return date($format, strtotime($param)) === $param; 
} 	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
