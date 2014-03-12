<?php

class View_Admin_Items_List extends ViewModel
{
    public function view()
    {
        // 状态
        $this->getStatus = function($status) {

            switch ($status) {
                case \Helper\Item::NOT_CHECK:
                    $name = '<span style="color:gray">待审核</span>';
                    break;
                case \Helper\Item::IS_SHOW:
                    $name = '<span style="color:blue">显示中</span>';
                    break;
                case \Helper\Item::IS_CHECK:
                    $name = '<span style="color:green">上架中</span>';
                    break;
                case \Helper\Item::NOT_PASS:
                    $name = '<span style="color:red">不通过</span>';
                    break;
                case \Helper\Item::IS_FINISH:
                    $name = '<span style="color:orange">已完成</span>';
                    break;
                default:
                    $name = '<span style="color:gray">未知</span>';
                    break;
            }

            return $name;
        };

        // 获取操作
        $this->getOperate = function($type, $id, $phaseId) {

            $group = $this->current_user->group;
            switch($type) {
                case 'uncheck':
                    if($group < 50) {
                        $operate = Html::anchor('admin/items/view/'.$id.'/'.$phaseId, '详情') .' | ' .
                                   Html::anchor('admin/items/edit/'.$id, '编辑');
                                   Html::anchor('admin/items/delete/'.$id, '删除', array('onclick' => "return confirm('亲，确定删除么?')"));
                    } else {
                        $operate = Html::anchor('admin/items/view/'.$id.'/'.$phaseId, '详情') .' | ' .
                                   Html::anchor('admin/items/sell/'.$id, '上架') . ' | ' .
                                   Html::anchor('admin/items/isPass/'.$id, '通过') . ' | ' .
                                   Html::anchor('admin/items/notPass/'.$id, '不通过') . ' | ' .
                                   Html::anchor('admin/items/delete/'.$id, '删除', array('onclick' => "return confirm('亲，确定删除么?')"));
                    }
                    break;
                case 'show':
                    if($group < 50) {
                        $operate = Html::anchor('admin/items/view/'.$id.'/'.$phaseId, '详情');
                    } else {
                        $operate = Html::anchor('admin/items/view/'.$id.'/'.$phaseId, '详情') .' | ' .
                                   Html::anchor('admin/items/sell/'.$id, '上架') . ' | ' .
                                   Html::anchor('admin/items/edit/'.$id, '编辑');
                                   Html::anchor('admin/items/delete/'.$id, '删除', array('onclick' => "return confirm('亲，确定删除么?')"));
                    }
                    break;
                case 'active':
                    if($group < 50) {
                        $operate = Html::anchor('admin/items/view/'.$id.'/'.$phaseId, '详情');
                    } else {
                        $operate = Html::anchor('admin/items/view/'.$id.'/'.$phaseId, '详情') .' | ' .
                                   Html::anchor('admin/items/edit/'.$id, '编辑');
                    }
                    break;
                case 'open':
                    $operate = Html::anchor('admin/items/view/'.$id.'/'.$phaseId, '详情');
                    break;
                case 'unpass':
                    $operate = Html::anchor('admin/items/view/'.$id.'/'.$phaseId, '详情') . ' | ' .
                               Html::anchor('admin/items/delete/'.$id, '删除', array('onclick' => "return confirm('亲，确定删除么?')"));
                    break;
                case 'finish':
                    if($group < 50) {
                        $operate = Html::anchor('admin/items/view/'.$id.'/'.$phaseId, '详情');
                    } else {
                        $operate = Html::anchor('admin/items/view/'.$id.'/'.$phaseId, '详情') . ' | ' .
                                   Html::anchor('admin/items/resell/'.$id, '重新发布');
                    }
                    break;
                case 'delete':
                    if($group < 50) {
                        $operate = Html::anchor('admin/items/view/'.$id.'/'.$phaseId, '详情');
                    } else {
                        $operate = Html::anchor('admin/items/view/'.$id.'/'.$phaseId, '详情') . ' | ' .
                                   Html::anchor('admin/items/restore/'.$id, '恢复');
                    }
                    break;
                case 'all':
                    $operate = Html::anchor('admin/items/view/'.$id.'/'.$phaseId, '详情');
                    break;
                default:
                    $operate = '';
                    break;
            }

            return $operate;
        };

        // 获取分类
        $this->getBrands = function($cateId) {
            if(empty($cateId)) return [];

            $cateModel = new Model_Cate();
            return $cateModel->brands($cateId);
        };
    }
}
