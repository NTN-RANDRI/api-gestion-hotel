<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Auth\GetAuthByUserable;
use App\Application\UseCases\Reservation\CheckInReservation;
use App\Application\UseCases\Reservation\CheckOutReservation;
use App\Application\UseCases\Reservation\CreatePaiementReservation;
use App\Application\UseCases\Reservation\CreateReservation;
use App\Application\UseCases\Reservation\DeleteReservation;
use App\Application\UseCases\Reservation\GetReservationByClient;
use App\Application\UseCases\Reservation\GetReservationById;
use App\Application\UseCases\Reservation\GetReservationByIdByClientAuth;
use App\Application\UseCases\Reservation\ListReservations;
use App\Application\UseCases\Reservation\ListReservationsByClientAuth;
use App\Application\UseCases\Reservation\UpdateReservation;
use App\Http\Mappers\ClientHttpMapper;
use App\Http\Mappers\PaiementHttpMapper;
use App\Http\Mappers\ReservationHttpMapper;
use App\Http\Requests\Paiement\StorePaiementRequest;
use App\Http\Requests\Reservation\StoreReservationRequest;
use App\Http\Requests\Reservation\UpdateReservationRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    private const RESSOURCE = 'Chambre';

    public function __construct(
        private ListReservations $listReservations,
        private GetReservationById $getReservationById,
        private CreateReservation $createReservation,
        private UpdateReservation $updateReservation,
        private DeleteReservation $deleteReservation,
        private CreatePaiementReservation $createPaiementReservation,
        private CheckInReservation $checkInReservation,
        private CheckOutReservation $checkeOutReservation,
        private GetAuthByUserable $getAuthByUserable,
        private ListReservationsByClientAuth $listReservationByClientAuth,
        private GetReservationByIdByClientAuth $getReservationByIdByClientAuth,
    )
    {}

    public function index(): JsonResponse
    {
        $reservationOutputs = $this->listReservations->execute();

        return ApiResponse::crudSuccess('list', self::RESSOURCE, $reservationOutputs);
    }

    public function indexByAuth()
    {
        $reservationOutputs = $this->listReservationByClientAuth->execute();

        return ApiResponse::crudSuccess('list', self::RESSOURCE, $reservationOutputs);
    }

    public function show(int $id): JsonResponse
    {
        $reservationOutput = $this->getReservationById->execute($id);

        return ApiResponse::crudSuccess('read', self::RESSOURCE, $reservationOutput);
    }

    public function showByAuth(int $id): JsonResponse
    {
        $reservationOutput = $this->getReservationByIdByClientAuth->execute($id);

        return ApiResponse::crudSuccess('read', self::RESSOURCE, $reservationOutput);
    }

    public function store(StoreReservationRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $reservationInput = ReservationHttpMapper::toDTO($validated['reservation']);

        if ($reservationInput->type === 'en_ligne') {
            $auth = $request->user();

            if (class_basename($auth->userable_type) === 'Personnel') {
                abort(403, 'Action non autorisée pour le personnel');
            }

            $client = $this->getAuthByUserable->execute($auth->userable_id, class_basename($auth->userable_type));
        } else {
            $client = ClientHttpMapper::toDTO($validated['client']);
        }

        $paiementInput = PaiementHttpMapper::toDTO($validated['paiement']);
        $reservationOutput = $this->createReservation->execute($client, $reservationInput, $paiementInput);

        return ApiResponse::crudSuccess('create', self::RESSOURCE, $reservationOutput);
    }

    public function update(int $id, UpdateReservationRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $updateReservationInput = ReservationHttpMapper::toUpdateDTO($validated);
        $reservationOutput = $this->updateReservation->execute($id, $updateReservationInput);

        return ApiResponse::crudSuccess('update', self::RESSOURCE, $reservationOutput);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteReservation->execute($id);

        return ApiResponse::crudSuccess('delete', self::RESSOURCE);
    }

    public function storePaiement(int $id, StorePaiementRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $paiementInput = PaiementHttpMapper::toDTO($validated);
        $reservationOutput = $this->createPaiementReservation->execute($id, $paiementInput);

        return ApiResponse::crudSuccess('create', 'Paiement', $reservationOutput);
    }

    public function checkIn(int $id): JsonResponse
    {
        $reservationOutput = $this->checkInReservation->execute($id);

        return ApiResponse::crudSuccess('update', self::RESSOURCE, $reservationOutput);
    }

    public function checkOut(int $id): JsonResponse
    {
        $reservationOutput = $this->checkeOutReservation->execute($id);

        return ApiResponse::crudSuccess('update', self::RESSOURCE, $reservationOutput);
    }

}
