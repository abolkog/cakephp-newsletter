<?php
namespace Newsletter\Model\Entity;

use Cake\ORM\Entity;

/**
 * Campaign Entity
 *
 * @property int $id
 * @property string $subject
 * @property string $sender
 * @property string $contents
 * @property int $group_id
 * @property int $template_id
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $completed
 *
 * @property \newsletter\Model\Entity\Group $group
 * @property \newsletter\Model\Entity\Template $template
 */
class Campaign extends Entity
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
