<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ChatSseController extends Controller
{
    private function sseResponse(callable $emit): StreamedResponse
    {
        $response = new StreamedResponse(function () use ($emit) {
            set_time_limit(0);
            ignore_user_abort(true);
            while (ob_get_level()) ob_end_clean();

            echo "retry: 2000\n\n";
            if (ob_get_level()) ob_flush();
            flush();

            $emit();
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('X-Accel-Buffering', 'no');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    private function emitMessage(array $msg): void
    {
        $data = json_encode([
            'id' => $msg['id'] ?? null,
            'session_id' => $msg['session_id'] ?? null,
            'sender_type' => $msg['sender_type'] ?? null,
            'message' => $msg['message'] ?? '',
            'created_at' => $msg['created_at'] ?? null,
        ]);
        echo "id: {$msg['id']}\nevent: message\ndata: {$data}\n\n";
    }

    private function emitTyping(array $status): void
    {
        $data = json_encode($status);
        echo "event: typing\ndata: {$data}\n\n";
    }

    public function sse($token)
    {
        $api = app(ApiService::class);

        return $this->sseResponse(function () use ($api, $token) {
            $lastId = 0;
            $lastTyping = '';

            while (true) {
                if (connection_aborted()) break;

                try {
                    $resp = $api->get("chat/messages/{$token}");
                    $msgData = $resp['data'] ?? [];
                    $messages = $msgData['messages'] ?? $msgData ?? [];

                    foreach ($messages as $msg) {
                        if ((int) $msg['id'] > $lastId) {
                            $this->emitMessage($msg);
                            $lastId = (int) $msg['id'];
                        }
                    }

                    $typing = $api->get("chat/typing/status/{$token}");
                    $tData = $typing['data'] ?? ['typing' => false];
                    $tKey = json_encode($tData);
                    if ($tKey !== $lastTyping) {
                        $lastTyping = $tKey;
                        $this->emitTyping($tData);
                    }
                } catch (\Exception $e) {
                    // backend sementara tidak terjangkau — tetap jaga stream tetap hidup
                }

                if (ob_get_level()) ob_flush();
                flush();
                if (connection_aborted()) break;
                sleep(2);
            }
        });
    }

    public function adminSse($id)
    {
        $api = app(ApiService::class);

        return $this->sseResponse(function () use ($api, $id) {
            $lastId = 0;
            $lastTyping = '';
            $firstRun = true;

            while (true) {
                if (connection_aborted()) break;

                try {
                    $resp = $api->get("admin/chat/messages/{$id}");
                    $data = $resp['data'] ?? [];
                    $messages = $data['messages'] ?? [];

                    foreach ($messages as $msg) {
                        if ((int) $msg['id'] > $lastId) {
                            $lastId = (int) $msg['id'];
                            if (!$firstRun) {
                                $this->emitMessage($msg);
                            }
                        }
                    }
                    $firstRun = false;

                    $typing = $api->get("admin/chat/typing/status/{$id}");
                    $tData = $typing['data'] ?? ['typing' => false];
                    $tKey = json_encode($tData);
                    if ($tKey !== $lastTyping) {
                        $lastTyping = $tKey;
                        $this->emitTyping($tData);
                    }
                } catch (\Exception $e) {
                    // backend sementara tidak terjangkau — tetap jaga stream tetap hidup
                }

                if (ob_get_level()) ob_flush();
                flush();
                if (connection_aborted()) break;
                sleep(2);
            }
        });
    }

    public function sessionsSse()
    {
        $api = app(ApiService::class);

        return $this->sseResponse(function () use ($api) {
            $lastCount = null;

            while (true) {
                if (connection_aborted()) break;

                $resp = $api->get('admin/chat/open-count');
                $count = (int) ($resp['count'] ?? 0);

                if ($count !== $lastCount) {
                    $lastCount = $count;
                    $data = json_encode(['count' => $count]);
                    echo "event: sessions\ndata: {$data}\n\n";
                }

                if (ob_get_level()) ob_flush();
                flush();
                if (connection_aborted()) break;
                usleep(800000);
            }
        });
    }
}
