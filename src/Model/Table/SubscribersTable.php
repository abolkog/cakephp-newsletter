<?php
namespace newsletter\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subscribers Model
 *
 * @property \newsletter\Model\Table\SubscriptionsTable|\Cake\ORM\Association\HasMany $Subscriptions
 *
 * @method \newsletter\Model\Entity\Subscriber get($primaryKey, $options = [])
 * @method \newsletter\Model\Entity\Subscriber newEntity($data = null, array $options = [])
 * @method \newsletter\Model\Entity\Subscriber[] newEntities(array $data, array $options = [])
 * @method \newsletter\Model\Entity\Subscriber|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \newsletter\Model\Entity\Subscriber patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \newsletter\Model\Entity\Subscriber[] patchEntities($entities, array $data, array $options = [])
 * @method \newsletter\Model\Entity\Subscriber findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SubscribersTable extends Table
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

        $this->setTable('subscribers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Subscriptions', [
            'foreignKey' => 'subscriber_id',
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

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
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
