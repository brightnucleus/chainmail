<?php
/**
 * BrightNucleus Chainmail Component.
 *
 * @package   BrightNucleus/Chainmail
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\ChainMail\View;

use BrightNucleus\ChainMail\ViewInterface;
use BrightNucleus\Config\ConfigInterface;

/**
 * Abstract Class AbstractView.
 *
 * @since   1.0.0
 *
 * @package BrightNucleus\ChainMail\Support
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class AbstractView implements ViewInterface
{

    /**
     * Configuration Settings.
     *
     * @since 1.0.0
     *
     * @var ConfigInterface
     */
    protected $config;

    /**
     * Location of the view data.
     *
     * @since 1.0.0
     *
     * @var   1.0.0
     */
    protected $viewLocation;

    /**
     * Instantiate a View object.
     *
     * @since 1.0.0
     *
     * @param ConfigInterface $config       Configuration settings.
     * @param string          $viewLocation Location of the View to render.
     */
    public function __construct($config, $viewLocation)
    {
        $this->config       = $config;
        $this->viewLocation = $viewLocation;
    }
}
