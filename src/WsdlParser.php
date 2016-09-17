<?php

namespace Wsdl2Composer;

use Wsdl2Composer\Definitions\ClassDefinition;
use Wsdl2Composer\Definitions\PropertyDefinition;

/**
 * Description of WsdlParser
 *
 * @author belinde
 */
class WsdlParser {

    const XML_SCHEMA = "http://www.w3.org/2001/XMLSchema";
    const SOAP_SCHEMA = "http://schemas.xmlsoap.org/wsdl/soap/";

    /**
     * @var \DOMDocument
     */
    private $dom;
    private $defaultNamespace;
    
    private $classes = [];
    
    public function __construct( $wsdlFile, $defaultNamespace ) {
        $this->defaultNamespace = $defaultNamespace;
        $this->dom = new \DOMDocument();
        $this->dom->load( $wsdlFile );
        $list = $this->dom->getElementsByTagNameNS( self::XML_SCHEMA, 'complexType' );

        foreach ( $list as $complexType ) {
            $this->analyzeComplexType( $complexType );
        }
    }

    private function addAttributeFromElement( ClassDefinition $class, \DOMNode $node ) {
        if ( $node->localName == 'element' and $node->attributes->getNamedItem( 'name' ) ) {
            $class->addProperty(
                    (new PropertyDefinition( $node->attributes->getNamedItem( 'name' )->nodeValue ) )
                            ->setType( $node->attributes->getNamedItem( 'type' )->nodeValue )
            );
        }
    }

    private function analyzeComplexType( \DOMNode $node ) {
        $attr = $node->attributes->getNamedItem( 'name' );
        if ( $attr ) {
            $class = (new ClassDefinition( $attr->nodeValue ) )
                    ->setNamespace( $this->defaultNamespace )
                    ->setLongDescription( "Taken from line " . $node->getLineNo() . " of WSDL file source" );

            $typeName = $attr->nodeValue;
            echo "\n=== $typeName\n";
            for ( $i = 0; $i < $node->childNodes->length; $i++ ) {
                $child = $node->childNodes->item( $i );
                switch ( true ) {
                    case ($child->namespaceURI === self::XML_SCHEMA and $child->localName === 'sequence'):
                        foreach ( $child->childNodes as $element ) {
                            $this->addAttributeFromElement( $class, $element );
                        }
                        break;
                }
                echo '  ' . $child->namespaceURI . "\n";
            }
            
            $this->classes[ $class->getFullName() ] = $class;
        }
    }

    public function getClasses() {
        return $this->classes;
    }


}
