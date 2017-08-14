<?php
namespace Newsletter\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Messages Model
 *
  @property \NewsLetter\Model\Table\CampaignsTable|\Cake\ORM\Association\BelongsTo $Campaigns
 *
 * @method \newsletter\Model\Entity\Message get($primaryKey, $options = [])
 * @method \newsletter\Model\Entity\Message newEntity($data = null, array $options = [])
 * @method \newsletter\Model\Entity\Message[] newEntities(array $data, array $options = [])
 * @method \newsletter\Model\Entity\Message|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \newsletter\Model\Entity\Message patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \newsletter\Model\Entity\Message[] patchEntities($entities, array $data, array $options = [])
 * @method \newsletter\Model\Entity\Message findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MessagesTable extends Table
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

        $this->setTable('messages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Campaigns', [
            'foreignKey' => 'campaign_id',
            'className' => 'NewsLetter.Campaigns'
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
            ->requirePresence('sender', 'create')
            ->notEmpty('sender');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('subject', 'create')
            ->notEmpty('subject');

        $validator
            ->requirePresence('contents', 'create')
            ->notEmpty('contents');

        $validator
            ->integer('attempts')
            ->requirePresence('attempts', 'create')
            ->notEmpty('attempts');

        $validator
            ->boolean('sent')
            ->requirePresence('sent', 'create')
            ->notEmpty('sent');

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

    /**
     * Mark the queue item as sent
     * @param $id Queue Item Id (Mysql)
     */
    public function success($id) {
        $this->updateAll(['sent'=>true], ['id'=>$id]);
    }

    public function fail($id, $attempts) {
        $attempts++;
        $this->updateAll(['sent'=>false, 'attempts'=>$attempts], ['id'=>$id]);
    }
}
