<?php
    /**
     * Class QQN
     * Factory methods for generating database nodes at the top of a node chain.
     */
	class QQN {
		/**
		 * @return NodeCompany
		 */
		static public function company() {
			return new NodeCompany('company', null, null);
		}
		/**
		 * @return NodeDevice
		 */
		static public function device() {
			return new NodeDevice('device', null, null);
		}
		/**
		 * @return NodeDeviceTourist
		 */
		static public function deviceTourist() {
			return new NodeDeviceTourist('device_tourist', null, null);
		}
		/**
		 * @return NodeEvent
		 */
		static public function event() {
			return new NodeEvent('event', null, null);
		}
		/**
		 * @return NodeLog
		 */
		static public function log() {
			return new NodeLog('log', null, null);
		}
		/**
		 * @return NodePosition
		 */
		static public function position() {
			return new NodePosition('position', null, null);
		}
		/**
		 * @return NodeTourist
		 */
		static public function tourist() {
			return new NodeTourist('tourist', null, null);
		}
		/**
		 * @return NodeTrack
		 */
		static public function track() {
			return new NodeTrack('track', null, null);
		}
		/**
		 * @return NodeTrackPoint
		 */
		static public function trackPoint() {
			return new NodeTrackPoint('track_point', null, null);
		}
		/**
		 * @return NodeUser
		 */
		static public function user() {
			return new NodeUser('user', null, null);
		}
	}