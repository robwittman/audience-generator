<?php

use Phinx\Migration\AbstractMigration;

class CreatePixels extends AbstractMigration
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

        $pixels = $this->table('pixels', $options);
        $pixels
            ->addColumn('id', 'string', array('limit' => 45, 'null' => false))
            ->addColumn('code', 'text', array('null' => true, 'default' => null))
            ->addColumn('last_fired_time', 'datetime', array('null' => true, 'default' => null))
            ->addColumn('name', 'string', array('limit' => 145, 'null' => true, 'default' => null))
            ->addColumn('owner_ad_account', 'string', array('limit' => 145, 'null' => false))
            ->create();
    }
}
