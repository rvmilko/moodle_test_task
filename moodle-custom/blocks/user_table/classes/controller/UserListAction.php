<?php

namespace block_user_table\controller;

use block_user_table\model\UserTableModel;
use block_user_table\view\UserTableView;
use dml_exception;

class UserListAction extends AbstractAction {
    /**
     * @throws dml_exception
     */
    public function execute()
    {
        global $USER, $OUTPUT;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userid']) && isset($_POST['rating'])) {
            $userid = intval($_POST['userid']);
            $rating = intval($_POST['rating']);

            if ($rating < 1 || $rating > 10) {
                return $OUTPUT->notification('Invalid rating. Please select a value between 1 and 10.', 'error');
            }

            if (UserTableModel::hasRated($userid, $USER->id)) {
                return $OUTPUT->notification('You have already rated this user.', 'error');
            }

            if (UserTableModel::addRating($userid, $USER->id, $rating)) {
                return $OUTPUT->notification('Thank you for your rating!', 'notifysuccess');
            } else {
                return $OUTPUT->notification('Unable to rate the user.', 'error');
            }
        }

        $users = UserTableModel::getAllUsersWithRatings();

        $view = new UserTableView($users, $USER->id);

        return $view->render();
    }
}