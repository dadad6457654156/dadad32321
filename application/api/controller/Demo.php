<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\common\controller\Backend;
use DB;
/**
 * 示例接口
 */
class Demo extends Api
{

    //如果$noNeedLogin为空表示所有接口都需要登录才能请求
    //如果$noNeedRight为空表示所有接口都需要验证权限才能请求
    //如果接口已经设置无需登录,那也就无需鉴权了
    //
    // 无需登录的接口,*表示全部
    protected $noNeedLogin = ['test', 'test1','quzhanghu','chukuanadd'];
    // 无需鉴权的接口,*表示全部
    protected $noNeedRight = ['test2'];
    protected $model = null;
    /**
     * 测试方法
     *
     * @ApiTitle    (测试名称)
     * @ApiSummary  (测试描述信息)
     * @ApiMethod   (POST)
     * @ApiRoute    (/api/demo/test/id/{id}/name/{name})
     * @ApiHeaders  (name=token, type=string, required=true, description="请求的Token")
     * @ApiParams   (name="id", type="integer", required=true, description="会员ID")
     * @ApiParams   (name="name", type="string", required=true, description="用户名")
     * @ApiParams   (name="data", type="object", sample="{'user_id':'int','user_name':'string','profile':{'email':'string','age':'integer'}}", description="扩展数据")
     * @ApiReturnParams   (name="code", type="integer", required=true, sample="0")
     * @ApiReturnParams   (name="msg", type="string", required=true, sample="返回成功")
     * @ApiReturnParams   (name="data", type="object", sample="{'user_id':'int','user_name':'string','profile':{'email':'string','age':'integer'}}", description="扩展数据返回")
     * @ApiReturn   ({
         'code':'1',
         'msg':'返回成功'
        })
     */
    public function test()
    {
    	
    	$private_key = '-----BEGIN PRIVATE KEY-----
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
eu/G45VFl53O10e8kHw7/CDW8QDWug==
-----END PRIVATE KEY-----

';
 
$public_key = '-----BEGIN PUBLIC KEY-----
MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEA56BmVYIEd71crpboo1Kh
IRVlA6TARTwKsYetnEVdzeRGMP0ZBOKmPQ2IyEDMhU8a9w3ZnkAV7K3rFzPJBpql
eOXEqi0hpBgoXNNuBc+LEDht+x12Og9p7iLWH5CmpJh/2N716FqpEFcQ2Vu0j2w1
it66zFyAYPcNPDt5ta+biaSZRSIT0X762UI4g21PHbCgX99q1x4E3CcQ5qDfkH0b
G38aznI7D+LNN+55MyTmAUxix72vWtZZ+fTCJKtk898/R6d0xcwzICEB0xEZ/zZO
/5a30WhZg1TGU5Gwwda3JqAEo5GjQggY29Awj9iO2exhOGT2p+CAXSn5nvCzHEYC
7fQtglXVPvBZHUHW+K/LZprFLu+4owH7DyKi1DB911d4XRMzOwPfravkOJgvgFJr
YKNs0IGjqjSyTcXOQI1p8jYxQQ787fAcTVxP9U7Hgmh1qzfJp833ZOLkVScph4k8
BcaMOdvmTqBEGo2RkRCj90iuf4v6FxhDvOyYkPbWLEd+995pIjt+5yc81qzD6zrw
ldZUxojbVOvDwVl6PRV0Btur8L9AgTJGTCsdFqMAKAmh95k7DOYcZSB6L2Ezq9GC
FTqZ/SoB5PhnGXZ8ZKIkooUfPj+rsyPSLlcz+9RF1yiVjAJlNkpjLpxTg0SOnwbJ
OFdS9UQtMwzCVHjgaHZFk5cCAwEAAQ==
-----END PUBLIC KEY-----
';
 
//echo $private_key;
$pi_key =  openssl_pkey_get_private($private_key);//这个函数可用来判断私钥是否是可用的，可用返回资源id Resource id
$pu_key = openssl_pkey_get_public($public_key);//这个函数可用来判断公钥是否是可用的
print_r($pi_key);echo "\n";
print_r($pu_key);echo "\n";
if(!$pi_key){
 $this->success('私钥无效', $this->request->param());	
}
if(!$pu_key){
 $this->success('公钥无效', $this->request->param());	
} 
$data = "账户管理ID 姓名  账户类型  身份证号 手机号 家庭住址 银行卡号 子账户  登陆用户名 登陆密码  U盾密码   取款密码  身份证正面 身份证反面  银行卡正面 银行卡反面  状态  手机通信状态   备注   购入时间  添加时间  更新时间  ";//原始数据
$encrypted = ""; 
$decrypted = ""; 
 
echo "source data:",$data,"\n";
 
echo "private key encrypt:\n";
 
openssl_private_encrypt($data,$encrypted,$pi_key);//私钥加密
$encrypted = base64_encode($encrypted);//加密后的内容通常含有特殊字符，需要编码转换下，在网络间通过url传输时要注意base64编码是否是url安全的
echo $encrypted,"\n";
 
echo "public key decrypt:\n";
 
openssl_public_decrypt(base64_decode($encrypted),$decrypted,$pu_key);//私钥加密的内容通过公钥可用解密出来
echo $decrypted,"\n";
 
echo "---------------------------------------\n";
echo "public key encrypt:\n";
 
openssl_public_encrypt($data,$encrypted,$pu_key);//公钥加密
$encrypted = base64_encode($encrypted);
echo $encrypted,"\n";
 
echo "private key decrypt:\n";
openssl_private_decrypt(base64_decode($encrypted),$decrypted,$pi_key);//私钥解密
echo $decrypted,"\n";
    	
    	
    	
    	
    	
    	
    	
        $this->success('返回成功', $this->request->param());
    }

