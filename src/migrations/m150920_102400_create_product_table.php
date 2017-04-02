<?php

use nullref\core\traits\MigrationTrait;
use yii\db\Migration;

class m150920_102400_create_product_table extends Migration
{
    use MigrationTrait;

    protected $productTable = '{{%product}}';
    protected $prototypeTable = '{{%product_prototype}}';
    protected $optionTable = '{{%product_option}}';
    protected $productHasOptionTable = '{{%product_has_option}}';
    protected $optionValueTable = '{{%product_option_value}}';
    protected $productHasOptionValueTable = '{{%product_has_option_value}}';
    protected $prototypeHasOptionTable = '{{%product_prototype_has_option}}';
    protected $prototypeHasOptionValueTable = '{{%product_prototype_has_option_value}}';

    public function up()
    {
        if (!$this->tableExist($this->productTable)) {
            $this->createTable($this->productTable, [
                'id' => $this->primaryKey(),
                'name' => $this->string(),
                'prototype_id' => $this->integer(),
                'type' => $this->string(),
                'image' => $this->string(),
                'description' => $this->text(),
                'price' => $this->decimal(10, 2),
                'status' => $this->integer(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
                'deleted_at' => $this->integer(),
            ], $this->getTableOptions());
            $this->createIndex('product_type_index', $this->productTable, ['type']);
        }
        if (!$this->tableExist($this->prototypeTable)) {
            $this->createTable($this->prototypeTable, [
                'id' => $this->primaryKey(),
                'name' => $this->string(),
                'type' => $this->string(),
            ]);
            $this->addForeignKey('prototype_has_product', $this->productTable, 'prototype_id', $this->prototypeTable, 'id');
        }
        if (!$this->tableExist($this->optionTable)) {
            /** Option */
            $this->createTable($this->optionTable, [
                'id' => $this->primaryKey(),
                'name' => $this->string(),
                'order' => $this->integer(),
            ]);

            /** Prototype has option */
            $this->createTable($this->prototypeHasOptionTable, [
                'prototype_id' => $this->integer(),
                'option_id' => $this->integer(),
            ]);
            $this->addPrimaryKey('prototype_has_option_fk', $this->prototypeHasOptionTable, [
                'prototype_id',
                'option_id',
            ]);

            /** Option value */
            $this->createTable($this->optionValueTable, [
                'id' => $this->primaryKey(),
                'option_id' => $this->integer(),
                'value' => $this->string(),
                'order' => $this->integer(),
            ]);
            $this->createIndex('option_has_value_unique', $this->optionValueTable, ['option_id', 'value'], true);
            $this->addForeignKey('option_has_value', $this->optionValueTable, 'option_id', $this->optionTable, 'id');

            /** Prototype has option value */
            $this->createTable($this->prototypeHasOptionValueTable, [
                'prototype_id' => $this->integer(),
                'value_id' => $this->integer(),
            ]);
            $this->addPrimaryKey('prototype_has_option_value_fk', $this->prototypeHasOptionValueTable, [
                'prototype_id',
                'value_id',
            ]);
        }
    }

    public function down()
    {
        if ($this->tableExist($this->optionTable)) {
            $this->dropTable($this->prototypeHasOptionValueTable);

            $this->dropForeignKey('option_has_value', $this->optionValueTable);

            $this->dropTable($this->optionValueTable);

            $this->dropTable($this->prototypeHasOptionTable);

            $this->dropTable($this->optionTable);
        }

        if ($this->tableExist($this->prototypeTable)) {
            $this->dropForeignKey('prototype_has_product', $this->productTable);
            $this->dropTable($this->prototypeTable);
        }
        if ($this->tableExist($this->productTable)) {
            $this->dropTable($this->productTable);
        }
        return true;
    }

}
