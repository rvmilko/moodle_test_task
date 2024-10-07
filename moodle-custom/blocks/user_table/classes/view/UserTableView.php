<?php

namespace block_user_table\view;

use block_user_table\model\UserTableModel;
use coding_exception;
use dml_exception;

defined('MOODLE_INTERNAL') || die();

class UserTableView {

    private $users;
    private $currentuserid;

    public function __construct($users, $currentuserid) {
        $this->users = $users;
        $this->currentuserid = $currentuserid;
    }

    /**
     * @throws coding_exception
     * @throws dml_exception
     */
    public function render(): string
    {
        global $OUTPUT, $USER, $PAGE;

        $content = '<table class="generaltable">';
        $content .= '<thead><tr>';
        $content .= '<th>' . get_string('user', 'block_user_table') . '</th>';
        $content .= '<th>' . get_string('ratings', 'block_user_table') . '</th>';
        $content .= '<th>' . get_string('rate_user', 'block_user_table') . '</th>';
        $content .= '</tr></thead><tbody>';

        foreach ($this->users as $user) {
            $content .= '<tr>';
            $content .= '<td>' . fullname($user) . '</td>';
            $content .= '<td>' . ($user->average_rating ? number_format($user->average_rating, 2) : 'N/A') . '</td>';

            if ($user->id != $this->currentuserid) {
                $rated = UserTableModel::hasRated($user->id, $this->currentuserid);
                if (!$rated) {
                    $content .= '<td>
                        <form method="post" action="">
                            <input type="hidden" name="userid" value="' . $user->id . '"/>
                            <select name="rating">
                                <option value="">--</option>';
                    for ($i = 1; $i <= 10; $i++) {
                        $content .= '<option value="' . $i . '">' . $i . '</option>';
                    }
                    $content .= '</select>
                            <input type="submit" value="' . get_string('submit_rating', 'block_user_table') . '"/>
                        </form>
                    </td>';
                } else {
                    $content .= '<td>Rated</td>';
                }
            } else {
                $content .= '<td>N/A</td>';
            }

            $content .= '</tr>';
        }

        $content .= '</tbody></table>';

        return $content;
    }
}