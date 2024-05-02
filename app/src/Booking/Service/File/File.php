<?php

declare(strict_types=1);

namespace Booking\Service\File;

final class File
{
    public int $id;
    
    public string $source;
    
    public string $alt;
    
    public string $mime_type;
    
    public string $entity_type;
    
    public int $entity_id;
}
