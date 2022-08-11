<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once(JPATH_COMPONENT . '/controller.php');

//if (!JRequest::getVar('view') && !JRequest::getVar('task') && !JRequest::getVar('controller')) {
//    JRequest::setVar('view', 'config');
//}

$controller = new GuildmasterController();
$controller->execute(JRequest::getVar('task'));
$controller->redirect();
?>