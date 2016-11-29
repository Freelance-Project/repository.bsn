<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Models\Researcher;

class GeneratePortofolio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:generate-portofolio';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Portofolio Personel';

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
        $baseUrl = env('CV_URL_TEMPLATE');

        $personel = Researcher::where('cv','=','')->get();
        
        if ($personel) {
            foreach ($personel as $key => $value) {
                
                $url = $baseUrl . '/' . $value['id'];
                
                $destination = public_path('personel/cv') . '/'.$value['id'];
                if (!\File::isDirectory($destination)) \File::makeDirectory($destination, 0777, true);
                $filename = 'cv-'.str_slug($value['name']).'-'.date('Y-m-d-H-i-s');
                
                $destinationPath = $destination .'/'.$filename.'.pdf';
                
                $cmd = env('WKHTMLTOPDF')." -q {$url} {$destinationPath}";
                exec($cmd);
                sleep(2);
                
                $updates['cv'] = $filename . '.pdf';
                Researcher::whereId($value['id'])->update($updates);
            }
        }
    }
}
