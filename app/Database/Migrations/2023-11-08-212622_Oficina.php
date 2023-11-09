<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Oficina extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_oficina' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => TRUE
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => true,
            ],
            'descripcion' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
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
        $this->forge->addKey('id_oficina', true);
        $this->forge->createTable('oficinas');
    }

    public function down()
    {
        $this->forge->dropTable('oficinas');
    }
}
