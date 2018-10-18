<?php declare(strict_types=1);

namespace Benchmarks;

use Entities\Measurement;

class Measurer
{
    public function measure(string $url): ?Measurement
    {
        $curlHandle = curl_init($url);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);

        if (curl_exec($curlHandle) !== false) {
            $info = curl_getinfo($curlHandle);
            $info['total_time'];

            return new Measurement($url, $info['total_time']);
        }

        curl_close($curlHandle);

        return null;
    }
}
