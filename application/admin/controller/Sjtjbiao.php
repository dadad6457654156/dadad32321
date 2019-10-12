<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;
/**
 * 数据报表
 *
 * @icon fa fa-circle-o
 */
class Sjtjbiao extends Backend
{
    
    /**
     * Accountmanagement模型对象
     * @var \app\admin\model\Accountmanagement
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Accountmanagement;
        $this->view->assign("sourceList", $this->model->getSourceList());
        $this->view->assign("statusList", $this->model->getStatusList());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    
    public function index()
    {
        //设置过滤方法
 
 
 
  //$status = input('status');
   // $kaishishijian = input('kaishishijian');      
         
         
         
        return $this->fetch();
    }

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
                    
                    
                    
                    $where = [];
                    $where["name"] = $params['name'];
                    $where["type"] = $params["type"];
                    $int = $this->model->where($where)->find();
                    if($int){
                      $this->error(__('账户已存在!'));	
                    	
                    }
                    //var_dump($params);exit;
                    
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

public function arraySort($array, $keys, $sort = SORT_DESC) {
    $keysValue = [];
    foreach ($array as $k => $v) {
        $keysValue[$k] = $v[$keys];
    }
    array_multisort($keysValue, $sort, $array);
    return $array;
}





public function zhichu(){
	
$status = input('status');
$Startingtime= input('Startingtime');
$EndTime= input('EndTime');

if(!$status){
$this->model = new \app\admin\model\Expenditurerecord;	
//币种，部门 时间 
$cxtj = [];
$cxtj['source'] = 0;
if($Startingtime and $EndTime){
$cxtj['createtime'] = ['between time', [strtotime($Startingtime), strtotime($EndTime)+86400]];
}
$typelist = $this->model->where($cxtj)->group('type')->column('type');
$data = [];
foreach ($typelist as $key => $value) {
$cxtj['type'] = $value;
$money = $this->model->where($cxtj)->sum('Amount');
if(!$money){
$money = 0;	
}
if($money > 0){
$data[] =  $money;
}else{
	unset($typelist[$key]);
}
}
$typelists = [];
foreach ($typelist as $key => $value) {
$typelists[] = $value	;
}
}
if($status==1){
$this->model = new \app\admin\model\Expenditurerecord;	
//币种，部门 时间 
$cxtj = [];
$cxtj['source'] = 1;
if($Startingtime and $EndTime){
$cxtj['createtime'] = ['between time', [strtotime($Startingtime), strtotime($EndTime)+86400]];
}
$typelist = $this->model->where($cxtj)->group('type')->column('type');
$data = [];
foreach ($typelist as $key => $value) {
$cxtj['type'] = $value;
$money = $this->model->where($cxtj)->sum('Amount');
if(!$money){
$money = 0;	
}
if($money > 0){
$data[] =  $money;
}else{
	unset($typelist[$key]);
}
}
$typelists = [];
foreach ($typelist as $key => $value) {
$typelists[] = $value	;
}
}
if($status==2){
$this->model = new \app\admin\model\Expenditurerecord;	
//币种，部门 时间 
$cxtj = [];
$cxtj['source'] = 0;
if($Startingtime and $EndTime){
$cxtj['createtime'] = ['between time', [strtotime($Startingtime), strtotime($EndTime)+86400]];
}
$typelist = $this->model->where($cxtj)->group('bumen')->column('bumen');
$data = [];
foreach ($typelist as $key => $value) {
$cxtj['bumen'] = $value;
$money = $this->model->where($cxtj)->sum('Amount');
if(!$money){
$money = 0;	
}
if($money > 0){
$data[] =  $money;
}else{
	unset($typelist[$key]);
}
}	
$typelists = [];
foreach ($typelist as $key => $value) {
 
$typelists[$key]  = $this->qubumen($value);	
}
}



if($status==3){
$this->model = new \app\admin\model\Expenditurerecord;	
//币种，部门 时间 
$cxtj = [];
$cxtj['source'] = 1;
if($Startingtime and $EndTime){
$cxtj['createtime'] = ['between time', [strtotime($Startingtime), strtotime($EndTime)+86400]];
}
$typelist = $this->model->where($cxtj)->group('bumen')->column('bumen');
$data = [];
foreach ($typelist as $key => $value) {
$cxtj['bumen'] = $value;
$money = $this->model->where($cxtj)->sum('Amount');
if(!$money){
$money = 0;	
}
if($money > 0){
$data[] =  $money;
}else{
	unset($typelist[$key]);
}
}	
$typelists = [];
foreach ($typelist as $key => $value) {
 
$typelists[$key]  = $this->qubumen($value);	
}
}
if($status==4){
$this->model = new \app\admin\model\Expenditurerecord;	//按部门支出人民币每天
//币种，部门 时间 
$cxtj = [];
$cxtj['source'] = 1;
$tianshu = (strtotime($EndTime)+86400 - strtotime($Startingtime))/86400;
$typelist = [];
$a= 0;
$b = strtotime($Startingtime)-86400;
do {
$b += 86400;
$typelist[] =date("Y-m-d H:i",$b); 
$a+=1;	
} while ($a<$tianshu);


$data = [];
foreach ($typelist as $key => $value) {
$cxtj['createtime'] = ['between time', [strtotime($value), strtotime($value)+86400]];
$money = $this->model->where($cxtj)->sum('Amount');
if(!$money){
$money = 0;	
}
if($money > 0){
$data[] =  $money;
}else{
	unset($typelist[$key]);
}
}
$typelists = [];
foreach ($typelist as $key => $value) {
$typelists[] = $value	;
}
}

if($status==5){
$this->model = new \app\admin\model\Expenditurerecord;	//按部门支出人民币每天
//币种，部门 时间 
$cxtj = [];
$cxtj['source'] = 0;
$tianshu = (strtotime($EndTime)+86400 - strtotime($Startingtime))/86400;
$typelist = [];
$a= 0;
$b = strtotime($Startingtime)-86400;
do {
$b += 86400;
$typelist[] =date("Y-m-d H:i",$b); 
$a+=1;	
} while ($a<$tianshu);


$data = [];
foreach ($typelist as $key => $value) {
$cxtj['createtime'] = ['between time', [strtotime($value), strtotime($value)+86400]];
$money = $this->model->where($cxtj)->sum('Amount');
if(!$money){
$money = 0;	
}
if($money > 0){
$data[] =  $money;
}else{
	unset($typelist[$key]);
}
}
$typelists = [];
foreach ($typelist as $key => $value) {
$typelists[] = $value	;
}
}
if($status==6){


 
$tianshu = (strtotime($EndTime)+86400 - strtotime($Startingtime))/86400;
$typelist = [];
$a= 0;
$b = strtotime($Startingtime)-86400;
do {
$b += 86400;
$typelist[] =date("Y-m-d H:i",$b); 
$a+=1;	
} while ($a<$tianshu);


$data = [];
foreach ($typelist as $key => $value) {

 


$data[] =   $this->qumeiricunkuan($value);
 
}
$typelists = [];
foreach ($typelist as $key => $value) {
$typelists[] = $value	;
}
}

if($status==7){


 
$tianshu = (strtotime($EndTime)+86400 - strtotime($Startingtime))/86400;
$typelist = [];
$a= 0;
$b = strtotime($Startingtime)-86400;
do {
$b += 86400;
$typelist[] =date("Y-m-d H:i",$b); 
$a+=1;	
} while ($a<$tianshu);


$data = [];
foreach ($typelist as $key => $value) {

 


$data[] =   $this->quchukuan($value);
 
}
$typelists = [];
foreach ($typelist as $key => $value) {
$typelists[] = $value	;
}
}



if($status==8){


 
$tianshu = (strtotime($EndTime)+86400 - strtotime($Startingtime))/86400;
$typelist = [];
$a= 0;
$b = strtotime($Startingtime)-86400;
do {
$b += 86400;
$typelist[] =date("Y-m-d H:i",$b); 
$a+=1;	
} while ($a<$tianshu);


$data = [];
foreach ($typelist as $key => $value) {

 


$data[] =   $this->qumeiricunkuan($value) - $this->quchukuan($value);
 
}
$typelists = [];
foreach ($typelist as $key => $value) {
$typelists[] = $value	;
}
}








return json(['code'=>1,'smg'=>'查询成功','typelist'=>$typelists,'money'=>$data]);











}




public function qumeiricunkuan($num){//取部门
$this->model = new \app\admin\model\Incomerecord;
$cxtj = [];//
$cxtj['createtime'] = ['between time', [strtotime($num), strtotime($num)+86400]];
$cxtj['status'] = 0;
$money = $this->model->where($cxtj)->sum('Amount');
if(!$money){
$money = 0;	
}
return $money;
	
	
	
}

public function quchukuan($num){//取部门
$this->model = new \app\admin\model\Paymentmanagement;
$cxtj = [];//
$cxtj['createtime'] = ['between time', [strtotime($num), strtotime($num)+86400]];
$money = $this->model->where($cxtj)->sum('Amount');
if(!$money){
$money = 0;	
}
return $money;
	
	
	
}





public function qubumen($num){//取部门
if($num==0){
	return '推广';
}else if($num==1){
return '后台';	
}else if($num==2){
return '引流';	
}else if($num==3){
return '股票';	
}else if($num==4){
return '新项目';	
}
else if($num==5){
return '公司';	
}else if($num==6){
return '公司';	
}

	
	
}
public function bumenzhichuleixingbaobiao(){//部门支出类型报表
	
	
}





public  function getStrOne($str){  
    if(empty($str)) return ''; 
 
    $fchar = ord($str{0});  
    if($fchar >= ord('A') && $fchar <= ord('z')) return strtoupper($str{0});
 
    $s1 = iconv('UTF-8','GB2312//TRANSLIT//IGNORE',$str);  
    $s2 = iconv('GB2312','UTF-8//TRANSLIT//IGNORE',$s1);  
    $s = $s2==$str ? $s1 : $str;  
    $asc = @ord($s{0})*256+@ord($s{1})-65536;  
 
    if($asc>=-20319 && $asc<=-20284) return 'A';  
    if($asc>=-20283 && $asc<=-19776) return 'B';  
    if($asc>=-19775 && $asc<=-19219) return 'C';  
    if($asc>=-19218 && $asc<=-18711) return 'D';  
    if($asc>=-18710 && $asc<=-18527) return 'E';  
    if($asc>=-18526 && $asc<=-18240) return 'F';  
    if($asc>=-18239 && $asc<=-17923) return 'G';  
    if($asc>=-17922 && $asc<=-17418) return 'H';  
    if($asc>=-17417 && $asc<=-16475) return 'J';  
    if($asc>=-16474 && $asc<=-16213) return 'K';  
    if($asc>=-16212 && $asc<=-15641) return 'L';  
    if($asc>=-15640 && $asc<=-15166) return 'M';  
    if($asc>=-15165 && $asc<=-14923) return 'N';  
    if($asc>=-14922 && $asc<=-14915) return 'O';  
    if($asc>=-14914 && $asc<=-14631) return 'P';  
    if($asc>=-14630 && $asc<=-14150) return 'Q';  
    if($asc>=-14149 && $asc<=-14091) return 'R';  
    if($asc>=-14090 && $asc<=-13319) return 'S';  
    if($asc>=-13318 && $asc<=-12839) return 'T';  
    if($asc>=-12838 && $asc<=-12557) return 'W';  
    if($asc>=-12556 && $asc<=-11848) return 'X';  
    if($asc>=-11847 && $asc<=-11056) return 'Y';  
    if($asc>=-11055 && $asc<=-10247) return 'Z';  
    return '~';  
}	



public  function getmoney(){  
	
$this->model = new \app\admin\model\Accountmanagement;
$where = [];
$idlist = $this->model->where($where)->column('id');
//var_dump($idlist);
 
foreach($idlist as $k=>$v){ 
$money = action('Incomerecord/zhuanchuqianjieyue',$v);
$money = round($money,2);
$data = [];
$data['id'] = $v;
$data['money'] = $money;

$this->xiugaiyue($data);

} 	
}


  public function xiugaiyue($datas){ //修改实时余额  
	 $this->model = new \app\admin\model\Accountmanagement;	//初实化账户管理

       $int = $this->model->where('id',  $datas['id'])
    ->update(['balance' => $datas['money'] ]);
     
	 
	 
	 echo $int;
	 return  1 ;	
	}	

 public function groupByInitials(array $data, $targetKey = 'name')
    {
        $data = array_map(function ($item) use ($targetKey) {
            return array_merge($item, [
                'initials' => $this->getInitials($item[$targetKey]),
            ]);
        }, $data);
        $data = $this->sortInitials($data);
        return $data;
    }

    /**
     * 按字母排序
     * @param  array  $data
     * @return array
     */
    public function sortInitials(array $data)
    {
        $sortData = [];
        foreach ($data as $key => $value) {
            $sortData[$value['initials']][] = $value;
        }
        ksort($sortData);
        return $sortData;
    }
    
