<?php

use App\Models\Categoria;
use App\Models\Estado;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $categoria=new Categoria;
       $categoria->nombre='Miedo';
       $categoria->save();

       $categoria=new Categoria;
       $categoria->nombre='Suspenso';
       $categoria->save();

       $categoria=new Categoria;
       $categoria->nombre='Accion';
       $categoria->save();

       $categoria=new Estado;
       $categoria->id=1;
       $categoria->nombre='Disponible';
       $categoria->save();

       $categoria=new Estado;
       $categoria->id=2;
       $categoria->nombre='No Disponible';
       $categoria->save();

       $categoria=new Estado;
       $categoria->id=3;
       $categoria->nombre='Reservado';
       $categoria->save();

       $categoria=new Estado;
       $categoria->id=4;
       $categoria->nombre='Pagado';
       $categoria->save();

       $rol=new Rol;
       $rol->id=1;
       $rol->nombre='Administrador';
       $rol->save();

       $rol=new Rol;
       $rol->id=2;
       $rol->nombre='Cliente';
       $rol->save();

       $usuario=new User;
       $usuario->name='Administrador';
       $usuario->email='administrador@gmail.com';
       $usuario->rol_id=1;
       $usuario->saldo=1000;
       $usuario->password = bcrypt('12345678');
       $usuario->save();


    }
}
