<?php

namespace App\Http\Controllers\API;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Services\HTMLSanitizer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    protected $sanitizer;

    public function __construct(HTMLSanitizer $sanitizer)
    {
        $this->sanitizer = $sanitizer;
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        // التحقق من وجود سكريبتات خبيثة
        if ($this->containsMaliciousScripts($request->input('content'))) {
            return response()->json(['error' => 'Content contains malicious scripts and cannot be saved.'], 400);
        }

        try {
            DB::beginTransaction();
            $sanitizedContent = $this->sanitizer->sanitize($request->input('content'));
            $content = Content::create([
                'content' => $sanitizedContent,
            ]);
            DB::commit();

            return response()->json(['success' => 'Content created successfully!', 'data' => $content], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return response()->json(['error' => 'Failed to create content'], 500);
        }
    }

    public function update(Request $request, Content $content)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        // التحقق من وجود سكريبتات خبيثة
        if ($this->containsMaliciousScripts($request->input('content'))) {
            return response()->json(['error' => 'Content contains malicious scripts and cannot be updated.'], 400);
        }

        try {
            DB::beginTransaction();
            $sanitizedContent = $this->sanitizer->sanitize($request->input('content'));
            $content->update([
                'content' => $sanitizedContent,
            ]);
            DB::commit();

            return response()->json(['success' => 'Content updated successfully!', 'data' => $content], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return response()->json(['error' => 'Failed to update content'], 500);
        }
    }

    // وظيفة للتحقق من وجود سكريبتات خبيثة
    private function containsMaliciousScripts($content)
    {
        // تحقق من وجود أي وسم <script>
        if (preg_match('/<\s*script/i', $content)) {
            return true;
        }
        return false;
    }
}
