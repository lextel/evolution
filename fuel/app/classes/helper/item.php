<?php
/**
 * 商品辅助类
 */
namespace Helper;

class Item {

    /**
     * @def 未删除
     */
    const NOT_DELETE = 0;

    /**
     * @def 已删除
     */
    const IS_DELETE = 1;

    /**
     * @def 未审核
     */
    const NOT_CHECK = 0;

    /**
     * @def 已审核
     */
    const IS_CHECK = 1;

    /**
     * @def 不通过
     */
    const NOT_PASS = 2;

    /**
     * @def 未揭晓
     */
    const NOT_OPEN = 0;

    /**
     * @def 已揭晓
     */
    const IS_OPEN = 1;

}
