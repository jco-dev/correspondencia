<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ArchivoAdjuntoEnvios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_archivo_adjunto_envio' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_envio_hoja_ruta' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_usuario' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],

            'nota' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],

            'numero_hojas' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
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
                'type' => 'TEXT',
                'constraint' => 50,
                'default' => 'REGISTRADO',
            ],
        ]);

        $this->forge->addKey('id_archivo_adjunto_envio', true);
        $this->forge->addForeignKey('id_envio_hoja_ruta', 'envios_hojas_rutas', 'id_envio_hoja_ruta', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_usuario', 'usuarios', 'id_usuario', 'CASCADE', 'CASCADE');
        $this->forge->createTable('archivos_adjuntos_envios');
    }

    public function down()
    {
        $this->forge->dropTable('archivos_adjuntos_envios');
    }
}
