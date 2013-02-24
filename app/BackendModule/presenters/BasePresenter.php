<?php

namespace BackendModule;

use \Nette\Security\User;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends \Nette\Application\UI\Presenter
{/*
	protected function startup()
	{
		parent::startup();
		if(!$this->user->isLoggedIn())	{
			$this->flashMessage('You must be logged in to access this area!', 'error');
		}

	}
*/
}

