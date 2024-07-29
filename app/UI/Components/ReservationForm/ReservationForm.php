<?php declare(strict_types=1);

namespace App\UI\Components\ReservationForm;

use App\Model\Facade\RoomAvailabilityFacade;
use App\Model\Room;
use App\Model\RoomReservation;
use App\Model\Service\RoomReservationService;
use App\Model\UserAccount;
use App\UI\Components\core\BaseForm;
use App\UI\Components\core\FormFactory;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;

interface ReservationFormFactory
{

    public function create(Room $room, UserAccount $userAccount): ReservationForm;

}

class ReservationForm extends BaseForm
{

    public function __construct(
        FormFactory $formFactory,
        private UserAccount $userAccount,
        private Room $room,
        private RoomAvailabilityFacade $roomAvailabilityFacade,
        private RoomReservationService $roomReservationService
    )
    {
        parent::__construct($formFactory);
    }

    public function render(): void
    {
        $this->template->availabilities = $this->room->getAvailabilities();
        $this->template->setFile(__DIR__ . '/reservationForm.latte');
        $this->template->render();
    }

    public function createComponentForm(): Form
    {
        $form = $this->createForm();

        $container = $form->addContainer('availability');

        foreach ($this->room->getAvailabilities() as $availability) {
            $container->addCheckbox($availability->getId(), '');
        }

        $form->addSubmit('submit', '');

        return $form;
    }

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function processForm(Form $form, ArrayHash $values): void
    {
        foreach ($values->availability as $availabilityId => $selected) {
            if ($selected) {
                $reservation = new RoomReservation;
                $reservation->setRoomAvailability($this->roomAvailabilityFacade->find((string) $availabilityId));
                $reservation->setUserAccount($this->userAccount);

                $this->roomReservationService->save($reservation);
            }
        }

        $this->onSend($values);
    }

}
