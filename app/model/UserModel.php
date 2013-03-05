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

	public function findAll($limit = NULL, $offset = NULL)
	{
		$table = $this->getConnection()
			->table('users')
			->select('*');

		if ($limit !== NULL && $offset !== NULL) {
			$table->limit($limit, $offset);
		}

		return $table;
	}

	public function count()	{
		return $this->getConnection()
			->table('users')
			->count();
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
	//TODO Refactor - New login system.
	public function authenticate(array $loginArray)
	{
		list($username, $password) = $loginArray;
		$user = $this->findByName($username);
		if(!$user) {
			throw new Nette\Security\AuthenticationException('Bad login');
		}

		if($user->password !== $password)
			throw new \Nette\Security\AuthenticationException('Bad password');


		return new Nette\Security\Identity($user->id, NULL, $user->toArray());
		}
}