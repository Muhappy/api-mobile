<?php
namespace App\Filament\Resources\UserResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\UserResource\Api\Transformers\UserTransformer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

       $model = $model->where('email', $request->email)->first();

       if(!$model || !Hash::check($request->password, $model->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
       }

       $token = $model->createToken($request->device_name)->plainTextToken;

        return static::sendSuccessResponse([
            'token' => $token,
            'user' => UserTransformer::make($model),
        ]);
    }
}