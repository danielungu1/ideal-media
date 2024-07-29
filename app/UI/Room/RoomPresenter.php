<?php

declare(strict_types=1);

namespace App\UI\Room;

use App\Model\Facade\RoomFacade;
use App\Model\Facade\RoomReservationFacade;
use App\Model\Facade\UserAccountFacade;
use App\Model\Room;
use App\Model\Service\RoomReservationService;
use App\UI\Components\ReservationForm\ReservationForm;
use App\UI\Components\ReservationForm\ReservationFormFactory;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;
use Nette\Utils\ArrayHash;

final class RoomPresenter extends Presenter
{

    #[Inject]
    public ReservationFormFactory $reservationFormFactory;

    #[Inject]
    public RoomFacade $roomFacade;

    #[Inject]
    public UserAccountFacade $userAccountFacade;

    #[Inject]
    public RoomReservationFacade $roomReservationFacade;

    #[Inject]
    public RoomReservationService $roomReservationService;

    private Room $room;

    public const NAVBAR_ITEMS = [
        'Konferenční místnosti' => 'Room:default',
        'Mé rezervace' => 'Room:myReservations',
        'Odhlášení' => 'Room:out',
    ];

    public function startup()
    {
        parent::startup();

        $this->template->navbarItems = self::NAVBAR_ITEMS;
    }

    public function actionDefault(): void
    {
        $this->template->rooms = $this->roomFacade->getAvailableRoom();
    }

    public function actionMyReservations(): void
    {
        $this->template->reservations = $this->roomReservationFacade->findBy([
            'userAccount' => (string) $this->getUser()->getId()
        ]);
    }

    public function actionReservation(string $id): void
    {
        if (!$room = $this->roomFacade->find($id)) {
            $this->flashMessage('Místnost nebyla nalezena');
            $this->redirect('Room:default');
        }

        $this->template->room = $this->room = $room;
    }

    public function actionDeleteReservation(string $id): void
    {
        if (!$reservation = $this->roomReservationFacade->find($id)) {
            $this->flashMessage('Rezervace nebyla nalezena');
            $this->redirect('Room:myReservations');
        }

        $this->roomReservationService->delete($reservation);
        $this->flashMessage('Rezervace byla smazána');
        $this->redirect('Room:myReservations');
    }

    public function actionOut(): void
    {
        $this->getUser()->logout(true);
        $this->redirect('Home:');
    }

    protected function createComponentReservationForm(): ReservationForm
    {
        $userAccount = $this->userAccountFacade->find((string) $this->getUser()->getId());
        $form = $this->reservationFormFactory->create($this->room, $userAccount);

        $form->onSend[] = function (ArrayHash $values) {
        };

        return $form;
    }

}
