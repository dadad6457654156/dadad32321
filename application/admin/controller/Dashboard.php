<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Config;
use think\Db;
/**
 * 控制台
 *
 * @icon fa fa-dashboard
 * @remark 用于展示当前系统中的统计数据、统计报表及重要实时数据
 */
class Dashboard extends Backend
{

    /**
     * 查看
     */
	 protected $model = null;
    public function index()
    {
        $seventtime = \fast\Date::unixtime('day', -7);
        $paylist = $createlist = [];
        for ($i = 0; $i < 7; $i++)
        {
            $day = date("Y-m-d", $seventtime + ($i * 86400));
            $createlist[$day] = mt_rand(20, 200);
            $paylist[$day] = mt_rand(1, mt_rand(1, $createlist[$day]));
        }
        $hooks = config('addons.hooks');
        $uploadmode = isset($hooks['upload_config_init']) && $hooks['upload_config_init'] ? implode(',', $hooks['upload_config_init']) : 'local';
        $addonComposerCfg = ROOT_PATH . '/vendor/karsonzhang/fastadmin-addons/composer.json';
        Config::parse($addonComposerCfg, "json", "composer");
        $config = Config::get("composer");
        $addonVersion = isset($config['version']) ? $config['version'] : __('Unknown');
        $zhichudairuzhang = $this->quyue(90);//支出待入账
        $chushijieyu = $this->cszc(0);//取初始资产
        $renminbicunkuan = $this->shouru(['source'=> 0,'status'=>0 ]);//取人民币存款
        $renminbituikuan =$this->shouru(['source'=> 0,'status'=>1 ]);//取人民币退款
        $renminbiqitashouru = $this->shouru(['source'=> 0,'status'=>2 ]);//取其它收入
        $renminbiduimeijinzhuanchu = $this->waihuizhuanchu(['status'=> 1 ]);//取人民币兑美金支出
        $renminbiduimeijinzhuanru = $this->waihuizhuanru(['status'=> 2 ]);//取美金兑人民币转入
        $renminbizhichu = $this->zhichu(['source'=> 0 ]);//取人民币支出
        $renminbichukuan = $this->chukuan();//取出款资金
        $renminbishouxufei = $this->qushouxufei(['source'=> 0 ]);//取手续费
        $wuzhukuandairuzhang = $this->quyue(100);//取人民币无主款
        $shourudairuzhang = $this->quyue(101);//取收入待入账
        $zhichudairuzhang = $this->quyue(90);//取支出待入账
        $renminbilinshidongjie = $this->renminbibeiyong(2);//取冻结资金
        $renminbibeiyongjin = $this->renminbibeiyong(0);//取备用金资金
        $renminbisanfangweijie = $this->renminbibeiyong(3);//取人民币三方未结算资金
       // var_dump($wuzhukuandairuzhang);exit;
        //取净盈亏 = 人民币存款+人民币退款+人民币其它收入-人民币支出-人民币出款 - 人民币支出待入账 - 无主款待入账 - 手续费
        $renminbijingyingkui = $renminbicunkuan + $renminbituikuan + $renminbiqitashouru - $renminbizhichu - $renminbichukuan - $zhichudairuzhang -  $wuzhukuandairuzhang -$renminbishouxufei ;
       // $renminbijingzichan = 初始资产+人民币净收支+美金兑人民币转入-人民币兑美金支出
       $renminbijingzichan = $chushijieyu +$renminbijingyingkui+$renminbiduimeijinzhuanru-$renminbiduimeijinzhuanchu;
       
       //公司取正常资产 = 人民币净资产 - 临时冻结资产
       $zhengchangzichan = $renminbijingzichan - $renminbilinshidongjie;
       //取后台可用流动资产 = 取正常资产 - 三方未结资产
       
       
       
       
        //var_dump($renminbiduimeijinzhuanru);exit;
        
        $meijinchoushizichan =  $this->cszc(1);//取美金初始结余 
        $meijintuikuan = $this->shouru(['source'=> 1,'status'=>1 ]);//取美金退款
        $meijinqitashouru = $this->shouru(['source'=> 1,'status'=>2 ]);//取美金其它收入
        $meijinduimeijinzhuanchu = $this->waihuizhuanchu(['status'=> 2 ]);//美金兑人民币支出
        $meijinduimeijinzhuanru = $this->waihuizhuanru(['status'=> 1 ]);//人民币兑美金收入
        $meijinzhichu = $this->zhichu(['source'=> 1 ]);//取美金支出
        $meijinshouxufei = $this->qushouxufei(['source'=> 1 ]);//取美金手续费
        $meijinzhichudairuzhang  = $this->quyue(102);//取美金支出待入账
        $yinliuchoujiangbeiyong = $this->quyue(38);//引流抽奖备用
        $tuiguangchoujiangbeiyong = $this->quyue(39);//推广抽奖备用
        //美金净资产 = 取美金初始结余 + 取美金退款 + 取美金其它收入-美金兑人民币支出+人民币兑美金收入-取美金支出-取美金手续费-取美金支出待入账
       // var_dump($meijinduimeijinzhuanchu);exit;
        $meijinjingzichan = $meijinchoushizichan + $meijintuikuan + $meijinqitashouru - $meijinduimeijinzhuanchu + $meijinduimeijinzhuanru - $meijinzhichu - $meijinshouxufei - $meijinzhichudairuzhang;
        $this->view->assign([
            'totaluser'        => $chushijieyu,//初始资产
			'renminbicunkuan'  =>$renminbicunkuan,//人民币存款
			'renminbituikuan'  =>$renminbituikuan,//人民币退款
			'renminbiqitashouru'  =>$renminbiqitashouru,//其它收入
			'renminbiduimeijinzhuanchu'=>$renminbiduimeijinzhuanchu,//人民币兑美金支出
			'renminbiduimeijinzhuanru'=>$renminbiduimeijinzhuanru,//美金兑人民币转入
			'renminbizhichu'=>$renminbizhichu,//人民币支出
			'renminbichukuan'=>$renminbichukuan,//人民币出款
			'renminbishouxufei'=>$renminbishouxufei,//取手续费
			
		//	'renminbijingzichan'=> $this->cszc(0) + 
			 //$this->shouru(['source'=> 0,'status'=>0 ]) +  
		//	 $this->shouru(['source'=> 0,'status'=>1 ]) + 
		 	// $this->shouru(['source'=> 0,'status'=>2 ]) +  
			// $this->waihuizhuanru(['status'=> 2 ]) - 
		//	/ $this->waihuizhuanchu(['status'=> 1 ])-
			// $this->zhichu(['source'=> 0 ]) -
			// $this->chukuan()-$this->qushouxufei(['source'=> 0 ]),
			
			
			'renminbijingzichan' =>$renminbijingzichan,
			'wuzhukuandairuzhang'=>$wuzhukuandairuzhang,//无主款待入账
			'shourudairuzhang'=>$shourudairuzhang,//收入待入账
			'zhichudairuzhang'=>$zhichudairuzhang,//支出待入账
			'renminbijingshouzhi'=>$renminbijingyingkui,//人民币净盈亏
			'zhengchangzichan'=>$zhengchangzichan,//正常资产
			'renminbibeiyongjin'=>   $renminbibeiyongjin,
			'renminbilinshidongjie'=>$renminbilinshidongjie,
			'renminbisanfangweijie'=>$renminbisanfangweijie,
            'totalviews'       => 219390,
            'totalorder'       => 32143,
            'totalorderamount' => 174800,
            'todayuserlogin'   => 321,
            'todayusersignup'  => 430,
            'todayorder'       => 2324,
            'unsettleorder'    => 132,
            'sevendnu'         => '80%',
            'sevendau'         => '32%',
            'paylist'          => $paylist,
            'createlist'       => $createlist,
            'addonversion'       => $addonVersion,
			'meijinchoushizichan'       =>$meijinchoushizichan,//美金初始化结余
			'meijintuikuan'  =>$meijintuikuan,//美金退款
			'meijinqitashouru'  =>$meijinqitashouru,//取美金其它收入
			'meijinduimeijinzhuanchu'=>$meijinduimeijinzhuanchu,//美金兑人民币支出
			'meijinduimeijinzhuanru'=>$meijinduimeijinzhuanru,//人民币兑美金收入
			'meijinzhichu'=> $meijinzhichu,//美金支出
			'meijinshouxufei'=>$meijinshouxufei,//美金手续费
			'meijinjingzichan'=>$meijinjingzichan,//美金净资产
			'meijinzhichudairuzhang'=>$meijinzhichudairuzhang,//美金支出待入账
		'yinliuchoujiangbeiyong'	=> $yinliuchoujiangbeiyong,//引流抽奖备用
		'tuiguangchoujiangbeiyong'	=> $tuiguangchoujiangbeiyong,//推广抽奖备用
         
			//'meijinjingzichan'=> $this->cszc(1) + $this->shouru(['source'=> 1,'status'=>2 ]) +
			//$this->shouru(['source'=> 1,'status'=>1 ]) + 
			//$this->waihuizhuanru(['status'=> 1 ]) - $this->waihuizhuanchu(['status'=> 2 ]) -$this->zhichu(['source'=> 1 ]) -$this->qushouxufei(['source'=> 1 ]),
			'meijinjinbeiyongjin'=>$this->renminbibeiyong(1),
            'uploadmode'       => $uploadmode
        ]);

        return $this->view->fetch();
    }
	
	
	
	
	
	
	
	
	
	
	
