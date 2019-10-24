<?php declare(strict_types=1);

use Benchmarks\CaseStudy;
use Notifications\Email;
use Notifications\Sms;
use Outputs\Console;
use Outputs\File;
use Rules\IsFaster;
use Rules\IsTwiceFaster;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConsoleCommand extends Command
{
    /**
     * @var PageSpeedTool
     */
    private $pageSpeedTool;

    public function __construct(?string $name = null)
    {
        parent::__construct($name);

        $this->pageSpeedTool = new PageSpeedTool();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('baseUrl', InputArgument::REQUIRED, 'Tested page url')
            ->addArgument(
                'comparedUrls',
                InputArgument::IS_ARRAY | InputArgument::REQUIRED,
                'Compared pages urls (separate multiple urls with a space)'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $baseUrl = $input->getArgument('baseUrl');
        $comparedUrls = $input->getArgument('comparedUrls');

        (new PageSpeedTool())
            ->addOutput(new Console($output))
            ->addOutput(new File('test.log'))
            ->addCaseStudy(
                (new CaseStudy())
                    ->addRule(new IsFaster())
                    ->addNotification(new Email())
            )
            ->addCaseStudy(
                (new CaseStudy())
                    ->addRule(new IsTwiceFaster())
                    ->addNotification(new Sms())
            )
            ->run($baseUrl, $comparedUrls);
    }
}
