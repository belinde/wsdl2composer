<?php

namespace Wsdl2Composer\Meta;

/**
 * Description of GenericInfo
 *
 * @author belinde
 */
abstract class GenericInfo {

    /**
     * @var string
     */
    protected $shortDescription;

    /**
     *
     * @var string
     */
    protected $longDescription;

    /**
     * @var array
     */
    protected $metaInfos = [ ];

    /**
     * @return string
     */
    public function getShortDescription() {
        return $this->shortDescription;
    }

    /**
     * @return string
     */
    public function getLongDescription() {
        return $this->longDescription;
    }

    /**
     * @param string $shortDescription
     * @return static
     */
    public function setShortDescription( $shortDescription ) {
        $this->shortDescription = (string) $shortDescription;
        return $this;
    }

    /**
     * @param string $longDescription
     * @return static
     */
    public function setLongDescription( $longDescription ) {
        $this->longDescription = (string) $longDescription;
        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     * @return static
     */
    public function addMetaInfo( $key, $value ) {
        $this->metaInfos[ (string) $key ] = (string) $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getMetaInfos() {
        return $this->metaInfos;
    }

}
