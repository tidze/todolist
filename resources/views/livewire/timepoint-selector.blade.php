{{-- Component startingTimepoint --}}
<div class="flex">
    {{-- for input date overlay to be clickable every where --}}
    <div id="startingDateContainer" class="basis-2/5 inline-block border rounded-xl border-transparent">
        <input {{-- wire:ignore --}} id="startingDate" type="date" class="border-2 rounded-xl border-gray-500 bg-gray-800" value="">
    </div>
    <div class="basis-2/5 flex">
        <input class="inline-block w-40 bg-black text-center startingTimepoint border-2 h-full rounded-xl border-gray-500" id="startingTimepoint" wire:model.defer="startingTimepoint" type="text" />
    </div>
    <label class="basis-1/5 self-center" for="startingTimepoint">Start</label>

    <input class="bg-black text-center p-0 text-[15px]" id="startingTimepoint_unix" wire:model.defer="startingTimepoint_unix" name="startingTimepoint_unix" type="hidden" value="" />
    <label for="startingTimepoint_unix">startingTimepoint_unix</label>
    @error('startingTimepoint_unix')
        <span class="text-red-500 text-[9px]">{{ $message }}</span>
    @enderror
</div>
