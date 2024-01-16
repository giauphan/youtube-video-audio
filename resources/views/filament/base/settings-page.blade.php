<x-filament-panels::page>
    <div class="grid grid-cols-8 gap-4 sm:gap-5 lg:gap-6" style="    grid-template-columns: repeat(8, minmax(0, 1fr));">
        <div class="col-span-2 md:col-span-1" style="    grid-column: span 2 / span 2;">
            <ul class="space-y-2 font-inter font-medium" wire:ignore>
                @foreach ($this->getSidebarItems() as $item)
                    <x-filament-panels::sidebar.item
                        :active-icon="$item->getActiveIcon()"
                        :active="$item->isActive()"
                        :badge-color="$item->getBadgeColor()"
                        :badge="$item->getBadge()"
                        :first="$loop->first"
                        :icon="$item->getIcon()"
                        :last="$loop->last"
                        :should-open-url-in-new-tab="$item->shouldOpenUrlInNewTab()"
                        :url="$item->getUrl()"
                    >
                        {{ $item->getLabel() }}
                    </x-filament-panels::sidebar.item>
                @endforeach
            </ul>
        </div>
        <div class="col-span-4 md:col-span-3" style="    grid-column: span 6 / span 6;">
            <x-filament-panels::form wire:submit="save">
                {{ $this->form }}

                <x-filament-panels::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" />
            </x-filament-panels::form>
        </div>
    </div>
</x-filament-panels::page>