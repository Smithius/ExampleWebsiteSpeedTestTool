<?php declare(strict_types=1);

namespace Benchmarks;

use Entities\Measurement;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\TransferStats;

class PageMeasurer implements PageMeasurerInterface
{
    public function measure(string $url): ?Measurement
    {
        $client = new Client(['verify' => false]);
        $measurement = new Measurement();
        $measurement->setUrl($url);

        try {
            $response = $client->get($url, [
                'on_stats' => function (TransferStats $stats) use ($measurement) {
                    $measurement->setTime($stats->getTransferTime());
                },
            ]);

            if ($response->getStatusCode() == 200) {
                return $measurement;
            }
        } catch (GuzzleException $e) {
        }

        return null;
    }
}
