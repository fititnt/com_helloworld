<?php

/**
 * @package    PortfolioX.Componente
 * @author     Emerson Rocha Luiz <emerson@webdesign.eng.br>
 * @copyright  Copyright (C) 2012 Webdesign Assessoria em Tecnologia da Informacao. All rights reserved.
 * @license    GNU General Public License version 3. See license.txt
 *
 */
defined('_JEXEC') or die;

// Import Joomla table library
jimport('joomla.database.table');

/**
 * Esta classe funciona como um facade ao JControllerForm do JPlatform. Ela é util em situações em que metodos devem ser adicionados a todas 
 * as classes que a herdam, potencialmente util tanto para futuras atualizações como economia massiva de código repetido
 * 
 * @package  PortfolioX.Componente
 * @since    2.5
 */
class HelloWorldJTableFacade extends JTable {

	/**
	 * Name of the database table to model.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $_tabela;

	/**
	 * Constructor
	 *
	 * @param   object  &$db  Database connector object
	 *
	 * @since  1.5
	 */
	public function __construct(&$db)
	{
		parent::__construct($this->_tabela, 'id', $db);
	}

	/**
	 * Overloaded bind function
	 *
	 * @param   array   $array   named array
	 * @param   string  $ignore  Ignore params
	 *
	 * @return  null|string  null is operation was satisfactory, otherwise returns an error
	 *
	 * @see JTable:bind
	 * @since 1.5
	 */
	public function bind($array, $ignore = '')
	{
		if (isset($array['params']) && is_array($array['params']))
		{
			// Convert the params field to a string.
			$parameter = new JRegistry;
			$parameter->loadArray($array['params']);
			$array['params'] = (string) $parameter;
		}
		return parent::bind($array, $ignore);
	}

	/**
	 * Overloaded load function
	 *
	 * @param   int      $pk     primary key
	 * @param   boolean  $reset  reset data
	 *
	 * @return  boolean
	 *
	 * @see JTable:load
	 */
	public function load($pk = null, $reset = true)
	{
		if (parent::load($pk, $reset))
		{
			// Convert the params field to a registry.
			if (isset($this->params))
			{
				$params = new JRegistry;
				$params->loadJSON($this->params);
				$this->params = $params;
			}
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Method to compute the default name of the asset.
	 * The default name is in the form `table_name.id`
	 * where id is the value of the primary key of the table.
	 *
	 * @return	string
	 *
	 * @since	1.6
	 */
	protected function _getAssetName()
	{
		$k = $this->_tbl_key;
		return 'com_px.message.' . (int) $this->$k;
	}

	/**
	 * Method to get the parent asset under which to register this one.
	 * By default, all assets are registered to the ROOT node with ID 1.
	 * The extended class can define a table and id to lookup.  If the
	 * asset does not exist it will be created.
	 *
	 * @param   JTable   $table  A JTable object for the asset parent.
	 * @param   integer  $id     Id to look up
	 *
	 * @return  integer
	 *
	 * @since   11.1
	 */
	protected function _getAssetParentId($table = null, $id = null)
	{
		$asset = JTable::getInstance('Asset');
		$asset->loadByName('com_px');
		return $asset->id;
	}

}
