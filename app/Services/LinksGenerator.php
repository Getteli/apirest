<?php

namespace App\Services;

use Illuminate\Contracts\Support\Arrayable;

class LinksGenerator implements Arrayable
{
	protected $links = [];

	protected function add(string $type, string $rel, string $url) : void
	{
		$this->links[] = [
			'type' => $type,
			'rel' => $rel,
			'url' => $url
		];
	}

	public function addGet(string $rel, string $url) : self
	{
		$this->add('GET', $rel, $url);

		return $this;
	}

	public function addPost(string $rel, string $url) : self
	{
		$this->add('POST', $rel, $url);

		return $this;
	}

	public function addPut(string $rel, string $url) : self
	{
		$this->add('PUT', $rel, $url);

		return $this;
	}

	public function addDelete(string $rel, string $url) : self
	{
		$this->add('DELETE', $rel, $url);

		return $this;
	}

	public function toArray() : array
	{
		return $this->links;		
	}
}