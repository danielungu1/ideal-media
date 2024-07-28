<?php declare(strict_types=1);

namespace App\UI\Components\SignUpForm;

use App\Model\UserAccount;
use App\UI\Components\core\BaseForm;
use App\UI\Components\core\FormFactory;
use Nette\Application\UI\Template;
use Nette\Forms\Form;
use Nette\Utils\ArrayHash;

interface SignUpFormFactory
{

    public function create(UserAccount $userAccount): SignUpForm;

}

/** @property Template $template */
class SignUpForm extends BaseForm
{

    public function __construct(FormFactory $formFactory, private UserAccount $userAccount)
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

        $form->addEmail('email', 'front.email')
            ->setHtmlAttribute('placeholder', '@')
            ->setRequired()
            ->addRule([$this, 'isEmailFreeToAssign'], 'front.emailAlreadyExists');

        $form->addPassword('password', 'front.password')
            ->setRequired()
            ->addRule(Form::Pattern, 'front.passwordValidation', UserAccount::PASSWORD_REGEX);

        $form->addPassword('passwordVerify', 'front.passwordVerify')
            ->setRequired()
            ->addRule(Form::Equal, 'front.passwordsDontMatch', $form['password']);

        return $form;
    }

    public function validateForm($form, $values)
    {

    }

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function processForm(Form $form, ArrayHash $values): void
    {

    }

}
