<?php

namespace App\Services;

use App\Models\MailTemplate;

class MailTemplateService
{
    public static function prepare(string $templateName, array $data = []): array
    {
        $template = MailTemplate::where('name', $templateName)->first();

        if (!$template) {
            return [
                'subject' => "Template not found: {$templateName}",
                'body' => "Template '{$templateName}' not found.",
            ];
        }

        $search = [
            '{{name}}','{{email}}','{{site_name}}','{{order_id}}','{{reset_link}}',
            '{{verification_link}}','{{subscription_end_date}}','{{support_email}}','{{tracking_link}}',
            '{{order_details_link}}','{{maintenance_date}}','{{start_time}}','{{end_time}}',
            '{{support_ticket}}','{{login_link}}','{{custom_variable}}'
        ];


        $replace = [
            $data['name'] ?? '',
            $data['email'] ?? '',
            $data['site_name'] ?? config('app.name'),
            $data['order_id'] ?? '',
            $data['reset_link'] ?? '',
            $data['verification_link'] ?? '',
            $data['subscription_end_date'] ?? '',
            $data['support_email'] ?? config('mail.from.address'),
            $data['tracking_link'] ?? '',
            $data['order_details_link'] ?? '',
            $data['maintenance_date'] ?? '',
            $data['start_time'] ?? '',
            $data['end_time'] ?? '',
            $data['support_ticket'] ?? '',
            $data['login_link'] ?? route('login'),
            $data['custom_variable'] ?? '',
        ];

        return [
            'subject' => str_replace($search, $replace, $template->subject),
            'body' => str_replace($search, $replace, $template->body),
        ];
    }
}
