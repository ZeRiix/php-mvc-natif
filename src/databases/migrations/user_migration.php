<?php

namespace Databases\Migrations;

use App\Core\Migration;

class UserMigration
{
    public function up(Migration $migration)
    {
        $migration->setTableName('user');
        
        $migration->setNameColumns('id');
        $migration->setTypeColumns('INT');
        $migration->setConstraintColumns('NOT NULL');
        $migration->setNullColumns('AUTO_INCREMENT');
        $migration->setPrimaryKeyColumns('PRIMARY KEY');
        $migration->save();

        $migration->setNameColumns('name');
        $migration->setTypeColumns('VARCHAR');
        $migration->setConstraintColumns('(255)');
        $migration->setNullColumns('NOT NULL');
        $migration->save();

        $migration->setNameColumns('email');
        $migration->setTypeColumns('VARCHAR');
        $migration->setConstraintColumns('(255)');
        $migration->setNullColumns('NOT NULL');
        $migration->save();

        $migration->setNameColumns('password');
        $migration->setTypeColumns('VARCHAR');
        $migration->setConstraintColumns('(255)');
        $migration->setNullColumns('NOT NULL');
        $migration->save();

        $migration->setNameColumns('created_at');
        $migration->setTypeColumns('DATETIME');
        $migration->setNullColumns('NOT NULL');
        $migration->save();

        $migration->setNameColumns('updated_at');
        $migration->setTypeColumns('DATETIME');
        $migration->setNullColumns('NOT NULL');
        $migration->save();
        $migration->create();
    }

    public function down(Migration $migration)
    {
        $migration->setTableName('user');
        $migration->drop();
    }
}