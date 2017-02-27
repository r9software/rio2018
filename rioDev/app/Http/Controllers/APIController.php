<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Device;

class APIController extends Controller {

    /**
     * 
     */
    public function generar() {
        session_start();
        if (!isset($_SESSION['session_key'])) {
            do {
                $key = APIController::generateRandomString();
                $count = Device::where('session_key', $key)
                        ->count();
            } while ($count > 0);
            $device = new Device;
            $device->session_key = $key;
            $device->save();
            $_SESSION['session_key'] = $key;
        } else {
            $key = $_SESSION['session_key'];
        }
        return json_encode(["sync_key" => $key, "step" => 1, "status" => "PENDIENTE"]);
    }

    public function sincronizar($key) {
        session_start();
        if (isset($_SESSION['session_key']) && $_SESSION['session_key'] == $key) {
            return json_encode(["status" => "SYNCHRONIZED"]);
        }
        $count = Device::where('session_key', $key)
                ->count();
        if ($count > 0) {
            Device::where('session_key', $key)->update(['sincronized' => 1]);
            $_SESSION['session_key'] = $key;
            return json_encode(["status" => "SYNCHRONIZED"]);
        } else {
            return json_encode(["status" => "NOT FOUND"]);
        }
    }

    public function status() {
        session_start();
        if (isset($_REQUEST['session_key'])) {
            $key = $_REQUEST['session_key'];
            $count = Device::where('session_key', $key)
                    ->count();
            if ($count > 0) {
                return json_encode(Device::where('session_key', $key)->get());
            } else {
                return json_encode(["status" => "NOT FOUND"]);
            }
        } else {
            return json_encode(["status" => "NOT FOUND"]);
        }
    }

    public function reiniciarPaso() {
        if (isset($_REQUEST['session_key'])) {
            $key = $_REQUEST['session_key'];
            $count = Device::where('session_key', $key)
                    ->count();
            if ($count > 0) {
                Device::where('session_key', $key)->update(['status' => "PENDIENTE"]);
                return json_encode(Device::where('session_key', $key)->get());
            } else {
                return json_encode(["status" => "NOT FOUND"]);
            }
        } else {
            return json_encode(["status" => "NOT FOUND"]);
        }
    }

    public function actualizarStatus() {
        if (isset($_REQUEST['session_key']) && isset($_REQUEST['status']) && ($_REQUEST['status'] == "CORRECTO") || $_REQUEST['status'] == "ERRONEO") {
            $key = $_REQUEST['session_key'];
            $count = Device::where('session_key', $key)
                    ->count();
            if ($count > 0) {
                Device::where('session_key', $key)->update(['status' => $_REQUEST['status']]);
                return json_encode(Device::where('session_key', $key)->get());
            } else {
                return json_encode(["status" => "KEY NOT FOUND"]);
            }
        } else {
            return json_encode(["status" => "STATUS OR KEY NOT FOUND"]);
        }
    }

    public function siguientePaso() {
        if (isset($_REQUEST['session_key'])) {
            $key = $_REQUEST['session_key'];
            $count = Device::where('session_key', $key)
                    ->count();
            if ($count > 0) {
                $devices = Device::where('session_key', $key)->get();
                foreach ($devices as $device) {
                    $device->step = $device->step + 1;
                    $device->status = "PENDIENTE";
                    $device->save();
                }
                return json_encode(Device::where('session_key', $key)->get());
            } else {
                return json_encode(["status" => "KEY NOT FOUND"]);
            }
        } else {
            return json_encode(["status" => "STATUS OR KEY NOT FOUND"]);
        }
    }

    public static function generateRandomString($length = 7) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
