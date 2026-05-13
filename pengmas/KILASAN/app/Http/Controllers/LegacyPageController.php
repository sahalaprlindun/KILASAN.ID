<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class LegacyPageController extends Controller
{
    public function home(): Response
    {
        return response($this->rewriteStaticLinks(file_get_contents(public_path('index.html'))));
    }

    public function about(): Response
    {
        return response($this->rewriteStaticLinks(file_get_contents(public_path('about.html'))));
    }

    public function form(): Response
    {
        $html = file_get_contents(public_path('form_page.html'));
        $html = $this->rewriteStaticLinks($html);
        $html = str_replace(
            '<form id="report-form" action="#" method="post">',
            '<form id="report-form" action="'.url('/lapor').'" method="post" enctype="multipart/form-data">'."\n".csrf_field(),
            $html
        );
        $html = str_replace('name="bukti" multiple', 'name="bukti[]" multiple', $html);
        $html = str_replace(
            "document.getElementById('report-form').addEventListener('submit', function(e) {",
            "document.getElementById('report-form').addEventListener('submit', function(e) {\n        return true;",
            $html
        );

        $message = '';
        if (session('success')) {
            $message = '<div class="container mt-4"><div class="alert alert-success">'.e(session('success')).'</div></div>';
        }
        if ($errors = session('errors')) {
            $items = collect($errors->all())->map(fn ($error) => '<li>'.e($error).'</li>')->implode('');
            $message .= '<div class="container mt-4"><div class="alert alert-danger"><strong>Periksa kembali data Anda.</strong><ul class="mb-0">'.$items.'</ul></div></div>';
        }

        $html = str_replace('<div class="main-content">', $message.'<div class="main-content">', $html);

        return response($html);
    }

    private function rewriteStaticLinks(string $html): string
    {
        return str_replace(
            ['href="index.html"', 'href="about.html"', 'href="form_page.html"', 'href="dasboard_admin.html"'],
            ['href="'.url('/').'"', 'href="'.url('/about').'"', 'href="'.url('/lapor').'"', 'href="'.url('/login').'"'],
            $html
        );
    }
}
