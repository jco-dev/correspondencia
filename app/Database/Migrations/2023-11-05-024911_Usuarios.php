<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuarios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_usuario' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false
            ],
            'usuario' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
                'unique'     => true,
            ],
            'clave' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false
            ],
            'rol' => [
                'type'       => 'ENUM',
                'constraint' => ['ADMINISTRADOR', 'USUARIO'],
                'default'    => 'USUARIO',
                'null'       => false
            ],
            'creado_el TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'actualizado_el' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => null,
                'on update' => 'CURRENT_TIMESTAMP',
            ],

            'estado' => [
                'type'       => 'ENUM',
                'constraint' => ['ACTIVO', 'INACTIVO'],
                'default'    => 'ACTIVO',
                'null'       => false
            ],
        ]);

        $this->forge->addKey('id_usuario', true);
        $this->forge->addForeignKey('id_usuario', 'personas', 'id_persona', 'CASCADE', 'CASCADE');
        $this->forge->createTable('usuarios', true, [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('usuarios', true);
    }
}
