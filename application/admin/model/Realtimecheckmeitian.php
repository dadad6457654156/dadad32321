<?php

namespace app\admin\model;

use think\Model;


class Realtimecheckmeitian extends Model
{

    

    

    // 表名
    protected $name = 'realtimecheckmeitian';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'shijian_text',
        'iszhengque_text',
        'beiyongjinhedui_text'
    ];
    

    
    public function getShijianList()
    {
        return ['0' => __('Shijian 0'), '1' => __('Shijian 1'), '2' => __('Shijian 2'), '3' => __('Shijian 3'), '4' => __('Shijian 4'), '5' => __('Shijian 5'), '6' => __('Shijian 6'), '7' => __('Shijian 7'), '8' => __('Shijian 8'), '9' => __('Shijian 9'), '10' => __('Shijian 10'), '11' => __('Shijian 11'), '12' => __('Shijian 12'), '13' => __('Shijian 13'), '14' => __('Shijian 14'), '15' => __('Shijian 15'), '16' => __('Shijian 16'), '17' => __('Shijian 17'), '18' => __('Shijian 18'), '19' => __('Shijian 19'), '20' => __('Shijian 20'), '21' => __('Shijian 21'), '22' => __('Shijian 22'), '23' => __('Shijian 23'), '24' => __('Shijian 24'), '25' => __('Shijian 25'), '26' => __('Shijian 26'), '27' => __('Shijian 27'), '28' => __('Shijian 28'), '29' => __('Shijian 29'), '30' => __('Shijian 30'), '31' => __('Shijian 31')];
    }

    public function getIszhengqueList()
    {
        return ['0' => __('Iszhengque 0'), '1' => __('Iszhengque 1')];
    }

    public function getBeiyongjinheduiList()
    {
        return ['0' => __('Beiyongjinhedui 0'), '1' => __('Beiyongjinhedui 1')];
    }


    public function getShijianTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['shijian']) ? $data['shijian'] : '');
        $list = $this->getShijianList();
        return isset($list[$value]) ? $list[$value] : '';
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




}
