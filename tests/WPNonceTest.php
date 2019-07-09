<?php declare(strict_types=1);
/*
 * This file is part of the WP-Nonce package.
 *
 * (c) Keval Thacker
 *
 */

namespace Wordpress\Nonces;

use Wordpress\Nonces\WPNonce;
use PHPUnit\Framework\TestCase;


/**
 *
 * @author  Keval thacker <kevalthacker@gmail.com>
 * @package Wordpress\Nonces
 */
class WPNounceTest extends TestCase
{
    /**
     * Action string.
     *
     * @var    string $action The nonce action value.
     */
    private $testAction;
    /**
     * Name of the nonce.
     *
     * @var    string $name The nonce request name.
     */
    private $testName;
    /**
     * Name of the nonce.
     *
     * @var    string $name The nonce request name.
     */
    private $testLife;
    /**
     * Nonce value.
     *
     * @var    string $nonce The nonce value.
     */
    private $testWPNonce;
    /**
     * NonceAbstract constructor.
     *
     * @param $param_action
     * @param string $param_name
     */
	 
	 protected function setUp()
     {
        $this->testAction = 'my_action';
        $this->testName = 'my_name';
        $this->testLife = 36400;
        $this->testWPNonce_1 = new WPNonce($this->testAction);
        $this->testWPNonce_2 = new WPNonce($this->testAction, $this->testName, $this->testLife);
        // Building nonce value.
        $this->testNonce = new WPNonce($this->testAction);
    }

    /**
     * Test the object instance.
     */
    public function testInstance()
    {
        $this->assertInstanceOf( WPNonce::class, $this->testWPNonce_1 );
        $this->assertInstanceOf( WPNonce::class, $this->testWPNonce_2 );
    }

    /**
     * Test the fetch and assign for the action property.
     */
    public function testFetchAssignAction()
    {
        $testWPNonce_val = $this->testWPNonce_2;
        // Check the fetch.
        $this->assertSame($this->testAction, $testWPNonce_val->fetchAction());
        // Check the assign.
        $action = $testWPNonce_val->assignAction('new_action');
        $this->assertSame($testWPNonce_val->fetchAction(), $action);
    }

    /**
     * Test the fetch and assign for the name property.
     */
    public function testFetchAssignName()
    {
        $testWPNonce_val = $this->testWPNonce_2;
        // Check the fetch.
        $this->assertSame($this->testName, $testWPNonce_val->fetchName());
        // Check the assign.
        $name = $testWPNonce_val->assignName('new_name');
        $this->assertSame($testWPNonce_val->fetchName(), $name);
    }

    /**
     * Test the fetch and assign for the life property.
     */
    public function testFetchAssignLife()
    {
        $testWPNonce_val = $this->testWPNonce_2;
        // Check the fetch.
        $this->assertSame($this->testLife, $testWPNonce_val->fetchLife());
        // Check the assign.
        $life = $testWPNonce_val->assignLife(5000);
        $this->assertSame($testWPNonce_val->fetchLife(), $life);
    }

    /**
     * Test the fetch and assign for the name property when default value in the constructor is used.
     */
    public function testDefaults() {
        $newAction = new WPNonce('another_action');

        // Check the action property fetch.
        $this->assertSame( 'another_action', $newAction->fetchAction() );

        // Check the name property fetch: the name value now is the default one.
        $this->assertSame( '_wpnonce', $newAction->fetchName() );

        // Check the life property fetch: the name value now is the default one.
        $this->assertSame( 86400, $newAction->fetchLife() );
    }

    /**
     * Test the wpnonceGenerate method used for the straight generation of the nonce.
     */
    public function testGenerateNonce() {
        $testWPNonce_val = $this->testWPNonce_1;
        // Generating the nonce.
        $nonce_generated = $testWPNonce_val->wpnonceGenerate();
        // Check the nonce.
        $this->assertSame($nonce_generated, $this->testNonce);
    }

    /**
     * Test the wpnonceGenerate method used for the url generation of the nonce.
     */
    public function testGenerateNonceUrl() {
        $testWPNonce_val = $this->testWPNonce_1;
        // Generating the nonce.
        $nonce_generated = $testWPNonce_val->wpnonceGenerate('_URL');
        // Check the nonce.
        $this->assertSame($nonce_generated, $this->testNonce);
    }

    /**
     * Test the wpnonceGenerate method used for the form generation of the nonce.
     */
    public function testGenerateNonceForm() {
        $testWPNonce_val = $this->testWPNonce_1;
        // Generating the nonce.
        $nonce_generated = $testWPNonce_val->wpnonceGenerate('_FORM');
        // Check the nonce.
        $this->assertSame($nonce_generated, $this->testNonce);
    }

    /**
     * Test the wpnonceValidate method used for the straight validation of the nonce.
     */
    public function testNonceValidate() {
        $testWPNonce_val = $this->testWPNonce_1;
        // Generating the nonce.
        $nonce_generated = $testWPNonce_val->wpnonceGenerate();
        // Check validating method.
        $isValid = $this->testWPNonce_1->wpnonceValidate($nonce_generated);
        $this->assertTrue($isValid);
        // Injecting wrong value in the nonce.
        $isValid = $this->testWPNonce_1->wpnonceValidate($nonce_generated.'failure');
        // Check failure on validating.
        $this->assertFalse($isValid);
    }
}