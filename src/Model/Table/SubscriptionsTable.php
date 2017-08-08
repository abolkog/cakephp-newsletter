<?php
namespace newsletter\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subscriptions Model
 *
 * @property \newsletter\Model\Table\GroupsTable|\Cake\ORM\Association\BelongsTo $Groups
 * @property \newsletter\Model\Table\SubscribersTable|\Cake\ORM\Association\BelongsTo $Subscribers
 *
 * @method \newsletter\Model\Entity\Subscription get($primaryKey, $options = [])
 * @method \newsletter\Model\Entity\Subscription newEntity($data = null, array $options = [])
 * @method \newsletter\Model\Entity\Subscription[] newEntities(array $data, array $options = [])
 * @method \newsletter\Model\Entity\Subscription|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \newsletter\Model\Entity\Subscription patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \newsletter\Model\Entity\Subscription[] patchEntities($entities, array $data, array $options = [])
 * @method \newsletter\Model\Entity\Subscription findOrCreate($search, callable $callback = null, $options = [])
 */
class SubscriptionsTable extends Table
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

        $this->setTable('subscriptions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER',
            'className' => 'Newsletter.Groups'
        ]);
        $this->belongsTo('Subscribers', [
            'foreignKey' => 'subscriber_id',
            'joinType' => 'INNER',
            'className' => 'Newsletter.Subscribers'
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

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['group_id'], 'Groups'));
        $rules->add($rules->existsIn(['subscriber_id'], 'Subscribers'));

        return $rules;
    }
}
