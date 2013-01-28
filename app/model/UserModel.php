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



	/**
	 * @param $username
	 * @return Nette\Database\Table\Selection
	 */
	public function findByName($username)
	{
		return $this->getConnection()
			->table('users')
			->select('*')
			->where('username', $username)
			->fetch();
	}

	public static function calculateHash($password, $salt = null)
	{
		if ($salt === null) {
			$salt = '$2a$07$' . Nette\Utils\Strings::random(32) . '$';
		}
		return crypt($password, $salt);
	}

	public function authenticate(array $loginArray)
	{
		list($username, $password) = $loginArray;
		$row = $this->findByName($username);

		if(!$row) {
			throw new Nette\Security\AuthenticationException('User '.$username.' not found.');
		}

		if($row->password !== '1234')
			throw new \Nette\Security\AuthenticationException('Invalid Password.');

		return new Nette\Security\Identity($row->id, NULL, $row->toArray());
		}
}