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

}