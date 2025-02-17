<?php

namespace App\Http\Controllers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthApiController extends Controller
{
use AuthorizesRequests, ValidatesRequests;
public function register(Request $request)
{
$user = User::create([
'name' => $request->name,
'email' => $request->email,
'password' => Hash::make($request->password),
]);

Mail::to($user->email)->send(new VerifyEmailMail($user));
return response()->json(['message' => 'Usuario registrado. Verifica tu correo antes de iniciar sesión.']);
}
public function login(Request $request)
{
$nom = $request->input('name');
$pass = $request->input('password');
$user = User::where('name', '=', $nom)->first();
if (isset($user)) {
$usuarioname = $user['name'];
$usuariohashpass = $user['password'];
if (Hash::check($pass, $usuariohashpass)) {
$token = JWTAuth::fromUser($user);
return $token;
} else {
return response()->json(['error' => 'Unauthorized', $nom => $pass], 401);
}
} else {
return response()->json(['error' => 'User not found', $nom => $pass], 401);
}
}}

class VerifyEmailMail extends Mailable {

    use Queueable, SerializesModels;
    public $user;
    public $verificationUrl;
    public function __construct(User $user)
    {
    $this->user = $user;
    $this->verificationUrl = URL::temporarySignedRoute(
    'api.verificarcorreo', //aquí el nombre de la ruta definida en routes/api.php
    Carbon::now()->addMinutes(60*24*7), //una semana para aceptar correo
    ['usuariorecibido' => $user->id, 'hash' => sha1($user->getEmailForVerification())]
    );
    }
    public function build()
    {
    return $this->subject('Verifica tu cuenta')->view('verifyemail')
    ->with([
    'user' => $this->user,
    'verificationUrl' => $this->verificationUrl,
    ]);
    }
}

?>
