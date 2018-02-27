<?php
namespace Pulsestorm\TutorialInstanceObjects\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pulsestorm\TutorialInstanceObjects\Model\ExampleFactory;
use \Magento\Framework\ObjectManagerInterface;

class Testbed extends Command
{
    protected $exampleFactory;
    public function __construct(ExampleFactory $example)
    {
        $this->exampleFactory = $example;
        return parent::__construct();
    }
    
    protected function configure()
    {
        $this->setName("ps:tutorial-instance-objects");
        $this->setDescription("A command the programmer was too lazy to enter a description for.");
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $example = $this->exampleFactory->create();
        $output->writeln("You just used a". "\n\n".
        get_class($this->exampleFactory) . "\n\n" .
        "to create a \n\n    "           .
        get_class($example) . "\n");
    }
} 