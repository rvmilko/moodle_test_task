<?php

namespace block_user_table\controllers;

class UserListAction extends AbstractAction {
    public function execute()
    {
        global $DB;

        $users = $DB->get_records('user', ['deleted' => 0], 'lastname ASC');

        return $this->render('userList', ['users' => $users]);
    }

    private function render($view, $data = []) {
        ob_start();
        include(__DIR__ . '/../../views/' . $view . '.php');
        return ob_get_clean();
    }
}