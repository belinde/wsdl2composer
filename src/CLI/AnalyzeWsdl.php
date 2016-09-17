<?php

namespace Wsdl2Composer\CLI;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Description of AnalyzeWsdl
 *
 * @author belinde
 */
class AnalyzeWsdl extends Command {

    /**
     * @var SymfonyStyle
     */
    private $io;

    /**
     * @var Filesystem
     */
    private $fs;

    protected function configure() {
        $this
                ->setName( 'analyze:wsdl' )
                ->setDescription( 'Analyze a WSDL file.' )
                ->addArgument( 'wsdl', InputArgument::REQUIRED, 'The WSDL file to analyze' )
                ->setHelp( "Parse the WSDL file and show a human readable description." );
    }

    protected function execute( InputInterface $input, OutputInterface $output ) {
        $this->io = new SymfonyStyle( $input, $output );
        $this->fs = new Filesystem();
        $wsdl = $input->getArgument( 'wsdl' );
        if ( !$this->fs->isAbsolutePath( $wsdl ) ) {
            $wsdl = trim(shell_exec('pwd')) . DIRECTORY_SEPARATOR . $wsdl;
        }

        $parser = new \Wsdl2Composer\WsdlParser($wsdl, 'TestAmazon');
        
    }

}
