<?php

namespace App\Http\Controllers;

use App\Models\ReleaseNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = $request->all();
        if (isset($payload['ref_type']) && $payload['ref_type'] === 'tag') {
            $tagName = $payload['ref']; // Get the tag name
            $releaseData = $this->fetchReleaseData($tagName);
            Log::info('Release data: ' . json_encode($releaseData));
            ReleaseNote::create([
                'version' => $tagName,
                'details' => $releaseData['body'] ?? 'No release notes provided.',
            ]);
        }

        return response()->json(['status' => 'success'], 200);
    }

    private function fetchReleaseData($tagName)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://api.github.com/repos/Ayush281999/release-notes/releases/tags/' . $tagName, [
            'headers' => [
                'Authorization' => 'Bearer ' . env('GITHUB_PAT'),
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
