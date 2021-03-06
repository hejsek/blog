<?php

/**
 * @author Jakub Heyduk
 */
class ArticleModel extends BaseModel
{

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
	 * @param int $author
	 * @param DateTime $date
	 * @param string $name
	 * @param bool $published
	 * @param string $content
	 */
	public function create($author, $date, $name, $published, $content)
	{
		$this->getConnection()->query('INSERT INTO article', array(
			'author_id' => $author,
			'date' => $date,
			'name' => $name,
			'published' => $published,
			'content' => $content,
		));
	}



	/**
	 * @param int $id
	 * @return Nette\Database\Table\Selection
	 */
	public function delete($id)
	{
		return $this->getConnection()->exec('DELETE FROM article WHERE id =?', $id);
	}



	/**
	 * @param int $id
	 * @param int $author
	 * @param \DateTime $date
	 * @param string $name
	 * @param bool $published
	 * @param string $content
	 * @return int
	 */
	public function edit($id, $author, \DateTime $date, $name, $published, $content)
	{
		$values = array(
			'author_id' => $author,
			'date' => $date,
			'name' => $name,
			'published' => $published,
			'content' => $content,
		);

		$this->getConnection()->exec('UPDATE article SET ? WHERE id = ?', $values, $id);
	}

}