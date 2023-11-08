<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Personas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_persona' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'ci' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'unique' => true,
            ],
            'expedido' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'paterno' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'materno' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'fecha_nacimiento' => [
                'type' => 'DATE',
            ],
            'celular' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'correo_electronico' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => true,
            ],
            'direccion' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'creado_el TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'actualizado_el' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => null,
                'on update' => 'CURRENT_TIMESTAMP',
            ],
            'estado' => [
                'type' => 'ENUM',
                'constraint' => ['REGISTRADO', 'ELIMINADO'],
                'default' => 'REGISTRADO',
            ],
        ]);

        $this->forge->addKey('id_persona', true);
        $this->forge->createTable('personas');
    }

    public function down()
    {
        $this->forge->dropTable('personas', true);
    }
}
