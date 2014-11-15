<?php

namespace SweetCaptcha;

/**
 * Interface SweetCaptchaInterface
 *
 * @package SweetCaptcha
 */
interface SweetCaptchaInterface
{
    /**
     * @return string
     */
    public function renderView();

    /**
     * @param string $sckey
     * @param string $scvalue
     * @return boolean
     */
    public function validate($sckey, $scvalue);
}
