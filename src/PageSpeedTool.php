<?php declare(strict_types=1);

use Benchmarks\CaseAnalyzer;
use Benchmarks\CaseStudyInterface;
use Benchmarks\PageMeasurer;
use Benchmarks\PageMeasurerInterface;
use Exceptions\UnmeasuredPageException;
use Outputs\OutputInterface;
use Entities\MeasureReport;

class PageSpeedTool
{
    /**
     * @var array|OutputInterface[]
     */
    private $outputs = [];

    /**
     * @var array|CaseStudyInterface[]
     */
    private $caseStudies = [];

    /**
     * @var PageMeasurerInterface
     */
    private $pageMeasurer;

    public function __construct(?PageMeasurerInterface $pageMeasurer = null)
    {
        $this->pageMeasurer = $pageMeasurer ?: new PageMeasurer();
    }

    public function addOutput(OutputInterface $output)
    {
        $this->outputs[] = $output;

        return $this;
    }

    public function addCaseStudy(CaseStudyInterface $caseStudy)
    {
        $this->caseStudies[] = $caseStudy;

        return $this;
    }

    public function run(string $baseUrl, array $comparedUrls): void
    {
        $report = $this->generateMeasureReport($baseUrl, $comparedUrls);

        $caseAnalyzer = new CaseAnalyzer();
        foreach ($this->caseStudies as $caseStudy) {
            $caseAnalyzer->run($report, $caseStudy);
        }

        $this->resolveOutputs($report);
    }

    private function generateMeasureReport(string $baseUrl, array $comparedUrls)
    {
        $baseUrlMeasure = $this->pageMeasurer->measure($baseUrl);

        if (!$baseUrlMeasure) {
            throw new UnmeasuredPageException('Can\'t measure base page');
        }

        $comparedUrlMeasures = [];
        foreach ($comparedUrls as $url) {
            $measurement = $this->pageMeasurer->measure($url);

            if ($measurement) {
                $comparedUrlMeasures[] = $measurement;
            }
        }

        if (!count($comparedUrlMeasures)) {
            throw new UnmeasuredPageException('Can\'t measure any compared page');
        }

        return new MeasureReport($baseUrlMeasure, $comparedUrlMeasures);
    }

    private function resolveOutputs(MeasureReport $report): void
    {
        foreach ($this->outputs as $output) {
            $output->write($report);
        }
    }
}
