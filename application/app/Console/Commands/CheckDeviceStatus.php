<?php

namespace App\Console\Commands;

use App\Models\Device;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CheckDeviceStatus extends Command
{
    protected $signature = 'devices:check-status';
    protected $description = 'Check device status and mark devices as offline if no call received in 10 minutes';

    public function handle()
    {
        $offlineThreshold = 10; // minutes
        $thresholdTime = Carbon::now()->subMinutes($offlineThreshold);

        // Find devices that are marked as live but haven't called in the threshold time
        $devicesToMarkOffline = Device::where('status', 'live')
            ->where(function ($query) use ($thresholdTime) {
                $query->whereNull('last_status_updated_at')
                    ->orWhere('last_status_updated_at', '<', $thresholdTime);
            })
            ->get();

        $count = 0;
        foreach ($devicesToMarkOffline as $device) {
            $device->markAsOffline();
            $count++;
        }

        if ($count > 0) {
            $this->info("Marked {$count} device(s) as offline.");
        } else {
            $this->info("No devices needed to be marked as offline.");
        }

        return Command::SUCCESS;
    }
}
