<?php

namespace Tests\Feature;

use App\Http\Controllers\Api\V1\System\GoodsController;
use Illuminate\Http\Request;
use Tests\TestCase;

class GoodsControllerTest extends TestCase
{
    public function testBasic()
    {
        $dir = __DIR__;
        $content = file_get_contents($dir . '/goods_store.json');
        $content = json_decode($content, true, flags: JSON_THROW_ON_ERROR);
        $this->post(route('api.v1.system.goods.store'), $content);
    }
}
