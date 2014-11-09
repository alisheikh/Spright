<?php
App::uses('CakeEventListener', 'Event');

class TaskListener implements CakeEventListener {

	public function implementedEvents() {
		return array(
			'Model.Task.scheduled' => 'sendActivationEmail',
		);
	}

	public function sendActivationEmail(CakeEvent $event) {
		$this->Task = ClassRegistry::init('Task');

		$this->Task->id = $event->data['id'];

		$this->Task->save();

		$email = new CakeEmail();
		$email->from(array(
			'noreply@spright.com.au' => 'Spright.',
		));
		$email->to($event->data['user']['email']);
		$email->subject('# has been scheduled to you');
		$email->template('taskSchedule');
		$email->viewVars(array(
			'data' => $event->data['user'],
			'activationKey' => $activationKey,
		));
		$email->emailFormat('text');
		$email->send();
	}

}