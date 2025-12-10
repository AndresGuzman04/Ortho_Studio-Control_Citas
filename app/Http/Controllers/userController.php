<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class userController extends Controller
{

    public function __construct()
{
    $this->middleware('permission:ver-usuarios|crear-usuario|editar-usuario|eliminar-usuario|restaurar-usuario', ['only' => ['index']]);
    $this->middleware('permission:crear-usuario', ['only' => ['create', 'store']]);
    $this->middleware('permission:editar-usuario', ['only' => ['edit', 'update']]);
    $this->middleware('permission:eliminar-usuario', ['only' => ['destroy']]);
}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'administrador');
        })
            ->latest()
            ->get();

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'administrador')->get();
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $request->merge(['password' =>  Hash::make($request->password)]);
            $user = User::create($request->all());
            $user->assignRole($request->role);

            DB::commit();
            //ActivityLogService::log('Creación de usuario', 'Usuarios', $request->validated());
            return redirect()->route('users.index')->with('success', 'Usuario registrado');
        } catch (Exception $e) {
            DB::rollBack();
            //Log::error('Error al crear el usuario', ['error' => $e->getMessage()]);
            return redirect()->route('users.index')->with('error', 'Ups, algo falló');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::where('name', '!=', 'administrador')->get();
        return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        DB::beginTransaction();
        try {

            /*Comprobar el password y aplicar el Hash*/
            if (empty($request->password)) {
                $request = Arr::except($request, array('password'));
            } else {
                $request->merge(['password' => Hash::make($request->password)]);
            }
            $user->update($request->all());
            $user->syncRoles([$request->role]);

            DB::commit();
            //ActivityLogService::log('Edición de usuario', 'Usuarios', $request->validated());
            return redirect()->route('users.index')->with('success', 'Usuario editado');
        } catch (Exception $e) {
            DB::rollBack();
            //Log::error('Error al editar el usuario', ['error' => $e->getMessage()]);
            return redirect()->route('users.index')->with('error', 'Ups, algo falló');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $user = User::findOrfail($id);

            $nuevoEstado = $user->estado == 1 ? 0 : 1;
            $user->update(['estado' => $nuevoEstado]);
            $message = $nuevoEstado == 1 ? 'Usuario activado' : 'Usuario desactivado';

            //ActivityLogService::log($message, 'Usuario', [
            //    'user_id' => $id,
            //    'estado' => $nuevoEstado
            //]);

            return redirect()->route('users.index')->with('success', $message);
        } catch (Exception $e) {
           //Log::error('Error al eliminar/restaurar al usuario', ['error' => $e->getMessage()]);
            return redirect()->route('users.index')->with('error', 'Ups, algo falló');
        }
    }
}
