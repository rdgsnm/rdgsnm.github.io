<?php
/**
 * @version SVN: $Id: plg_adminformfixer 2 2012-01-28 10:34:13Z al $
 * @package Joomla.Plugin
 * @author     Al - Cats Eye Solutions for GWS-Desk.com
 * @license    GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;

/**
 * Joomla! Form Fixer
 *
 * appends the form id in case it is absent
 *
 * @package	Joomla.Plugin
 * @subpackage	System
 */
class plgSystemAdminformfixer extends JPlugin
{
   /**
    * Converting non compliant admin forms to joomla compliant forms
    */
    public function onAfterRender()
    {
	$application = JFactory::getApplication();

	if ($application->getName() != 'administrator') 
	{
	    return true;
	}

	//get the buffer
	$buffer = JResponse::getBody();

	//return in case the form already has an id or when there is no admin form at all
	if(preg_match("/id=\"adminForm\"/", $buffer) || !(preg_match("/name=\"adminForm\"/", $buffer)))
	{
	    return true;
	}

	//Admin form replacement
	$buffer = preg_replace('/name=\"adminForm\"/', 'name="adminForm" id="adminForm"', $buffer);

	JResponse::setBody($buffer);

	return true;
    }
}
