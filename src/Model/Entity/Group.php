<?php
namespace Newsletter\Model\Entity;

use Cake\ORM\Entity;

/**
 * Group Entity
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property \Cake\I18n\Time $created
 *
 * @property \newsletter\Model\Entity\Campaign[] $campaigns
 * @property \newsletter\Model\Entity\Subscription[] $subscriptions
 */
class Group extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
