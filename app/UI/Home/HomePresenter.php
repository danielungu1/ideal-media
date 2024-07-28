<?php

declare(strict_types=1);

namespace App\UI\Home;

use App\Model\UserAccount;
use App\UI\Components\SignUpForm\SignUpForm;
use App\UI\Components\SignUpForm\SignUpFormFactory;
use Nette\Application\UI\Presenter;

final class HomePresenter extends Presenter
{

    protected function createComponentSignUpForm(SignUpFormFactory $factory): SignUpForm
    {
        $form = $factory->create(new UserAccount);

        $form->onSend[] = function (
            UserAccount $userAccount,
            string $email,
            string $password,
        ) {

        };

        return $form;
    }

}
