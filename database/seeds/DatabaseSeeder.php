<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $isProduction = app()->environment() === 'production';
        if ($isProduction ) return;

        $this->setForeignKeyCheck(0);

        if( $results = $this->truncateAllTables(false))
            $this->seedTables(true);

        $this->setForeignKeyCheck(1);
    }

    private function seedTables($allowed = false)
    {
        if ($allowed) {
            $this->call(UsersTableSeeder::class);
            $this->call(CountriesTableSeeder::class);
            $this->call(StatusesTableSeeder::class);
            $this->call(TypesTableSeeder::class);
        }
    }

    private function setForeignKeyCheck($int)
    {
        $int ? Model::reguard() : Model::unguard();

        DB::statement("SET FOREIGN_KEY_CHECKS=$int");
    }

    private function truncateAllTables($isAllowed = false)
    {
        // Proceed, is not production
        if ( !$isAllowed) {
            try {
                // Get database from .env file
                $db = 'Tables_in_'.env('DB_DATABASE');
                // Get all table names
                $tables = DB::select('SHOW TABLES');

                // Truncate all tables, except migrations
                foreach ( $tables as $table ) {
                    $tableName = $table->$db;
                    if($tableName != 'migrations') DB::table($tableName)->truncate();
                }

                return true;
            } catch (Exception $ex) {
                dump($ex->getMessage());
            }
        }
        return false;
    }
}
