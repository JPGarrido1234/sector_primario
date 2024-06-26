<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Empresa;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('login');
    }

    public function showRegistroForm(){
        $tipo_empresas = \App\Models\TipoEmpresa::all();
        return view('registro', compact('tipo_empresas'));
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $users_chart_count = UtilController::getChart1();
            if(Auth::user()->email_verified_at == null){
                Auth::logout();
                return redirect('login')->with('error', 'El usuario no ha sido validado');
            }

            ActividadController::setActividad('Enhorabuena!, cuenta activada.', Auth::user()->id, 0, now());
            return redirect('admin/dashboard')->with('users_chart_count', $users_chart_count);
        }

        return back()->withErrors([
            'error' => trans('login_error')
        ]);
    }

    public function registro(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'tipo_empresa' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($request->password != $request->password_confirmation){
            return back()->withErrors([
                'password' => trans('password_input'),
            ]);
        }

        DB::beginTransaction();
        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $user_role = new UserRole;
            $user_role->user_id = $user->id;
            $user_role->role_id = 2; //Usuario normal
            $user_role->save();

            $empresa = new Empresa;
            $empresa->user_id = $user->id;
            $empresa->activo = 0;
            $empresa->tipo_empresa_id = $request->tipo_empresa; // Reemplaza esto con el id del tipo de empresa
            $user->empresa()->save($empresa);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['message' => 'No se pudo crear el usuario: ' . $e->getMessage()])->withInput();
        }

        Mail::send('mails.email_alta', ['user' => $user], function ($message) use ($user) {
            $message->from('admin_sane@sane.com', 'SANE Admin');
            //$message->to($user->email);
            $message->to('jpgl.garrido.linares@gmail.com');
            $message->subject(trans('email_alta'));
        });

        ActividadController::setActividad('Registro', $user->id, $empresa->id, now());
        return redirect('login')->with('success', trans('registro_ok'));
    }

    public function valida_email(Request $request){
        try {
                $user = User::findOrFail($request->id);
                if($user->email_verified_at != null){
                    return redirect('login')->with('error', 'El usuario ya ha sido validado');
                }

                $user->email_verified_at = now();
                $user->save();

                ActividadController::setActividad('Enhorabuena!, cuenta activada.', $user->id, $user->empresa->id, now());
                return redirect('login')->with('success', 'Enhorabuena!, cuenta activada.');

            } catch (ModelNotFoundException $e) {
                return  redirect('login')->with('error', $e->getMessage());
            }
    }

    public function destroy(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('login');
    }
}
