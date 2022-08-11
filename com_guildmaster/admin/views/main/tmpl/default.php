<?php
/**
* @package     GuildMaster
* @subpackage  Component.Administrator
* @author      Thomas Hunziker <admin@bakual.net>
* @copyright   © 2022 - Thomas Hunziker, original idea by Stefan Reimer
* @license     http://www.gnu.org/licenses/gpl.html
**/

defined('_JEXEC') or die();

use Joomla\CMS\Router\Route;
?>
<form action="<?php echo Route::_('index.php?option=com_guildmaster&view=main'); ?>" method="post"
	  name="adminForm" id="adminForm">
	<div>
		In order to set a direct link to the heritage tracking page, create <b>Link - URL</b> and enter <b>index.php?option=com_guildmaster&action=heritage</b>
		as link.
	</div>
	</div>
	<input type="hidden" name="option" value="com_guildmaster"/>
	<input type="hidden" name="task" value=""/>
</form>
