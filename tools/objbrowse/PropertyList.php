#!/usr/bin/php
<?php
//
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 Freek Dijkstra                                    |
// +----------------------------------------------------------------------+
// | License: Permission is hereby granted, free of charge, to any person |
// | obtaining a copy of this software and associated documentation files |
// | (the "Software"), to deal in the Software without restriction,       |
// | including without limitation the rights to use, copy, modify, merge, |
// | publish, distribute, and/or sell copies of the Software, and to      |
// | permit persons to whom the Software is furnished to do so, provided  |
// | that the above copyright notice(s) and this permission notice appear |
// | in all copies of the Software and that both the above copyright      |
// | notice(s) and this permission notice appear in supporting            |
// | documentation.                                                       |
// | The software is provided "as is", without warranty of any kind.      |
// +----------------------------------------------------------------------+
// | Author: Freek Dijkstra <php@macfreek.nl>                             |
// | Thanks to: Stephan Schmidt (author XML_Parser_Simple)                |
// +----------------------------------------------------------------------+

/**
 * PropertyList XML parser class.
 *
 * This class parses property lists (PLIST) XML files, which 
 * adhere to the DTD at 
 * http://www.apple.com/DTDs/PropertyList-1.0.dtd.
 * Property lists are often used by Mac OS X applications.
 * It can return a datastructure which you can use to find 
 * specific data elements.
 *
 * Future versions may return objects instead of a simple 
 * datastructure, or may be geared towards creating subclasses.
 *
 * @category XML
 * @package XML_PropertyList
 * @author  Freek Dijkstra <php@macfreek.nl>
 */


/**
 * uses PEAR's error handling
 */
require_once 'PEAR.php';

/**
 * Unsupported Property List version (Define an error ID)
 */
define('XML_PROPERTYLIST_UNSUPPORTED_VERSION', 300);

/**
 * Parse Error in PLIST format (Define an error ID)
 */
define('XML_PROPERTYLIST_INVALID_INPUT', 301);

/**
 * built on XML_Parser
 */
require_once 'XML/Parser.php';

/**
 * PropertyList XML parser class.
 *
 * This class parses property lists (PLIST) XML files, which 
 * adhere to the DTD at 
 * http://www.apple.com/DTDs/PropertyList-1.0.dtd.
 * Property lists are often used by Mac OS X applications.
 * It can return a datastructure which you can use to find 
 * specific data elements.
 *
 * Future versions may return objects instead of a simple 
 * datastructure, or may be geared towards creating subclasses.
 *
 * <code>
 * require_once '../Parser/PropertyList.php';
 * 
 * $plp = &new XML_Parser_PropertyList();
 * 
 * $result = $plp->setInputFile('myDoc.xml');
 * $result = $plp->parse();
 * $data = $plp->getDataStructure();
 * </code>
 *
 * @category XML
 * @package XML_PropertyList
 * @author  Freek Dijkstra <php@macfreek.nl>
 */
class XML_Parser_PropertyList extends XML_Parser
{
   /**
    * element stack
    *
    * @access   private
    * @var      array
    */
    var $_elStack = array();

   /**
    * key stack
    *
    * @access   private
    * @var      array
    */
    var $_keyStack = array();

   /**
    * all character data for the current elements
    *
    * @access   private
    * @var      array
    */
    var $_data = array();

   /**
    * all hierarchical data
    *
    * @access   private
    * @var      mixed
    */
    var $_plist = NULL;

   /**
    * element depth
    *
    * @access   private
    * @var      integer
    */
    var $_depth = 0;

    /**
     * Creates an XML parser.
     *
     * This is needed for PHP4 compatibility, it will
     * call the constructor, when a new instance is created.
     *
     * @param string $srcenc source charset encoding, use NULL (default) to use
     *                       whatever the document specifies
     * @param string $mode   how this parser object should work, "event" for
     *                       handleElement(), "func" to have it call functions
     *                       named after elements (handleElement_$name())
     * @param string $tgenc  a valid target encoding
     */
    function XML_Parser_PropertyList($srcenc = null, $mode = 'event', $tgtenc = null)
    {
        $this->XML_Parser($srcenc, $mode, $tgtenc);
    }

