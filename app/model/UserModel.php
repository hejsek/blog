<?php

/**
 * @author Jakub Heyduk
 */
class UserModel extends BaseModel implements \Nette\Security\IAuthenticator
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



	/**
	 * @param $password
	 * @param null $salt
	 * @return string
	 */
	public static function calculateHash($password, $salt = NULL)
	{
		if ($salt === NULL) {
			$salt = '$2a$07$' . Nette\Utils\Strings::random(32) . '$';
		}
		return crypt($password, $salt);
	}



	/**
	 * @param array $loginArray
	 * @return Nette\Security\Identity|Nette\Security\IIdentity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $loginArray)
	{
		list($username, $password) = $loginArray;
		$row = $this->findByName($username);
		if(!$row) {
			throw new Nette\Security\AuthenticationException('User '.$username.' not found.');
		}

		if($row->password !== $password)
			throw new \Nette\Security\AuthenticationException('Invalid Password');

		return new Nette\Security\Identity($row->id, NULL, $row->toArray());
		}
}