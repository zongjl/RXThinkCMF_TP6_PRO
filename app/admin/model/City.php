<?php


namespace app\admin\model;


use app\common\model\BaseModel;

/**
 * 城市模型
 * @author 牧羊人
 * @since: 2020/6/30
 * Class City
 * @package app\admin\model
 */
class City extends BaseModel
{
    // 设置数据表名
    protected $name = "city";

    /**
     * 获取缓存信息
     * @param int $id 记录ID
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
     * 获取子级城市
     * @param $pid 上级ID
     * @param bool $flag 是否获取子级
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * @author 牧羊人
     * @since: 2020/6/30
     */
    public function getChilds($pid, $flag = false)
    {
        $list = [];
        $result = $this->where([
            'pid' => $pid,
            'mark' => 1
        ])->order("id asc")->select();
        if ($result) {
            foreach ($result as $val) {
                $id = (int)$val['id'];
                $info = $this->getInfo($id);
                if ($flag) {
                    $childList = $this->getChilds($id, $flag);
                    if (is_array($childList)) {
                        $info['children'] = $childList;
                    }
                }
                if ($flag) {
                    $list[] = $info;
                } else {
                    $list[$id] = $info;
                }
            }
        }
        return $list;
    }

    /**
     * 获取城市名称
     * @param $cityId
     * @param string $delimiter
     * @param bool $isReplace
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @author 牧羊人
     * @since: 2020/6/30
     */
    public function getCityName($cityId, $delimiter = "", $isReplace = false)
    {
        do {
            $info = $this->getInfo($cityId);
            if ($isReplace) {
                $names[] = str_replace(array("省", "市", "维吾尔", "壮族", "回族", "自治区"), "", $info['name']);
            } else {
                $names[] = $info['name'];
            }
            $city_id = isset($info['pid']) ? (int)$info['pid'] : 0;
        } while ($city_id > 1);
        $names = array_reverse($names);
        if (strpos($names[1], $names[0]) === 0) {
            unset($names[0]);
        }
        return implode($delimiter, $names);
    }
}