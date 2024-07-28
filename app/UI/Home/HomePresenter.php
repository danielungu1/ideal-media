<?php

declare(strict_types=1);

namespace App\UI\Home;

use App\Model\Service\UserAccountService;
use App\Model\UserAccount;
use App\UI\Components\SignUpForm\SignUpForm;
use App\UI\Components\SignUpForm\SignUpFormFactory;
use Nette\Application\UI\Presenter;
use Nette\Security\User;

final class HomePresenter extends Presenter
{

    public function __construct(
        private User $user,
        private SignUpFormFactory $signUpFormFactory,
        private UserAccountService $userAccountService
    )
    {
        parent::__construct();
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

}
