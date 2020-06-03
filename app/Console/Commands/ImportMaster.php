<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

use App\Agency;
use App\Division;

class ImportMaster extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'master:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To import master data.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $this->importAgencies('agencies',new Agency);
        $this->importDivisions('divisions', new Division);

    }

    //function to import agencies list.
    public function importAgencies($filename,Model $model) {
        if(($handle = fopen(public_path() . '/master/'.$filename.'.csv','r')) !== FALSE)
        {
            $this->line("Importing ".$filename." tables...");
            $i=0;
            while( ($data = fgetcsv($handle,1000,',')) !== FALSE)
            {
                $data = [
                        'id' => $data[0],
                        'name' => $data[1],
                        'dispatch_no' => $data[2],
                    ];
                try{
                    if($model::firstorCreate($data)) {
                        $i++;
                    }
                }
                catch(\Exception $e) {
                    $this->error('something went wrong... '.$e);
                    return;
                }
            }

            fclose($handle);
            $this->line($i." entries successfully added in ".$filename." table");
        }
    }
     //function to import divisions list.
     public function importDivisions($filename,Model $model) {
        if(($handle = fopen(public_path() . '/master/'.$filename.'.csv','r')) !== FALSE)
        {
            $this->line("Importing ".$filename." tables...");
            $i=0;
            while( ($data = fgetcsv($handle,100,',')) !== FALSE)
            {
                if(empty($data))
                {
                    continue;
                }
                else {
                    //converting "" returned from csv file to null.
                    if(empty($data[2])) {
                        $data[2] = null;
                    }

                    $data = [
                        'id' => $data[0],
                        'division' => $data[1],
                        'agency_id' => $data[2],
                    ];
                    try{
                        if($model::firstorCreate($data)) {
                            $i++;
                        }
                    }
                    catch(\Exception $e) {
                        $this->error('something went wrong... '.$e);
                        return;
                    }

                }
               
                
            }

            fclose($handle);
            $this->line($i." entries successfully added in ".$filename." table");
        }
    }
}
