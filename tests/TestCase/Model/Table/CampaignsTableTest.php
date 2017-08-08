<?php
namespace newsletter\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use newsletter\Model\Table\CampaignsTable;

/**
 * newsletter\Model\Table\CampaignsTable Test Case
 */
class CampaignsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \newsletter\Model\Table\CampaignsTable
     */
    public $Campaigns;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.newsletter.campaigns',
        'plugin.newsletter.groups',
        'plugin.newsletter.templates'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Campaigns') ? [] : ['className' => CampaignsTable::class];
        $this->Campaigns = TableRegistry::get('Campaigns', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Campaigns);

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
