<?php
declare(strict_types = 1);
namespace App\Services\UniversalParser;

use DiDom\Document;
use App\Vocabulary;
// use App\Services\UniversalParser\Yandex_Translate;

class UniversalParserObject {
    private $url;
    private $document;
    private $documentTarget;

    public function __construct(string $url)
    {
        $this->url = $url;
        $this->document = new Document($url, true);
        $this->documentTarget = $this->document;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getParsingData()
    {
        return $this->document;
    }

    public function get()
    {
        return $this->documentTarget;
    }

    public function findClasses(string $className): array
    {
        $result = $this->documentTarget->find($className);
        if (count($result)>0) {
            $this->documentTarget = $result;
            return $this->documentTarget;
        } else {
            return false;
        }
    }
}