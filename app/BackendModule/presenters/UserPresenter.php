<?php

namespace BackendModule;

use Nette\Application\UI\Form;



/**
 * @author Jakuy Heyduk <heyduk2@seznam.cz>
 */
class LoginPresenter extends BasePresenter
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

	public function processLoginForm(Form $form)
	{
		try {
			$user = $this->getUser();
			$values = $form->getValues();

			$user->login($values->username, $values->password);
			$this->flashMessage('You have been logged in.', 'succes');
		} catch(\AuthenticationException $e) {
			$form->addError('Bad username or password');
		}
	}
}