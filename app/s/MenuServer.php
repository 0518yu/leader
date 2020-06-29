<?php


namespace App\s;


use App\m\BeanSysMenu;
use App\pithy\BeanPDO;

/**
 * Class MenuServer
 * @package App\s
 */
class MenuServer
{
    // 更新url
    public function fresh($web)
    {
        $db = new BeanPDO(BeanSysMenu::class);
        $db->u(['status' => 0], []);// 清空
        $display_order = 1;
        foreach ($web as $url => $f) {
            // 检查是否存在
            $info = BeanSysMenu::queryOne(['url' => $url]);
            if ($info) {
                $db->u([
                    'status' => 1,
                    'display_order' => $display_order++,
                    'updated_at' => date('Y-m-d H:i:s')
                ], [
                    'id' => $info->id
                ]);
                continue;
            }
            $db->c([
                'pid' => 0,
                'title' => '',
                'url' => $url,
                'icon' => '',
                'rids' => '1',
                'uids' => '',
                'is_menu' => 0,
                'status' => 1,
                'display_order' => $display_order++,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

    }

    private static function parseUrl($current_url)
    {
        return substr($current_url, 0, strrpos($current_url, "/")) . '/';
    }

    /**
     * http://www.fontawesome.com.cn/faicons/
     * 可以找自己喜欢的图标
     * @param string $current_url
     * @return array
     */
    public static function getMenu($current_url = '/')
    {
        $db = new BeanPDO();
        $u = UserServer::loginInfo();
        $sql = /** @lang text */
            <<<STR
select * from sys_menu 
where is_menu = 1 and (FIND_IN_SET(?,rids) or FIND_IN_SET(?,uids)) 
order by display_order desc
STR;
        $list = $db->queryArrList($sql, [$u->r_id, $u->id]);
        $childData = [];

        foreach ($list as $item) {
            $tmp = [];
            // 父节点产生
            if (isset($childData[$item['id']])) {
                $tmp['subitem_active'] = false;
                $tmp['subitems'] = array_reverse($childData[$item['id']]);
                unset($childData[$item['id']]);
            }
            $tmp['title'] = $item['title'];
            $tmp['url'] = $item['url'];
            $tmp['icon'] = $item['icon'];
            $tmp['active'] = false;

            $childData[$item['pid']][] = $tmp;
        }

        $current_url = self::parseUrl($current_url);
        $info = array_reverse($childData[0]);
        // 处理是否展示
        foreach ($info as $k => $v) {
            if (self::parseUrl($v['url']) == $current_url)
                $info[$k]['active'] = true;

            if (isset($v['subitems']) && $v['subitems']) {
                foreach ($v['subitems'] as $k_1 => $v_1) {
                    if (self::parseUrl($v_1['url']) == $current_url) {
                        $info[$k]['subitem_active'] = true;
                        $info[$k]['subitems'][$k_1]['active'] = true;
                    }
                }
            }
        }
        return $info;
    }
}