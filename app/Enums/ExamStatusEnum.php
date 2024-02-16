<?php

namespace App\Enums;

enum ExamStatusEnum: string
{
    case PENDING = 'pending';
    case READY = 'ready';
    case PROCESSING = 'processing';
    case COMPLETE = 'complete';

    public function value(): string
    {
        return match ($this) {
            self::PENDING    => 'Chờ tạo đề',
            self::READY      => 'Sẵn sàng thi',
            self::PROCESSING => 'Đang làm bài',
            self::COMPLETE   => 'Hoàn thành',
        };
    }
}
