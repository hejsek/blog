<?php

namespace BackendModule;

use Nette\Application\UI\Form;
use Nette\Application\UI\Control;



/**
 * @author Jakuy Heyduk <heyduk2@seznam.cz>
 */
class LoginPresenter extends BasePresenter
{

	/**
	 * @return Form
	 */
	protected function createComponentLoginForm()
	{
		$form = new Form;

		$form->addText('username', 'Username:')
			->setRequired('Username must be filled!')
			->setAttribute('class', 'span4')
			->setAttribute('placeholder', 'Username');

		$form->addPassword('password', 'Password:')
			->setRequired('Password must be filled')
			->setAttribute('class', 'span4')
			->setAttribute('placeholder', 'Password');


		$form->addSubmit('submit');

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
			//$this->redirect('Article:list');;
			$user->getRoles();
			$this->redirect('Article:list');
		} catch(\AuthenticationException $e) {
			$form->addError($e);
		}
	}



	public function actionLogout()
	{
		$this->getUser()->logout();
		$this->flashMessage('Logout has been successful.', 'warning');
		$this->redirect('Login:');
	}

}