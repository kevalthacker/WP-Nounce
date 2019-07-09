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
/**
 * The abstract class for the nonces functionality.
 */
abstract class WPNonceAbstract implements WPNonceInterface
{
    /**
     * Action string.
     *
     * @var    string $action The nonce action value.
     */
    private $action;
    /**
     * Name of the nonce.
     *
     * @var    string $name The nonce request name.
     */
    private $name;
    /**
     * Name of the nonce.
     *
     * @var    string $name The nonce request name.
     */
    private $life;
    /**
     * Nonce value.
     *
     * @var    string $nonce The nonce value.
     */
    private $nonce;
    /**
     * WPNonceAbstract constructor.
     *
     * @param $param_action
     * @param string $param_name
     * @param integer $param_life
     */
    public function __construct(string $paramAction, string $paramName, int $paramLife)
    {
        $this->assignAction($paramAction);
        $this->assignName($paramName);
        $this->assignLife($paramLife);
    }
    /**
     * Fetch action property.
     *
     * @return string $action
     */
    public function fetchAction() : string
    {
        return $this->action;
    }
    /**
     * Assign action property.
     *
     * @param string $param_action
     * @return string $action
     */
    public function assignAction(string $paramAction) : string
    {
        $this->action = $paramAction;
        return $this->fetchAction();
    }
    /**
     * Fetch request name property.
     *
     * @return string $name
     */
    public function fetchName() : string
    {
        return $this->name;
    }
    /**
     * Assign request name property.
     *
     * @param string $param_name
     * @return string $name
     */
    public function assignName(string $paramName) : string
    {
        $this->name = $paramName;
        return $this->fetchName();
    }
    /**
     * Fetch request life property.
     *
     * @return integer $life
     */
    public function fetchLife() : int
    {
        return (int)$this->life;
    }
    /**
     * Assign request name property.
     *
     * @param integer $param_life
     * @return integer $life
     */
    public function assignLife(int $paramLife) : int
    {
        $this->life = is_numeric($paramLife) ? (int)$paramLife : $paramLife;
        return $this->fetchLife();
    }
    /**
     * Fetch nonce property.
     *
     * @return string $nonce.
     */
    public function fetchNonce() : string
    {
        return $this->nonce;
    }
    /**
     * Assign nonce property.
     *
     * @param string $param_nonce
     * @return string $nonce
     */
    public function assignNonce(string $paramNonce) : string
    {
        $this->nonce = $paramNonce;
        return $this->fetchNonce();
    }
}
