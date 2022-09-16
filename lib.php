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

function local_banner_messages_before_standard_top_of_body_html()
{
    global $USER;

    if (!isloggedin() || isguestuser()) {
        return;
    }

    if (strpos($USER->profile["person_holds"],"F3") == true) {
        return "<script>window.location.replace(\"https://www.brookes.ac.uk/alerts/moodle-access-blocked\")</script>";
    }
}