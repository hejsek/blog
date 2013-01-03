<?php

/**
 * @author Jakub Heyduk
 */
class ArticleModel extends BaseModel
{

	/**
	 * @var \Nette\Http\Request
	 */
	private $httpRequest;



	/**
	 * @param Nette\Database\Connection $connection
	 * @param Nette\Http\Request $httpRequest
	 */
	public function __construct(\Nette\Database\Connection $connection, \Nette\Http\Request $httpRequest)
	{
		parent::__construct($connection);
		$this->httpRequest = $httpRequest;
	}



	/**
	 * @return Nette\Database\Table\Selection
	 */
	public function findNewest()
	{
		return $this->getConnection()
			->table('article')
			->select('*')
			->order('date DESC')
			->limit(5);
	}



	/**
	 * @param int $id
	 * @return Nette\Database\Table\ActiveRow
	 */
	public function findOneById($id)
	{
		return $this->getConnection()
			->table('article')
			->select('*')
			->where('id', $id)
			->limit(1)
			->fetch();
	}



	/**
	 * @param string $slug
	 * @return Nette\Database\Table\ActiveRow
	 */
	public function findOneBySlug($slug)
	{
		return $this->getConnection()
			->table('article')
			->select('*')
			->where('slug', $slug)
			->limit(1)
			->fetch();
	}



	/**
	 * @param int $limit
	 * @param int $offset
	 * @return Nette\Database\Table\Selection
	 */
	public function findAll($limit = NULL, $offset = NULL)
	{
		$table = $this->getConnection()
			->table('article')
			->select('*')
			->order('date DESC');

		if ($limit !== NULL && $offset !== NULL) {
			$table->limit($limit, $offset);
		}

		return $table;
	}



	/**
	 * @return int
	 */
	public function count()
	{
		return $this->getConnection()
			->table('article')
			->count();
	}



	/**
	 * @param $id
	 * @return Nette\Database\Table\Selection
	 */
	public function findComments($id)
	{
		return $this->getConnection()
			->table('comment')
			->select('*')
			->where('article_id', $id)
			->order('date ASC');
	}



	/**
	 * @param int $article
	 * @param string $author
	 * @param string $email
	 * @param string $content
	 */
	public function addComment($article, $author, $email, $content)
	{
		$this->getConnection()->query('INSERT INTO comment', array(
			'article_id' => $article,
			'author' => $author,
			'email' => $email,
			'content' => $content,
			'ip' => $this->httpRequest->getRemoteAddress(),
			'date' => new \DateTime,
		));
	}

}