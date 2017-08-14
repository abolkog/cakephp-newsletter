<?php
namespace Newsletter\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Campaigns Model
 *
 * @property \NewsLetter\Model\Table\GroupsTable|\Cake\ORM\Association\BelongsTo $Groups
 * @property \NewsLetter\Model\Table\TemplatesTable|\Cake\ORM\Association\BelongsTo $Templates
 *
 * @method \newsletter\Model\Entity\Campaign get($primaryKey, $options = [])
 * @method \newsletter\Model\Entity\Campaign newEntity($data = null, array $options = [])
 * @method \newsletter\Model\Entity\Campaign[] newEntities(array $data, array $options = [])
 * @method \newsletter\Model\Entity\Campaign|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \newsletter\Model\Entity\Campaign patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \newsletter\Model\Entity\Campaign[] patchEntities($entities, array $data, array $options = [])
 * @method \newsletter\Model\Entity\Campaign findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CampaignsTable extends Table
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

        $this->setTable('campaigns');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER',
            'className' => 'Newsletter.Groups'
        ]);
        $this->belongsTo('Templates', [
            'foreignKey' => 'template_id',
            'className' => 'Newsletter.Templates'
        ]);

        $this->hasMany('Messages', ['dependent'=>true]);
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
            ->requirePresence('subject', 'create')
            ->notEmpty('subject');

        $validator
            ->allowEmpty('sender');

        $validator
            ->requirePresence('contents', 'create')
            ->notEmpty('contents');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->dateTime('completed')
            ->allowEmpty('completed');

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
        $rules->add($rules->existsIn(['template_id'], 'Templates'));

        return $rules;
    }

    /**
     * Mark Campaign as completed
     * @param $id
     */
    public function completed($id) {
        $this->updateAll(['status'=>3, 'completed'=> date('Y-m-d H:i:s') ], ['id'=>$id]);
    }
}
