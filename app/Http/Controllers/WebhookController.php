<?php

namespace App\Http\Controllers;

use App\Models\ReleaseNote;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = $request->all();

        if (isset($payload['ref_type']) && $payload['ref_type'] === 'tag') {
            $tagName = $payload['ref']; // Get the tag name
            $releaseData = $this->fetchReleaseData($tagName);

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
        $response = $client->get('https://api.github.com/repos/your-username/your-repository/releases/tags/' . $tagName, [
            'headers' => [
                'Authorization' => 'Bearer ' . env('GITHUB_PAT'),
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
