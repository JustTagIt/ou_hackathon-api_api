<?php

use Swagger\Swagger;
use Swagger\Annotations as SWG;

/**
 * @SWG\Resource(
 *   apiVersion="1.0.0",
 *   swaggerVersion="1.2",
 *   resourcePath="alert",
 *   description="Alerts",
 *   produces="['application/json']"
 * )
 */

class AlertController extends \BaseController {

	/**
	 * Send a Message
	 *    
	 * @SWG\Api(
	 *   path="alert/send",
	 *   @SWG\Operation(
	 *     method="POST",
	 *     summary="Send SMS/E-Mail Alerts",
	 *     notes="This method will allow SMS or E-Mail alerts to be sent to a specified address",
	 *     nickname="SendAlert",
	 *     @SWG\Parameters(
	 * 	 	  @SWG\Parameter(
	 *         name="full_name",
	 *         description="Full name for sending email",
	 *         required=false,
	 *         type="string",
	 *         paramType="form"
	 *       ),
	 * 	 	 @SWG\Parameter(
	 *         name="email",
	 *         description="Email Address to send an alert to",
	 *         required=false,
	 *         type="string",
	 *         paramType="form",
	 *     	 ),
	 * 	     @SWG\Parameter(
	 *         name="phone_number",
	 *         description="Phone Number to send SMS to. +1 must prefix the phone number",
	 *         required=false,
	 *         type="string",
	 *         paramType="form"
	 *       )
	 *     ),
	 *     @SWG\ResponseMessage(code=200, message="Messages sent.")
	 *   )
	 * )
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
			'body' => 'Your child has left your proximity'
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
			Twilio::message($phone_number, 'ALERT: Find Yo Baby. It ran away!');

		}

		// Save the alert to the database so we know it was sent.
		$alert = new Alert;

		$alert->email = $email;
		$alert->phone_number = $phone_number;
		$alert->full_name = $full_name;
		$alert->save();


		return Response::json(array(
			'response' => 'Message Sent',
			'email_sent' => $email,
			'sms_sent' => $phone_number
			),200);
	}

}
