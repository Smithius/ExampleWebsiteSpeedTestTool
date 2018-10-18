<?php declare(strict_types=1);

use Benchmarks\Measurer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConsoleCommand extends Command
{
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

        $measurer = new Measurer();
        $testedWebsite = $measurer->measure($websiteUrl);

        $comparedWebsites = [];
        foreach ($otherWebsitesUrls as $url) {
            $measurement = $measurer->measure($url);
            $measurement->setParentMeasurement($testedWebsite);

            $comparedWebsites[] = $measurement;
        }

        $cm = new ComparisonManager($testedWebsite, $comparedWebsites);
        $cm->setOutput($output)
            ->run();
    }

    private function parseCompUrls(string $comparedUrls): array
    {
        return explode(';', $comparedUrls);
    }
}
