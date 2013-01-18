<?php

namespace FrontendModule;



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
 * @var \ArticleModel
 */
	private $articleModel;

	/**
	 * @var \CommentModel
	 */
	private $commentModel;



	/**
	 * @var \UserModel
	 */
	private $userModel;



	/**
	 * @param \ArticleModel $articleModel
	 */
	public function injectArticleModel(\ArticleModel $articleModel)
	{
		$this->articleModel = $articleModel;
	}


	public function injectUserModel(\UserModel $userModel)
	{
		$this->userModel = $userModel;
	}



	/**
	 * @param \CommentModel
	 */
	public function injectCommentModel(\CommentModel $commentModel)
	{
		$this->commentModel = $commentModel;
	}



	public function renderDefault()
	{
		$this->template->articles = $this->articleModel->findNewest();
	}



	/**
	 * @param string $slug
	 */
	public function renderDetail($slug)
	{
		$this->template->article = $this->articleModel->findOneById($slug);
		$this->template->comments = $this->commentModel->findByArticle($this->template->article->id);
	}



	/**
	 * @return \Nette\Application\UI\Form
	 */
	public function createComponentCommentForm()
	{
		$form = new \Nette\Application\UI\Form;
		$form->addProtection();

		$form->addText('name', 'Name:')
			->setRequired('Name must be filled');

		$form->addText('email', 'E-mail:')
			->addRule($form::EMAIL, 'Wrong e-mail format')
			->setRequired('E-mail must be filled');

		$form->addTextArea('content', 'Text:')
			->setRequired('Text must be filled');

		$form->addSubmit('send', 'Send');

		$form->onSuccess[] = callback($this, 'processCommentForm');

		return $form;
	}



	/**
	 * @param \Nette\Application\UI\Form $form
	 */
	public function processCommentForm(\Nette\Application\UI\Form $form)
	{
		$values = $form->getValues();
		$this->commentModel->create(
			$this->getParameter('id'),
			$values->name,
			$values->email,
			$values->content
		);
		$this->redirect('this');
	}



	public function renderArchive()
	{
		$paginator = new \Nette\Utils\Paginator;
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
