<?php

use App\Models\{Applicant, Raffle};
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    public ?Raffle $raffle = null;
    public ?string $email = null;
    public bool $success = false;

    public function mount(): void
    {
        $this->raffle = Raffle::inRandomOrder()->first();
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('applicants', 'email')->where('raffle_id', $this->raffle->id)
            ]
        ];
    }

    #[Computed]
    public function applications()
    {
        return $this->raffle->applicants;
    }

    public function sub(): bool
    {
        $this->validate();

        Applicant::create([
            'raffle_id' => $this->raffle->id,
            'email' => $this->email
        ]);

        return $this->success = true;
    }
};
?>

<div class="mx-auto mt-8 w-full max-w-md rounded-xl border border-zinc-200 bg-white p-6 shadow-sm">
    <h1>{{$this->raffle->name}}</h1>


    @if($success)
        <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
            Salvo com sucesso
        </div>
    @else
        <form wire:submit="sub" class="space-y-4">
            <label class="block">
                <span class="mb-1 block text-sm font-medium text-zinc-700">Texto</span>
                <input wire:model="email"
                       type="text"
                       class="w-full rounded-lg border border-zinc-300 px-3 py-2 text-zinc-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                       placeholder="Digite algo..."
                >
            </label>

            @error('email')
            <div>
                <p class="text-sm text-red-600">{{ $message }}</p>
            </div>
            @enderror

            <button type="submit"
                    class="inline-flex w-full items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 font-medium text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-300"
            >
                Enviar
            </button>
        </form>

        @foreach($this->applications AS $application)
            <div>{{$application->email}}</div>
        @endforeach

    @endif</div>
