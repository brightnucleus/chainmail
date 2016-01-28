<?php
/**
 * HeroTemplate HTML View
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail;

?>
<html>
<head></head>
<body>
<?php echo ChainMail::renderSection('HeaderSection', $context); ?>
<?php echo ChainMail::renderSection('HeroSection', $context); ?>
<?php echo ChainMail::renderSection('BodySection', $context); ?>
<?php echo ChainMail::renderSection('FooterSection', $context); ?>
</body>
</html>
