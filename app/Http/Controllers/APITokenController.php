<?php

namespace App\Http\Controllers;

use App\Http\Controllers\APIAuth\UserAccessController;
use App\Models\APIToken;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;

class APITokenController extends Controller
{
    private static function get($id, $userType, $tokenType) {
        if (!in_array($userType, ['User', 'Customer']))
            throw new InvalidArgumentException('User type has to be User or Customer');

        return APIToken::get($id, $userType, $tokenType);
    }

    public static function isValid(APIToken $token) {
        return $token->expiresAt > time() - 10;
    }

    private static function updateOrCreate($data) {
        APIToken::updateOrCreate([
            'type' => $data['type'],
            'customerID' => $data['customerID'] ?? '0',
            'userID' => $data['userID'] ?? '0',
        ], $data);
    }

    public static function refreshUserAccess() {
        $tokenData = UserAccessController::getToken();

        self::saveUserAccess($tokenData['access_token'], $tokenData['expires_in']);
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

    public static function saveUserAccess($token, $expiresIn) {
        $data = [
            'type' => 'Access',
            'token' => $token,
            'userID' => Auth::user()->id,
            'expiresAt' => time() + $expiresIn
        ];
        return self::updateOrCreate($data);
    }

    public static function saveCustomerAccess($id, $token, $expiresIn) {
        $data = [
            'type' => 'Access',
            'token' => $token,
            'customerID' => $id,
            'expiresAt' => time() + $expiresIn
        ];
        return self::updateOrCreate($data);
    }

    public static function saveCustomerRefresh($id, $token, $expiresIn) {
        $data = [
            'type' => 'Refresh',
            'token' => $token,
            'customerID' => $id
        ];
        return self::updateOrCreate($data);
    }
}
