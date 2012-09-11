<?php

/**
 * @package    HelloWorld.Componente
 * @author     Emerson Rocha Luiz <emerson@webdesign.eng.br>
 * @copyright  Copyright (C) 2012 Webdesign Assessoria em Tecnologia da Informacao. All rights reserved.
 * @license    GNU General Public License version 3. See license.txt
 *
 */
defined('_JEXEC') or die;

// Import the Joomla modellist library
jimport('joomla.application.component.modellist');

/**
 * Esta classe funciona como um facade ao JModelList do JPlatform. Ela é util em situações em que metodos devem ser adicionados a todas as classes
 * que a herdam, potencialmente util tanto para futuras atualizações como economia massiva de código repetido
 * 
 * @package  HelloWorld.Componente
 * @since    2.5
 */
class HelloWorldModelListFacade extends JModelList {

	/**
	 * A list of main component params
	 * 
	 * @example
	 * @code
	 * echo $this->component_params->get('my_param');
	 * @endcode
	 * 
	 * @var    object
	 * @since  11.1
	 */
	protected $component_params;

	/**
	 * JInput
	 * 
	 * @var  object 
	 */
	protected $input;

	/**
	 * Log de erros via texto
	 * 
	 * @var  object 
	 */
	protected $log = false;

	/**
	 * Log de debug via console
	 * 
	 * @var  object 
	 */
	protected $log_console = false;

	/**
	 * Campos pesquisáveis
	 * 
	 * @var  object 
	 */
	protected $search_fields = array();

	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see     JController
	 * @since   11.1
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		// JInput
		$this->input = JFactory::getApplication()->input;

		// Load component parameters
		$this->component_params = JComponentHelper::getParams('com_helloworld');

		if (isset($config['state_definitions']))
		{
			$this->populateStateHelper($config['state_definitions']);
		}

		if (isset($config['search_fields']))
		{
			$this->search_fields = $config['search_fields'];
		}

		if (PXDEBUG)
		{
			// Necessário definir caso debug esteja logado, pois __construct() ainda não foi chamado

			$this->context = strtolower('com_helloworld.' . $this->getName());

			if ($this->component_params->get('debug_texto', 0))
			{
				// Log de texto
				$this->log = new PxLog($this->context);
			}

			if ($this->component_params->get('debug_console', 0))
			{
				// Log via console
				$this->log_console = new PxLogConsole($this->component_params->get('debug_console', null));
			}
		}
	}

	/**
	 * Função para ajudar a usar o método populateState usando apenas arrays. Como exemplo de entrada, deve usar array de arrays:
	 * array(array('filter.search', 'filter_search') ), que geraria uma chamada plana como
	 * $this->setState('filter.search', $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search'));
	 * 
	 * @param   array  $state_definitions  Definições de estado  
	 * 
	 * @return	void
	 *
	 * @since	2.5
	 */
	protected function populateStateHelper($state_definitions)
	{
		// List state information.
		parent::populateState();

		foreach ($state_definitions AS $k => $v)
		{
			$this->setState(
					$state_definitions[$k][0],
					$this->getUserStateFromRequest($this->context . '.' . $state_definitions[$k][0], $state_definitions[$k][1])
			);
		}

		PXDEBUG && $this->log_console ? $this->log_console->log($this->state, $this->input) : '';
	}

	/**
	 *  Método para ajudar a criar definir o termo de busca
	 * 
	 * @param   object  $query   JDatabaseQuery  
	 * @param   string  $search  Termo pesquisado
	 * 
	 *  @example
	 *  @code
	 * // Conforme termo previamente definido em $this->search_fields (no __construct()), que dev conter um array de arrays, sendo o primeiro item
	 * // do array interno o campo a ser pesquisado no banco de dados e o segundo (e opcional) campo prefixo que deve estar na busca para significar
	 * // a busca pelo termo exato, a exemplo de $this->search_fields igual a:
	 * array(
	 * 		array('item_midia.id', 'id:'),
	 * 		array('midia_tipo.nome', 'item:'),
	 * 	);
	 * // Caso $search fosse 'id:2' retornaria "item_midia.id LIKE '2'" enquando 'xpto retornaria 
	 * // (item_midia.id LIKE '%xpto%' OR midia_tipo.nome LIKE '%xpto%')
	 * @endcode
	 * 
	 * 
	 * @return  JDatabaseQuery
	 */
	protected function querySearchHelper($query, $search = '')
	{
		if ($search === '')
		{
			$search = $this->getState('filter.search');
		}

		// Caso o termo pesquisado esteja vazio, ou não haja campos a serem pesquisados, devolve o $query intacto
		if (!$search || empty($this->search_fields))
		{
			return $query;
		}

		$search_escaped = $this->_db->Quote('%' . $this->_db->escape($search, true) . '%');

		$search_all = array();
		foreach ($this->search_fields AS $k => $v)
		{
			if (empty($this->search_fields[$k][1]))
			{
				continue;
			}

			// Caso o início do termo pesquisado contenha o prefixo de pesquisa específica e retorna o objeto da querie
			if (stripos($search, $this->search_fields[$k][1]) === 0)
			{
				$query->where($this->search_fields[$k][0] . ' LIKE ' . $this->_db->Quote(substr($search, mb_strlen($this->search_fields[$k][1]))));
				return $query;
			}

			// Armazena para busca completa
			$search_all[] = $this->search_fields[$k][0] . ' LIKE ' . $search_escaped;
		}

		// Caso busca exata não tenha sido identificada, então define a pesquisa genérica
		$query->where('(' . implode(' OR ', $search_all) . ')');
		//die('(' . implode(' OR ', $search_all) . ')');

		return $query;
	}

	/**
	 * Verifica se a URL contem parametros do tipo GET para os filtros comuns e, se tiver,
	 * sobrepõe valores de estado
	 * 
	 * @return  void
	 */
	/*
	  private function _overrideStateFilter()
	  {
	  $filters = array('search', 'item', 'tipo');
	  $input = JFactory::getApplication()->input;
	  foreach ($filters AS $filter)
	  {
	  if ($input->get->get('filter_' . $filter))
	  {
	  $this->setState('filter.' . $filter, $input->get->get($filter));
	  }
	  }
	  }
	 */
}
