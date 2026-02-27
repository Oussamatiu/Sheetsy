<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invitation</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, Helvetica, sans-serif; background-color:#f4f4f4;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" 
                       style="background:#ffffff; padding:40px; border-radius:8px;">

                    <tr>
                        <td align="center">
                            <h2 style="margin:0; color:#222;">
                                Invitation to join {{ $colocationName }}
                            </h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-top:20px; color:#555; font-size:15px; line-height:1.6;">
                            <p>
                                Hello,
                            </p>

                            <p>
                                <strong>{{ $inviterName }}</strong> has invited you to join the 
                                colocation <strong>{{ $colocationName }}</strong>.
                            </p>

                            <p>
                                Click the button below to accept the invitation:
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding:30px 0;">
                            <a href="{{ route('invitations.accept', $token) }}"
                               style="background:#111; 
                                      color:#fff; 
                                      padding:12px 25px; 
                                      text-decoration:none; 
                                      border-radius:6px; 
                                      display:inline-block;
                                      font-size:14px;">
                                Accept Invitation
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td style="color:#888; font-size:13px; line-height:1.5;">
                            <p>
                                If you did not expect this invitation, you can safely ignore this email.
                            </p>

                            <p>
                                This invitation link may expire for security reasons.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding-top:20px; font-size:12px; color:#aaa;">
                            © {{ date('Y') }} EasyColoc. All rights reserved.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>