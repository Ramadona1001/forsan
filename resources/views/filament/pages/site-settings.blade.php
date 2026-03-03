<x-filament-panels::page>
    <form wire:submit="save">
        {{ $this->form }}

        <div class="mt-6">
            <x-filament::button type="submit">
                {{ __('filament.pages.site_settings.save_btn') }}
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
