<?php

namespace block_user_table\controller;

class UserTableController extends AbstractController {

    public static function actions(): array
    {
         return [
            'UserListAction' => UserListAction::class,
         ];
    }
}