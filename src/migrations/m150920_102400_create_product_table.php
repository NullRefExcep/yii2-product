<?php

use nullref\core\traits\MigrationTrait;
use yii\db\Migration;

class m150920_102400_create_product_table extends Migration
{
    use MigrationTrait;

    protected $tableName = '{{%product}}';

    public function up()
    {
        if (!$this->tableExist($this->tableName)) {
            $this->createTable($this->tableName, [
                'id' => $this->primaryKey(),
                'name' => $this->string(),
                'image' => $this->string(),
                'description' => $this->text(),
                'price' => $this->decimal(10, 2),
                'status' => $this->integer(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
                'deleted_at' => $this->integer(),
            ], $this->getTableOptions());
        }
    }

    public function down()
    {
        if ($this->tableExist($this->tableName)) {
            $this->dropTable($this->tableName);
        }
        return true;
    }

}
