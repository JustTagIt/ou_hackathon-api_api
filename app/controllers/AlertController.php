<?php

class AlertController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function sendAlert()
	{
		@$email = $_POST['email'];
		@$full_name = $_POST['full_name'];
		@$phone_number = $_POST['phone_number'];

		$data = array(
			'full_name' => $full_name,
			'body' => 'Your kid is lost you fuck'
		);

		$email_detail = array(
			'full_name' => $full_name,
			'email' => $email
		);

		// If There is an email or phone number we need to send
		// an alert to whatever device we recieve.
		if($email) {

			// EMAIL FOR EVERYONE!!!
			Mail::queue('emails.alert', $data, function($message) use ($email_detail)
			{
			    $message->to($email_detail['email'], $email_detail['full_name'])->subject('ALERT: Find Yo Baby');
			});

		}

		if($phone_number) {

			// Send that sweet SMS
			Twilio::message($phone_number, 'ALERT: Find Yo Baby. You are a terrible parent.');

		}

		// Save the alert to the database so we know it was sent.
		$alert = new Alert;

		$alert->email = $email;
		$alert->phone_number = $phone_number;
		$alert->save();


		return Response::json(array(
			'email_sent' => $email,
			'sms_sent' => $phone_number
			),200);
	}

}
