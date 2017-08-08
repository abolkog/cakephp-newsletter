<?php
namespace newsletter\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use newsletter\Model\Table\SubscribersTable;

/**
 * newsletter\Model\Table\SubscribersTable Test Case
 */
class SubscribersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \newsletter\Model\Table\SubscribersTable
     */
    public $Subscribers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.newsletter.subscribers',
        'plugin.newsletter.subscriptions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Subscribers') ? [] : ['className' => SubscribersTable::class];
        $this->Subscribers = TableRegistry::get('Subscribers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Subscribers);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
