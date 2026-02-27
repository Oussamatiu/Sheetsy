<?php

namespace App\Http\Controllers;

use App\Mail\invitation as MailInvitation;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function sendInvitation(Request $request, $colocationId)
{
    $invitation = Invitation::create([
        'colocation_id' => $colocationId,
        'email' => $request->email,
        'token' => Str::uuid(), 
        'status' => 'pending',
    ]);

  
    Mail::to($invitation->email)->send(new MailInvitation($invitation));

    return back()->with('success', 'Invitation sent successfully!');
}
    
    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)->firstOrFail();

        if ($invitation->expires_at && now()->greaterThan($invitation->expires_at)) {
            return redirect()->route('home')->with('error', 'This invitation has expired.');
        }

        $invitation->update(['status' => 'accepted']);

        $colocation = $invitation->colocation;
        $colocation->users()->attach(auth()->id(), ['joined_at' => now()]);

        return redirect()->route('colocations.show', $invitation->colocation_id)->with('success', 'You have joined the colocation!');
    }

    public function destroy(Invitation $invitation)
    {
            if ($invitation->colocation->owner_id !== auth()->id()) {
                return back()->with('error', 'You are not authorized to delete this invitation!');
            }

        $invitation->delete();

        return back()->with('success', 'Invitation deleted successfully!');
    }
}
