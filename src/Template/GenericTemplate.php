<?php
/**
 * GenericTemplate
 *
 * @package   brightnucleus/chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\Template;

use RuntimeException;

/**
 * Class GenericTemplate
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail\Template
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class GenericTemplate extends AbstractTemplate
{

    /**
     * Set the name of the View to use for rendering.
     *
     * @since 1.0.0
     *
     * @param string $template Optional. Name of the template.
     * @throws RuntimeException
     */
    protected function setViewName($template = null)
    {
        if ( ! $template) {
            throw new RuntimeException('Initialised GenericSection without passing it a template name.');
        }
        $this->viewName = $template;
    }

    /**
     * Get an array of Sections that are used by this template.
     *
     * @since 1.0.0
     *
     * @return array Sections that are used by this template.
     */
    public function getUsedSections()
    {
        return $this->config['used_sections'][$this->getViewName()];
    }
}