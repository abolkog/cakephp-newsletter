<?php
namespace newsletter\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use newsletter\Model\Table\NewsletterPhinxlogTable;

/**
 * newsletter\Model\Table\NewsletterPhinxlogTable Test Case
 */
class NewsletterPhinxlogTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \newsletter\Model\Table\NewsletterPhinxlogTable
     */
    public $NewsletterPhinxlog;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.newsletter.newsletter_phinxlog'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('NewsletterPhinxlog') ? [] : ['className' => NewsletterPhinxlogTable::class];
        $this->NewsletterPhinxlog = TableRegistry::get('NewsletterPhinxlog', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NewsletterPhinxlog);

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