	    public function cszc($num) //取初始资产
    {
		$this->model = new \app\admin\model\Accountmanagement;	//初始账户模型
		$where = [];
		$where['source'] = $num; 	
		return $this->model->where($where)->sum('Initialbalance');

		
	}
	
	
		    public function quyue($num) //取账户余额
    {
		$this->model = new \app\admin\model\Accountmanagement;	//初始账户模型
		$where = [];
		$where['id'] = $num; 	
		return $this->model->where($where)->sum('balance');

		
	}	
	
	
	
	
	
	
	
	
	
	
	    public function shouru($data,$time = []) //取收入
    {
		
		//var_dump($data);exit;
		$this->model = new \app\admin\model\Incomerecord;	//初始收入模型
		$where = [];
		$where['source'] = $data['source'];
        $where['status'] = $data['status'];
		if(count($time)){
	    $where['createtime'] =  array('between', array($time['kaishitime'],$time['jieshutime']));	
		}
		return $this->model->where($where)->sum('Amount');
	}		
	
		    public function waihuizhuanru($data,$time = []) //外汇转入
    {
		//var_dump($data);exit;
		$this->model = new \app\admin\model\Exchangeshuanhui;	//实例化外汇模型
		$where = [];
        $where['status'] = $data['status'];
		if(count($time)){
	    $where['createtime'] =  array('between', array($time['kaishitime'],$time['jieshutime']));	
		}
		return $this->model->where($where)->sum('Redemptioamount');
	}	

