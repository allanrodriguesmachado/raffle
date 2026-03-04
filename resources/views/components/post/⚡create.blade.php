<?php

use App\Models\Applicat;
use App\Models\Raffle;
use Livewire\Component;

new class extends Component {
    public ?string $text = null;
    public bool $success = false;


    public function sub(): bool
    {
        Applicat::create([
            'raffle_id' => Raffle::first()->id,
            'email' => $this->text,
        ]);

        return $this->success = true;
    }
};
?>


<div class="mx-auto mt-8 w-full max-w-md rounded-xl border border-zinc-200 bg-white p-6 shadow-sm">
    @if($success)
        <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
            Salvo com sucesso
        </div>
    @else
        <form wire:submit="sub" class="space-y-4">
            <label class="block">
                <span class="mb-1 block text-sm font-medium text-zinc-700">Texto</span>
                <input wire:model="text"
                       type="text"
                       class="w-full rounded-lg border border-zinc-300 px-3 py-2 text-zinc-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                       placeholder="Digite algo..."
                >
            </label>

            <button type="submit"
                    class="inline-flex w-full items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 font-medium text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-300"
            >
                Enviar
            </button>
        </form>
    @endif</div>
