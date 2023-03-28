<?php

if ( !class_exists('Wrt_Tuc_DebugBar_ThemePanel', false) ):

	class Wrt_Tuc_DebugBar_ThemePanel extends Wrt_Tuc_DebugBar_Panel {
		/**
		 * @var Wrt_Tuc_Theme_UpdateChecker
		 */
		protected $updateChecker;

		protected function displayConfigHeader() {
			$this->row('Theme directory', htmlentities($this->updateChecker->directoryName));
			parent::displayConfigHeader();
		}

		protected function getUpdateFields() {
			return array_merge(parent::getUpdateFields(), array('details_url'));
		}
	}

endif;
