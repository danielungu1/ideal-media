<?php

declare(strict_types=1);

namespace App\UI\Room;

use App\Model\Facade\RoomFacade;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;

final class RoomPresenter extends Presenter
{

    #[Inject]
    public RoomFacade $roomFacade;

    public const NAVBAR_ITEMS = [
        'Konferenční místnosti' => 'Room:default',
        'Mé rezervace' => 'Room:myReservations',
        'Odhlášení' => 'Room:out'
    ];

    public function actionDefault(): void
    {
        $this->template->navbarItems = self::NAVBAR_ITEMS;
        $this->template->rooms = $this->roomFacade->findAll();
    }

    public function actionMakeReservation(string $id): void
    {

    }

    public function actionMyReservations(): void
    {

    }

    public function actionReservation(string $id): void
    {

    }

    public function actionOut(): void
    {
        $this->getUser()->logout(true);
    }

}
