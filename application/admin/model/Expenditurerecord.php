<?php

namespace app\admin\model;

use think\Model;


class Expenditurerecord extends Model
{

    

    

    // 表名
    protected $name = 'expenditurerecord';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'source_text'
    ];
    

    
    public function getSourceList()
    {
        return ['0' => __('Source 0'), '1' => __('Source 1')];
    }

  public function getbumenList()
    {
        return ['6' => __('bumen 6'),'0' => __('bumen 0'), '1' => __('bumen 1'), '2' => __('bumen 2'), '3' => __('bumen 3'), '4' => __('bumen 4'), '5' => __('bumen 5')];
    }







    public function getSourceTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['source']) ? $data['source'] : '');
        $list = $this->getSourceList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
