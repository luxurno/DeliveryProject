<?php

declare(strict_types = 1);

namespace App\Core\Transformer;

use App\Core\Model\QueueMessage;

class QueueMessageTransformer
{
    public function transformFromQueueMessage(string $message): QueueMessage
    {
        return unserialize($message);
    }

    public function transformToQueueMessage(QueueMessage $object): string
    {
        return serialize($object);
    }
}
