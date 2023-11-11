<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EnvioHojaRuta extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_envio_hoja_ruta' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => TRUE
            ],

            'id_hoja_ruta_documento' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],

            'id_usuario' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],

            'id_oficina_envio' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],

            'id_oficina_destino' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],

            'fecha_envio' => [
                'type' => 'TIMESTAMP',
                'null' => false,
            ],

            'fecha_recepcion' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],

            'prioridad' => [
                'type' => 'ENUM',
                'constraint' => ['URGENTE', 'NORMAL'],
                'null' => false,
            ],

            'motivo_archivado' => [
                'type' => 'TEXT',
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

        $this->forge->addKey('id_envio_hoja_ruta', true);
        $this->forge->addForeignKey('id_hoja_ruta_documento', 'hojas_rutas_documentos', 'id_hoja_ruta_documento', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_usuario', 'usuarios', 'id_usuario', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_oficina_envio', 'oficinas', 'id_oficina', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_oficina_destino', 'oficinas', 'id_oficina', 'CASCADE', 'CASCADE');
        $this->forge->createTable('envios_hojas_rutas');
    }

    public function down()
    {
        $this->forge->dropTable('envios_hojas_rutas');
    }
}
