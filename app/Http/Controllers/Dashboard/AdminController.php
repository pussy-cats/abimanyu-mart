<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'allAdmins' => User::role('admin')
                            ->paginate(10)
        ];
        return view('dashboard.admin.index', $data);
    }

    public function addAdmin()
    {
        return view('dashboard.admin.add');
    }

    public function createAdmin(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()){
            if($user->assignRole('admin')){
                return redirect()->route('dashboard.admin.index')->with('flash', [
                    'card' => 'success',
                    'message' => 'Tambah Data Admin berhasil'
                ]);
            }else{
                return redirect()->route('dashboard.admin.index')->with('flash', [
                    'card' => 'failed',
                    'message' => 'Tambah Data Admin gagal'
                ]);
            }
        }else{
            return redirect()->route('dashboard.admin.index')->with('flash', [
                'card' => 'failed',
                'message' => 'Tambah Data Admin gagal'
            ]);
        }
    }

    public function editAdmin($id)
    {
        $data = [
            'adminData' => User::find($id)
        ];
        return view('dashboard.admin.edit', $data);
    }

    public function updateAdmin(Request $request, $id)
    {
        $admin = User::find($id);
        if(empty($admin)){
            return redirect()->route('dashboard.admin.index')->with('flash', [
                'card' => 'warning',
                'message' => 'Data Admin tidak ditemukan'
            ]);
        }else{
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = Hash::make($request->password);
            if($admin->save()){
                return redirect()->route('dashboard.admin.index')->with('flash', [
                    'card' => 'success',
                    'message' => 'Data Admin berhasil diubah'
                ]);
            }else{
                return redirect()->route('dashboard.admin.index')->with('flash', [
                    'card' => 'failed',
                    'message' => 'Data Admin gagal diubah'
                ]);
            }
        }
    }

    public function deleteAdmin($id)
    {
        $admin = User::find($id);
        if($admin->delete()){
            return redirect()->route('dashboard.admin.index')->with('flash', [
                'card' => 'success',
                'message' => 'Hapus Data Admin berhasil'
            ]);
        }else{
            return redirect()->route('dashboard.admin.index')->with('flash', [
                'card' => 'failed',
                'message' => 'Hapus Data Admin gagal'
            ]);
        }
    }
}
