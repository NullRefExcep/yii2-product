<?php
/**
 * @author    Dmytro Karpovych
 * @copyright 2015 NRE
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace nullref\product;


use nullref\core\components\ModuleInstaller;
use Yii;
use yii\db\Schema;

class Installer extends ModuleInstaller
{
    public function getModuleId()
    {
        return 'product';
    }

    public $updateConfig = true;

    protected $tableName = '{{%product}}';

    /**
     * Create table
     */
    public function install()
    {
        if (!$this->tableExist($this->tableName)) {
            $tableOptions = null;
            if (\Yii::$app->db->driverName === 'mysql') {
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
            }
            $this->createTable($this->tableName, [
                'id' => Schema::TYPE_PK,
                'title' => Schema::TYPE_STRING,
                'image' => Schema::TYPE_STRING,
                'description' => Schema::TYPE_TEXT,
                'price' => Schema::TYPE_DECIMAL . '(10,2)',
                'status' => Schema::TYPE_INTEGER,
                'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
                'deleted' => Schema::TYPE_SMALLINT,
            ], $tableOptions);
        }

        parent::install();
    }

    /**
     * Drop table
     */
    public function uninstall()
    {
        if ($this->tableExist($this->tableName)) {
            $this->dropTable($this->tableName);
        }
        parent::uninstall();
    }

} 