    /**
     * 无需登录的接口
     *
     */
    public function test1()
    {
        $this->success('返回成功', ['action' => 'test1']);
    }
        public function type()
    {
        $this->success('返回成功', ['action' => 'test1']);
    }
    /**
     * 需要登录的接口
     *
     */
    public function test2()
    {
        $this->success('返回成功', ['action' => 'test2']);
    }

    /**
     * 需要登录且需要验证有相应组的权限
     *
     */
    public function test3()
    {
        $this->success('返回成功', ['action' => 'test3']);
    }
    
    
    
    public function quzhanghu()
    {
    	$this->model = new \app\admin\model\Accountmanagement;
    	$bankid = input('bankid');
    	$md5 = input('md5');
    	//var_dump($bankid);exit;
    	if(!$bankid){
    	//{"code":1,"msg":"返回成功","time":"1570466181","data":{"action":"test1"}}
    	return json(['code'=>0,'msg'=>"账户id不能未空！"]);
    	}
    	if(!$md5){
    	//{"code":1,"msg":"返回成功","time":"1570466181","data":{"action":"test1"}}
    	return json(['code'=>0,'msg'=>"密钥不能为空！"]);
    	} 
    	if($md5!="61C25513C34DEA04AB41F8905C"){
    	//{"code":1,"msg":"返回成功","time":"1570466181","data":{"action":"test1"}}
    	return json(['code'=>0,'msg'=>"密钥有误请核对！"]);
    	}     	
    	
    	
    	
    	$bank = $this->model->where(['id'=>$bankid])->field('name,type')->find();
	    if(!$bank){
    	//{"code":1,"msg":"返回成功","time":"1570466181","data":{"action":"test1"}}
    	return json(['code'=>0,'msg'=>"账户不存在请核对!"]);
    	}
        
        
    	 
    	
        $this->success('返回成功',  $bank->name."|".$bank->type);
    }   
    
