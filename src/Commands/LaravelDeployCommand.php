<?php

namespace BenQoder\LaravelDeploy\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZanySoft\Zip\Facades\Zip;
use ZipArchive;

class LaravelDeployCommand extends Command
{
    public $signature = 'deploy';

    public $description = 'Deploy Project';

    public function handle(): int
    {
        $this->info('Preparing to deploy project...');

        File::deleteDirectory(base_path('debloyables'));
        File::ensureDirectoryExists(base_path('debloyables'));

        $zip = Zip::create(base_path('debloyables/source.zip'), true);

        foreach (scandir(base_path()) as $item) {
            if (in_array($item, [
                '.',
                '..',
                'vendor',
                'node_modules',
            ])) {
                continue;
            }

            $zip->add(
                base_path($item),
            );
        }

        $zip->close();

        $this->info('Preparing vendor!');

        $rootPath = base_path('vendor');

        $zip = new ZipArchive();
        $zip->open(base_path('debloyables/vendor.zip'), ZipArchive::CREATE | ZipArchive::OVERWRITE);

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if (! $file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();

        return self::SUCCESS;
    }
}
