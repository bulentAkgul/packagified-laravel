<?php

namespace Database\Seeders;

use Bakgul\Kernel\Helpers\Package;
use Bakgul\Kernel\Tasks\GenerateNamespace;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    const PACKAGES_BY_SEEDING_PRIORITY = [];

    public function run(): void
    {
        $this->call(array_filter(array_map(fn ($x) => $this->class($x), self::PACKAGES_BY_SEEDING_PRIORITY)));
    }

    private function class($package)
    {
        return '\\' . GenerateNamespace::_([
            'root' => Package::root($package),
            'package' => $package,
            'family' => 'database',
            'job' => 'file'
        ]) . '\Seeders\PackageSeeder';
    }
}
