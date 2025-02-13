<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Cola;
use App\Models\Configuration;
use App\Models\Grupo;
use App\Models\GrupoUsuario;
use App\Models\Rol;
use App\Models\TecnicoCola;
use App\Models\User;
use App\Models\UsuarioRol;
use App\Models\Vista;
use App\Models\VistaRol;
use App\Models\Tecnico;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        echo ":::: STARTING SEED ::::\n";
        $users = User::factory(10)->create();
        $rols = Rol::factory(4)->create();
        $vistas = Vista::factory(5)->create();
        $categorias = Categoria::factory(5)->create();
        $grupos = Grupo::factory(5)->create();
        Configuration::factory(10)->create();

        foreach($grupos as $g){
            GrupoUsuario::factory()
                ->for($g)
                ->for($users->random())
                ->create();
        }

        foreach ($users as $user) {
            UsuarioRol::factory()
                ->for($user) // Asignar un usuario
                ->for($rols->random()) // Asignar un rol aleatorio
                ->create();
        }

        foreach ($vistas as $vista) {
            VistaRol::factory()
                ->for($vista) // Asignar una vista
                ->for($rols->random()) // Asignar un rol aleatorio
                ->create();
        }

        $tecnicos = collect();
        foreach ($users as $u){
            $tecnicos->push(
                Tecnico::factory()
                ->for($u)
                ->create());
        }

        $colas = collect();
        foreach ($categorias as $c){
            $colas->push( Cola::factory()
                ->for($c)
                ->create());
        }

        foreach($tecnicos as $t){
            TecnicoCola::factory()
                ->for($t)
                ->for($colas->random())
                ->create();
        }
        echo ":::: FINISH SUCCESSFULY ::::";

    }
}
