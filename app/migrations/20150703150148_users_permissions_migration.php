<?php

use Phinx\Migration\AbstractMigration;

class UsersPermissionsMigration extends AbstractMigration
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
        $users_permissions = $this->table('users_permissions');
        $users_permissions->addColumn('user_id', 'integer', array('limit' =>  11))
        ->addColumn('is_admin', 'boolean')
        ->addColumn('created_at', 'timestamp')
        ->addColumn('updated_at', 'timestamp', array(
                'null'    => true,
                'default' => null
               ))
        ->create();
    }
}
