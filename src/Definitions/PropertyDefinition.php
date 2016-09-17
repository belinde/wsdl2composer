<?php

namespace Wsdl2Composer\Definitions;

/**
 * Description of PropertyDefinition
 *
 * @author belinde
 */
class PropertyDefinition extends GenericInfo {

    const V_PUBLIC = 0;
    const V_PROTECTED = 1;
    const V_PRIVATE = 2;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     *
     * @var integer
     */
    private $visibility = 0;

    /**
     * 
     * @return integer
     */
    public function getVisibility() {
        return $this->visibility;
    }

    /**
     * 
     * @param integer $visibility
     * @return \Wsdl2Composer\Meta\PropertyDefinition
     */
    public function setVisibility( $visibility ) {
        $this->visibility = (integer) $visibility;
        if ( $this->visibility < 0 or $this->visibility > 2 )
            $this->visibility = 0;
        return $this;
    }

    /**
     * @var mixed
     */
    private $defaultValue;

    public function __construct( $name ) {
        $this->name = (string) $name;
        $this->setShortDescription( $name );
    }

    /**
     * @return mixed
     */
    public function getDefaultValue() {
        return $this->defaultValue;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * 
     * @param type $type
     * @return \Wsdl2Composer\Meta\PropertyDefinition
     */
    public function setType( $type ) {
        $this->type = (string) $type;
        $this->addMetaInfo( 'var', $this->type );
        return $this;
    }

    /**
     * 
     * @param type $defaultValue
     * @return \Wsdl2Composer\Meta\PropertyDefinition
     */
    public function setDefaultValue( $defaultValue ) {
        $this->defaultValue = $defaultValue;
        return $this;
    }

}
