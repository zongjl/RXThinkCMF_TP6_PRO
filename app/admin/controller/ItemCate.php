<?php
// +----------------------------------------------------------------------
// | RXThinkCMF框架 [ RXThinkCMF ]
// +----------------------------------------------------------------------
// | 版权所有 2017~2020 南京RXThinkCMF研发中心
// +----------------------------------------------------------------------
// | 官方网站: http://www.rxthink.cn
// +----------------------------------------------------------------------
// | Author: 牧羊人 <1175401194@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;


use app\admin\service\ItemCateService;
use app\common\controller\Backend;
use think\facade\View;

/**
 * 栏目-控制器
 * @author 牧羊人
 * @since 2020/7/2
 * Class Itemcate
 * @package app\admin\controller
 */
class Itemcate extends Backend
{
    /**
     * 初始化
     * @author 牧羊人
     * @since 2020/7/2
     */
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->model = new \app\admin\model\ItemCate();
        $this->service = new ItemCateService();
    }

    /**
     * 添加或编辑
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * @author 牧羊人
     * @since 2020/7/2
     */
    public function edit()
    {
        // 获取站点列表
        $itemMod = new \app\admin\model\Item();
        $itemList = $itemMod->where("status", 1)->where("mark", 1)->select()->toArray();
        View::assign("itemList", $itemList);

        return parent::edit(); // TODO: Change the autogenerated stub
    }

    /**
     * 根据站点ID获取栏目列表
     * @return array
     * @since 2020/7/2
     * @author 牧羊人
     */
    public function getCateList()
    {
        // 站点ID
        $itemId = request()->param("item_id", 0);
        $result = $this->model->getChilds($itemId, 0, true);
        $cateList = [];
        if (is_array($result)) {
            foreach ($result as $val) {
                $cateList[] = [
                    'id' => $val['id'],
                    'name' => $val['name'],
                ];
                foreach ($val['children'] as $vt) {
                    $cateList[] = [
                        'id' => $vt['id'],
                        'name' => "|--" . $vt['name'],
                    ];
                }
            }
        }
        return message("操作成功", true, $cateList);
    }
}