<?php declare(strict_types=1);

namespace App\UI\Components\core;

use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Application\UI\Template;

/** @property Template $template */
abstract class BaseForm extends Control
{

    public array $onSend = [];

    public function __construct(protected FormFactory $formFactory)
    {
    }

    protected function createForm(): Form
    {
        $form = $this->formFactory->create();

        $this->addComponent($form, 'form');

        $form->onSuccess[] = [$this, 'processForm'];

        if (method_exists($this, 'validateForm')) {
            $form->onValidate[] = [$this, 'validateForm'];
        }

        return $form;
    }

}
