<?php
/**
 * GenericSection HTML View
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail;

if ( ! $content) {
    return;
}
?>
<div class="<?php echo $context['css_class']; ?>"><?php echo $content; ?></div>