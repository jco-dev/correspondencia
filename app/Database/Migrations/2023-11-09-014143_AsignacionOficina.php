<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AsignacionOficina extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_asignacion_oficina' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_persona' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'id_oficina' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'grado_academico' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => false,
                'enum' => ['P.Ph.D.', 'Ph.D.', 'M.Sc.', 'Esp.', 'Lic.'],
            ],
            'cargo' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'enum' => ['JEFE', 'SECRETARIA'],
            ],
            'fecha_inicio' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'fecha_fin' => [
                'type' => 'DATE',
                'null' => false,
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
                'constraint' => ['REGISTRADO', 'FINALIZADO'],
                'default' => 'REGISTRADO',
            ],
        ]);

        $this->forge->addKey('id_asignacion_oficina', true);
        $this->forge->addForeignKey('id_persona', 'personas', 'id_persona', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_oficina', 'oficinas', 'id_oficina', 'CASCADE', 'CASCADE');
        $this->forge->createTable('asignacion_oficinas');
    }

    public function down()
    {
        $this->forge->dropTable('asignacion_oficinas');
    }
}
