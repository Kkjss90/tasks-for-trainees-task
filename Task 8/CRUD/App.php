<?php
require_once 'vendor/autoload.php';
include 'config/config.php';

class App
{
    public $disk;
    private $path = 'disk:/';

    function __construct()
    {
        session_start();
    }

    public function setSession($token, $path = null): void
    {
        $this->disk = new Arhitector\Yandex\Disk($token);
        $_SESSION['path'] = $path ?? $this->path;
        $_SESSION['yandex_token'] = $token;
    }

    public function show(): void
    {
        try {
            $resources = $this->disk->getResource($_SESSION['path'], 1000)
                ->setPreview('100x250') // размер превью изображений
                ->setPreviewCrop(false) // обрезать превью согласно размеру
                ->setSort('name', true) // Сортировка по имени в обратном порядке
                ->items
                ->toArray();
            foreach ($resources as $resource) {
                $iterator = $resource->getIterator();
                $preview = isset($iterator['preview']) ? $iterator['preview'] : '';

                if ($resource->isDir()) {
                    echo '<div class="full-item">';
                    if ($preview) {
                        echo '<div class="dir" data-path="' . $iterator['path'] . '" data-item="true" data-dir="true">
                    <img src="' . $preview . '" alt="dir" data-item="true" data-dir="true">
                  </div>';
                    } else {
                        echo '<div class="dir" data-path="' . $iterator['path'] . '" data-item="true" data-dir="true">
                    <img src="images/free-icon-folder-8924327.png" alt="dir" class="default" data-item="true" data-dir="true">
                  </div>';
                    }
                    echo '<p data-item="true" data-dir="true">' . $iterator['name'] . '</p>';
                    echo '<a class="delete-button" data-path="' . $iterator['path'] . '">Удалить</a>';
                    echo '</div>';
                } elseif ($resource->isFile()) {
                    echo '<div class="full-item">';
                    if ($preview) {
                        echo '<div class="item" data-path="' . $iterator['path'] . '" data-item="true">
                    <img src="' . $preview . '" alt="file" data-item="true">
                  </div>';
                    } else {
                        echo '<div class="item" data-path="' . $iterator['path'] . '" data-item="true">
                    <img src="images/free-icon-file-3291803.png" alt="file" class="default" data-item="true" >
                  </div>';
                    }
                    echo '<p data-item="true">' . $iterator['name'] . '</p>';
                    echo '<a class="delete-button" data-path="' . $iterator['path'] . '">Удалить</a>';
                    echo '</div>';
                }
            }

        } catch (Exception $e) {
            throw new Exception('Ошибка получения ресурсов: ' . $e->getMessage());
        }
    }

    public function delete($pathToDelete): string
    {
        $this->disk->getResource($pathToDelete)->delete();
        return 'Объект' . $pathToDelete . 'помещен в корзину';
    }

    public function upload($localPath, $diskPath)
    {
        if (!file_exists($localPath)) {
            throw new Exception('Файл не найден: ' . $localPath);
        }
        return $this->disk->getResource($diskPath)->upload($localPath);

    }

    public function view(string $path): string
    {
        try {
            $tempFile = __DIR__ . 'yandex_';
            $resource = $this->disk->getResource($path);

            if (!$resource->isFile()) {
                throw new Exception('Указанный путь не является файлом.');
            }

            $resource->download($tempFile);

            $content = file_get_contents($tempFile);

            unlink($tempFile);

            return $content;
        } catch (Exception $e) {
            throw new Exception('Ошибка при просмотре файла: ' . $e->getMessage());
        }
    }

    public function edit(string $path, string $newContent): void
    {
        try {
            $resource = $this->disk->getResource($path);

            if (!$resource->isFile()) {
                throw new Exception('Указанный путь не является файлом.');
            }

            $tempFile = __DIR__ . 'yandex_';
            file_put_contents($tempFile, $newContent);

            $resource->upload($tempFile, true); // true для перезаписи файла

            unlink($tempFile);
        } catch (Exception $e) {
            throw new Exception('Ошибка при редактировании файла: ' . $e->getMessage());
        }
    }


    public function countItems()
    {
        $resource = $this->disk->getResource($_SESSION['path']);
        if ($resource->has()) {
            return $resource->items->count();
        } else {
            return 0;
        }
    }

}