<?php

declare(strict_types=1);

namespace App\UI\Home;

use App\Model\Service\UserAccountService;
use App\Model\UserAccount;
use App\Services\User;
use App\UI\Components\SignInForm\SignInForm;
use App\UI\Components\SignInForm\SignInFormFactory;
use App\UI\Components\SignUpForm\SignUpForm;
use App\UI\Components\SignUpForm\SignUpFormFactory;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;
use Nette\Security\AuthenticationException;
use Nette\Utils\ArrayHash;

final class HomePresenter extends Presenter
{

    #[Inject]
    public User $user;

    #[Inject]
    public SignUpFormFactory $signUpFormFactory;

    #[Inject]
    public SignInFormFactory $signInFormFactory;

    #[Inject]
    public UserAccountService $userAccountService;

    public function startup()
    {
        parent::startup();

        if ($this->user->isLoggedIn()) {
            $this->redirect('Room:default');
        }
    }

    protected function createComponentSignUpForm(): SignUpForm
    {
        $form = $this->signUpFormFactory->create(new UserAccount);

        $form->onSend[] = function (UserAccount $userAccount, ArrayHash $values) {
            $this->userAccountService->save($userAccount);

            $this->flashMessage('Účet byl úspěšně vytvořen', 'success');

            $this->user->login($userAccount->getEmail(), $values->password);

            $this->redirect('Room:default');
        };

        return $form;
    }

    protected function createComponentSignInForm(): SignInForm
    {
        $form = $this->signInFormFactory->create();

        $form->onSend[] = function (ArrayHash $values) {
            try {
                $this->user->login($values->email, $values->password);
                $this->redirect('Room:default');
            } catch (AuthenticationException $e) {
                $this->flashMessage($e->getMessage(), 'danger');
            }
        };

        return $form;
    }

}