  	    public function chukuanadd()
    {
       
            $params = [];
            $params["Redeemtheaccouid"] = input('Redeemtheaccouid');
            $params["Redeemtheaccount"] = input('Redeemtheaccount');
            $params["Amount"] = input('Amount');
            $params["Handlingee"] = input('Handlingee');
            $params["Redeemtheaccounthmoney"]= input('Redeemtheaccountqmoney');
            $params["Redeemtheaccountqmoney"] = input('Redeemtheaccountqmoney');
            $params['md5'] = input('md5');
            $params['pingtaidingdanhao'] = input('pingtaidingdanhao');
            $params["createtime"] = input('createtime');
            $params["operator"] = input('operator');
            $params["username"] = input('username');
            
            if ($params) {
                
			     
			 
		     	$params["Redeemtheaccount"] = $this->bankname($params["Redeemtheaccouid"]);
				$params["Redeemtheaccountqmoney"] = $this->zhuanchuqianjieyue($params["Redeemtheaccouid"]);
			 
				$params["Redeemtheaccounthmoney"] = $params["Redeemtheaccountqmoney"] - $params["Amount"] - $params["Handlingee"];
				$dingdanhao = $this->dingdanhao();
			    if(round($this->zhangbianhou($params["Redeemtheaccouid"]),2) != round($params["Redeemtheaccountqmoney"],2)){
					 $this->error(__('账变前资金不符，请核对！', ''));
				}
				
				if($params['md5']){
				if($params['md5']!="61C25513C34DEA04AB41F8905C"){
				$this->error(__('密码有误！', ''));		
				}	
					
				}else{
					$this->error(__('密码不能为空！', ''));	
				}
				if($params['pingtaidingdanhao']){
				
				if($this->rukuqianpanduan($params['pingtaidingdanhao'])){
				$this->error(__('订单号已存在，请核对！或手工入账！', ''));
					
				}	
				}else{
				$this->error(__('订单号不能为空，请核对！', ''));	
				}
			   // var_dump($params);exit;
                 $this->model = new \app\admin\model\Paymentmanagement;
                
                $result = false;
                
               
                    //是否采用模型验证
                  
                    $params["dingdanhao"] = $dingdanhao;
                   if(!$params["createtime"]){
                     $params["createtime"] = time();
                     $result = $this->model->allowField(true)->save($params);	
                    }else{
                    if(!$this->isDatetime($params["createtime"])){
                    	 $this->error(__('时间格式输入有误！'));
                    }	
                    	
                    $params["createtime"] = strtotime($params["createtime"]);
                    //var_dump($params["createtime"]);exit;
                    $result = $this->model->allowField(true)->save($params);	
                    	
                    }
                    
                   
                   
           
                    
                    
                
                    
                
               
             
                   
                }
                $result = $this->model->allowField(true)->save($params);
                if ($result !== false) {
					
				$datas= [];
				$datas['zhangbianqian'] = $params["Redeemtheaccountqmoney"];
				$datas['zhangbianhou'] = $params["Redeemtheaccounthmoney"]  + $params['Handlingee'];
				$datas['dingdanhao'] = $dingdanhao;
				$datas['name'] = $params['Redeemtheaccount'];
				$datas['nameid'] = $params['Redeemtheaccouid'];
				$datas['Amount'] = $params['Amount'];
				$datas['operator'] = $params['operator'];
				$datas['status']	= 5;
				$datas['time'] =  $params["createtime"];
				
				
				
				$money = [];
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
				$datas['time'] =  $params["createtime"];
				$this->zhangbianruku($datas);
				$money['id'] = $params['Redeemtheaccouid'];
				$money['money'] = $params["Redeemtheaccounthmoney"];
					 
				 	 
					 
					 
					 
					 
			$int = $this->xiugaiyue($money);
			
			if($int){
				$data = "账变前:".$params["Redeemtheaccountqmoney"]."账变后:".$params["Redeemtheaccounthmoney"];
				return json(['code'=>1,'msg'=>'添加成功','data'=>$data]);
				
			}
	 
    }  
    
  
        
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
	public function bankname($bankid){ //取账户ID
	 
	 $this->model = new \app\admin\model\Accountmanagement;	//实例化账户模型
	 $where = [];
	 $where['id'] = $bankid;
     $bank = $this->model->where($where)->field('name,type')->find();
 
	 if(!$bank){
	 $this->error(__('账户不存在！', ''));exit;		  
	 }
	 return $bank->name."|".$bank->type;	
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
	
	//出款表相关
	public function rukuqianpanduan($pingtaidingdanhao){ //取出款金额
	 $this->model = new \app\admin\model\Paymentmanagement;	//初始出款模型
	 $where = [];
	 $where['pingtaidingdanhao'] = $pingtaidingdanhao;
	 $count = $this->model->where($where)->count(); //取出款金额
	 
	 return $count;	
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
