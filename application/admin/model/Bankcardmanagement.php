<?php

namespace app\admin\model;

use think\Model;


class Bankcardmanagement extends Model
{

    

    

    // 表名
    protected $name = 'bankcardmanagement';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'Phonenumberstatus_text',
        'IsopenWeChat_text',
        'IsopenAlipay_text',
        'yanzhengjizhi_text'
    ];
    

    
    public function getPhonenumberstatusList()
    {
        return ['0' => __('Phonenumberstatus 0'), '1' => __('Phonenumberstatus 1'), '2' => __('Phonenumberstatus 2'), '3' => __('Phonenumberstatus 3'), '4' => __('Phonenumberstatus 4'), '5' => __('Phonenumberstatus 5')];
    }

    public function getIsopenwechatList()
    {
        return ['0' => __('Isopenwechat 0'), '1' => __('Isopenwechat 1'), '2' => __('Isopenwechat 2')];
    }

    public function getIsopenalipayList()
    {
        return ['0' => __('Isopenalipay 0'), '1' => __('Isopenalipay 1'), '2' => __('Isopenalipay 2')];
    }

    public function getYanzhengjizhiList()
    {
        return ['0' => __('Yanzhengjizhi 0'), '1' => __('Yanzhengjizhi 1'), '2' => __('Yanzhengjizhi 2'), '3' => __('Yanzhengjizhi 3')];
    }


    public function getPhonenumberstatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['Phonenumberstatus']) ? $data['Phonenumberstatus'] : '');
        $list = $this->getPhonenumberstatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getIsopenwechatTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['IsopenWeChat']) ? $data['IsopenWeChat'] : '');
        $list = $this->getIsopenwechatList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getIsopenalipayTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['IsopenAlipay']) ? $data['IsopenAlipay'] : '');
        $list = $this->getIsopenalipayList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getYanzhengjizhiTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['yanzhengjizhi']) ? $data['yanzhengjizhi'] : '');
        $list = $this->getYanzhengjizhiList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
