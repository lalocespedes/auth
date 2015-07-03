<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class UsersMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        $users = $this->table('users');
        $users->addColumn('username', 'string', array('limit' => 20))
              ->addColumn('email', 'string', array('limit' => 255, 'null' => true))
              ->addColumn('first_name', 'string', array('limit' => 50, 'null' => true))
              ->addColumn('last_name', 'string', array('limit' => 50, 'null' => true))
              ->addColumn('password', 'string', array('limit' => 255))
              ->addColumn('active', 'boolean')
              ->addColumn('active_hash', 'string', array('limit' => 255, 'null' => true))
              ->addColumn('recover_hash', 'string', array('limit' => 255, 'null' => true))
              ->addColumn('remember_identifier', 'string', array('limit' => 255, 'null' => true))
              ->addColumn('remember_token', 'string', array('limit' => 255, 'null' => true))
              ->addColumn('created_at', 'timestamp')
              ->addColumn('updated_at', 'timestamp', array(
                'null'    => true,
                'default' => null
               ))
              ->create();
    }
}
