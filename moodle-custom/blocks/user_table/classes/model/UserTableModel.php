<?php

namespace block_user_table\model;

use dml_exception;
use stdClass;

defined('MOODLE_INTERNAL') || die();

class UserTableModel {

    /**
     * @throws dml_exception
     */
    public static function getAllUsersWithRatings(): array
    {
        global $DB;

        $sql = "SELECT u.id, u.firstname, u.lastname, AVG(r.rating) as average_rating
                FROM {user} u
                LEFT JOIN {block_user_table} r ON u.id = r.userid
                WHERE u.deleted = 0 AND u.suspended = 0
                GROUP BY u.id, u.firstname, u.lastname
                ORDER BY u.firstname ASC";

        return $DB->get_records_sql($sql);
    }

    /**
     * @throws dml_exception
     */
    public static function addRating($userid, $ratedby, $rating): bool|int
    {
        global $DB;

        if ($userid == $ratedby) {
            return false;
        }

        $record = new stdClass();
        $record->userid = $userid;
        $record->ratedby = $ratedby;
        $record->rating = $rating;
        $record->timecreated = time();

        return $DB->insert_record('block_user_table', $record);
    }

    /**
     * @throws dml_exception
     */
    public static function hasRated($userid, $ratedby): bool
    {
        global $DB;
        return $DB->record_exists('block_user_table', ['userid' => $userid, 'ratedby' => $ratedby]);
    }
}
