<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HojaRutaDocumento extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_hoja_ruta_documento' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => TRUE
            ],

            'id_documento' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],

            'id_usuario' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],

            'numero_hoja_ruta' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false,
                'unique' => true
            ],

            'numero_hojas' => [
                'type' => 'INT',
                'constraint' => 11,
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
        $this->forge->addKey('id_hoja_ruta_documento', true);
        $this->forge->addForeignKey('id_documento', 'documentos', 'id_documento', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_usuario', 'usuarios', 'id_usuario', 'CASCADE', 'CASCADE');
        $this->forge->createTable('hoja_ruta_documento');
    }

    public function down()
    {
        $this->forge->dropTable('hoja_ruta_documento');
    }
}