    /**
     * 获取首字母
     * @param  string $str 汉字字符串
     * @return string 首字母
     */
    public function getInitials($str)
    {
        if (empty($str)) {return '';}
        $fchar = ord($str{0});
        if ($fchar >= ord('A') && $fchar <= ord('z')) {
            return strtoupper($str{0});
        }

        $s1  = iconv('UTF-8', 'gb2312', $str);
        $s2  = iconv('gb2312', 'UTF-8', $s1);
        $s   = $s2 == $str ? $s1 : $str;
        $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
        if ($asc >= -20319 && $asc <= -20284) {
            return 'A';
        }

        if ($asc >= -20283 && $asc <= -19776) {
            return 'B';
        }

        if ($asc >= -19775 && $asc <= -19219) {
            return 'C';
        }

        if ($asc >= -19218 && $asc <= -18711) {
            return 'D';
        }

        if ($asc >= -18710 && $asc <= -18527) {
            return 'E';
        }

        if ($asc >= -18526 && $asc <= -18240) {
            return 'F';
        }

        if ($asc >= -18239 && $asc <= -17923) {
            return 'G';
        }

        if ($asc >= -17922 && $asc <= -17418) {
            return 'H';
        }

        if ($asc >= -17417 && $asc <= -16475) {
            return 'J';
        }

        if ($asc >= -16474 && $asc <= -16213) {
            return 'K';
        }

        if ($asc >= -16212 && $asc <= -15641) {
            return 'L';
        }

        if ($asc >= -15640 && $asc <= -15166) {
            return 'M';
        }

        if ($asc >= -15165 && $asc <= -14923) {
            return 'N';
        }

        if ($asc >= -14922 && $asc <= -14915) {
            return 'O';
        }

        if ($asc >= -14914 && $asc <= -14631) {
            return 'P';
        }

        if ($asc >= -14630 && $asc <= -14150) {
            return 'Q';
        }

        if ($asc >= -14149 && $asc <= -14091) {
            return 'R';
        }

        if ($asc >= -14090 && $asc <= -13319) {
            return 'S';
        }

        if ($asc >= -13318 && $asc <= -12839) {
            return 'T';
        }

        if ($asc >= -12838 && $asc <= -12557) {
            return 'W';
        }

        if ($asc >= -12556 && $asc <= -11848) {
            return 'X';
        }

        if ($asc >= -11847 && $asc <= -11056) {
            return 'Y';
        }

        if ($asc >= -11055 && $asc <= -10247) {
            return 'Z';
        }

        return null;
    }


}
