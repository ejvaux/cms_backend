<?php

namespace App\Console\Commands;

use App\Models\Item;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImagesImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:images {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Item images';

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
     * @return int
     */
    public function handle()
    {
        $this->output->title('Starting import');

        $img_binary = null;

        $images = Storage::files($this->option('path'));

        foreach ($images as $image_path)
        {
            //Get image filename
            $filename = File::name($image_path);

            // Convert image to binary
            $datastring = file_get_contents(Storage::path($image_path));
            $data = unpack("H*hex", $datastring);
            $img_binary = $data['hex'];

            //Get items
            $items = Item::where('part_number',$filename)->get();

            //Check if item exists
            if($items->isNotEmpty())
            {
                foreach ($items as $item)
                {
                    //Update item, insert image binary
                    Item::find($item->id)->update(['image' => \DB::raw('0x'.$img_binary)]);
                }
                $this->info($filename." uploaded.");
            }
            else
            {
                $this->error($filename.". Item not found.");
            }
        }
        $this->newLine();
        $this->output->success('Import finished');
    }
}
