<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Customer\APIAuth\APIAuthController;
use App\Models\APIToken;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;

class APITokenController extends Controller
{
    public static function get($id, $userType, $tokenType) {
        if (!in_array($userType, ['User', 'Customer']))
            throw new InvalidArgumentException('User type has to be User or Customer');

        return APIToken::get($id, $userType, $tokenType);
    }

    public static function isValid(APIToken $token) {
        return $token->expiresAt > time() - 10;
    }

    public static function updateOrCreate($data) {
        APIToken::updateOrCreate([
            'type' => $data['type'],
            'customerID' => $data['customerID'] ?? '0',
            'userID' => $data['userID'] ?? '0',
        ], $data);
    }

    public static function refreshUserAccess($userID) {
        $tokenData = APIAuthController::getNewUserAccessToken();

        $token = $tokenData['access_token'];
        $expiresAt = time() + $tokenData['expires_in'];

        $data = ['userID' => $userID, 'token' => $token, 'expiresAt' => $expiresAt, 'type' => 'Access'];

        self::updateOrCreate($data);
    }

    public static function getUserAccess() {
        return self::get(Auth::user()->id, 'User', 'Access');
    }

    public static function getCustomerAccess($id) {
        return self::get($id, 'Customer', 'Access');
    }

    public static function getCustomerRefresh($id) {
        return self::get($id, 'Customer', 'Refresh');
    }
}
