<?php

use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    #[Rule(['required', 'string', 'current_password'])]
    public string $password = '';

    public bool $deleteUserModal = false;

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

    <x-button negative wire:click="deleteUserModal = true">
        {{ __('Delete Account') }}
    </x-button>

    <x-modal title="Confirmação" blur wire:model.defer="deleteUserModal" focusable>
        <form wire:submit="deleteUser">
            <x-card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-6">
                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                    <x-text-input
                        wire:model="password"
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="{{ __('Password') }}"
                    />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <x-slot name="footer">
                    <div class="flex justify-end gap-x-4">
                        <x-button flat label="Cancelar" x-on:click="close" />
                        <x-button type="submit" primary label="Confirmar"/>
                    </div>
                </x-slot>
            </x-card>
        </form>
    </x-modal>
</section>
