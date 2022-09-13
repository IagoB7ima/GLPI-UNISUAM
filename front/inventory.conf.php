<?php

/**
 * ---------------------------------------------------------------------
 *
 * GLPI - Gestionnaire Libre de Parc Informatique
 *
 * http://glpi-project.org
 *
 * @copyright 2015-2022 Teclib' and contributors.
 * @copyright 2003-2014 by the INDEPNET Development Team.
 * @licence   https://www.gnu.org/licenses/gpl-3.0.html
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of GLPI.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * ---------------------------------------------------------------------
 */

use Glpi\Inventory\Conf;

include('../inc/includes.php');

Session::checkRight("config", READ);

Html::header(__('Inventory'), $_SERVER['PHP_SELF'], "admin", "glpi\inventory\inventory");

$conf = new Conf();

if (isset($_FILES['inventory_file']) && $_FILES['inventory_file']['tmp_name'] != '') {
    $conf->importFile($_FILES);
    Html::back();
}

if (isset($_POST['update'])) {
    unset($_POST['update']);
    $conf->saveConf($_POST);
    Session::addMessageAfterRedirect(
        __('Configuration has been updated'),
        false,
        INFO
    );
    Html::back();
}

$conf->display(['id' => 1]);

Html::footer();
