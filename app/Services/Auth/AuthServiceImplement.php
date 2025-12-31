<?php

namespace App\Services\Auth;

use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Hash;
use App\Http\Helpers\ResponseHelpers;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class AuthServiceImplement extends Service implements AuthService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(UserRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function LoginServices($request)
    {
      try {
  
        // cari user lewat email
        $user = $this->mainRepository->findByEmail($request->email);
    
        if (is_null($user)) {
            return ResponseHelpers::sendError('No user found', [], 404);
        }
    
        // Check password
        if (!Hash::check($request->password, $user->password)) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }

        Auth::login($user);

        return ['success' => true, 'message' => 'Login successful'];

        } catch (\Exception $e) {
            return ResponseHelpers::sendError('Something went wrong during login',[$e],500);
        }
    }
    
    public function RegisterServices($request)
    {
      DB::beginTransaction();
      try{
            $hashedPassword = Hash::make($request->password);

            $user = $this->mainRepository->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $hashedPassword,
            ]);

      DB::commit();

            $token = $user->createToken('authToken')->accessToken;

            return ResponseHelpers::sendSuccess('Registration Successful', [
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ], 201);
              } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Logout failed: '.$e->getMessage(), ['exception' => $e]);

              return ResponseHelpers::sendError('Something went wrong during Register',[$e],500);
            }
    }

      // Log out the user by revoking their token
    public function LogOutServices($request)
    {
        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return true;
        } catch (\Exception $e) {
            throw $e;
        }    
    }

      // Get the profile details of the authenticated user
      public function ProfileServices($request)
      {
          try {
              // Get the authenticated user
              $user = Auth::user();

              if (!$user) {
                  return ResponseHelpers::sendError('User not found', [], 404);
              }

              return ResponseHelpers::sendSuccess('Profile fetched successfully', [
                  'user' => [
                      'id' => $user->id,
                      'name' => $user->name,
                      'email' => $user->email,
                  ]
              ], 200);
          } catch (\Exception $e) {
              return ResponseHelpers::sendError('Something went wrong while fetching profile', [$e->getMessage()], 500);
          }
      }

}

