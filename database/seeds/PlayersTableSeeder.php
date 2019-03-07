<?php

use App\Models\Player;
use App\Models\PlayerDataPoint;
use Illuminate\Database\Seeder;
use function GuzzleHttp\json_decode;
use Illuminate\Database\Eloquent\Collection;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get some default names to record
        $players = ['SalvationDMS', 'Silvia 240sx', 'Frosty F7', 'Visqo', 'Mr Buchu'];

        $data = [];

        foreach ($players as $player) {
            $data[] = [
                'name' => $player,
                'type' => 'normal',
                'last_updated' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        Player::insert($data);

        $json = file_get_contents(__DIR__ . '/../../data-points.json');

        $playerDataPoints = json_decode($json, true);

        $preparedData = [];

        foreach ($playerDataPoints as $dataPoint) {
            $preparedData[] = [
                'player_id' => $dataPoint['player_id'],
                'data' => json_encode($dataPoint['data']),
                'created_at' => $dataPoint['created_at'],
                'updated_at' => $dataPoint['updated_at']
            ];
        }

        PlayerDataPoint::insert($preparedData);
    }
}