    /**
     * Reset the parser.
     *
     * This allows you to use one parser instance
     * to parse multiple XML documents.
     *
     * @access   public
     * @return   boolean|object     true on success, PEAR_Error otherwise
     */
    function reset()
    {
        $this->_keyStack = array();
        $this->_elStack = array();
        $this->_data     = array();
        $this->_depth    = 0;
        $this->_plist    = NULL;
        
        return parent::reset();
    }

    /**
     * Init the element handlers
     *
     * @access  private
     */
    function _initHandlers()
    {
        if (!is_resource($this->parser)) {
            return false;
        }

        if (!is_object($this->_handlerObj)) {
            $this->_handlerObj = &$this;
        }

        if ($this->mode != 'func' && $this->mode != 'event') {
            return $this->raiseError('Unsupported mode given', XML_PARSER_ERROR_UNSUPPORTED_MODE);
        }
        xml_set_object($this->parser, $this);

        xml_set_element_handler($this->parser, 'startHandler', 'endHandler');

        /**
         * set additional handlers for character data, entities, etc.
         */
        foreach ($this->handler as $xml_func => $method) {
            if (method_exists($this, $method)) {
                $xml_func = 'xml_set_' . $xml_func;
                $xml_func($this->parser, $method);
            }
		}
    }


   /**
    * start handler
    *
    * Pushes attributes and tagname onto a stack
    *
    * @access   private
    * @final
    * @param    resource    xml parser resource
    * @param    string      element name
    * @param    array       attributes
    */
    function startHandler($xp, $elem, &$attribs)
    {
		$this->_elStack[$this->_depth] = $elem;
        
        // for ($i = 0; $i < $this->_depth; $i++)  echo "  ";
        // echo "<$elem>\n";
        
        switch ($elem) {
        	case 'PLIST':
				// Handle the PLIST element (start of propertylist)
				if ($this->_depth != 0) {
					return $this->raiseError('PLIST element may only occur at root level', XML_PROPERTYLIST_INVALID_INPUT);
				}
				if (!isset($attribs["VERSION"])) {
					return $this->raiseError('Version attribute for PLIST missing', XML_PROPERTYLIST_INVALID_INPUT);
				}
				if ($attribs["VERSION"] != "1.0") {
					return $this->raiseError('Only PropertyList version 1.0 is supported, '.$attribs["VERSION"].' not', XML_PROPERTYLIST_UNSUPPORTED_VERSION);
				}
				$this->_keyStack = array();
				$this->_data     = array();
				$this->_plist    = NULL;
				break;
        	case 'DICT':
				// Handles the DICT element (start of named array)
				if ($this->_depth == 0) {
					return $this->raiseError('Only PLIST element may occur at root level', XML_PROPERTYLIST_INVALID_INPUT);
				}
				// create array in current subitem of $_plist
				$subplist = $this->getCurrentPlistVariableName();
				eval('$this->'.$subplist.' = array();');
        	    // variables variable (line below) does not work due to use of arrays:
				// $this->$subplist = array();
				break;
        	case 'ARRAY':
				// Handles the ARRAY element (start of unnamed (numbered) array)
				if ($this->_depth == 0) {
					return $this->raiseError('Only PLIST element may occur at root level', XML_PROPERTYLIST_INVALID_INPUT);
				}
				// create array in current subitem of $_plist
				$subplist = $this->getCurrentPlistVariableName();
				eval('$this->'.$subplist.' = array();');
				$this->_keyStack[] = 0;
				break;
        	case 'KEY':
        	    // Check if a key was already defined (thus two keys after each other, shouldn't happen)
				if (count($this->_keyStack) > $this->_depth-2) {
				    return $this->raiseError('Two <key> siblings defined next to each other', XML_PROPERTYLIST_INVALID_INPUT);
					// resolution: set value of first key to NULL.
					$subplist = $this->getCurrentPlistVariableName();
					eval('$this->'.$subplist.' = NULL;');
					array_pop($this->_keyStack);
				}
				break;
        	case 'DATA':
        	case 'STRING':
        	case 'TRUE':
        	case 'FALSE':
        	case 'REAL':
        	case 'INTEGER':
        	case 'DATE':
				break;
			default:
				return $this->raiseError("Unknown element $elem", XML_PROPERTYLIST_INVALID_INPUT);
				break;
        }
        // var_dump($this->_plist);
        $this->_depth++;
        $this->_data[$this->_depth] = '';
    }

