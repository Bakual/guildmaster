<?php
/**
 * @package     GuildMaster
 * @subpackage  Component.Administrator
 * @author      Thomas Hunziker <admin@bakual.net>
 * @copyright   © 2022 - Thomas Hunziker, original idea by Stefan Reimer
 * @license     http://www.gnu.org/licenses/gpl.html
 **/

defined('_JEXEC') or die();

use Joomla\CMS\MVC\Controller\BaseController;

/**
 * GuildMaster Controller
 */
class GuildmasterController extends BaseController
{
	/**
	 * The default view for the display method.
	 *
	 * @var    string
	 * @since  2.0
	 */
	protected $default_view = 'main';

	function save($tmpl = null)
	{
		$data  = JRequest:: get('params');
		$model = $this->getModel('GuildMaster');

		if ($model->store($data))
		{
			$message = JText::_('CONFIG SAVED SUCCESSFULLY');
		}
		else
		{
			$message = $model->getError();
		}

		$this->setRedirect(JRoute::_('index.php?option=com_guildmaster', false), $message);
	}

	/**
	 * Cancels editing and checks in the record
	 */
	function cancel($tmpl = null)
	{
		$msg = JText:: _('EDIT CANCELED');
		$this->setRedirect(JRoute:: _('index.php?option=com_guildmaster', false), $msg);
	}
}

?>
