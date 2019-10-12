<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;
/**
 * 银行卡管理
 *
 * @icon fa fa-circle-o
 */
class Bankcardmanagement extends Backend
{
    
    /**
     * Bankcardmanagement模型对象
     * @var \app\admin\model\Bankcardmanagement
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Bankcardmanagement;
        $this->view->assign("phonenumberstatusList", $this->model->getPhonenumberstatusList());
        $this->view->assign("isopenwechatList", $this->model->getIsopenwechatList());
        $this->view->assign("isopenalipayList", $this->model->getIsopenalipayList());
        $this->view->assign("yanzhengjizhiList", $this->model->getYanzhengjizhiList());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
	 
	 //查看
	 
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
			 
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    } 
	 
	 
	 
	 
	 
	 
	 
	 
	 //添加
       public function add()
    {
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);

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
                    
                
                    
                     $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
                     $params["trae"] = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(100000, 999999));
                     $zhname = $this->qzhname($params["accountmanagementID"]);
                     $params["type"] =   $zhname["type"];
					 $params["name"] = $zhname["name"];
					 $params["IDnumber"] = $this->miwenruku($params["trae"],$this->jiami($params["IDnumber"]),'IDnumber');
					 $params["Homeaddress"] = $this->miwenruku($params["trae"],$this->jiami($params["Homeaddress"]),'Homeaddress');
					 $params["telephone"] = $this->miwenruku($params["trae"],$this->jiami($params["telephone"]),'telephone');
					 $params["Bankcardnumber"] = $this->miwenruku($params["trae"],$this->jiami($params["Bankcardnumber"]),'Bankcardnumber');
					 $params["subBankcardnumber"] = $this->miwenruku($params["trae"],$this->jiami($params["subBankcardnumber"]),'subBankcardnumber');
					 $params["Loginaccount"] = $this->miwenruku($params["trae"],$this->jiami($params["Loginaccount"]),'Loginaccount');
					 $params["loginpassword"] = $this->miwenruku($params["trae"],$this->jiami($params["loginpassword"]),'loginpassword');
					 $params["Ushieldpassword"] = $this->miwenruku($params["trae"],$this->jiami($params["Ushieldpassword"]),'Ushieldpassword');
					 $params["Withdrawalspassword"] = $this->miwenruku($params["trae"],$this->jiami($params["Withdrawalspassword"]),'Withdrawalspassword');
					 $params["IDcardfrontpicturez"] = $this->miwenruku($params["trae"],$this->jiami($params["IDcardfrontpicturez"]),'IDcardfrontpicturez');
					 $params["IDcardreversepictures"] = $this->miwenruku($params["trae"],$this->jiami($params["IDcardreversepictures"]),'IDcardreversepictures');
					 $params["bankcardfrontpicture"] = $this->miwenruku($params["trae"],$this->jiami($params["IDnumber"]),'bankcardfrontpicture');
					 $params["bankcardreversepicture"] = $this->miwenruku($params["trae"],$this->jiami($params["IDnumber"]),'bankcardreversepicture');					 
 					 
					 
					  
					  
					 
					  
					 
				 
					 
 
					 
		             
					  
					 
					 
					 $this->model = new \app\admin\model\Bankcardmanagement;
					 
                   
                    
                    $result = $this->model->allowField(true)->save($params);
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
                    $this->success();
                } else {
                    $this->error(__('No rows were inserted'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        return $this->view->fetch();
    } 
	
	
	
	//编辑
	
	    public function edit($ids = null)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.edit' : $name) : $this->modelValidate;
                        $row->validateFailException(true)->validate($validate);
                    }
                    $result = $row->allowField(true)->save($params);
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
                    $this->success();
                } else {
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign("row", $row);
		
					 //$row["IDnumber"] = $this->qmm($row['IDnumber']);
					// $row["Homeaddress"] = $this->qmm($row['Homeaddress']);
					 //$row["telephone"] = $this->qmm($row['telephone']);
					 //$row["Bankcardnumber"] = $this->qmm($row['Bankcardnumber']);
					// $row["subBankcardnumber"] = $this->qmm($row['subBankcardnumber']);
					 //$row["Loginaccount"] = $this->qmm($row['Loginaccount']);
					 //$row["loginpassword"] = $this->qmm($row['loginpassword']);
					// $row["Ushieldpassword"] = $this->qmm($row['Ushieldpassword']);
					 //$row["Withdrawalspassword"] = $this->qmm($row['Withdrawalspassword']);
					 //$row["IDcardfrontpicturez"] = $this->qmm($row['IDcardfrontpicturez']);
					 //$row["IDcardreversepictures"] = $this->qmm($row['IDcardreversepictures']);
					// $row["bankcardfrontpicture"] = $this->qmm($row['bankcardfrontpicture']);
					// $row["bankcardreversepicture"] = $this->qmm($row['bankcardreversepicture']);			
					$row["IDnumber"] = $this->jiemi($this->qmm($row['IDnumber']));
				$row["Homeaddress"] = $this->jiemi($this->qmm($row['Homeaddress']));
					$row["telephone"] = $this->jiemi($this->qmm($row['telephone']));
					$row["Bankcardnumber"] = $this->jiemi($this->qmm($row['Bankcardnumber']));
					$row["subBankcardnumber"] = $this->jiemi($this->qmm($row['subBankcardnumber']));
					$row["Loginaccount"] = $this->jiemi($this->qmm($row['Loginaccount']));
					$row["loginpassword"] = $this->jiemi($this->qmm($row['loginpassword']));
					 $row["Ushieldpassword"] = $this->jiemi($this->qmm($row['Ushieldpassword']));
					$row["Withdrawalspassword"] = $this->jiemi($this->qmm($row['Withdrawalspassword']));
					$row["IDcardfrontpicturez"] = $this->jiemi($this->qmm($row['IDcardfrontpicturez']));
					$row["IDcardreversepictures"] = $this->jiemi($this->qmm($row['IDcardreversepictures']));
					$row["bankcardfrontpicture"] = $this->jiemi($this->qmm($row['bankcardfrontpicture']));
					 $row["bankcardreversepicture"] = $this->jiemi($this->qmm($row['bankcardreversepicture']));	
		
        return $this->view->fetch();
    }
	
	//删除
    public function del($ids = "")
    {
        if ($ids) {
            $pk = $this->model->getPk();
            $adminIds = $this->getDataLimitAdminIds();
            if (is_array($adminIds)) {
                $this->model->where($this->dataLimitField, 'in', $adminIds);
            }
            $list = $this->model->where($pk, 'in', $ids)->select();

            $count = 0;
            Db::startTrans();
            try {
                foreach ($list as $k => $v) {
                    $count += $v->delete();
                }
                Db::commit();
            } catch (PDOException $e) {
                Db::rollback();
                $this->error($e->getMessage());
            } catch (Exception $e) {
                Db::rollback();
                $this->error($e->getMessage());
            }
            if ($count) {
                $this->success();
            } else {
                $this->error(__('No rows were deleted'));
            }
        }
        $this->error(__('Parameter %s can not be empty', 'ids'));
    }



public function qzhname($bankid){
$this->model = new \app\admin\model\Accountmanagement;	
$where = [];
$where["id"] = $bankid;
$int = $this->model->where($where)->find();	
if(!$int){
$this->error(__('账户管理ID有误请核对!'));             	
}else{
return $int;	
}	
}
public function qmm($miwenid){
$this->model = new \app\admin\model\Miwen;
$where = [];
$where["id"] = $miwenid;
$int = $this->model->where($where)->find();	
if(!$int){
$this->error(__('账户管理ID有误请核对!'));             	
}else{
return $int['mimen'];	
}	
}










    public function jiami($str)
    {
    	
			$private_key = '-----BEGIN PRIVATE KEY-----
	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
	eu/G45VFl53O10e8kHw7/CDW8QDWug==
	-----END PRIVATE KEY-----

';
 
$public_key = '-----BEGIN PUBLIC KEY-----
MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAu5bSSLNTiusXWTXTVEwG
chOx7E9tDBPQmCJjRgg4KHlgzIECtqAPSdFnRqtoA+4T1k/6oKXzaNXpTYJJgCw5
qZ8pdyvCN5ABfmuw0vTpEFRgrj2Tn2VZe3rjBGyhUfvPqt8XJAOihv3tSjZlcL6J
xzub/o8GeNgz6vHIqQ39vOE6CgRxKR9O7dPAOX8YwoH2MllTlEbR9bYqy65BbIRx
n4TbiW82vHCZbFfZvVu+jFRO7W5QXpV5oQ1Bp4uWgWN0pHEUzaqsdbHn42K08LyM
EKrTFL1hFgvGjIaXpzGp8Bd4RahBLoIMEBoZkugvO+63sDVVu14/rn4ezUunb1Df
NeghLmb6DNrEEeCJq5gwUcmWDtmhBjCk2JGoXU6DqvCpQJLzh0skZaX/pnCklt3d
fpVnic2cveLt/X+MCjUyP3J1qX03ytmwrHB0I7aTEhFa2ipNlvWJDvW5rbFQYx4R
so3HLduV5wUHIHecSCgvsr08vs/NCZV0rEPcF8I1z9iB9hzxhXPERL0BxRyw87Ys
NnO0XqM4B6D187TTMTDwOSMKuK39g1OLsRz/18qgPsx9gA6AOa4Yt8Q/bF0Q/rRG
wVuC5RcFaD8XBtW+8xOEZIRF16/Pi9C882FIS3x4MOGxppkeaVS3RYmDTufEvWqi
JsnB6SPLK4Y2vuEvtaZOCX0CAwEAAQ==
-----END PUBLIC KEY-----';
$pi_key =  openssl_pkey_get_private($private_key);//这个函数可用来判断私钥是否是可用的，可用返回资源id Resource id
$pu_key = openssl_pkey_get_public($public_key);//这个函数可用来判断公钥是否是可用的
if(!$pu_key){
$this->error(__('公钥无效!')); 		
} 
$data = $str;
$encrypted = ""; 
openssl_public_encrypt($data,$encrypted,$pu_key);//公钥加密
$encrypted = base64_encode($encrypted);
if(!$encrypted){
$this->error(__('加密失败!')); 	
}
return $encrypted;  
}

  public function miwenruku($trae,$str,$key){
  $this->model = new \app\admin\model\Miwen;		  
  
  $data=[];
  $data['trae']=$trae;
  $data['mimen']=$str;
  $data['key']=$key;
  $data['createtime']=time();
  $data['updatetime']=date('Y-m-d H:i:s');  
  $id = $this->model->insertGetId($data);
  if(!$id){
	$this->error(__('密文入库失败!'));  
  }  
  return $id;	  
  }

public function jiemi($str){
			$private_key = '-----BEGIN PRIVATE KEY-----
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
/d+0I32EE0XHtiB6YU3b71cF8/kn
-----END PRIVATE KEY-----
';
$decrypted = "";	

 

$pi_key =  openssl_pkey_get_private($private_key);//这个函数可用来判断私钥是否是可用的，可用返回	
if(!$pi_key){
	$this->error(__('私钥无效!')); 	
} 
openssl_private_decrypt(base64_decode($str),$decrypted,$pi_key);//私钥解密
return  $decrypted;
	
}











}
