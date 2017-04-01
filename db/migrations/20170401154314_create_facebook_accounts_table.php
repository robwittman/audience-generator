<?php

use Phinx\Migration\AbstractMigration;

class CreateFacebookAccountsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $options = array(
            'id'            => false,
            'primary_key'   => 'id'
        );

        $accounts = $this->table('accounts', $options);
        $accounts
            ->addColumn('id', 'string', ['limit' => 45, 'null' => false])
            ->addColumn('account_id', 'string', ['limit' => 45, 'null' => false])
            ->addColumn('name', 'string', ['limit' => 145, 'null' => true, 'default' => null])
            ->addColumn('facebook_user_id', 'string', ['limit' => 45, 'null' => true, 'default' => null])
            ->create();
    }
}
