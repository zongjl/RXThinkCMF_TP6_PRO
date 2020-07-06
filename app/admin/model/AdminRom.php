<?php


namespace app\admin\model;


use app\common\model\BaseModel;

/**
 * 人员权限模型
 * @author 牧羊人
 * @since: 2020/6/30
 * Class AdminRom
 * @package app\admin\model
 */
class AdminRom extends BaseModel
{
    // 设置数据表名
    protected $name = "admin_rom";

    /**
     * 获取缓存信息
     * @param int $id
     * @return \app\common\model\数据信息|mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @author 牧羊人
     * @since: 2020/6/30
     */
    public function getInfo($id)
    {
        return parent::getInfo($id); // TODO: Change the autogenerated stub
    }

    /**
     * 获取权限列表
     * @param $adminId 人员ID
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * @since: 2020/6/30
     * @author 牧羊人
     */
    public function getPermissionList($adminId)
    {
        $adminMod = new Admin();
        $adminInfo = $adminMod->where("id", $adminId)->find();

        $map1 = [];
        if ($adminInfo['role_ids']) {
            $map1 = [
                ['r.type', '=', 1],
                ['r.type_id', 'in', $adminInfo['role_ids']],
            ];
        }
        $map2 = [
            ['r.type', '=', 2],
            ['r.type_id', '=', $adminId],
        ];
        $map = [$map1, $map2];
        $menuMod = new Menu();
        $menuList = $menuMod->alias('m')
            ->join(DB_PREFIX . 'admin_rom r', 'r.menu_id=m.id')
            ->distinct(true)
            ->where(function ($query) use ($map) {
                $query->whereOr($map);
            })
            ->where('m.type', '=', 3)
            ->where('m.status', '=', 1)
            ->where('m.mark', '=', 1)
            ->order('m.pid ASC,m.sort ASC')
            ->field('m.id')
            ->select();
        $list = [];
        if (!empty($menuList)) {
            foreach ($menuList as $vm) {
                // 根据菜单获取节点
                $funcList = $menuMod->alias('m')
                    ->join(DB_PREFIX . 'admin_rom r', 'r.menu_id=m.id')
                    ->distinct(true)
                    ->where(function ($query) use ($map) {
                        $query->whereOr($map);
                    })
                    ->where('m.type', '=', 4)
                    ->where('m.pid', '=', intval($vm['id']))
                    ->where('m.status', '=', 1)
                    ->where('m.mark', '=', 1)
                    ->order('m.id ASC')
                    ->field('m.id')
                    ->select();
                if ($funcList) {
                    foreach ($funcList as $v) {
                        $list[$vm['id']][] = $v['id'];
                    }
                }
            }
        }
        return $list;
    }
}