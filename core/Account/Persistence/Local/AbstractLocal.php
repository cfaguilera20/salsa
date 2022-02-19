<?php
namespace Core\Account\Persistence\Local;

abstract class AbstractLocal
{
    protected $jsonFile;

    public function __construct(string $jsonFile = 'data.json')
    {
        $this->jsonFile = __DIR__.'/'.$jsonFile;
    }

    public function loadData(): array
    {
        if (!file_exists($this->jsonFile)) {
            return [];
        }
        $data = json_decode(file_get_contents($this->jsonFile), true);
        return  is_array($data) ? $data : [];
    }

    public function saveData(array $data): void
    {
        file_put_contents($this->jsonFile, json_encode($data));
    }
}
