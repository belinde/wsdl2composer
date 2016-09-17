<?php

namespace Wsdl2Composer\Writers;

use \Symfony\Component\Filesystem\Filesystem;
use \Wsdl2Composer\Definitions\ClassDefinition;

/**
 * Description of AbstractWriter
 *
 * @author belinde
 */
abstract class AbstractWriter {

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var string
     */
    private $baseDir;

    /**
     * @var string
     */
    private $text = "<?php\n";

    /**
     * @var integer
     */
    private $indentation = 0;

    protected function indentPlus() {
        $this->indentation++;
    }

    protected function indentMinus() {
        $this->indentation--;
        if ( $this->indentation < 0 )
            $this->indentation = 0;
    }

    protected function write( $string = null ) {
        if ( $string ) {
            $this->text .= str_repeat( ' ', 4 * $this->indentation ) . $string;
        }
        $this->text .= "\n";
    }

    /**
     * @param string $baseDir Directory where create the directory hierarchy
     */
    final public function __construct( $baseDir ) {
        $this->filesystem = new Filesystem();
        if ( $this->filesystem->isAbsolutePath( $baseDir ) ) {
            $this->baseDir = $baseDir;
        } else {
            throw new Exception( "\$baseDir must be an absolute path, \"$baseDir\" given" );
        }
    }

    /**
     * @param ClassDefinition $definition
     */
    final public function dump( ClassDefinition $definition ) {
        $this->text = "<?php\n";
        $this->indentation = 0;
        $this->doDump( $definition );
        $namespacedDir = str_replace( '\\', DIRECTORY_SEPARATOR, $this->baseDir . '\\' . $definition->getNamespace() );
        $this->filesystem->mkdir( $namespacedDir );
        $this->filesystem->dumpFile( $namespacedDir . DIRECTORY_SEPARATOR . $definition->getBaseName() . '.php', $this->text );
    }

    /**
     * @param ClassDefinition $definition
     */
    abstract protected function doDump( ClassDefinition $definition );
}
