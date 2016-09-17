<?php

namespace Wsdl2Composer\Meta;

/**
 * Description of ClassDefinition
 *
 * @author belinde
 */
class ClassDefinition extends GenericInfo {

    /**
     * @var string
     */
    private $baseName;

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var PropertyDefinition[]
     */
    private $properties = [ ];

    /**
     * 
     * @param string $baseName
     */
    public function __construct( $baseName ) {
        $this->baseName = (string) $baseName;
        $this->setShortDescription( $baseName );
    }

    /**
     * @param string $namespace
     * @return static
     */
    public function setNamespace( $namespace ) {
        $this->namespace = trim( $namespace, '\\' );
        return $this;
    }

    /**
     * @return string
     */
    public function getBaseName() {
        return $this->baseName;
    }

    /**
     * @return string
     */
    public function getNamespace() {
        return $this->namespace;
    }

    /**
     * @return string
     */
    public function getFullName() {
        return '\\' . $this->getNamespace() . '\\' . $this->getBaseName();
    }

    /**
     * @param \Wsdl2Composer\Meta\PropertyDefinition $property     
     * @return static
     */
    public function addProperty( PropertyDefinition $property ) {
        $this->properties[ $property->getName() ] = $property;
        return $this;
    }
    
    /**
     * 
     * @return array|\Wsdl2Composer\Meta\PropertyDefinition[]
     */
    public function getProperties() {
        return $this->properties;
    }



}
