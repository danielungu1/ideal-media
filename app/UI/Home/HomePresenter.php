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
use Nette\Utils\ArrayHash;

final class HomePresenter extends Presenter
{

    public function __construct(
        private User $user,
        private SignUpFormFactory $signUpFormFactory,
        private SignInFormFactory $signInFormFactory,
        private UserAccountService $userAccountService
    )
    {
        parent::__construct();
    }

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

        $form->onSend[] = function (UserAccount $userAccount) {
            $this->userAccountService->save($userAccount);

            $this->flashMessage('Účet byl úspěšně vytvořen', 'success');

            $this->user->login($userAccount->getEmail(), $userAccount->getPassword());
        };

        return $form;
    }

    protected function createComponentSignInForm(): SignInForm
    {
        $form = $this->signInFormFactory->create();

        $form->onSend[] = function (ArrayHash $values) {
            $this->user->login($values->email, $values->password);
        };

        return $form;
    }

}
