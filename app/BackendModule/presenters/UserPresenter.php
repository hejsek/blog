<?php

namespace BackendModule;

use Nette\Application\UI\Form;




/**
 * @author Jakuy Heyduk <heyduk2@seznam.cz>
 */
class UserPresenter extends BasePresenter
{

	/**
	 * @var $userModel
	 */
	private $userModel;



	/**
	 * @param \UserModel $userModel
	 */
	public function injectUserModel(\UserModel $userModel)	{
		$this->userModel = $userModel;
	}


	public function renderList()	{
		$paginator = new \Nette\Utils\Paginator;
		$paginator->setItemCount($this->articleModel->count());
		$paginator->setItemsPerPage(10);
		$paginator->setPage($this->page);

		$this->template->paginator = $paginator;
		$this->template->users = $this->userModel->findAll($paginator->getLength(), $paginator->getOffset());
	}

}