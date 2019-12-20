<?php


namespace App\Cart;


interface CartInterface
{
    public function add($product, int $quantity): void;

    public function update(string $rowId, int $quantity): void;

    public function remove(string $rowId): void;

    public function destroy(): void;

    public function getDuplicate(int $id): bool;

    public function count(): int;

    public function getContent(): object;

    public function total(): string;

    public function subtotal(): string;

    public function getInstance(string $instance): object;

}
