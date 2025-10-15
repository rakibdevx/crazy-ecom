<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MailTemplate;

class MailTemplatesSeeder extends Seeder
{
    public function run()
    {
        $templates = [
            [
                'name' => 'Welcome Email',
                'subject' => 'Welcome to {{site_name}}!',
                'body' => "Hi {{name}},\n\nWelcome to {{site_name}}! We are thrilled to have you onboard. Get started by exploring your dashboard and checking out our latest features.\n\nIf you have any questions, contact us anytime: {{support_email}}\n\nThanks,\nThe {{site_name}} Team"
            ],
            [
                'name' => 'Email Verification',
                'subject' => 'Verify Your Email Address',
                'body' => "Hi {{name}},\n\nThank you for registering at {{site_name}}! Please verify your email address by clicking the link below:\n\nVerify Email: {{verification_link}}\n\nIf you did not create an account, please ignore this email.\n\nThanks,\nThe {{site_name}} Team"
            ],
            [
                'name' => 'Two Step Verification',
                'subject' => '🔐 Your {{site_name}} Verification Code',
                'body' => "Hi {{name}},\n\nWe’ve received a request to verify your identity for your {{site_name}} account.\n\nPlease use the verification code below to complete your two-step verification:\n\nYour Code: {{verification_code}}\n\nThis code will expire in {{time}} minutes for your security. If you didn’t request this verification, you can safely ignore this message.\n\nStay secure,\nThe {{site_name}} Team"
            ],

            [
                'name' => 'Password Reset',
                'subject' => 'Reset Your Password',
                'body' => "Hi {{name}},\n\nYou have requested to reset your password for {{site_name}}. Click the link below to reset your password:\n\nReset Password: {{reset_link}}\n\nIf you did not request this, please ignore this email.\n\nThanks,\nThe {{site_name}} Team"
            ],
            [
                'name' => 'Password Changed',
                'subject' => 'Your Password Has Been Changed',
                'body' => "Hi {{name}},\n\nThis is a confirmation that your password for {{site_name}} has been successfully changed.\n\nIf you did not make this change, please contact our support immediately: {{support_email}}\n\nThanks,\nThe {{site_name}} Team"
            ],
            [
                'name' => 'Order Confirmation',
                'subject' => 'Your Order {{order_id}} is Confirmed',
                'body' => "Hi {{name}},\n\nThank you for your order #{{order_id}} at {{site_name}}. Your order has been successfully received and is being processed.\n\nOrder Details: {{order_details_link}}\n\nThanks for shopping with us,\nThe {{site_name}} Team"
            ],
            [
                'name' => 'Shipping Notification',
                'subject' => 'Your Order #{{order_id}} Has Shipped',
                'body' => "Hi {{name}},\n\nGood news! Your order #{{order_id}} from {{site_name}} has been shipped.\n\nYou can track your shipment here: {{tracking_link}}\n\nThanks for choosing {{site_name}},\nThe {{site_name}} Team"
            ],
            [
                'name' => 'Delivery Confirmation',
                'subject' => 'Your Order #{{order_id}} Has Delivered',
                'body' => "Hi {{name}},\n\nGood news! Your order #{{order_id}} from {{site_name}} has been Delevered.\n\n Thanks for choosing {{site_name}},\nThe {{site_name}} Team"
            ],
            [
                'name' => 'Invoice Email',
                'subject' => 'Invoice for Your Order #{{order_id}}',
                'body' => "Hi {{name}},\n\nPlease find the invoice for your recent order #{{order_id}} attached.\n\nThank you for shopping with {{site_name}}.\n\nBest regards,\nThe {{site_name}} Team"
            ],
            [
                'name' => 'Payment Failed',
                'subject' => 'Payment Failed for Order #{{order_id}}',
                'body' => "Hi {{name}},\n\nWe were unable to process payment for your order #{{order_id}} at {{site_name}}.\n\nPlease try again or contact support: {{support_email}}\n\nThanks,\nThe {{site_name}} Team"
            ],
            [
                'name' => 'Payment Successful',
                'subject' => 'Payment Successful for Order #{{order_id}}',
                'body' => "Hi {{name}},\n\nYour payment for order #{{order_id}} at {{site_name}} has been successfully processed.\n\nThank you for your purchase!\n\nThe {{site_name}} Team"
            ],
            [
                'name' => 'Account Termination',
                'subject' => 'Your Account Has Been Terminated',
                'body' => "Hi {{name}},\n\nWe regret to inform you that your account at {{site_name}} has been terminated due to policy violations.\n\nFor more details, contact support: {{support_email}}\n\nThe {{site_name}} Team"
            ],
            [
                'name' => 'Account Suspended',
                'subject' => 'Your Account Has Been Suspended',
                'body' => "Hi {{name}},\n\nYour account at {{site_name}} has been temporarily suspended.\n\nPlease contact support to resolve the issue: {{support_email}}\n\nThe {{site_name}} Team"
            ],
            [
                'name' => 'Maintenance Notification',
                'subject' => 'Scheduled Maintenance Notification',
                'body' => "Hi {{name}},\n\n{{site_name}} will be undergoing scheduled maintenance on {{maintenance_date}} from {{start_time}} to {{end_time}}.\n\nDuring this time, some services may be unavailable.\n\nThank you for your understanding.\n\nThe {{site_name}} Team"
            ],
        ];

        foreach ($templates as $template) {
            MailTemplate::updateOrCreate(
                ['name' => $template['name']],
                [
                    'subject' => $template['subject'],
                    'body' => $template['body']
                ]
            );
        }
    }
}
