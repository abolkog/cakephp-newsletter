<?php
namespace Newsletter\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Groups Model
 *
 * @property \newsletter\Model\Table\CampaignsTable|\Cake\ORM\Association\HasMany $Campaigns
 * @property \newsletter\Model\Table\SubscriptionsTable|\Cake\ORM\Association\HasMany $Subscriptions
 *
 * @method \newsletter\Model\Entity\Group get($primaryKey, $options = [])
 * @method \newsletter\Model\Entity\Group newEntity($data = null, array $options = [])
 * @method \newsletter\Model\Entity\Group[] newEntities(array $data, array $options = [])
 * @method \newsletter\Model\Entity\Group|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \newsletter\Model\Entity\Group patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \newsletter\Model\Entity\Group[] patchEntities($entities, array $data, array $options = [])
 * @method \newsletter\Model\Entity\Group findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GroupsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('groups');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Campaigns', [
            'foreignKey' => 'group_id',
            'className' => 'Newsletter.Campaigns'
        ]);
        $this->hasMany('Subscriptions', [
            'foreignKey' => 'group_id',
            'className' => 'Newsletter.Subscriptions'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        return $validator;
    }
}
