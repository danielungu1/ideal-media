<?php declare(strict_types=1);

namespace App\UI\Components\SignUpForm;

use App\Model\Facade\UserAccountFacade;
use App\Model\UserAccount;
use App\UI\Components\core\BaseForm;
use App\UI\Components\core\FormFactory;
use Nette\Forms\Controls\BaseControl;
use Nette\Forms\Form;
use Nette\Utils\ArrayHash;

interface SignUpFormFactory
{

    public function create(UserAccount $userAccount): SignUpForm;

}

class SignUpForm extends BaseForm
{

    public function __construct(
        FormFactory $formFactory,
        private UserAccount $userAccount,
        private UserAccountFacade $userAccountFacade
    )
    {
        parent::__construct($formFactory);
    }

    public function render(): void
    {
        $this->template->setFile(__DIR__ . '/signUpForm.latte');
        $this->template->render();
    }

    public function createComponentForm(): Form
    {
        $form = $this->createForm();

        $form->addText('email', '')
            ->setHtmlAttribute('placeholder', '@')
            ->setRequired('Zadejte email')
            ->addRule(Form::Email, 'Zadejte platný email')
            ->addRule([$this, 'isEmailFreeToAssign'], 'Tento email je již používán!');

        $form->addPassword('password', '')
            ->setRequired('Zadejte heslo')
            ->addRule(
                Form::Pattern,
                'Heslo musí obsahovat alespoň 6 znaků, z toho jedno číslo a jedno velké písmeno',
                UserAccount::PASSWORD_REGEX
            );

        $form->addPassword('passwordVerify', '')
            ->setRequired('Zadejte heslo znovu')
            ->addRule(Form::Equal, 'Zadaná hesla nesouhlasí', $form['password']);

        $form->addSubmit('submit', '');

        return $form;
    }

    public function processForm(Form $form, ArrayHash $values): void
    {
        $userAccount = $this->userAccount;
        $userAccount->setEmail($values->email);
        $userAccount->setPassword($values->password);

        $this->onSend($userAccount);
    }

    /////////////////////////////////////////////// Utils

    public function isEmailFreeToAssign(BaseControl $control): bool
    {
        return $this->userAccountFacade->isEmailFreeToAssign($this->userAccount, $control->getValue());
    }

}
