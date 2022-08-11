<?php
/**
 * @package     GuildMaster
 * @subpackage  Component.Site
 * @author      Thomas Hunziker <admin@bakual.net>
 * @copyright   © 2022 - Thomas Hunziker, original idea by Stefan Reimer
 * @license     http://www.gnu.org/licenses/gpl.html
 **/

defined('_JEXEC') or die();

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Model\ItemModel;

/**
 * Model class for the Guildmaster Component
 *
 * @since  2.0
 */
class GuildmasterModelGuild extends ItemModel
{
	/**
	 * Method to get an object
	 *
	 * @param   int  $id  The id of the object to get
	 *
	 * @return mixed Object on success, false on failure
	 *
	 * @throws Exception
	 * @since ?
	 */
	public function getItem($id = null)
	{
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		$query->select('*');
		$query->from('#__guildmaster_guild AS guild');

		$db->setQuery($query);

		try
		{
			$data = $db->loadObject();
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}

		if (!$data)
		{
			throw new Exception(Text::_('JGLOBAL_RESOURCE_NOT_FOUND'));
		}

		return $data;
	}
}
