<?php

/**
 * @author Jakub Heyduk
 */
class UserModel extends BaseModel
{

	/**
	 * @return array
	 */
	public function getPairs()
	{
		$authors = $this->getConnection()
			->table('author')
			->select('*');

		$pairs = array();
		foreach ($authors as $author) {
			$pairs[$author->id] = $author->name;
		}
		return $pairs;
	}

}