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
 * $banner_messages file description here.
 *
 * @package    banner_messages
 * @copyright  2022 Jock Coats <jock.coats@brookes.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function local_banner_messages_after_config() {
    if (isloggedin() && !isguestuser()) {
        local_banner_messages_after_require_login();
    }
}

function local_banner_messages_after_require_login() {
    global $USER;

    if (is_siteadmin($USER->id) || !isloggedin() || isguestuser()) {
        return;
    }

    if (isset($GLOBALS['banner_holds']) && $GLOBALS['banner_holds'] == 1) {
        $GLOBALS['banner_holds'] = 0;
        return;
    }

    if (!strpos($USER->profile['person_holds'], 'F3') && !strpos($USER->profile['person_holds'], 'RX')) {
        return;
    }

    if(requiresUserHold($USER)) {
        try {
            redirect(new moodle_url('/local/banner_messages/banner_holds.php'));
        }
        catch (moodle_exception $e) { }
    }
}

function requiresUserHold(object $user) : bool {
    $holds = json_decode($user->profile['person_holds']);
    foreach($holds as $hold) {
        if(property_exists($hold, "typeCode") && !in_array($hold->typeCode, ["F3", "RX"])) {
            continue;
        }

        if(property_exists($hold, "endOn") && strtotime($hold->endOn) < time()) {
            continue;
        }

        if(property_exists($hold, "startOn") && strtotime($hold->startOn) > time()) {
            continue;
        }

        return true;
    }

    return false;
}
