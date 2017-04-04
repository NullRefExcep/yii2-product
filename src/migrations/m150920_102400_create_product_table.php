<?php

use nullref\core\traits\MigrationTrait;
use yii\db\Migration;

class m150920_102400_create_product_table extends Migration
{
    use MigrationTrait;

    protected $prototypeTable = '{{%product_prototype}}';
    protected $productTable = '{{%product}}';

    protected $optionTable = '{{%product_option}}';
    protected $optionTypeTable = '{{%product_option_type}}';
    protected $productHasOptionTable = '{{%product_has_option}}';

    protected $optionValueTable = '{{%product_option_value}}';
    protected $prototypeHasOptionTable = '{{%product_prototype_has_option}}';
    protected $productHasOptionValueTable = '{{%product_has_option_value}}';

    protected $prototypeHasOptionValueTable = '{{%product_prototype_has_option_value}}';

    public function up()
    {
        if (!$this->tableExist($this->productTable)) {
            $this->createTable($this->productTable, [
                'id' => $this->primaryKey(),
                'name' => $this->string(),
                'prototype_id' => $this->integer(),
                'parent_id' => $this->integer(),
                'type' => $this->string(),
                'image' => $this->string(),
                'description' => $this->text(),
                'price' => $this->decimal(10, 2),
                'price_from' => $this->decimal(10, 2),
                'price_to' => $this->decimal(10, 2),
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
                'price' => $this->decimal(10, 2),
                'type' => $this->string(),
            ], $this->getTableOptions());
            $this->addForeignKey('prototype_has_product', $this->productTable, 'prototype_id', $this->prototypeTable, 'id');
        }
        if (!$this->tableExist($this->optionTable)) {
            /** Option */
            $this->createTable($this->optionTable, [
                'id' => $this->primaryKey(),
                'code' => $this->string(),
                'name' => $this->string(),
                'type_id' => $this->integer(),
                'order' => $this->integer(),
            ], $this->getTableOptions());

            /** Option Type */
            $this->createTable($this->optionTypeTable, [
                'id' => $this->primaryKey(),
                'name' => $this->string(),
            ]);
            $this->addForeignKey('option_has_type', $this->optionTable, 'type_id', $this->optionTypeTable, 'id');

            /** Prototype has option */
            $this->createTable($this->prototypeHasOptionTable, [
                'prototype_id' => $this->integer(),
                'option_id' => $this->integer(),
            ], $this->getTableOptions());
            $this->addPrimaryKey('prototype_has_option_pk', $this->prototypeHasOptionTable, [
                'prototype_id',
                'option_id',
            ]);

            /** Option value */
            $this->createTable($this->optionValueTable, [
                'id' => $this->primaryKey(),
                'option_id' => $this->integer(),
                'name' => $this->string(),
                'value' => $this->string(),
                'order' => $this->integer(),
            ], $this->getTableOptions());
            $this->createIndex('option_has_value_unique', $this->optionValueTable, ['option_id', 'value'], true);
            $this->addForeignKey('option_has_value', $this->optionValueTable, 'option_id', $this->optionTable, 'id');

            $this->createTable($this->prototypeHasOptionValueTable, [
                'prototype_id' => $this->integer(),
                'option_id' => $this->integer(),
                'value_id' => $this->integer(),
            ]);

            $this->addPrimaryKey('product_prototype_has_option_value_pk', $this->prototypeHasOptionValueTable, [
                'prototype_id',
                'option_id',
                'value_id',
            ]);



            $this->batchInsert($this->optionTypeTable, ['id', 'name'], [
                [1, 'Size'],
                [2, 'Color'],
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

            $this->dropForeignKey('option_has_type', $this->optionTable);

            $this->dropTable($this->optionTypeTable);

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
