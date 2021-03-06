<?php

class Model_Invitcode extends \Orm\Model
{
    protected static $_properties = array(
        'id',
        'code',
        'status',
        'member_id',
        'award',
        'is_delete',
        'created_at',
        'updated_at',
    );

    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => false,
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events' => array('before_update'),
            'mysql_timestamp' => false,
        ),
    );
    protected static $_table_name = 'invitcodes';

    /**
     * 统计
     *
     * @return int
     */
    public function countCode($get) {
        $where = ['is_delete' => 0];
        if (isset($get['code']) && ($get['code'])) $where += ['code' => $get['code']];
        return Model_Invitcode::count(['where' => $where]);
    }

    /**
     * 列表
     *
     * @param $page int 页码
     *
     * @return obj
     */
    public function lists($get, $offset, $pagesize) {
        $where = ['is_delete' => 0];
        if (isset($get['code']) && $get['code']) $where += ['code' => $get['code']];
        return Model_Invitcode::find('all', ['where' =>$where, 'offset' => $offset, 'limit' => $pagesize, 'order_by' => ['status' => 'asc', 'id' => 'desc'] ]);
    }

    /**
     * 礼品码删除
     *
     * @param $id integer 商品ID
     *
     * @return boolean 是否成功
     */
    public function remove($id) {

        $result = false;
        if ($code = Model_Invitcode::find($id)) {
            $code->is_delete = 1;
            $code->save();

            Model_Log::add('删除礼品码 #' . $code->id);

            $result = true;
        }

        return $result;
    }

    /**
     * 验证礼品码是否可用
     *
     * @param $code string 礼品码
     *
     * @return boolean 是否可用
     */
    public function check($code) {
        return Model_Invitcode::find('first', ['where' => ['is_delete' => 0, 'code' => $code, 'status' => 0]]);
    }

    /**
     * 使用礼品码
     *
     * @param $member_id int
     * @param $code      string
     *
     * @return void
     */
    public function used($member_id, $code) {

        Config::load('common');

        //$addPoints = Config::get('point') * Config::get('inviteCodeAddPoints');

        $code = Model_Invitcode::find('first', ['where' => ['code' => $code]]);

        $code->status = 1;
        $code->member_id = $member_id;
        $code->save();

        $member = Model_Member::find($member_id);
        $addPoints = intval($code->award) * Config::get('point');
        // 礼品码使用日志
        $point = Config::get('point');
        $data = [
            'phase_id'  => 0,
            'total'     => $addPoints / $point,
            'sum'       => $addPoints,
            'type'      => 3,
            'source'    => '礼品码',
            'member_id' => $member_id,
            ];
        $model = new Model_Member_Moneylog($data);
        $model->save();
        $member->points += $addPoints;
        $member->save();
    }
}
