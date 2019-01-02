<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Event observers used in SafeAssign Plagiarism plugin.
 *
 * @package   plagiarism_safeassign
 * @copyright Copyright (c) 2018 Blackboard Inc. (http://www.blackboard.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}

require_once($CFG->dirroot.'/plagiarism/safeassign/lib.php');

/**
 * Class plagiarism_safeassign_observer
 * @copyright Copyright (c) 2017 Blackboard Inc. (http://www.blackboard.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class plagiarism_safeassign_observer {

    /**
     * Creates an instructor record if the given enrolment correspond to an editing teacher.
     * @param \core\event\user_enrolment_created
     */
    public static function role_assigned(\core\event\role_assigned $event) {
        $eventdata = $event->get_data();
        $safeassign = new plagiarism_plugin_safeassign();
        $safeassign->process_role_assignments($eventdata, 'create');
    }

    /**
     * Creates an instructor record if the given enrolment correspond to an editing teacher.
     * @param \core\event\user_enrolment_created
     */
    public static function role_unassigned(\core\event\role_unassigned $event) {
        $eventdata = $event->get_data();
        $safeassign = new plagiarism_plugin_safeassign();
        $safeassign->process_role_assignments($eventdata, 'delete');
    }

    /**
     * Sends the event to the SafeAssign plug-in.
     * @param \core\event\base $event
     */
    public static function event_triggered(\core\event\base $event) {
        $safeassign = new plagiarism_plugin_safeassign();
        $safeassign->process_event($event);
    }
}