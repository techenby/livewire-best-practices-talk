<form wire:submit="save" class="space-y-4">
    <div class="space-y-2">
        <flux:heading size="lg" level="2">Times</flux:heading>

        @foreach ($meetings as $index => $meeting)
            <flux:card :key="'meeting-' . $index" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <flux:select wire:model="meetings.{{ $index }}.day" name="day" placeholder="Day of Week">
                    <flux:select.option>Monday</flux:select.option>
                    <flux:select.option>Tuesday</flux:select.option>
                    ...
                </flux:select>

                <flux:select wire:model="meetings.{{ $index }}.period" name="period" placeholder="Period">
                    <flux:select.option>1st Period</flux:select.option>
                    <flux:select.option>2nd Period</flux:select.option>
                    ...
                </flux:select>
            </flux:card>
        @endforeach

        <flux:button icon="plus-circle" variant="ghost" wire:click="add">Add new time</flux:button>
    </div>

    <flux:button type="submit" variant="primary">Save</flux:button>
</form>
