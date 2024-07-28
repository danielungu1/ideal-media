<?php declare(strict_types=1);

namespace App\UI\Components\core;

use Nette\Application\UI\Control;
use Nette\Application\UI\Template;

/** @property Template $template */
abstract class BaseFrontForm extends Control
{

    public array $onSend = [];

}
