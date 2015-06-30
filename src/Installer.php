<?php
/**
 * @author    Dmytro Karpovych
 * @copyright 2015 NRE
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace nullref\product;


use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;
use Composer\Repository\InstalledRepositoryInterface;
use yii\db\Migration;
use yii\db\Schema;

class Installer extends LibraryInstaller
{
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        $tableOptions = null;
        if (\Yii::$app->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $migration = new Migration();
        $migration->createTable('{{%product}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING,
            'image' => Schema::TYPE_STRING,
            'description' => Schema::TYPE_TEXT,
            'price' => Schema::TYPE_DECIMAL,
            'status' => Schema::TYPE_INTEGER,
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        parent::install($repo, $package);
    }

    public function uninstall(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        $migration = new Migration();
        $migration->dropTable('{{%product}}');

        parent::uninstall($repo, $package);
    }


} 