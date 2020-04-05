<?php


namespace Ydb\Util;


class PageUtil
{
    /**
     * 数组分页函数  核心函数  array_slice
     * 用此函数之前要先将数据库里面的所有数据按一定的顺序查询出来存入数组中
     * $count   每页多少条数据
     * $page   当前第几页
     * $array   查询出来的所有数组
     * order 0 - 不变     1- 反序
     */
    public static function page_array($count, $page, $array, $order)
    {
        $page = (empty($page)) ? '1' : $page; #判断当前页面是否为空 如果为空就表示为第一页面
        $start = ($page - 1) * $count; #计算每次分页的开始位置
        if ($order == 1) {
            $array = array_reverse($array);
        }
        $totals = count($array);
        $countpage = ceil($totals / $count); #计算总页面数
        return array_slice($array, $start, $count);  #返回查询数据
    }
}