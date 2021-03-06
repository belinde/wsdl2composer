<?php

namespace Wsdl2Composer\CLI;

use \Wsdl2Composer\Definitions\PropertyDefinition;
use \Wsdl2Composer\Definitions\ClassDefinition;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Description of GeneratePackage
 *
 * @author belinde
 */
class GeneratePackage extends Command {

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
                ->setName( 'generate:package' )
                ->setDescription( 'Generate the Composer package.' )
                ->addArgument( 'wsdl', InputArgument::REQUIRED, 'The WSDL file to analyze' )
                ->setHelp( "Parse the WSDL file and generate the Composer package" );
    }

    protected function execute( InputInterface $input, OutputInterface $output ) {
        $this->io = new SymfonyStyle( $input, $output );
        $this->fs = new Filesystem();
        $wsdl = $input->getArgument( 'wsdl' );
        if ( !$this->fs->isAbsolutePath( $wsdl ) ) {
            $wsdl = trim( shell_exec( 'pwd' ) ) . DIRECTORY_SEPARATOR . $wsdl;
        }

        $parser = new \Wsdl2Composer\WsdlParser( $wsdl, 'TestAmazon' );

        $writer = new \Wsdl2Composer\Writers\Basic( '/home/belinde/Dropbox/Sviluppo/wsdl2composer/prove' );
        foreach ( $parser->getClasses() as $def )
            $writer->dump( $def );
    }

}
