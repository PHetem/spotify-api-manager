<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\APIAuth\CustomerAccessController;
use App\Http\Controllers\APIAuth\CustomerAuthController;
use App\Http\Controllers\APITokenController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Http\Controllers\Media\AlbumController;
use App\Http\Controllers\Media\ArtistController;
use App\Http\Controllers\Media\PlaylistController;
use App\Http\Controllers\Media\PodcastController;
use App\Http\Controllers\Media\TrackController;
use App\Models\APIToken;
use App\Models\Customer\Customer;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function create(Request $request) {
        $response = $request->all();

        if (isset($response['error']) || !isset($response['code']))
            throw new Exception('Something went wrong');

        $tokens = CustomerAccessController::getToken($response);
        $user = Customer::requestCustomerData($tokens['access_token']);

        $customer = self::mapResponse($user);

        $customer = Customer::updateOrCreate(['spotifyID' => $customer['spotifyID']], $customer);

        LogController::store('Customer Added: ' . $customer->id);
        self::updateCustomerContent($customer->id, $tokens);
    }

    public function refresh($id) {
        self::updateCustomerMedia($id);

        return self::details($id);
    }

    public function list($pagination = 30) {
        $customers = Customer::paginate($pagination);

        return view('dashboard', compact('customers'));
    }

    public function details($id) {
        $customer = Customer::with('playlists', 'albums', 'podcasts', 'tracks', 'refreshToken', 'accessToken')
                            ->find($id);

        LogController::store('Customer Viewed: ' . $id);
        return view('customer.view', compact('customer'));
    }

    public function delete($id) {
        Customer::find($id)->delete();

        LogController::store('Customer Deleted: ' . $id);
        return redirect()->route('dashboard');
    }

    private function mapResponse($user) {
        $data['spotifyID'] = $user['id'];
        $data['name'] = $user['display_name'];
        $data['email'] = $user['email'];
        $data['country'] = $user['country'];
        $data['followerCount'] = $user['followers']['total'];
        $data['profileURL'] = $user['href'];
        $data['profilePictureURL'] = $user['images'][0]['url'];
        $data['accountType'] = $user['product'];

        return $data;
    }

    private static function updateCustomerContent($id, $tokens) {
        self::updateCustomerTokens($id, $tokens);
        self::updateCustomerMedia($id);
    }

    private static function updateCustomerTokens($id, $tokens) {
        APITokenController::saveCustomerAccess($id, $tokens['access_token'], $tokens['expires_in']);
        APITokenController::saveCustomerRefresh($id, $tokens['refresh_token']);
    }

    private static function updateCustomerMedia($id) {
        PlaylistController::updateCustomerMedia($id);
        ArtistController::updateCustomerMedia($id);
        AlbumController::updateCustomerMedia($id);
        PodcastController::updateCustomerMedia($id);
        TrackController::updateCustomerMedia($id);
    }
}
