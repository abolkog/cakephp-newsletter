<?php
namespace newsletter\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use newsletter\Model\Table\TemplatesTable;

/**
 * newsletter\Model\Table\TemplatesTable Test Case
 */
class TemplatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \newsletter\Model\Table\TemplatesTable
     */
    public $Templates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.newsletter.templates',
        'plugin.newsletter.campaigns',
        'plugin.newsletter.groups',
        'plugin.newsletter.subscriptions',
        'plugin.newsletter.subscribers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Templates') ? [] : ['className' => TemplatesTable::class];
        $this->Templates = TableRegistry::get('Templates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Templates);

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
}
