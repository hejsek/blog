<?php

namespace BackendModule;

use Nette\Application\UI\Form;



/**
 * @author Jakuy Heyduk <heyduk2@seznam.cz>
 */
class ArticlePresenter extends BasePresenter
{

	/**
	 * @var int
	 * @persistent
	 */
	public $page = 1;

	/**
	 * @var \ArticleModel
	 */
	private $articleModel;



	/**
	 * @param \ArticleModel $articleModel
	 */
	public function injectArticleModel(\ArticleModel $articleModel)
	{
		$this->articleModel = $articleModel;
	}



	public function renderList()
	{
		$paginator = new \Nette\Utils\Paginator;
		$paginator->setItemCount($this->articleModel->count());
		$paginator->setItemsPerPage(10);
		$paginator->setPage($this->page);

		$this->template->paginator = $paginator;
		$this->template->articles = $this->articleModel->findAll($paginator->getLength(), $paginator->getOffset());
	}



	/**
	 * @param int $id
	 */
	public function renderView($id)
	{
		$this->template->article = $this->articleModel->findOneById($id);
	}



	/**
	 * @param int $id
	 */
	public function renderEdit($id)
	{
		$this->template->article = $this->articleModel->findOneById($id);
	}



	/**
	 * @return Form
	 */
	public function createComponentForm()
	{
		$form = new Form;

		$form->addText('name', 'Name:')
			->setRequired('Article name must be filled!');

		$form->addText('date', 'Date:')
			->setRequired('Date must be filled!');

		$form->addCheckbox('published', 'Publish');

		$form->addTextArea('content')
			->addRule($form::MIN_LENGTH, 'Article must contain minimal %d characters', 100);

		$form->addButton('save', 'Save');

		$form->onSuccess[] = callback($this, 'processForm');

		return $form;
	}



	/**
	 * @param \Nette\Application\UI\Form $form
	 */
	public function processForm(Form $form)
	{
		dump($form->getValues());
	}
}