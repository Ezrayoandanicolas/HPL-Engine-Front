<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TrafficLogger
{
    protected $token;
    protected $chatId;
    protected $threadId;

    protected $botPatterns = [
        'bot', 'crawl', 'spider', 'slurp', 'mediapartners',
        'feedfetcher', 'newsreader', 'screenshot', ' thumbs',
        'facebookexternalhit', 'vkShare', 'W3C_Validator',
        'whatsapp', 'telegrambot', 'discordbot', 'twitterbot',
        'bingbot', 'yandexbot', 'baiduspider', 'duckduckbot',
        'sogou', 'exabot', 'facebot', 'ia_archiver',
        'semrushbot', 'ahrefsbot', 'mj12bot', 'dotbot',
        'petalbot', 'bytespider', 'gptbot', 'chatgpt-user',
        'ccbot', 'claudebot', 'anthropic', 'cohere-ai',
        'python-requests', 'python-urllib', 'go-http-client',
        'java/', 'php/', 'curl/', 'wget/', 'libwww-perl',
        'scrapy', 'httpclient', 'apache-httpclient',
        'googlebot', 'adsbot-google', 'mediapartners-google',
    ];

    public function __construct()
    {
        $this->token = env('TG_BOT_TOKEN');
        $this->chatId = env('TG_CHAT_ID');
        $this->threadId = (int) env('TG_TOPIC_TRAFFIC', 3);
    }

    public function detectType(string $userAgent): string
    {
        $ua = strtolower($userAgent);
        foreach ($this->botPatterns as $pattern) {
            if (str_contains($ua, strtolower($pattern))) {
                return 'BOT';
            }
        }
        return 'HUMAN';
    }

    public function send($request, string $type): void
    {
        $ip = $request->ip();
        $ua = $request->userAgent() ?? '-';
        $url = $request->fullUrl();
        $method = $request->method();
        $referer = $request->headers->get('referer', '-');
        $now = now('Asia/Jakarta')->format('d M Y H:i:s');

        $emoji = $type === 'BOT' ? '🤖' : '👤';
        $color = $type === 'BOT' ? '🔴' : '🟢';

        $text = "{$emoji} <b>TRAFFIC LOG</b> {$color}\n\n";
        $text .= "<b>Type:</b> {$type}\n";
        $text .= "<b>Time:</b> {$now} WIB\n";
        $text .= "<b>IP:</b> <code>{$ip}</code>\n";
        $text .= "<b>URL:</b> {$url}\n";
        $text .= "<b>Method:</b> {$method}\n";
        $text .= "<b>Referer:</b> {$referer}\n";
        $text .= "<b>User-Agent:</b>\n<code>{$ua}</code>";

        try {
            Http::timeout(5)->post("https://api.telegram.org/bot{$this->token}/sendMessage", [
                'chat_id'    => $this->chatId,
                'text'       => $text,
                'parse_mode' => 'HTML',
                'message_thread_id' => $this->threadId,
            ]);
        } catch (\Exception $e) {
            // silent fail
        }
    }

    public function setThread(int $threadId): self
    {
        $this->threadId = $threadId;
        return $this;
    }
}
