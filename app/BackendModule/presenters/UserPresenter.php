<?php

namespace BackendModule;

use Nette\Application\UI\Form;



/**
 * @author Jakuy Heyduk <heyduk2@seznam.cz>
 */
class UserPresenter extends BasePresenter
{

	/**
	 * @var \UserModel
	 */
	private $userModel;



	/**
	 * @param \UserModel $userModel
	 */
	public function injectUserModel(\UserModel $userModel)
	{
		$this->userModel = $userModel;
	}



	public function renderForm($name)
	{
		$this->template->form = $this->userModel->findByName($name);
	}



	/**
	 * @return Form
	 */
	protected function createComponentLoginForm()
	{
		$form = new Form;

		$form->addText('username', 'Username:')
			->setRequired('Username must be filled!');

		$form->addPassword('password', 'Password:')
			->setRequired('Password must be filled');

		$form->addSubmit('submit', 'Submit');

		$form->onSuccess[] = $this->processLoginForm;

		return $form;
	}



	/**
	 * @param \Nette\Application\UI\Form $form
	 */
	public function processLoginForm(Form $form)
	{
		try {
			$user = $this->getUser();
			$values = $form->getValues();

			$user->login($values->username, $values->password);
			$this->flashMessage('You have been logged in.', 'success');
		} catch(\AuthenticationException $e) {
			$form->addError('Bad username or password');
			$this->reditect('Login:');
		}
	}



	public function actionLogout()
	{
		$this->getUser()->logout();
		$this->flashMessage('Byl jste úspěšně odhlášen', 'success');
		$this->redirect('Article:list');
	}

}