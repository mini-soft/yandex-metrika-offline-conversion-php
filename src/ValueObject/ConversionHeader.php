<?php

namespace Meiji\YandexMetrikaOffline\ValueObject;


use Meiji\YandexMetrikaOffline\Scope\Upload;


/**
 * Class ConversionHeader
 *
 * @package Meiji\YandexMetrikaOffline\ValueObject
 */
class ConversionHeader
{
	
	/**
	 *
	 */
	const CLIENT_ID_TYPE_USER_COLUMN_NAME  = 'UserId';
	/**
	 *
	 */
	const CLIENT_ID_TYPE_CIENT_COLUMN_NAME = 'ClientId';
	
	/**
	 * @var array
	 */
	private static $availableColumns = ['UserId', 'ClientId', 'Target', 'DateTime', 'Price', 'Currency'];
	
	/**
	 * @var null
	 */
	private $ClientIdType;
	/**
	 * @var
	 */
	private $usesColumns;
	
	/**
	 * ConversionHeader constructor.
	 *
	 * @param null $client_id_type
	 */
	public function __construct(&$client_id_type = null)
	{
		
		$this->ClientIdType = &$client_id_type;
		
		$this->setDefaultUsesColumns();
	}
	
	/**
	 * @return string
	 */
	public function getString()
	{
		
		$typeColumnName = $this->ClientIdType == Upload::CLIENT_ID_TYPE_USER ? self::CLIENT_ID_TYPE_USER_COLUMN_NAME :
			self::CLIENT_ID_TYPE_CIENT_COLUMN_NAME;
		
		$headerString = $typeColumnName;
		foreach ($this->usesColumns as $columnName) {
			$headerString .= "," . $columnName;
		}
		
		return $headerString;
	}
	
	/**
	 *
	 */
	public function setDefaultUsesColumns()
	{
		
		$this->usesColumns = [];
		$this->addUsesColumn('Target');
		$this->addUsesColumn('DateTime');
	}
	
	/**
	 * @param $name
	 */
	public function addUsesColumn($name)
	{
		
		if (in_array($name, self::$availableColumns)) {
			if (!in_array($name, $this->usesColumns)) {
				$this->usesColumns[] = $name;
			}
		}
	}
	
	/**
	 * @return mixed
	 */
	public function getUsesColumns()
	{
		
		return $this->usesColumns;
	}
	
	/**
	 * @return int
	 */
	public function count()
	{
		
		return count($this->usesColumns) + 1;
	}
	
}
