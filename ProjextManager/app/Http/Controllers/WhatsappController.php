<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class WhatsappController extends Controller
{
    public function index()
    {
        return view('whatsapp');
    }

    public function store(Request $request)
    {
        $twilioSid = env('TWILIO_SID');
        $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
        $twilioWhatsappNumber = 'whatsapp:' . env('TWILIO_WHATSAPP_NUMBER');
        $phoneNumbers = $request->phoneNumbers;
        $message = $request->message;
        $buttonUrl = $request->buttonUrl;
        $buttonText = 'Confirm Task Completion';

        $client = new Client($twilioSid, $twilioAuthToken);

        foreach ($phoneNumbers as $phoneNumber) {
            $to = 'whatsapp:' . $phoneNumber;
            try {
                $message = $client->messages->create(
                    $to,
                    contentSid: "HXXXXXXXXX",
                    contentVariables: JSON.stringify(),
                );
                return "Message sent successfully! SID: " . $message->sid;
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        }
        return redirect()->back()->with('success', 'Messages sent successfully');
    }
}
