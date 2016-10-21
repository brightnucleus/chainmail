<?php
/**
 * GenericSection HTML View.
 *
 * @package   BrightNucleus/Chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail;

if ( ! isset($this->content)) {
    return;
}
?>
<div class="<?= $this->css_class ?>"><?= $this->content ?></div>
