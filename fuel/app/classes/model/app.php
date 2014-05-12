<?php

class Model_App extends \Classes\Model
{
    protected static $_properties = [
        'id',
        'package',
        'title',
        'icon',
        'award',
        'is_delete',
        'sort',
        'status',
        'images',
        'summary',
        'link',
        'os',
        'size',
        'created_at',
        'updated_at',
    ];

    protected static $_observers = [
        'Orm\Observer_CreatedAt' => [
            'events' => ['before_insert'],
            'mysql_timestamp' => false,
        ],
        'Orm\Observer_UpdatedAt' => [
            'events' => ['before_save'],
            'mysql_timestamp' => false,
        ],
    ];
    
    //保存数据
    public static function appSave($app){
        $app->title = trim(Input::post('title'));
        $app->package = trim(Input::post('package'));
        $app->icon = trim(Input::post('icon', ''));
        $app->award = trim(Input::post('award'));
        $app->images = serialize(Input::post('images', []));
        $app->summary = trim(Input::post('summary'));
        $app->link = trim(Input::post('link'));
        $app->os = trim(Input::post('os'));
        $app->size = trim(Input::post('size'));
        $app->is_delete = 0;
        $app->sort = 0;
        $app->status = 0;
        return $app;
    }

}
