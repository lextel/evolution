<?php
return [
    'item' => [
            ['name' => '人气', 'field' => 'hots', 'order' => ['desc']],
            ['name' => '最新', 'field' => 'item_created_at', 'alias' => 'new', 'order' => ['desc']],
            ['name' => '价格', 'field' => 'cost', 'alias' => 'price', 'order' => ['desc', 'asc']],
    ],
];
