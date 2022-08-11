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
use Joomla\CMS\MVC\Model\ListModel;

/**
 * Model class for the SermonSpeaker Component
 *
 * @since  2.0
 */
class GuildmasterModelRoster extends ListModel
{
	/**
	 * @var object
	 *
	 * @since ?
	 */
	private $item;

	/**
	 * Get the master query for retrieving a list of items subject to the model state.
	 *
	 * @return  \Joomla\Database\QueryInterface
	 *
	 * @since ?
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		return $query;
	}

	/**
	 * Method to auto-populate the model state
	 *
	 * Note. Calling getState in this method will result in recursion
	 *
	 * @param   string  $ordering   Ordering column
	 * @param   string  $direction  'ASC' or 'DESC'
	 *
	 * @return  void
	 *
	 * @throws \Exception
	 * @since ?
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$app    = Factory::getApplication();
		$params = $app->getParams();
		$this->setState('params', $params);
		$jinput = $app->input;

		$user = Factory::getUser();

		if ((!$user->authorise('core.edit.state', 'com_sermonspeaker')) && (!$user->authorise('core.edit', 'com_sermonspeaker')))
		{
			// Filter on published for those who do not have edit or edit.state rights
			$this->setState('filter.state', 1);
		}

		$this->setState('filter.language', $app->getLanguageFilter());

		$search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter-search', '', 'STRING');
		$this->setState('filter.search', $search);

		// Speakerfilter
		if ($jinput->get('view') == 'speaker')
		{
			$id = $app->getUserStateFromRequest($this->context . '.filter.speaker', 'id', 0, 'INT');
			$this->setState('speaker.id', $id);
		}

		parent::populateState('ordering', 'ASC');

		$defaultLimit = $params->get('default_pagination_limit', $app->get('list_limit'));
		$limit        = $app->getUserStateFromRequest($this->context . '.list.limit', 'limit', $defaultLimit, 'uint');
		$this->setState('list.limit', $limit);

		$value      = $app->getUserStateFromRequest($this->context . '.limitstart', 'limitstart', 0, 'int');
		$limitstart = ($limit != 0 ? (floor($value / $limit) * $limit) : 0);
		$this->setState('list.start', $limitstart);
	}
}
