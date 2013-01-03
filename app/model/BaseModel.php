<?php

/**
 * @author Jakub Heyduk
 */
abstract class BaseModel extends \Nette\Object
{

	/**
	 * @var Nette\Database\Connection
	 */
	private $connection;



	/**
	 * @param Nette\Database\Connection $connection
	 */
	public function __construct(\Nette\Database\Connection $connection)
	{
		$this->connection = $connection;
	}



	/**
	 * @return Nette\Database\Connection
	 */
	public function getConnection()
	{
		return $this->connection;
	}

}