<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $selectedGenre = 'all';
    public $selectedMovie = null;
    public $cart = [];
    public $showCart = false;

    public $movies = [
        ['id' => 1, 'title' => 'Aksi Heroik', 'genre' => 'aksi', 'poster' => 'https://via.placeholder.com/200x300?text=Aksi+Heroik'],
        ['id' => 2, 'title' => 'Cinta Sejati', 'genre' => 'drama', 'poster' => 'https://via.placeholder.com/200x300?text=Cinta+Sejati'],
        ['id' => 3, 'title' => 'Tawa Ceria', 'genre' => 'komedi', 'poster' => 'https://via.placeholder.com/200x300?text=Tawa+Ceria'],
        ['id' => 4, 'title' => 'Hantu Malam', 'genre' => 'horor', 'poster' => 'https://via.placeholder.com/200x300?text=Hantu+Malam'],
    ];

    public $foodMenu = [
        ['id' => 1, 'name' => 'Popcorn Karamel', 'price' => 25000, 'image' => 'https://via.placeholder.com/100x100?text=Popcorn'],
        ['id' => 2, 'name' => 'Minuman Soda', 'price' => 15000, 'image' => 'https://via.placeholder.com/100x100?text=Soda'],
    ];

    public function filterGenre($genre)
    {
        $this->selectedGenre = $genre;
    }

    public function selectMovie($id)
    {
        $this->selectedMovie = collect($this->movies)->firstWhere('id', $id);
    }

    public function addToCart($item)
    {
        $existing = collect($this->cart)->firstWhere('id', $item['id']);

        if ($existing) {
            foreach ($this->cart as &$cartItem) {
                if ($cartItem['id'] === $item['id']) {
                    $cartItem['quantity']++;
                }
            }
        } else {
            $item['quantity'] = 1;
            $this->cart[] = $item;
        }
    }

    public function toggleCart()
    {
        $this->showCart = !$this->showCart;
    }

    public function removeItem($id)
    {
        $this->cart = array_filter($this->cart, fn($item) => $item['id'] !== $id);
    }

    public function getTotalProperty()
    {
        return collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    public function render()
    {
        return view('livewire.home')->layout('layouts.app', ['title' => 'CineTicket']);
    }
}
