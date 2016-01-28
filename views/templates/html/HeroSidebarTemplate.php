<?php
/**
 * HeroSidebarTemplate HTML View
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail;

/** @var SectionInterface $header */
$header = $context['sections']['HeaderSection'];
/** @var SectionInterface $hero */
$hero = $context['sections']['HeroSection'];
/** @var SectionInterface $body */
$body = $context['sections']['BodySection'];
/** @var SectionInterface $sidebar */
$sidebar = $context['sections']['SidebarSection'];
/** @var SectionInterface $footer */
$footer = $context['sections']['FooterSection'];

?>
<html>
<head></head>
<body>
<?php echo $header->render($context); ?>
<?php echo $hero->render($context); ?>
<?php echo $body->render($context); ?>
<?php echo $sidebar->render($context); ?>
<?php echo $footer->render($context); ?>
</body>
</html>
