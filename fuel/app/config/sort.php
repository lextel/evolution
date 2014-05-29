<?php
return [
    'item' => [
            ['name' => '人气', 'field' => 'hots', 'order' => ['desc']],
            ['name' => '最新', 'field' => 'created_at', 'alias' => 'new', 'order' => ['desc']],
            ['name' => '价格', 'field' => 'price', 'alias' => 'price', 'order' => ['desc', 'asc']],
    ],
];
