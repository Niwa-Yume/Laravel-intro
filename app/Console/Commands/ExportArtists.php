<?php

namespace App\Console\Commands;

use App\Models\Artist;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ExportArtists extends Command
{
    protected $signature = 'artists:export {path=artists.json}';
    protected $description = 'Exporte tous les artistes au format JSON';

    public function handle()
    {
        $path = $this->argument('path');
        $artists = Artist::with(['country', 'movies'])->get();
        Storage::disk('public')->put($path, json_encode($artists, JSON_PRETTY_PRINT));
        $this->info("Artistes exportés vers: {$path}");

        return Command::SUCCESS;
    }
}
