<?php declare(strict_types=1);
/*
 * This file is part of the WPNonce package.
 *
 * (c) Keval Thacker
 *
 */

namespace Wordpress\Nonces;

/**
 *
 * @author  Keval thacker <kevalthacker@gmail.com>
 * @package Wordpress\Nonces
 */
final class WPNonce extends WPNonceAbstract
{
    /**
     * WPNonce constructor.
     *
     * @param $param_action
     * @param string $param_name
     * @param integer $param_life
     */
    public function __construct(string $paramAction, string $paramName = '_wpnonce', int $paramLife = 86400)
    {
        parent::__construct($paramAction, $paramName, $paramLife);
    }

    /**
     * Generate nonce string
     *
     * @param string $param_type
     * @param string $param_url
     * @return string
     */
    public function wpnonceGenerate(string $paramType = '_DEFAULT', string $paramUrl = ''): string
    {
        add_filter('nonce_life', $this->fetchLife());
        $this->assignNonce(wp_create_nonce($this->fetchAction()));
        remove_filter('nonce_life', $this->fetchLife());
        if ($paramType === '_DEFAULT') {
            return $this->fetchNonce();
        } elseif ($paramType === '_URL') {
            return $this->wpnonceGenerateUrl($paramUrl);
        } elseif ($paramType === '_FORM') {
            return $this->wpnonceGenerateField();
        }
    }

    /**
     * Generate url with nonce value parameter
     *
     * @param string $paramActionurl
     * @return mixed
     */
    public function wpnonceGenerateUrl(string $paramActionurl): string
    {
        $name = $this->fetchName();
        $action = $this->fetchAction();
        $actionurl = str_replace('&amp;', '&', $paramActionurl);
        return wp_nonce_url($actionurl, $action, $name);
    }

    /**
     * Generate the nonce field html tags
     *
     * @param bool $param_referer
     * @param bool $param_echo
     * @return string
     */
    public function wpnonceGenerateField(bool $paramReferer = true, bool $paramEcho = true): string
    {
        $name = $this->fetchName();
        $action = $this->fetchAction();
        $nonce = $this->fetchNonce();
        $name = esc_attr($name);
        return wp_nonce_field($action, $name, $paramReferer, $paramEcho);
    }

    /**
     * Validate the nonce.
     *
     * @return    boolean $is_valid False if the nonce is invalid. Otherwise, returns true.
     */
    private function wpnonceValidation(): bool
    {
        $isValid = wp_verify_nonce($this->fetchNonce(), $this->fetchAction());
        if (false === $isValid) {
            return $isValid;
        }
        return true;
    }

    /**
     * Validate nonce
     *
     * @param $paramNonce
     * @return bool
     */
    public function wpnonceValidate(string $paramNonce): boolean
    {
        $isValid = false;
        $this->assignNonce($paramNonce);
        $isValid = $this->wpnonceValidation();
        return $isValid;
    }
}
