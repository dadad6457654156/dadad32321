<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use app\common\model\Category as CategoryModel;
use fast\Tree;
use DB;
use think\Request;
use think\Cache;
/**
 * 分类管理
 *
 * @icon fa fa-list
 * @remark 用于统一管理网站的所有分类,分类可进行无限级分类,分类类型请在常规管理->系统配置->字典配置中添加
 */
class Category extends Backend
{

    /**
     * @var \app\common\model\Category
     */
    protected $model = null;
    protected $categorylist = [];
    protected $noNeedRight = ['selectpage','typeaa','banklist','zhichuapi'];
    

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('app\common\model\Category');

        $tree = Tree::instance();
        $tree->init(collection($this->model->order('weigh desc,id desc')->select())->toArray(), 'pid');
        $this->categorylist = $tree->getTreeList($tree->getTreeArray(0), 'name');
        $categorydata = [0 => ['type' => 'all', 'name' => __('None')]];
        foreach ($this->categorylist as $k => $v) {
            $categorydata[$v['id']] = $v;
        }
        $typeList = CategoryModel::getTypeList();
        $this->view->assign("flagList", $this->model->getFlagList());
        $this->view->assign("typeList", $typeList);
        $this->view->assign("parentList", $categorydata);
        $this->assignconfig('typeList', $typeList);
    }

    /**
     * 查看
     */
    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            $search = $this->request->request("search");
            $type = $this->request->request("type");

            //构造父类select列表选项数据
            $list = [];

            foreach ($this->categorylist as $k => $v) {
                if ($search) {
                    if ($v['type'] == $type && stripos($v['name'], $search) !== false || stripos($v['nickname'], $search) !== false) {
                        if ($type == "all" || $type == null) {
                            $list = $this->categorylist;
                        } else {
                            $list[] = $v;
                        }
                    }
                } else {
                    if ($type == "all" || $type == null) {
                        $list = $this->categorylist;
                    } elseif ($v['type'] == $type) {
                        $list[] = $v;
                    }
                }
            }

            $total = count($list);
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

    /**
     * 编辑
     */
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

                if ($params['pid'] != $row['pid']) {
                    $childrenIds = Tree::instance()->init(collection(\app\common\model\Category::select())->toArray())->getChildrenIds($row['id']);
                    if (in_array($params['pid'], $childrenIds)) {
                        $this->error(__('Can not change the parent to child'));
                    }
                }

                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.edit' : $name) : $this->modelValidate;
                        $row->validate($validate);
                    }
                    $result = $row->allowField(true)->save($params);
                    if ($result !== false) {
                        $this->success();
                    } else {
                        $this->error($row->getError());
                    }
                } catch (\think\exception\PDOException $e) {
                    $this->error($e->getMessage());
                } catch (\think\Exception $e) {
                    $this->error($e->getMessage());
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign("row", $row);
        return $this->view->fetch();
    }


    /**
     * Selectpage搜索
     *
     * @internal
     */
    public function selectpage()
    {
        return parent::selectpage();
    }
	
	
	  public function typeaa()
    {    
	 $this->model = new \app\admin\model\Accounttypes;
		//$accounttypeslist = new accounttypeslist::get(1);
	 $accounttypeslist = $this->model->where('status', 1)->column('type','id');
	 $data = array();
	 foreach ($accounttypeslist as $from => $to) {
	 $linshi= [];
	 $linshi['id'] = $from;
     $linshi['name'] = $accounttypeslist[$from];
	 $linshi['value'] = $accounttypeslist[$from];
	 $data[] = $linshi;
	 
     }
	 
	 			 $w = [];
foreach ($data as $k =>$v) {  
    $data[$k]['key'] = $this->getStrOne($v['name']);
    $w[$k] = $this->getStrOne($v['name']);
}
array_multisort($w,SORT_STRING,SORT_ASC,$data);
 $data = $this->arraySort($data, 'name', SORT_DESC);
	 
	 
	 
	 $datas = [];
	 $datas['code'] = 1;
	 $datas['data'] = $data;
	 $datas['wait'] = count($data);
     $datas['msg'] = '';
	 $datas['url'] = "/";
     return json($datas);
    }
		  public function banklist()
    {    
    	$options = [
     // 缓存类型为File
    'type'   => 'File', 
     // 缓存有效期为永久有效
    'expire' => 0,
     // 指定缓存目录
    'path'   => APP_PATH . 'runtime/cache/', 
];

// 缓存初始化
// 不进行缓存初始化的话，默认使用配置文件中的缓存配置
cache($options);

// 设置缓存数据
 
// 获取缓存数据
 
// 删除缓存数据
 

// 设置缓存的同时并且进行参数设置
 
      	
     $name  =   Request::instance()->param('name');
     $data = cache('data'.$name);
     //var_dump($data);exit;
     if(!$data){
	 $this->model = new \app\admin\model\Accountmanagement;
	   
		//$accounttypeslist = new accounttypeslist::get(1);
	 $accounttypeslist = $this->model->field('id,name,type')->select();
	 $data = array();
	 foreach ($accounttypeslist as $from => $to) {
	 $linshi= [];
	 $linshi['id'] = $from;
     $linshi['name'] = $accounttypeslist[$from]['name'].'|'.$accounttypeslist[$from]['type'];
	 $linshi['value'] = $accounttypeslist[$from]['name'].'|'.$accounttypeslist[$from]['type'];
	 $data[] = $linshi;
	 
     }
      
     if($name){
     foreach($data as $k=>$v){
     
if(strpos($data[$k]['name'],$name) !== false){ 
  
}else{
unset($data[$k]);	
}

     
     }
	 
	 }

	 	 			 $w = [];
foreach ($data as $k =>$v) {  
    $data[$k]['key'] = $this->getStrOne($v['name']);
    $w[$k] = $this->getStrOne($v['name']);
}
array_multisort($w,SORT_STRING,SORT_ASC,$data);


 $data = $this->arraySort($data, 'name', SORT_DESC);
 cache('data'.$name, $data, 3600);
}
 
	 $datas = [];
	 $datas['code'] = 1;
	 $datas['data'] = $data;
	 $datas['wait'] = count($data);
     $datas['msg'] = '';
	 $datas['url'] = "/";
     return json($datas);
    }
	//支出类型管理
		  public function zhichuapi()
    {    
	 $this->model = new \app\admin\model\Zccategory;
		//$accounttypeslist = new accounttypeslist::get(1);
	 $accounttypeslist = $this->model->where('status', 1)->column('type','id');
	 $data = array();
	 foreach ($accounttypeslist as $from => $to) {
	 $linshi= [];
	 $linshi['id'] = $from;
     $linshi['name'] = $accounttypeslist[$from];
	 $linshi['value'] = $accounttypeslist[$from];
	 $data[] = $linshi;
	 
     }
	 
	 			 $w = [];
foreach ($data as $k =>$v) {  
    $data[$k]['key'] = $this->getStrOne($v['name']);
    $w[$k] = $this->getStrOne($v['name']);
}
array_multisort($w,SORT_STRING,SORT_ASC,$data);




 
 $data = $this->arraySort($data, 'name', SORT_DESC);
 
 
 
	 $datas = [];
	 $datas['code'] = 1;
	 $datas['data'] = $data;
	 $datas['wait'] = count($data);
     $datas['msg'] = '';
	 $datas['url'] = "/";
     return json($datas);
    }
	public function arraySort($array, $keys, $sort = SORT_DESC) {
    $keysValue = [];
    foreach ($array as $k => $v) {
        $keysValue[$k] = $v[$keys];
    }
    array_multisort($keysValue, $sort, $array);
    return $array;
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

	
	
	
	
	
	
	
	
	
	
	
}
