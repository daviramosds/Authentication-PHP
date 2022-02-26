<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Users extends AbstractMigration
{
    public function up(): void
    {
        $this->execute('
            CREATE TABLE "users" (
                "id"	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                "username"	TEXT NOT NULL,
                "email"	TEXT NOT NULL,
                "password"	TEXT NOT NULL,
                "resetPasswordToken" TEXT,
                "resetPasswordTokenExpires" TEXT
            );
        ');
        
    }

    public function down(): void
    {
        $this->execute('
            DROP TABLE "users"
        ');
    }
}