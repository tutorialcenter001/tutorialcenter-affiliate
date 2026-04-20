<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your TC Affiliate Account</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f2f2f2; font-family: Arial, Helvetica, sans-serif; color: #333333;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f2f2f2; margin: 0; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width: 600px; background-color: #ffffff; border-radius: 10px; overflow: hidden;">
                    
                    <tr>
                        <td style="background-color: #0b3a67; padding: 30px 20px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; line-height: 1.3;">
                                Welcome to TC Affiliates
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px 25px;">
                            <h2 style="margin: 0 0 16px; color: #0b3a67; font-size: 22px;">
                                Hello {{ $user->firstname }},
                            </h2>

                            <p style="margin: 0 0 16px; font-size: 15px; line-height: 1.7; color: #333333;">
                                Thank you for registering with TC Affiliates. We’re excited to have you join the platform.
                            </p>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f9f9f9; border-left: 4px solid #0b3a67; margin: 20px 0;">
                                <tr>
                                    <td style="padding: 16px;">
                                        <p style="margin: 0 0 8px; font-size: 14px; color: #333333;">
                                            <strong>Account Details</strong>
                                        </p>
                                        <p style="margin: 0 0 6px; font-size: 14px; color: #333333;">
                                            <strong>Name:</strong> {{ $user->firstname }} {{ $user->surname }}
                                        </p>
                                        <p style="margin: 0 0 6px; font-size: 14px; color: #333333;">
                                            <strong>Email:</strong> {{ $user->email }}
                                        </p>
                                        <p style="margin: 0; font-size: 14px; color: #333333;">
                                            <strong>Referral Code:</strong> {{ $user->referral_code }}
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 0 0 20px; font-size: 15px; line-height: 1.7; color: #333333;">
                                To complete your registration and activate your affiliate account, please verify your email address by clicking the button below.
                            </p>

                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: 25px auto;">
                                <tr>
                                    <td align="center" bgcolor="#ed1c24" style="border-radius: 6px;">
                                        <a href="{{ $verificationUrl }}"
                                           style="display: inline-block; padding: 14px 28px; font-size: 15px; font-weight: bold; color: #ffffff; text-decoration: none; border-radius: 6px;">
                                            Verify Email Address
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 0 0 10px; font-size: 13px; line-height: 1.7; color: #666666;">
                                If the button above does not work, copy and paste this link into your browser:
                            </p>

                            <p style="margin: 0 0 20px; font-size: 13px; line-height: 1.7; word-break: break-all; color: #666666; background-color: #f5f5f5; padding: 10px; border-radius: 6px;">
                                {{ $verificationUrl }}
                            </p>

                            <p style="margin: 0 0 16px; font-size: 15px; line-height: 1.7; color: #333333;">
                                This verification link will expire in 24 hours.
                            </p>

                            <p style="margin: 0 0 10px; font-size: 15px; line-height: 1.7; color: #333333;">
                                Once your email is verified, you’ll be able to:
                            </p>

                            <ul style="margin: 0 0 20px 20px; padding: 0; color: #333333; font-size: 15px; line-height: 1.8;">
                                <li>Access your affiliate dashboard</li>
                                <li>Track your account growth</li>
                                <li>Monitor your referral activity</li>
                                <li>Manage your withdrawals</li>
                            </ul>

                            <p style="margin: 0 0 16px; font-size: 15px; line-height: 1.7; color: #333333;">
                                If you did not create this account, please ignore this email.
                            </p>

                            <p style="margin: 0; font-size: 15px; line-height: 1.7; color: #333333;">
                                Best regards,<br>
                                <strong>The TC Affiliates Team</strong><br>
                                <span style="color: #666666;">Empowering Minds. Achieving Excellence.</span>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 20px 25px; border-top: 1px solid #eeeeee; text-align: center;">
                            <p style="margin: 0 0 6px; font-size: 12px; color: #666666;">
                                &copy; {{ now()->year }} TC Affiliates. All rights reserved.
                            </p>
                            <p style="margin: 0; font-size: 12px; color: #666666;">
                                This is an automated message. Please do not reply directly to this email.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>