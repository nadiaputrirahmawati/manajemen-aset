<div class="space-y-6">
    @include('livewire.partials.flash')
    @include('livewire.partials.page-header')
    @include('livewire.partials.kpi-cards')
    @include('livewire.partials.filters')
    @include('livewire.partials.assets-table')

    @if ($isFormOpen)
        @include('livewire.partials.modals.asset-form')
    @endif

    @if ($isDetailOpen && $selectedAsset)
        @include('livewire.partials.modals.asset-detail')
    @endif

    @if ($isTransferModalOpen)
        @include('livewire.partials.modals.asset-transfer')
    @endif

    @if ($isDeleteModalOpen)
        @include('livewire.partials.modals.asset-delete')
    @endif
</div>
