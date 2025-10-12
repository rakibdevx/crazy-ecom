<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MailTemplate;

class MailTemplateController extends Controller
{
    public function index()
    {
        $mailtemplates = MailTemplate::get();
        return view('backend.admin.mailtemplate.index',compact('mailtemplates'));
    }
    public function edit($id)
    {
        $mailtemplate = MailTemplate::findOrFail($id);
        return view('backend.admin.mailtemplate.edit',compact('mailtemplate'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        $mailtemplate = MailTemplate::findOrFail($id);
        $mailtemplate->subject = $request->subject;
        $mailtemplate->body = $request->body;
        $mailtemplate->save();

        return redirect()
            ->route('admin.setting.mail.template.index')
            ->with('success', 'Mail Template updated successfully!');
    }
}
