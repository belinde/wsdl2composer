<?php
namespace Wsdl2Composer\CLI;
use \Wsdl2Composer\Meta\PropertyDefinition;
use \Wsdl2Composer\Meta\ClassDefinition;
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
        
        $prop1 = (new PropertyDefinition('nomignolo'))
                ->setType('string')
                ->setDefaultValue('pippo')
                ->setVisibility(PropertyDefinition::V_PUBLIC)
                ->setLongDescription("Una semplice proprietà pubblica");
        
        $prop2 = (new PropertyDefinition('controvalore'))
                ->setType('integer')
                ->setDefaultValue(123)
                ->setVisibility(PropertyDefinition::V_PRIVATE)
                ->setLongDescription("Una semplice proprietà privata");
        
        $def = (new ClassDefinition("ClasseDiTest"))
                ->setNamespace('\NamespaceDi\Prova')
                ->setLongDescription("Una classe che fa cose e vede gente")
                ->addMetaInfo('author', 'Belinde di Reds')
                ->addProperty( $prop1)
                ->addProperty( $prop2);
        
        $writer = new \Wsdl2Composer\Writers\Basic('/home/belinde/Dropbox/Sviluppo/wsdl2composer/prove');
        $writer->dump($def);
    }
}
