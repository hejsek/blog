<?php

/**
 * Homepage presenter.
 */
class ArticlePresenter extends BasePresenter
{

	/**
	 * @var int
	 * @persistent
	 */
	public $page = 1;

	/**
	 * @var ArticleModel
	 */
	private $articleModel;



	/**
	 * @param ArticleModel $articleModel
	 */
	public function injectArticleModel(ArticleModel $articleModel)
	{
		$this->articleModel = $articleModel;
	}



	public function renderDefault()
	{
		$this->template->articles = $this->articleModel->findNewest();
	}



	/**
	 * @param int $id
	 */
	public function renderDetail($id)
	{
		$this->template->article = $this->articleModel->findOneById($id);
	}



	public function renderArchive()
	{
		$paginator = new Nette\Utils\Paginator;
		$paginator->setItemCount($this->articleModel->count());
		$paginator->setItemsPerPage(10);
		$paginator->setPage($this->page);

		$this->template->paginator = $paginator;
		$this->template->articles = $this->articleModel->findAll($paginator->getLength(), $paginator->getOffset());
	}



	public function renderRss()
	{
		$this->template->articles = $this->articleModel->findAll();
	}

}
