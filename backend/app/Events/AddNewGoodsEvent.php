<?php

namespace App\Events;

use App\Http\DTO\V1\GoodsDTO;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AddNewGoodsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public GoodsDTO $goods;

    /**
     * Create a new event instance.
     */
    public function __construct(GoodsDTO $goods)
    {
        $this->goods = $goods;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
