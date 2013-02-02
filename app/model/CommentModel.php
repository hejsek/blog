<?php

/**
 * @author Jakub Heyduk
 */
class CommentModel extends BaseModel
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
	 * @param $id
	 * @return Nette\Database\Table\Selection
	 */
	public function findByArticle($id)
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
	public function create($article, $author, $email, $content)
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