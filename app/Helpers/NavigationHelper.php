<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

class NavigationHelper {

    public static function forward($parameters = null) {
        $history = self::getHistory();
        $current = self::getCurrent($parameters);

        if (last($history) != $current)
            self::addToHistory($history, $current);
    }

    public static function back() {
        self::removeLastHistoryElement();
        $history = self::getPrevious();

        $route = $history['route'] ?? 'dashboard';
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

    private static function getHistory() {
        return session()->has('history') ? session('history') : [];
    }

    private static function getCurrent($parameters = null) {
        $current['route'] = Route::currentRouteName();
        $current['parameters'] = $parameters;
        return $current;
    }

}

