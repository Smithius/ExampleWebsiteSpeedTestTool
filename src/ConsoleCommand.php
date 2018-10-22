<?php declare(strict_types=1);

use Benchmarks\Measurer;
use Entities\Measurement;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConsoleCommand extends Command
{
    /**
     * @var Measurer
     */
    private $measurer;

    public function __construct(?string $name = null)
    {
        parent::__construct($name);
        $this->measurer = new Measurer();
    }

    protected function configure()
    {
        $this
            ->addArgument('websiteUrl', InputArgument::REQUIRED, 'Tested page url')
            ->addArgument('otherWebsitesUrls', InputArgument::REQUIRED, 'Compared pages urls separated by semicolon');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $websiteUrl = $input->getArgument('websiteUrl');
        $otherWebsitesUrls = $this->parseCompUrls($input->getArgument('otherWebsitesUrls'));

        $testedWebsite = $this->measureWebsite($websiteUrl);

        if (!$testedWebsite) {
            throw new Exception('Can\'t measure tested website');
        }

        $comparedWebsites = [];
        foreach ($otherWebsitesUrls as $url) {
            $measurement = $this->measureWebsite($url, $testedWebsite);

            if ($measurement) {
                $comparedWebsites[] = $measurement;
            }
        }

        $cm = new ComparisonManager($testedWebsite, $comparedWebsites);
        $cm->setOutput($output)
            ->run();
    }

    private function measureWebsite($websiteUrl, $parent = null): ?Measurement
    {
        $measurement = $this->measurer->measure($websiteUrl);

        if ($measurement && $parent) {
            $measurement->setParentMeasurement($parent);
        }

        return $measurement;
    }

    private function parseCompUrls(string $comparedUrls): array
    {
        return explode(';', $comparedUrls);
    }
}
