<?php

require_once('BLCommentsAdmin.php');

/**
 *
 * @author Brandlovers
 * @version 1.0.0
 */
class BLComments
{
    /**
     * Default script attributes
     *
     * @var array
     * @access private
     */
    private $scriptAttributes = [
        'src' => 'http://dev1.brandlovers.com:443/brandlovers-connect/dist/v1/comments.js',
        'data-name' => 'bl-script',
    ];

    /**
     * Default element attributes
     *
     * @var array
     * @access private
     */
    private $elementAttributes = [
        'class' => 'bl-comment'
    ];

    /**
     *
     * Class constructor
     * @access public
     */
    public function __construct()
    {
        $options = get_option(BLCommentsAdmin::OPTIONS_NAME);
        $this->scriptAttributes['data-language'] = isset($options['data-language']) ? $options['data-language'] : 'pt';
        add_shortcode('bl-comment', array($this, 'shortcode'));
        add_action('wp_footer', array($this, 'printScript'));
    }

    /**
     * Print script which defined attributes
     *
     * @access public
     * @return void
     */
    public function printScript()
    {
        $domDocument = new DOMDocument();
        $domScript = $domDocument->createElement('script');
        foreach ($this->scriptAttributes as $key => $value) {
            $domAttribute = $domDocument->createAttribute($key);
            $domAttribute->value = $value;
            $domScript->appendChild($domAttribute);
        }
        $domDocument->appendChild($domScript);
        echo $domDocument->saveHtml();
    }

    /**
     * Shortcode to use in any wordpress section
     *
     * @access public
     * @param array $attributes
     * @return String
     */
    public function shortcode(array $attributes)
    {
        $defaultOptions = get_option(BLCommentsAdmin::OPTIONS_NAME);
        $domDocument = new DOMDocument();
        $domElement = $domDocument->createElement('div');
        $attributesToInsert = array_merge($attributes, $this->elementAttributes);
        // default options
        $domElement = $this->addAttributesToElement($domElement, $defaultOptions, $domDocument);
        // custom attributes
        $domElement = $this->addAttributesToElement($domElement, $attributesToInsert, $domDocument);
        $domDocument->appendChild($domElement);

        return $domDocument->saveHtml();
    }

    /**
     * Add attributes to DOMElement
     *
     * @access private
     * @param DOMElement $domElement
     * @param array $attributes
     * @param DOMDocument $domDocument
     * @return DOMElement
     */
    private function addAttributesToElement(DOMElement $domElement, array $attributes, DOMDocument $domDocument)
    {
        foreach ($attributes as $key => $value) {
            $domAttribute = $domDocument->createAttribute($key);
            $domAttribute->value = $value;
            $domElement->appendChild($domAttribute);
        }

        return $domElement;
    }
}

