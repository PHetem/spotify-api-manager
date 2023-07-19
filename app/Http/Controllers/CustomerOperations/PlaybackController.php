<?php

namespace App\Http\Controllers\CustomerOperations;

use App\Http\Controllers\APITokenController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomerOperations\Player\NavigationController;
use App\Http\Controllers\CustomerOperations\Player\StateController;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class PlaybackController extends Controller
{

    protected $customerID;
    protected $token;
    protected $data;

    public function __construct(Request $request) {
        if (!isset($request['id']))
            throw new InvalidParameterException('Missing customer ID');

        $this->data = $request->all();
        $this->customerID = $request['id'];
        $this->token = APITokenController::getCustomerAccess($this->customerID)->token;
    }

    public function getPlayback() {
        $data = app(StateController::class)->getState();

        $DeviceController = app(DeviceController::class);
        if ($DeviceController->hasActiveDevice()) {
            $data['track'] = app(NavigationController::class)->getCurrentTrack();
            $data['queue'] = app(QueueController::class)->getQueue();
        } else {
            $data['track'] = null;
            $data['queue'] = null;
        }

        $data['devices'] = $DeviceController->getDevices();

        return $data;
    }

    public function renderPlayer() {
        return view('player.main', ['playback' => $this->getPlayback(), 'customerID' => $this->customerID]);
    }
}
