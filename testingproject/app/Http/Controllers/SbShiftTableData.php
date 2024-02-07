<?php

namespace App\Console\Commands\Sportsbook;

use Illuminate\Console\Command;

class SbShiftTableData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SbShiftTableData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $tables = [
            'sb_feed_bet_cancel',
            'sb_feed_bet_settlement',
            'sb_feed_messages',
            'sb_feed_rbk_bet_cancel',
            'sb_feed_rbk_bet_settlement',
            'sb_producer_status_logs'
        ];

        foreach ($tables as $main_table) {
            self::shiftTableData($main_table);
        }

    }







    public function shiftTableData($main_table)
    {

        $move_until_date = date('Y-m-d H:i:s');
        $move_until_date = date('2024-01-12');

        $backup_table = 'backup_'.$main_table;

         // DB TRANSACTION STARTS HERE

         DB::beginTransaction();

         try {

            $sql = "INSERT INTO $backup_table
            SELECT * FROM $main_table
            WHERE
            created_at < '$move_until_date'";

             $result = DB::select($sql);

             DB::table($main_table)->where('created_at','<',$move_until_date)->delete();

             DB::commit();

             // COMMIT HERE IF NOT ERRORS

         } catch (\Exception $e) {

             // IF ANY ERROR COMPLETE ROLLBACK FOR PARTICULAR USER

             DB::rollback();
         }

    }
}
