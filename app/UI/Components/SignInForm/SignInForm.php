<?php declare(strict_types=1);

namespace App\UI\Components\SignInForm;

use App\UI\Components\core\BaseForm;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;

interface SignInFormFactory
{

    public function create(): SignInForm;

}

class SignInForm extends BaseForm
{

    public function render(): void
    {
        $this->template->setFile(__DIR__ . '/signInForm.latte');
        $this->template->render();
    }

    public function createComponentForm(): Form
    {
        $form = $this->createForm();

        $form->addText('email', '')
            ->setRequired('Zadejte email');

        $form->addPassword('password', '')
            ->setRequired('Zadejte heslo');

        $form->addSubmit('submit', '');

        return $form;
    }

    public function processForm(Form $form, ArrayHash $values): void
    {
        $this->onSend($values);
    }

}
