<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Migrate1 extends CI_Migration {

    public function up()
    {
        // Buat tabel users untuk PostgreSQL
        $this->dbforge->add_field([
            'id' => [
                'type' => 'SERIAL', // PostgreSQL auto increment
                'unsigned' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ],
            'url_modul' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ],
        ]);

        $this->dbforge->add_key('id', TRUE); // Primary key
        $this->dbforge->create_table('tbl_modul', TRUE);

         /**
         * Tabel: tbl_menu
         */
        $this->dbforge->add_field([
            'id' => [
                'type' => 'SERIAL',
                'unsigned' => TRUE
            ],
            'modul_id' => [
                'type' => 'INT',
                'unsigned' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ],
            'url' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_menu', TRUE);

        /**
         * Tabel: tbl_role
         */
        $this->dbforge->add_field([
            'id' => [
                'type' => 'SERIAL',
                'unsigned' => TRUE
            ],
            'nama_role' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_role', TRUE);

        /**
         * Tabel: tbl_role_akses
         */
        $this->dbforge->add_field([
            'id' => [
                'type' => 'SERIAL',
                'unsigned' => TRUE
            ],
            'akses' => [
                'type' => 'INT',
                'null' => FALSE
            ],
            'role_id' => [
                'type' => 'INT',
                'null' => FALSE
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_role_akses', TRUE);

        /**
         * Tabel: tbl_user_modul_akses
         */
        $this->dbforge->add_field([
            'id' => [
                'type' => 'SERIAL',
                'unsigned' => TRUE
            ],
            'user_id' => [
                'type' => 'INT',
                'null' => FALSE
            ],
            'modul_id' => [
                'type' => 'INT',
                'null' => FALSE
            ],
            'role_id' => [
                'type' => 'INT',
                'null' => FALSE
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_user_modul_akses', TRUE);

        /**
         * Tabel: tbl_user_menu_akses
         */
        $this->dbforge->add_field([
            'id' => [
                'type' => 'SERIAL',
                'unsigned' => TRUE
            ],
            'user_id' => [
                'type' => 'INT',
                'null' => FALSE
            ],
            'menu_id' => [
                'type' => 'INT',
                'null' => FALSE
            ],
            'role_id' => [
                'type' => 'INT',
                'null' => FALSE
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_user_menu_akses', TRUE);


        /**
         * Tabel: tbl_user
         */
        $this->dbforge->add_field([
            'id' => [
                'type' => 'SERIAL',
                'unsigned' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => TRUE
            ],
            'status' => [
                'type' => 'INT',
                'unsigned' => TRUE
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => TRUE,
                'default' => null
            ],
            'nik' => [
                'type' => 'TEXT',
                'unsigned' => TRUE
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_user', TRUE);
    }

    public function down()
    {
        // Drop tabel dengan urutan yang tepat untuk hindari foreign key error
        $this->dbforge->drop_table('tbl_user', TRUE);
        $this->dbforge->drop_table('tbl_role', TRUE);
        $this->dbforge->drop_table('tbl_menu', TRUE);
        $this->dbforge->drop_table('tbl_modul', TRUE);
        $this->dbforge->drop_table('tbl_role_akses', TRUE);
        $this->dbforge->drop_table('tbl_user_modul_akses', TRUE);
        $this->dbforge->drop_table('tbl_user_menu_akses', TRUE);
        
    }
}
