<?php
namespace Wsdl2Composer\CLI;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Description of GeneratePackage
 *
 * @author belinde
 */
class GeneratePackage extends Command
{
    /**
     * @var SymfonyStyle
     */
    private $io;
    
//    private $fs;
    
    protected function configure()
    {
        $this
            ->setName('generate:package')
            ->setDescription('Generate the Composer package.')
            ->setHelp("Parse the WSDL file and generate the Composer package");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
//        $this->fs = new \Symfony\Component\Filesystem\Filesystem();
        $this->io = new SymfonyStyle($input,$output);
        $this->io->block("Fungo eccome");
    }
}
