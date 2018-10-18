<?php declare(strict_types=1);

use Benchmarks\TestRunner;
use Benchmarks\TestCase;
use Rules\IsSlower;
use Rules\IsTwiceSlower;
use Notifications\Email;
use Notifications\Sms;
use Entities\Measurement;
use Entities\Report;
use Symfony\Component\Console\Output\OutputInterface;

class ComparisonManager
{
    /**
     * @var Measurement
     */
    private $testedWebsite;

    /**
     * @var Measurement[]
     */
    private $comparedWebsites;

    /**
     * @var OutputInterface
     */
    private $output = null;

    public function __construct(Measurement $testedWebsite, array $comparedWebsites)
    {
        $this->testedWebsite = $testedWebsite;
        $this->comparedWebsites = $comparedWebsites;
    }

    public function run(): void
    {
        $report = new Report($this->testedWebsite, $this->comparedWebsites);

        $this->configureTestRunner($report)
            ->run();

        foreach ($this->getOutputsConfiguration() as $outputMethod) {
            $outputMethod->write($report);
        }
    }

    public function getOutput(): OutputInterface
    {
        return $this->output;
    }

    public function setOutput(OutputInterface $output): ComparisonManager
    {
        $this->output = $output;

        return $this;
    }

    private function configureTestRunner($report): TestRunner
    {
        return (new TestRunner($report))
            ->addTest(
                (new TestCase())
                    ->addRule(new IsSlower())
                    ->addNotification(new Email())
            )
            ->addTest(
                (new TestCase())
                    ->addRule(new IsTwiceSlower())
                    ->addNotification(new Sms())
            );
    }

    private function getOutputsConfiguration(): array
    {
        return [
            new \Outputs\Console($this->output),
            new \Outputs\File()
        ];
    }
}