   /**
    * end handler
    *
    * Pulls attributes and tagname from a stack
    *
    * @access   private
    * @final
    * @param    resource    xml parser resource
    * @param    string      element name
    */
    function endHandler($xp, $elem)
    {
        // $el   = array_pop($this->_elStack);
		unset($this->_elStack[$this->_depth]);
        $data = trim($this->_data[$this->_depth]);
        
        // for ($i = 0; $i < $this->_depth; $i++)  echo "  ";
        // echo "$data\n";
        
        $this->_depth--;
        
        // for ($i = 0; $i < $this->_depth; $i++)  echo "  ";
        // echo "</$elem>\n";

        switch ($elem) {
        	case 'PLIST':
				// Handle the closing of a PLIST element (end of propertylist)
				if ($data != '') {
					return $this->raiseError('PLIST should not contain cdata, only other elements', XML_PROPERTYLIST_INVALID_INPUT);
				}
				break;
        	case 'DICT':
				// Handle the closing of a DICT element (end of named array)
				if ($data != '') {
					return $this->raiseError('DICT should not contain cdata, only other elements', XML_PROPERTYLIST_INVALID_INPUT);
				}
				if (count($this->_keyStack) != $this->_depth-1) {
				   return $this->raiseError('The number of keys ('.count($this->_keyStack).') does not match the expected number for the current nesting depth ('.($this->_depth-1).')', XML_PROPERTYLIST_INVALID_INPUT);
				}
				$key = array_pop($this->_keyStack);
				if (is_integer($key)) $this->_keyStack[] = (++$key);
				break;
        	case 'ARRAY':
        	    
        	    array_pop($this->_keyStack);
				$key = array_pop($this->_keyStack);
				if (is_integer($key)) $this->_keyStack[] = (++$key);
				
				break;
        	case 'KEY':
				if ($this->_data[$this->_depth] == '') {
					return $this->raiseError('KEY must contain cdata', XML_PROPERTYLIST_INVALID_INPUT);
				}
        	    $this->_keyStack[] = $data;
        	    
				break;
				
			// handle atomic data types
        	case 'DATA':
        	    // first do base64 decoding
				$subplist = $this->getCurrentPlistVariableName();
				$data = base64_decode($data);
				eval('$this->'.$subplist.' = $data;');
				$key = array_pop($this->_keyStack);
				if (is_integer($key)) $this->_keyStack[] = (++$key);
				break;
        	case 'STRING':
				$subplist = $this->getCurrentPlistVariableName();
				eval('$this->'.$subplist.' = $data;');
				$key = array_pop($this->_keyStack);
				if (is_integer($key)) $this->_keyStack[] = (++$key);
				break;
        	case 'TRUE':
				$subplist = $this->getCurrentPlistVariableName();
				eval('$this->'.$subplist.' = true;');
				$key = array_pop($this->_keyStack);
				if (is_integer($key)) $this->_keyStack[] = (++$key);
				break;
        	case 'FALSE':
				$subplist = $this->getCurrentPlistVariableName();
				eval('$this->'.$subplist.' = false;');
				$key = array_pop($this->_keyStack);
				if (is_integer($key)) $this->_keyStack[] = (++$key);
				break;
        	case 'REAL':
				$subplist = $this->getCurrentPlistVariableName();
				eval('$this->'.$subplist.' = (float)$data;');
				$key = array_pop($this->_keyStack);
				if (is_integer($key)) $this->_keyStack[] = (++$key);
				break;
        	case 'INTEGER':
        		$subplist = $this->getCurrentPlistVariableName();
        		eval('$this->'.$subplist.' = (integer)$data;');
				$key = array_pop($this->_keyStack);
				if (is_integer($key)) $this->_keyStack[] = (++$key);
				break;
        	case 'DATE':
				$subplist = $this->getCurrentPlistVariableName();
				eval('$this->'.$subplist.' = $data;');
				$key = array_pop($this->_keyStack);
				if (is_integer($key)) $this->_keyStack[] = (++$key);
				break;
				
			default:
				return $this->raiseError("Unknown element $elem", XML_PROPERTYLIST_INVALID_INPUT);
				break;
        }
        
        // print_r($this->_plist);
        /*
        switch ($this->mode) {
            case 'event':
                $this->_handlerObj->handleKey($el['name'], $data);
                break;
            case 'func':
                $func = 'handleKey_' . $elem;
                if (method_exists($this->_handlerObj, $func)) {
                    call_user_func(array(&$this->_handlerObj, $func), $el['name'], $data);
                }
                break;
        }
        */
        
    }

