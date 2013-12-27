<?php

class View_Admin_Items_List extends ViewModel
{
    public function view()
    {
        // 状态
        $this->getStatus = function($status) {

            switch ($status) {
                case \Helper\Item::NOT_CHECK:
                    $name = '待审核';
                    break;
                case \Helper\Item::IS_CHECK:
                    $name = '已审核';
                    break;
                case \Helper\Item::NOT_PASS:
                    $name = '不通过';
                    break;
                default:
                    $name = '未知';
                    break;
            }

            return $name;
        };

        // 获取操作
        $this->getOperate = function($type, $id, $phaseId) {

            switch($type) {
                case 'uncheck':
                    $operate = Html::anchor('admin/items/view/'.$id.'/'.$phaseId, '详情') .' | ' .
                               Html::anchor('admin/items/isPass/'.$id, '通过') . ' | ' .
                               Html::anchor('admin/items/notPass/'.$id, '不通过') . ' | ' .
                               Html::anchor('admin/items/delete/'.$id, '删除', array('onclick' => "return confirm('亲，确定删除么?')"));
                    break;
                case 'active':
                case 'open':
                case 'unpass':
                    $operate = Html::anchor('admin/items/view/'.$id.'/'.$phaseId, '详情');
                    break;
                default:
                    $operate = '';
                    break;
            }

            return $operate;
        };
    }
}