<?php

class Session {
    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $value) {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null) {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    public static function has($key) {
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function remove($key) {
        self::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy() {
        self::start();
        session_destroy();
        $_SESSION = [];
    }

    public static function setFlash($key, $message) {
        self::start();
        $_SESSION['flash'][$key] = $message;
    }

    public static function getFlash($key) {
        self::start();
        if (isset($_SESSION['flash'][$key])) {
            $msg = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $msg;
        }
        return null;
    }

    public static function hasFlash($key) {
        self::start();
        return isset($_SESSION['flash'][$key]);
    }

    public static function isLoggedIn() {
        return self::has('user_id');
    }

    public static function getUserId() {
        return self::get('user_id');
    }

    public static function getUserName() {
        return self::get('user_nombre');
    }
}
