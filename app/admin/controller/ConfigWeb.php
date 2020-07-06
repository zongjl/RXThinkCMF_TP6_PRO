<?php


namespace app\admin\controller;


use app\admin\model\ConfigGroup;
use app\common\controller\Backend;
use think\facade\View;

/**
 * 网站配置-控制器
 * @author 牧羊人
 * @since 2020/7/2
 * Class Configweb
 * @package app\admin\controller
 */
class Configweb extends Backend
{
    /**
     * 初始化
     * @author 牧羊人
     * @since 2020/7/2
     */
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->model = new \app\admin\model\Config();
    }

    /**
     * 网站配置管理
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * @author 牧羊人
     * @since 2020/7/2
     */
    public function index()
    {
        if (IS_POST) {
            $result = $this->service->config();
            return $result;
        }
        // 配置分组ID
        $group_id = request()->param('group_id', 1);

        // 获取配置分组
        $configGroupModel = new ConfigGroup();
        $configGroupList = $configGroupModel->where(['mark' => 1])->select();
        View::assign("configGroupList", $configGroupList);

        // 获取元素列表
        $list = $this->model->getList([['group_id', '=', $group_id]], "id asc");
        if ($list) {
            foreach ($list as &$val) {
                if ($val['type'] == "select") {
                    // 单选下拉
                    $val['format_name'] = "{$val['name']}|1|{$val['title']}|name|id";
                }
                if ($val['type'] == 'checkbox') {
                    // 复选框
                    $val['format_name'] = "{$val['name']}__checkbox|name|id";

                    // 组件数据源
                    $options_list = [];
                    if ($val['options']) {
                        $options = preg_split("/[\r\n]/", $val['options']);
                        if ($options && is_array($options)) {
                            foreach ($options as $v) {
                                $item = explode(':', $v);
                                $options_list[] = [
                                    'id' => $item[0],
                                    'name' => $item[1],
                                ];
                            }
                        }
                    }
                    $val['format_options'] = $options_list;

                    // 选中的值
                    if ($val['value']) {
                        $val['format_value'] = explode(',', $val['value']);
                    }
                }
                if ($val['type'] == 'radio') {
                    // 单选
                    $val['format_name'] = "{$val['name']}|name|id";

                    // 组件数据源
                    $options_list = [];
                    if ($val['options']) {
                        $options = preg_split("/[\r\n]/", $val['options']);
                        if ($options && is_array($options)) {
                            foreach ($options as $v) {
                                $item = explode(':', $v);
                                $options_list[] = [
                                    'id' => $item[0],
                                    'name' => $item[1],
                                ];
                            }
                        }
                    }
                    $val['format_options'] = $options_list;
                }
                if ($val['type'] == 'select') {
                    // 下拉选择
                    $val['format_name'] = "{$val['name']}|1|{$val['title']}|name|id";

                    // 组件数据源
                    $options_list = [];
                    if ($val['options']) {
                        $options = preg_split("/[\r\n]/", $val['options']);
                        if ($options && is_array($options)) {
                            foreach ($options as $v) {
                                $item = explode(':', $v);
                                $options_list[] = [
                                    'id' => $item[0],
                                    'name' => $item[1],
                                ];
                            }
                        }
                    }
                    $val['format_options'] = $options_list;
                }
            }
        }
        // 绑定数据源
        View::assign("list", $list);
        return $this->render('', [
            'group_id' => $group_id,
        ]);
    }
}