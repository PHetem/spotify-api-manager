<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

class NavigationHelper {

    public static function forward($parameters = null) {
        $current = self::getCurrent($parameters);

        if ($current['route'] == self::getBaseRoute())
            self::clearHistory();

        $history = self::getHistory();

        if (last($history) != $current)
            self::addToHistory($history, $current);
    }

    public static function back() {
        self::removeLastHistoryElement();
        $history = self::getPrevious();

        $route = $history['route'] ?? self::getBaseRoute();
        $parameters = $history['parameters'] ?? [];

        return redirect()->route($route, $parameters);
    }

    public static function getPrevious() {
        $history = self::getHistory();
        return last($history);
    }

    private static function addToHistory($history, $current) {
        array_push($history, $current);
        session(['history' => $history]);
    }

    private static function removeLastHistoryElement() {
        $history = self::getHistory();
        array_pop($history);
        session(['history' => $history]);
    }

    public static function getHistory() {
        return session()->has('history') ? session('history') : [];
    }

    private static function getCurrent($parameters = null) {
        $current['route'] = Route::currentRouteName();
        $current['parameters'] = $parameters;
        return $current;
    }

    public static function clearHistory() {
        session(['history' => []]);
    }

    private static function getBaseRoute() {
        return 'dashboard';
    }
}

