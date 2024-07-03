<?php

namespace App\Filament\Resources\UserResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\UserResource;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserApiService extends ApiService
{
    protected static string | null $resource = UserResource::class;

    public static function handlers(): array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                return $this->sendError('Unauthorized', 'Authentication Failed', 401);
            }

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw new Exception('Invalid Credentials');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return $this->sendResponse([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 'Authenticated');
        } catch (Exception $error) {
            return $this->sendError(
                'Login Failed',
                ['message' => 'Something went wrong', 'error' => $error->getMessage()],
                500
            );
        }
    }

    protected function sendResponse($result, $message, $code = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $result,
            'message' => $message,
        ], $code);
    }

    protected function sendError($error, $errorMessages = [], $code = 500)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            $user->tokens()->delete();

            return $this->sendResponse([], 'Logged out successfully');
        } catch (\Exception $error) {
            return $this->sendError(
                'Logout Failed',
                ['message' => 'Something went wrong', 'error' => $error->getMessage()],
                500
            );
        }
    }
}
