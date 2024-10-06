<?php

namespace block_user_table\controllers;

class UserTableController extends AbstractController {

    public static function actions()
    {
         return [
            'UserListAction' => \block_user_table\controllers\UserListAction::class,
         ];
    }
}