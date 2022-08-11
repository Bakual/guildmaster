<?php
/**
 * @package     GuildMaster
 * @subpackage  Component.Administrator
 * @author      Thomas Hunziker <admin@bakual.net>
 * @copyright   © 2022 - Thomas Hunziker, original idea by Stefan Reimer
 * @license     http://www.gnu.org/licenses/gpl.html
 **/

defined('_JEXEC') or die();

use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

class GuildmasterViewMain extends HtmlView
{
	function display($tpl = null)
	{
		ToolbarHelper::title(Text::_('COM_GUILDMASTER'), 'users');
		ToolbarHelper::preferences('com_guildmaster');

		parent::display($tpl);
	}
}
