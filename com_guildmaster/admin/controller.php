<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

/**
 * GuildMaster Controller
 */
class GuildmasterController extends JController {
	function GuildmasterController() {
		parent :: __construct();
	}

	function display($tmpl= null) {
		parent :: display($tmpl);
	}

	function save($tmpl= null) {
		$data = JRequest :: get('params');
		$model = $this->getModel('GuildMaster');

        if ($model->store($data)) {
            $message = JText::_('CONFIG SAVED SUCCESSFULLY');
        } else {
            $message = $model->getError();
        }

        $this->setRedirect(JRoute::_('index.php?option=com_guildmaster', false), $message);
	}

	/**
	* Cancels editing and checks in the record
	*/
	function cancel($tmpl= null) {
		$msg= JText :: _('EDIT CANCELED');
		$this->setRedirect(JRoute :: _('index.php?option=com_guildmaster', false), $msg);
	}
}
?>