   /**
    * handle character data
    *
    * @access   private
    * @final
    * @param    resource    xml parser resource
    * @param    string      data
    */
    function cdataHandler($xp, $data)
    {
        $this->_data[$this->_depth] .= $data;
    }

   /**
    * get php-string representation of variable of current element in plist
    *
    * @access   private
    */
    function getCurrentPlistVariableName()
    {
        $varname = '_plist';
        foreach ($this->_keyStack AS $subname) {
            if (is_integer($subname)) {
                $varname .= "[$subname]";
            } else {
                $varname .= "['$subname']";
            }
        }
        return $varname;
    }


   /**
    * get hierarchical plist data structure
    *
    * @access   public
    */
    function getDataStructure()
    {
        return $this->_plist;
    }



   /**
    * handle a key
    *
    * Implement this in your parser 
    *
    * @access   public
    * @abstract
    * @param    string      key name
    * @param    *           hierarchical data
    */
    function handleKey($name, $attribs, $data)
    {
    }

   /**
    * get the current tag depth
    *
    * The root tag is in depth 0.
    *
    * @access   public
    * @return   integer
    */
    function getCurrentDepth()
    {
        return $this->_depth;
    }

   /**
    * add some string to the current ddata.
    *
    * This is commonly needed, when a document is parsed recursively.
    *
    * @access   public
    * @param    string      data to add
    * @return   void
    */
    function addToData( $data )
    {
        $this->_data[$this->_depth] .= $data;
    }
}


/**
 * PropertyList XML parser class, with custom raiseError routine
 *
 * See the XML_Parser_PropertyList class for details.
 *
 * <code>
 * require_once '../Parser/PropertyList.php';
 * 
 * $plp = &new XML_Parser_PropertyList();
 * 
 * $result = $plp->setInputFile('myDoc.xml');
 * $result = $plp->parse();
 * $data = $plp->getDataStructure();
 * </code>
 *
 * @category XML
 * @package XML_PropertyList
 * @author  Freek Dijkstra <php@macfreek.nl>
 */
class XML_Parser_PropertyList_custom_raiseError extends XML_Parser_PropertyList
{
    
    /**
     * XML_Parser_PropertyList_custom_raiseError::raiseError()
     * 
     * Just echo the error and exit().
     * 
     * @param string  $msg   the error message
     * @param integer $ecode the error message code
     * @return NULL (script is terminated)
     **/
     
    function raiseError($msg = null, $ecode = 0)
    {
        $msg = empty($msg) ? 'no error to report' : $msg;
        echo "Error: $msg\n";
        // echo "depth = ",$this->_depth,"\n";
        // print_r($this->_keyStack);
        // print_r($this->_plist);
        exit;
    }
    
}


// code:

// use a broken PLIST, so that we get an error. In this case, 
// a <true/> element was replaced with a <whatever/> element.
$filename = 'boss-All.graffle';

// Create a new XML_Parser_PropertyList
// Since XML_Parser_PropertyList has no custom raiseError routine,
// we may see a nice crash. I got a 'Bus error'.
// Use XML_Parser_PropertyList_custom_raiseError to avoid the crash.
$pp = new XML_Parser_PropertyList();

// set Input file...
$result = $pp->setInputFile($filename);

// parse ... we should get the error here
$result = $pp->parse();

// In case the error wasn't there, let's continue
// Get the data structure
$data = $pp->getDataStructure();

// object not needed. Doing over-active cleanup
unset($pp);

// Echo the resulting data structure (may be binary, but who cares)
print_r($data);
    
// We're done
exit;

?>
