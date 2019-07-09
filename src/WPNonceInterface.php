<?php declare(strict_types=1);
/*
 * This file is part of the WP-Nonce package.
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
interface WPNonceInterface
{
  /**
     * Fetch signature for action property.
     **
     * @return string $action Action value.
     */
    public function fetchAction();
    /**
     * Assign signature for action property.
     *
     * @param string $param_action Action value.
     * @return string $action      Action value set.
     */
    public function assignAction(string $paramAction);
    /**
     * Fetch signature for name property.
     *
     * @return string $name The nonce name value.
     */
    public function fetchName();
    /**
     * Assign signature for name property.
     *
     * @param string $param_name Name for the nonce value to set.
     * @return string $name      The nonce name value set.
     */
    public function assignName(string $paramName);
    /**
     * Fetch signature for life property.
     *
     * @return integer $life The nonce life value.
     */
    public function fetchLife();
    /**
     * Assign signature for life property.
     *
     * @param integer $param_life life for the nonce value to set.
     * @return integer $life      The nonce life value set.
     */
    public function assignLife(int $paramLife);
    /**
     * Fetch signature for nonce property.
     *
     * @return string $nonce Nonce value.
     */
    public function fetchNonce();
    /**
     * Assign signature for nonce property.
     *
     * @param string $param_nonce Nonce value to set.
     * @return string $nonce      Nonce value set.
     */
    public function assignNonce(string $paramNonce);
}
