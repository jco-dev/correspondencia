<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Documentos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_documento' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],

            'id_oficina' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],

            'id_usuario_creado' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],

            'numero_correlativo' => [
                'type' => 'INT',
                'constraint' => 11,
            ],

            'tipo_documento' => [
                'type' => 'ENUM',
                'constraint' => ['DOCUMENTO INTERNO', 'DOCUMENTO EXTERNO'],
                'null' => false,
            ],

            'tipo_informe' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],

            'referencia' => [
                'type' => 'TEXT',
            ],

            'archivo' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
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
                'type' => 'TEXT',
                'constraint' => 50,
                'default' => 'REGISTRADO',
            ],
        ]);

        $this->forge->addKey('id_documento', true);
        $this->forge->addForeignKey('id_oficina', 'oficinas', 'id_oficina', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_usuario_creado', 'usuarios', 'id_usuario', 'CASCADE', 'CASCADE');
        $this->forge->createTable('documentos');
    }

    public function down()
    {
        $this->forge->dropTable('documentos');
    }
}
