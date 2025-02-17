<?php

namespace App\Services;

use App\Constants\BasicConstants;
use App\Constants\ConfigKeys;
use App\Models\Configuration;
use Illuminate\Support\Facades\Cache;

class ConfigSystemService{
    protected array $config;

    public function __construct()
    {
        $this->loadConfig();
    }

    private function loadConfig(): void
    {
        $this->config = Cache::rememberForever('system_config', function () {
            return Configuration::where('status', BasicConstants::STATUS_ACTIVE)
                                ->pluck('string_value', 'key')
                                ->toArray();
        });
    }

    public function get(string $key, $default = null)
    {
        return $this->config[$key] ?? $default;
    }

    public function autoAssign(): bool{
        $this->refresh();
        return $this->get(ConfigKeys::ASSIGN_TYPE->value, ConfigKeys::ASSIGN_TYPE_AUTO->value) === ConfigKeys::ASSIGN_TYPE_AUTO->value;
    }

    public function refresh(): void
    {
        Cache::forget('system_config');
        $this->loadConfig();
    }
}
