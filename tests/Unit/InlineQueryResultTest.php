<?php

namespace WeStacks\TeleBot\Tests\Unit;

use PHPUnit\Framework\TestCase;
use WeStacks\TeleBot\Exception\TeleBotObjectException;
use WeStacks\TeleBot\Objects\InlineQueryResult;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultArticle;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultAudio;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultCachedAudio;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultCachedDocument;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultCachedGif;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultCachedMpeg4Gif;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultCachedPhoto;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultCachedSticker;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultCachedVideo;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultCachedVoice;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultContact;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultDocument;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultGame;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultGif;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultLocation;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultMpeg4Gif;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultPhoto;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultVenue;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultVideo;
use WeStacks\TeleBot\Objects\InlineQueryResult\InlineQueryResultVoice;

class InlineQueryResultTest extends TestCase
{
    public function testInlineQueryResultDefault()
    {
        $object = InlineQueryResult::create(['type' => 'photo']);
        $this->assertInstanceOf(InlineQueryResultPhoto::class, $object);

        $object = InlineQueryResult::create(['type' => 'article']);
        $this->assertInstanceOf(InlineQueryResultArticle::class, $object);

        $object = InlineQueryResult::create(['type' => 'gif']);
        $this->assertInstanceOf(InlineQueryResultGif::class, $object);

        $object = InlineQueryResult::create(['type' => 'mpeg4_gif']);
        $this->assertInstanceOf(InlineQueryResultMpeg4Gif::class, $object);

        $object = InlineQueryResult::create(['type' => 'video']);
        $this->assertInstanceOf(InlineQueryResultVideo::class, $object);

        $object = InlineQueryResult::create(['type' => 'audio']);
        $this->assertInstanceOf(InlineQueryResultAudio::class, $object);

        $object = InlineQueryResult::create(['type' => 'voice']);
        $this->assertInstanceOf(InlineQueryResultVoice::class, $object);

        $object = InlineQueryResult::create(['type' => 'document']);
        $this->assertInstanceOf(InlineQueryResultDocument::class, $object);

        $object = InlineQueryResult::create(['type' => 'location']);
        $this->assertInstanceOf(InlineQueryResultLocation::class, $object);

        $object = InlineQueryResult::create(['type' => 'venue']);
        $this->assertInstanceOf(InlineQueryResultVenue::class, $object);

        $object = InlineQueryResult::create(['type' => 'contact']);
        $this->assertInstanceOf(InlineQueryResultContact::class, $object);

        $object = InlineQueryResult::create(['type' => 'game']);
        $this->assertInstanceOf(InlineQueryResultGame::class, $object);
    }

    public function testInlineQueryResultCached()
    {
        $object = InlineQueryResult::create(['type' => 'photo', 'photo_file_id' => 123123123]);
        $this->assertInstanceOf(InlineQueryResultCachedPhoto::class, $object);

        $object = InlineQueryResult::create(['type' => 'gif', 'gif_file_id' => 123123123]);
        $this->assertInstanceOf(InlineQueryResultCachedGif::class, $object);

        $object = InlineQueryResult::create(['type' => 'mpeg4_gif', 'mpeg4_file_id' => 123123123]);
        $this->assertInstanceOf(InlineQueryResultCachedMpeg4Gif::class, $object);

        $object = InlineQueryResult::create(['type' => 'sticker', 'sticker_file_id' => 123123123]);
        $this->assertInstanceOf(InlineQueryResultCachedSticker::class, $object);

        $object = InlineQueryResult::create(['type' => 'document', 'document_file_id' => 123123123]);
        $this->assertInstanceOf(InlineQueryResultCachedDocument::class, $object);

        $object = InlineQueryResult::create(['type' => 'video', 'video_file_id' => 123123123]);
        $this->assertInstanceOf(InlineQueryResultCachedVideo::class, $object);

        $object = InlineQueryResult::create(['type' => 'voice', 'voice_file_id' => 123123123]);
        $this->assertInstanceOf(InlineQueryResultCachedVoice::class, $object);

        $object = InlineQueryResult::create(['type' => 'audio', 'audio_file_id' => 123123123]);
        $this->assertInstanceOf(InlineQueryResultCachedAudio::class, $object);
    }

    public function testWrongInlineQueryResult()
    {
        $this->expectException(TeleBotObjectException::class);
        InlineQueryResult::create(['type' => 'some_wrong_type']);
    }
}
