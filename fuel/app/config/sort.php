<?php
return [
    'item' => [
            ['name' => '即将揭晓', 'field' => 'remain', 'alias' => 'win', 'order' => ['asc']],
            ['name' => '人气', 'field' => 'hots', 'order' => ['desc']],
            ['name' => '剩余人次', 'field' => 'remain', 'order' => ['asc']],
            ['name' => '最新', 'field' => 'item_created_at', 'alias' => 'new', 'order' => ['desc']],
            ['name' => '价格', 'field' => 'cost', 'alias' => 'price', 'order' => ['desc', 'asc']],
    ],
];
