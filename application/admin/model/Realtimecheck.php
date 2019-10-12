<?php

namespace app\admin\model;

use think\Model;


class Realtimecheck extends Model
{

    

    

    // 表名
    protected $name = 'realtimecheck';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'iszhengque_text',
        'beiyongjinhedui_text',
        'status_text'
    ];
    

    
    public function getIszhengqueList()
    {
        return ['0' => __('Iszhengque 0'), '1' => __('Iszhengque 1')];
    }

    public function getBeiyongjinheduiList()
    {
        return ['0' => __('Beiyongjinhedui 0'), '1' => __('Beiyongjinhedui 1')];
    }

    public function getStatusList()
    {
        return ['0' => __('Status 0'), '1' => __('Status 1'), '2' => __('Status 2'), '3' => __('Status 3'), '4' => __('Status 4'), '5' => __('Status 5')];
    }


    public function getIszhengqueTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['iszhengque']) ? $data['iszhengque'] : '');
        $list = $this->getIszhengqueList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getBeiyongjinheduiTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['beiyongjinhedui']) ? $data['beiyongjinhedui'] : '');
        $list = $this->getBeiyongjinheduiList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
