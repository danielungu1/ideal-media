<?php declare(strict_types=1);

namespace App\UI\Components\SignUpForm;

use App\Model\UserAccount;
use App\UI\Components\core\BaseFrontForm;
use Nette\Application\UI\Template;
use Nette\Forms\Form;
use Nette\Utils\ArrayHash;

interface SignUpFormFactory
{

    public function create(UserAccount $userAccount): SignUpForm;

}

/** @property Template $template */
class SignUpForm extends BaseFrontForm
{

    public function __construct(private UserAccount $userAccount)
    {
    }

    public function render(): void
    {
        $this->template->setFile(__DIR__ . '/signUpForm.latte');
        $this->template->render();
    }

    public function createComponentForm(): Form
    {
        return new Form();
    }

    public function validateForm($form, $values)
    {

    }

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function processForm(Form $form, ArrayHash $values): void
    {

    }

}
