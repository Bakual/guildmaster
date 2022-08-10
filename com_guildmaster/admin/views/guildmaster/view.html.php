<?php
//no direct access
defined( '_JEXEC' ) or die( 'Restricted Access' );

jimport( 'joomla.application.component.view' );

class guildmasterViewguildmaster extends JView
{
    function display( $tmpl = null )
    {
        //set up the tool bar
		JToolBarHelper::title(JText::_( 'Guildmaster' ));
		JToolBarHelper::save();
		JToolBarHelper::cancel();

        $items = $this->get('Data');

        $this->assignRef('items', $items);

        parent::display($tmpl);
    } //end display
}
?>