	    public function waihuizhuanchu($data,$time = []) //外汇转出
    {
		//var_dump($data);exit;
		$this->model = new \app\admin\model\Exchangeshuanhui;	//实例化外汇模型
		$where = [];
        $where['status'] = $data['status'];
		if(count($time)){
	    $where['createtime'] =  array('between', array($time['kaishitime'],$time['jieshutime']));	
		}
		return $this->model->where($where)->sum('CashoutAmount');
	}		
	
	    public function zhichu($data,$time = []) //获取支出
    {
		$this->model = new \app\admin\model\Expenditurerecord;	//实例化支出模型
		$where = [];
        $where['source'] = $data['source'];
		if(count($time)){
	    $where['createtime'] =  array('between', array($time['kaishitime'],$time['jieshutime']));	
		}
		return $this->model->where($where)->sum('Amount');
	}		
		
	 public function chukuan($time = []) //获取出款
    {
		$this->model = new \app\admin\model\Paymentmanagement;	//实例化出款模型
		$where = [];
        
		if(count($time)){
	    $where['createtime'] =  array('between', array($time['kaishitime'],$time['jieshutime']));	
		}
		return $this->model->where($where)->sum('Amount');
	}
	
	
		 public function qushouxufei($data,$time = []) //取手续费
    {
        if(!$data['source']){
			$data['status'] = 1;
			return $this->zhichushouxufei($data) + $this->qukuanshouxufei($time) +  $this->zhongzhuanshouxufei($time)  + $this->huilvshouxufei($data,$time);
			
		}else{
			$data['status'] = 2;
			return  $this->zhichushouxufei($data) + $this->huilvshouxufei($data,$time);
			
		}
		return $this->model->where($where)->sum('Amount');
	}
	
	
		public function zhichushouxufei($data,$time = []) //取支出手续费
    {
		$this->model = new \app\admin\model\Expenditurerecord;	//实例化支出模型
		$where = [];
        $where['source'] = $data['source'];
		if(count($time)){
	    $where['createtime'] =  array('between', array($time['kaishitime'],$time['jieshutime']));	
		}
		return $this->model->where($where)->sum('Handlingee');
	}
	
		public function qukuanshouxufei($time = []) //取出款手续费
    {
		$this->model = new \app\admin\model\Paymentmanagement;	//实例化出款模型
		$where = [];
       
		if(count($time)){
	    $where['createtime'] =  array('between', array($time['kaishitime'],$time['jieshutime']));	
		}
		return $this->model->where($where)->sum('Handlingee');
	}
			public function zhongzhuanshouxufei($time = []) //取中转手续费
    {
		$this->model = new \app\admin\model\Transferoffunds;	//实例化中转模型
		$where = [];
       
		if(count($time)){
	    $where['createtime'] =  array('between', array($time['kaishitime'],$time['jieshutime']));	
		}
		return $this->model->where($where)->sum('Handlingee');
	}
	
	public function huilvshouxufei($data,$time = []) //取换汇手续费
    {
		$this->model = new \app\admin\model\Exchangeshuanhui;	//实例化外汇模型
		$where = [];
		$where['status'] = $data['status'];
		if(count($time)){
	    $where['createtime'] =  array('between', array($time['kaishitime'],$time['jieshutime']));	
		}
		return $this->model->where($where)->sum('Handlingee');
	}
	
	public function renminbibeiyong($num) //取人民币备用金结余
    {
		$this->model = new \app\admin\model\Accountmanagement;	//实例化外汇模型
		if($num == 0){
		$where = [];
		$where['id'] = 33;	
		return $this->model->where($where)->sum('balance');	
		}
		if($num == 1){
		$where = [];
		$where['id'] = 32;	
		return $this->model->where($where)->sum('balance');	
			
		}
		if($num == 2){
		$where = [];
		$where['status'] = 3;	
		return $this->model->where($where)->sum('balance');	
			
		}	


if($num == 3){
		$where = [];
		$where['status'] = 1;	
		return $this->model->where($where)->sum('balance');	
			
		}			

	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	


	

}
