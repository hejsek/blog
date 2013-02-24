<?php

namespace BackendModule;

use Nette\Application\UI\Form;



/**
 * @author Jakuy Heyduk <heyduk2@seznam.cz>
 * @User loggedIn
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



	/**
	 * @param \UserModel $userModel
	 */
	public function injectUserModel(\UserModel $userModel)
	{
		$this->userModel = $userModel;
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
	 * @param $id
	 */
	public function actionDelete($id)
	{
		$this->template->article =  $this->articleModel->delete($id);
		$this->redirect('list');
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
		$this->template->article = $this['form']->setDefaults($this->articleModel->findOneById($id));
		$this->template->article = $id;
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

		$form->addSelect('author', 'Author:')
			->setItems($this->userModel->getPairs());

		$form->addCheckbox('published', 'Publish');

		$form->addTextArea('content')
			->addRule($form::MIN_LENGTH, 'Article must contain minimal %d characters', 100);

		$form->addSubmit('save', 'Save');

		$form->onSuccess[] = callback($this, 'processForm');

		return $form;
	}



	/**
	 * @param \Nette\Application\UI\Form $form
	 */
	public function processForm(Form $form)
	{
		$values = $form->getValues();
		$values['date'] = \Nette\DateTime::from($values->date);

		if ((int) $this->getParameter('id')) {
			$this->articleModel->edit($this->getParameter('id'), $values->author, $values->date, $values->name, $values->published, $values->content);
		} else {
			$this->articleModel->create($values->author, $values->date, $values->name, $values->published, $values->content);
		}
		$this->redirect('list');
	}

}