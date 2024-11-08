<?php
namespace App\Filament\Resources\UserResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\UserResource;

class LoginHandler extends Handlers {
    public static string | null $uri = '/login';
    public static string | null $resource = UserResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    public function handler(Request $request)
    {
        $model = new (static::getModel());

       $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
        'device_name' => ['required'],
       ]);
        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}