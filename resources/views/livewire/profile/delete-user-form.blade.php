<?php

use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    #[Rule(['required', 'string', 'current_password'])]
    public string $password = '';

    public function deleteUser(): void
    {
        $this->validate();

        tap(auth()->user(), fn () => auth()->logout())->delete();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-button color="secondary" x-on:click="$modalOpen('modal-confirme-delete')">
        {{ __('Delete Account') }}
    </x-button>

    <x-modal title="Confirmação" id="modal-confirme-delete" blur>
        <form wire:submit="deleteUser">
            <x-card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-6">
                    <label>{{ __('Password') }}</label>

                    <x-password
                        wire:model="password"
                        id="password"
                        name="password"
                        class="mt-1 block w-3/4"
                        placeholder="{{ __('Password') }}"
                    />
                </div>

                <x-slot name="footer">
                    <div class="flex justify-end gap-x-4">
                        <x-button flat x-on:click="close">Cancelar</x-button>
                        <x-button type="submit" color="primary">Confirmar</x-button>
                    </div>
                </x-slot>
            </x-card>
        </form>
    </x-modal>
</section>
