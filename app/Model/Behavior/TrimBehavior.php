<?php

/**
 * Behavior to trim all string fields in a model
 *
 * @author noud
 *
 */
class TrimBehavior extends ModelBehavior {

/**
 *
 * @param Model $Model
 * @param unknown_type $settings
 */
	public function setup(Model $Model, $settings = array()) {
		if (!isset($this->settings[$Model->alias])) {
			$this->settings[$Model->alias] = array(
				'fields' => 'all',
			);
		}
		$this->settings[$Model->alias] = array_merge(
			$this->settings[$Model->alias], (array)$settings);
	}

/**
 *
 * @param $options
 */
	public function beforeValidate(Model $Model, $options = array()) {
		//parent::beforeValidate();

		// process some..
		$this->trimStringFields($Model);

		return true;
	}

/**
 * Trim String Fields
 *
 * @param Model $Model
 * @param unknown_type $array
 */
	public function trimStringFields(Model $Model) {
		foreach ($Model->data[$Model->name] as &$field) {
			if (is_string($field)) {
				$field = trim($field);
			}
		}
		return true;
	}
}
