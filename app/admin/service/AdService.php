<?php


namespace app\admin\service;


use app\admin\model\Ad;
use app\common\service\BaseService;

/**
 * 广告管理-服务类
 * @author 牧羊人
 * @since 2020/7/2
 * Class AdService
 * @package app\admin\service
 */
class AdService extends BaseService
{
    /**
     * 构造函数
     * @author 牧羊人
     * @since 2020/7/2
     * AdService constructor.
     */
    public function __construct()
    {
        $this->model = new Ad();
    }

    /**
     * 添加或编辑
     * @return array
     * @since 2020/7/2
     * @author 牧羊人
     */
    public function edit()
    {
        $data = request()->param();
        // 图片处理
        $cover = trim($data['cover']);
        if (strpos($cover, "temp")) {
            $data['cover'] = save_image($cover, 'ad');
        } else {
            $data['cover'] = str_replace(IMG_URL, "", $data['cover']);
        }
        return parent::edit($data); // TODO: Change the autogenerated stub
    }
}