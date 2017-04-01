<?php

use Phinx\Migration\AbstractMigration;

class CreateCustomAudiences extends AbstractMigration
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

        $audiences = $this->table('audiences', $options);
        $audiences
            ->addColumn('id', 'string', array('limit' => 45, 'null' => false))
            ->addColumn('account_id', 'string', array('limit' => 45, 'null' => false))
            ->addColumn('approximate_count', 'integer', array('limit' => 11, 'null' => true, 'default' => null))
            ->addColumn('data_source', 'string', array('limit' => 255, 'null' => true, 'default' => null))
            ->addColumn('delivery_status', 'text', array('null' => true, 'default' => null))
            ->addColumn('description', 'string', array('limit' => 245, 'null' => true, 'default' => null))
            ->addColumn('external_event_source', 'text', array('null' => true, 'default' => null))
            ->addColumn('lookalike_audience_ids', 'text', array('null' => true, 'default' => null))
            ->addColumn('lookalike_spec', 'text', array('null' => true, 'default' => null))
            ->addColumn('name', 'string', array('limit' => 145, 'null' => true, 'default' => null))
            ->addColumn('operation_status', 'text', array('null' => true, 'default' => null))
            ->addColumn('opt_out_link', 'string', array('limit' => 145, 'null' => true, 'default' => null))
            ->addColumn('pixel_id', 'string', array('limit' => 45, 'null' => true, 'default' => null))
            ->addColumn('retention_days', 'integer', array('limit' => 11, 'null' => true, 'default' => null))
            ->addColumn('rule', 'text', array('null' => true, 'default' => null))
            ->addColumn('subtype', 'string', array('limit' => 145, 'null' => true, 'default' => null))
            ->addColumn('time_content_update', 'integer', array('limit' => 11, 'null' => true, 'default' => null))
            ->addColumn('time_created', 'integer', array('limit' => 11, 'null' => true, 'default' => null))
            ->addColumn('time_updated', 'integer', array('limit' => 11, 'null' => true, 'default' => null))
            ->create();
    }
}
