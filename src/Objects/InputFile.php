<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use InvalidArgumentException;
use RuntimeException;

final readonly class InputFile
{
	private function __construct(private ?string $path, private ?string $contents, private string $filename)
	{
		if ($filename === "" || strpbrk($filename, "\r\n\0") !== false) throw new InvalidArgumentException("Необходимо корректное имя загружаемого файла.");
	}

	/**
	 * Создаём файл для загрузки из локального пути, не читая его целиком в память.
	 *
	 * Удалённые URL не являются локальными файлами. Поток открывается при отправке и закрывается сервисом загрузки.
	 * @param string $path Путь к существующему доступному файлу.
	 * @param string|null $filename Имя в multipart; null использует имя исходного файла.
	 * @return self Описание локального файла.
	 * @throws InvalidArgumentException Файл не существует, недоступен или передан URL.
	 * @see https://dev.vk.ru/ru/api/api-requests
	 */
	public static function fromPath(string $path, ?string $filename = null): self
	{
		if (str_contains($path, "://") || !is_file($path) || !is_readable($path)) throw new InvalidArgumentException("Файл загрузки недоступен по локальному пути.");
		return new self($path, null, $filename ?? basename($path));
	}

	/**
	 * Создаём файл из готовых байтов, например сформированного PDF или CSV.
	 *
	 * Содержимое не интерпретируется как путь или URL.
	 * @param string $contents Байты файла, включая двоичные данные.
	 * @param string $filename Имя с расширением, например report.csv.
	 * @return self Описание файла в памяти.
	 * @throws InvalidArgumentException Некорректно имя файла.
	 * @see https://dev.vk.ru/ru/api/api-requests
	 */
	public static function fromString(string $contents, string $filename): self
	{
		return new self(null, $contents, $filename);
	}

	/**
	 * Получаем имя файла для поля Content-Disposition в multipart.
	 *
	 * Имя может отличаться от локального пути.
	 * @return string Имя загружаемого файла.
	 */
	public function getFilename(): string
	{
		return $this->filename;
	}

	/**
	 * Открываем отдельный читаемый поток для одной отправки файла.
	 *
	 * Вызывающий сервис обязан закрыть поток также при исключении HTTP-транспорта.
	 * @return resource Поток с позицией в начале содержимого.
	 * @throws RuntimeException Файл исчез или поток не удалось открыть/заполнить.
	 */
	public function openStream()
	{
		$stream = @fopen($this->path ?? "php://temp", $this->path === null ? "w+b" : "rb");
		if ($stream === false) throw new RuntimeException("Не удалось открыть файл для загрузки.");
		if ($this->path === null) {
			if (fwrite($stream, $this->contents) !== strlen($this->contents)) {
				fclose($stream);
				throw new RuntimeException("Не удалось подготовить поток файла.");
			}
			rewind($stream);
		}
		return $stream;
	}
}
