<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Menu;
use App\Repositories\Admin\MenuRoleRepository;

class MenuRoleController extends Controller
{
   
    private $menuRoleRepository;

    public function __construct(MenuRoleRepository $menuRoleRepository)
    {
        $this->menuRoleRepository = $menuRoleRepository;
    }

    public function index()
    {
        can('ver-menu-rol');

        $roles = $this->menuRoleRepository->get_roles();

        $menus = Menu::getMenu();

        $menus_roles = $this->menuRoleRepository->get_menu_roles();

        return view('admin.menus_roles.index',compact('roles','menus','menus_roles'));

    }

    public function store(Request $request)
    {
        can('agregar-menu-rol');

        if ($this->menuRoleRepository->edit($request) == '1') {

            return 'Registro de menú rol asignado.';
        } else {
            return 'Registro de menú rol desasignado.';
        }    
    }
}
