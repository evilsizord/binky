<?php
/**
 * @package Binky
 * @author Daniel Evilsizor
 * @link https://github.com/evilsizord/binky
 *
 * Simple html email template engine, inspired by Inky (email templater from Zurb Foundation)
 * However it does not do CSS style inlining - it is purely search and replace templating solution.
 * 
 * IMPORTANT: Requires Pharse for HTML parsing. (https://github.com/ressio/pharse/)
 *
 * @license https://opensource.org/licenses/MIT
 */


class Binky
{
    private $buffer;
	private $configFilePath = './default.config.php';
	private $config;
	
	// Options for rendering tags
	const TAG_COPY_VALUE = 1;		// {{WIDTH}} becomes 320
	const TAG_COPY_ATTR = 2;		// {{=WIDTH}} becomes width="320"
	const TAG_CUSTOM = 4;			// {{WIDTH}} becomes custom value
	const TAG_REMOVE = 8;			// {{WIDTH}} is removed from the output

	/**
	 * Class constructor
	 * @param string $configFilePath
	 */
	public function __construct($config = 'default')
	{
		// load default config, unless one is provided
		if ($configFilePath) {
			$this->configFilePath = $configFilePath;
		}

		// The included config file should return a BinkyConfig array
		$this->config = include_once $this->configFilePath;
		
		// todo: error handling
	}

	/**
	 * Start output buffering
	 */
	public function startBuffering()
	{
		ob_start();
	}
	
	/**
	 * Stop output buffering
	 */
	public function stopBuffering()
	{
		$this->buffer = trim( ob_get_contents() );
		ob_end_clean();
	}
	
	/**
	 * Add a component to the configurations
	 * @param string $selector
	 * @param string $template 
	 */
	public function addComponent($selector, $template)
	{
		$this->config[] = array(
			'selector' => $selector,
			'template' => $template
		);
	}

	/**
	 * Render the email
	 */
	public function render($text = null)
	{
		// IMPORTANT
		// Selectors MUST be mutually exclusive
		//   (right? otherwise the first rule would be applied but then subsequent rules may not I guess..)
		// Selectors MUST be completely replaced
		//   (because there seems to be a bug in pharse with the normal for loop, we have to re-select and replace nselectors)
		//   (note: can get by this requirement if we add a 'processed' flag to nodes?)
		
		if (empty($text)) {
			$text = $this->buffer;
		}
		
		try {
			$html = Pharse::str_get_dom($text);
			
			foreach ($this->config as $component) {
				$nodes = $html->select($component['selector']);
				
				while ( $nodes !== false && count($nodes) > 0) {
					$el = $nodes[0];
					$text = $component['template'];

					// Find tags in this component template
					preg_match_all('/{{(=?[\w\-]+)}}/', $text, $matches, PREG_SET_ORDER);
					
					foreach ($matches as $match) {
						$tag = $match[0];
						$tagname = $match[1];

						if (substr($tagname, 0, 1) == '=') {
							// Tags starting with "=" sign are expanded to include attribute names
							$action = self::TAG_COPY_ATTR;
							$tagname = substr($tagname, 1);
						}
						else {
							// Otherwise just replace with the value
							$action = self::TAG_COPY_VALUE;
						}
						
						$attr = strtolower($tagname);
						$attr_val = $el->getAttribute($attr);
						
						// Apply default width for rows and containers
						if (in_array($component['selector'], array('row','container'))) {
							if ($attr == 'width' && !$attr_val) {
								// Look for width attribute on parent element
								$elparent = $el->parent;
								$parentwidth = $elparent->getAttribute('width');
								if ($parentwidth) {
									$attr_val = $parentwidth;
								}
							}
						}
						
						// Apply default width for columns
						if ($component['selector'] == 'column') {
							if ($attr == 'width' && !$attr_val) {
								// Find first ancestor with a defined width
								$node = $el->parent;
								while ($node != null && $node->tag != 'body') {
									$width = $node->getAttribute('width');
									if ($width) {
										$attr_val = $width;
										break;
									}
									$node = $node->parent;
								}
							}
						}
						
						if (!$attr_val) {
							// If no value was provided for this tag, remove it
							$action = self::TAG_REMOVE;
						}
						
						// Special tags
						if ($tagname == 'COLUMN-STYLE') {
							$tdstyle = '';
							if ($el->getAttribute('padding')) {
								$tdstyle .= 'padding: ' . $el->getAttribute('padding') . ';';
							}
							if ($el->getAttribute('textalign')) {
								$tdstyle .= 'text-align: ' . $el->getAttribute('textalign') . ';';
							}
							//echo "TDSTYLE=".$tdstyle;
							if (!empty($tdstyle)) {
								$action = self::TAG_CUSTOM;
								$custom_replace = 'style="' . $tdstyle . '"';
							}
						}
						
						if ($tagname == 'INNERTEXT') {
							$action = self::TAG_CUSTOM;
							$custom_replace = $el->getInnerText();
						}
						
						switch ($action) {
							case self::TAG_COPY_VALUE:
								$replace = $attr_val;
								break;
							case self::TAG_COPY_ATTR:
								$replace = sprintf('%s="%s"', $attr, $attr_val);
								break;
							case self::TAG_CUSTOM:
								$replace = $custom_replace;
								break;
							case self::TAG_REMOVE:
							default:
								$replace = '';
								break;
						}
						
						$text = str_replace($tag, $replace, $text);
					}
	
					// Update the HTML DOM
					$result = $el->setOuterText($text);
					if (true !== $result) throw new Exception('Error updating outerText:' . print_r($result, true));
				
					// Update $nodes to continue the while() loop
					$nodes = $html->select($component['selector']);
				}
			}
			
			echo $html;
		}
		catch (Exception $e) {
			trigger_error("Unable to render email: " . $e->getMessage());
		}
	}
}

 
/*************************
Requirements
 - PHP 5.1
 - simple + fast
 - make easy to produce html emails
   - structure      | container, row, column
   - links          | link
   - paragraphs     | p.formatted
   - buttons        | button
   - spacers        | spacer
   - preheader      | preheader
   - inspired by inky but has to run on ooold servers (https://github.com/zurb/inky)
 - have default tag code, but allow custom configurations
 
TODO
 
 Xauto-add doctype and html xmlns attr
  create responsive config
 *rows and containers should inherit parent width if not specified
 *add row padding option
 *spacer
  button
 *preheader
  row.text-center | left | right (or should this be p?)
  valign?

 *gapixel
 *fix warning about undefined index

  other email best practices
    all image src HTTPS
	links open in new window
	line length shorter than maxlen

REFERENCES

 https://templates.mailchimp.com/getting-started/html-email-basics/
 https://www.emailonacid.com/blog/article/email-development/email-development-best-practices-2/
 
****/
