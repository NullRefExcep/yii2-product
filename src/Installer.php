<?php
/**
 * @author    Dmytro Karpovych
 * @copyright 2015 NRE
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace nullref\product;


use Composer\Installer\PackageEvent;
use nullref\core\components\ModuleInstaller;
use yii\db\Schema;

class Installer extends ModuleInstaller
{
    protected $tableName = '{{%product}}';

    /**
     * Create table
     * @param PackageEvent $event
     */
    public function install(PackageEvent $event)
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
                'price' => Schema::TYPE_DECIMAL,
                'status' => Schema::TYPE_INTEGER,
                'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        }

        parent::install($event);
    }

    /**
     * Drop table
     * @param PackageEvent $event
     */
    public function uninstall(PackageEvent $event)
    {
        if ($this->tableExist($this->tableName)) {
            $this->dropTable('{{%product}}');
        }
        parent::uninstall($event);
    }


} 