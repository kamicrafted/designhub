<?php
namespace Craft;

class Comments_StatusElementAction extends BaseElementAction
{
	public function getTriggerHtml()
	{
		return craft()->templates->render('comments/_elementactions/status');
	}

	public function performAction(ElementCriteriaModel $criteria)
	{
		$status = $this->getParams()->status;

		// Figure out which element IDs we need to update
		$elementIds = $criteria->ids();

		// Update their statuses
		craft()->db->createCommand()->update(
			'comments',
			array('status' => $status),
			array('in', 'id', $elementIds)
		);

		// Clear their template caches
		craft()->templateCache->deleteCachesByElementId($elementIds);

		// Fire an 'onSetStatus' event
		$this->onSetStatus(new Event($this, array(
			'criteria'   => $criteria,
			'elementIds' => $elementIds,
			'status'     => $status,
		)));

		$this->setMessage(Craft::t('Statuses updated.'));

		return true;
	}

	public function onSetStatus(Event $event)
	{
		$this->raiseEvent('onSetStatus', $event);
	}

	protected function defineParams()
	{
		return array(
			'status' => array(AttributeType::Enum, 'values' => array(
			    Comments_CommentModel::APPROVED,
			    Comments_CommentModel::PENDING,
			    Comments_CommentModel::SPAM,
			    Comments_CommentModel::TRASHED,
			), 'required' => true)
		);
	}
}
