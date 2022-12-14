<?php
/**
 * @package     GuildMaster
 * @subpackage  Component.Administrator
 * @author      Thomas Hunziker <admin@bakual.net>
 * @copyright   © 2022 - Thomas Hunziker, original idea by Stefan Reimer
 * @license     http://www.gnu.org/licenses/gpl.html
 **/

defined('_JEXEC') or die();

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;

$app    = Factory::getApplication();
$jinput = $app->input;

$controller = BaseController::getInstance('Guildmaster');
$controller->execute($jinput->get('task'));
$controller->redirect();
