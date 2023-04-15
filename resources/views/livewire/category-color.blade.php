<div class="border-2 border-sky-400 rounded-sm">
    {{-- I added this class empty div because of livewire multiple root elements detected --}}
    <div>
        <p class="text-teal-600 text-[12px]">
            {{-- $user_id = <span class="text-teal-100">{{ isset($user_id) ? $user_id : 'Not Set' }}</span><br> --}}
            {{-- $targetCategoryId = <span class="text-teal-100">{{ isset($targetCategoryId) ? $targetCategoryId : 'Not Set' }}</span> <br> --}}
            {{-- $categoryId = <span class="text-teal-100">{{ isset($categoryId) ? $categoryId : 'Not Set' }}</span><br> --}}
            {{-- $category = <span class="text-teal-100">{{ isset($category) ? $category : 'Not Set' }}</span><br> --}}
            {{-- $categoryDescription = <span class="text-teal-100">{{ isset($categoryDescription) ? $categoryDescription : 'Not Set' }}</span><br> --}}
            {{-- $categoryColor = <span class="text-teal-100">{{ isset($categoryColor) ? $categoryColor : 'Not Set' }}</span><br> --}}
            {{-- $x_endingHourpoint = <span class="text-teal-100">{{ isset($x_endingHourpoint) ? $x_endingHourpoint : 'Not Set' }}</span><br> --}}
            {{-- $$x_tasksGraphArray --> = <pre class="text-teal-100">{{ isset($x_tasksGraphArray) ? print_r($x_tasksGraphArray) : 'Not Set' }}</pre><br> --}}
            {{-- $x_flattened = <span class="text-teal-100">{{ var_dump($x_flattened) }}</span><br> --}}
        </p>
    </div>
    <div>
        <div>
            <input class="bg-black text-white w-52" type="hidden" name="targetCategoryId" id="targetCategoryId" value="{{ isset($targetCategoryId) ? $targetCategoryId : '' }}" wire:model.defer="targetCategoryId">
            {{-- <label class="text-white" for="targetCategoryId">targetCategoryId</label> --}}
        </div>
        <div class="flex items-center">
            <input class="bg-black text-white w-52 h-10" type="color" name="categoryColor" id="categoryColor" value="{{ isset($categoryColor) ? $categoryColor : '' }}" wire:model.defer="categoryColor">
            <label class="text-white pl-1" for="categoryColor">categoryColor</label>
        </div>
        <div>
            <input class="bg-black text-white w-52" type="hidden" name="categoryId" id="categoryId" value="{{ isset($categoryId) ? $categoryId : '' }}" wire:model.defer="categoryId">
            {{-- <label class="text-white" for="categoryId" >categoryId</label> --}}
        </div>
        <div>
            <input class="bg-black text-white w-52" type="text" name="category" id="category" value="{{ isset($category) ? $category : '' }}" wire:model.defer="category">
            <label class="text-white" for="category">category</label>
        </div>
        <div>
            <input class="bg-black text-white w-52" type="text" name="categoryDescription" id="categoryDescription" value="{{ isset($categoryDescription) ? $categoryDescription : '' }}"
                wire:model.defer="categoryDescription">
            <label class="text-white" for="categoryDescription">categoryDescription</label>
        </div>
    </div>
    <button wire:click="storeOrUpdate()"
        class="flex-1 px-3 py-2 text-sm font-medium mb-2 text-gray-900
        focus:outline-none bg-white border border-gray-200 rounded-sm
        hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4
        focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800
        dark:text-gray-400 dark:border-gray-600 dark:hover:text-white
        dark:hover:bg-gray-700">Update
        Task</button>
    {{-- Alert Message for Success or Unsuccuss of Category update record --}}
    <div>
        @if (session()->has('successfull_message'))
            <div class="text-green-500">
                {{ session('successfull_message') }}
            </div>
        @endif
        @if (session()->has('unsuccessfull_message'))
            <div class="text-red-500">
                {{ session('unsuccessfull_message') }}
            </div>
        @endif
    </div>
    <table class="overflow-x-auto relative w-full inline-block shadow-md sm:rounded-lg box-border border-2 border-sky-600">
        <thead class="text-[14px] uppercase bg-gray-50 dark:bg-gray-700 text-white">
            <tr>
                <th class="px-1 py-0">c.Id</th>
                <th class="px-1 py-0">category</th>
                <th class="px-1 py-0">c.Desc</th>
                <th class="px-1 py-0">c.Color</th>
                <th class="px-1 py-0">Edit</th>
                <th class="px-1 py-0">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allCategories as $category)
                <tr class="text-center">
                    <td class="box-border border-b bg-gray-900 border-gray-700 border text-teal-600 py-4">{{ $category->id }}</td>
                    <td class="box-border border-b bg-gray-900 border-gray-700 border text-teal-600 px-3">{{ $category->category }}</td>
                    <td class="box-border border-b bg-gray-900 border-gray-700 border text-teal-600 px-3">{{ $category->description }}</td>
                    <td class="box-border border-b bg-gray-900 border-gray-700 border text-teal-600 px-3">
                        {{-- {{ $category->color }} --}}
                        <div style="background-color:{{ $category->color }}" class="w-full h-4"></div>
                    </td>
                    <td class="box-border border-b bg-gray-900 border-gray-700 border text-teal-600 px-3">

                        <form wire:submit.prevent="edit({{ $category->id }})">
                            <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                        </form>
                    </td>
                    <td class="box-border border-b bg-gray-900 border-gray-700 border text-teal-600 px-3"><a href="">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('script')
    <script>
        $('#categoryColor').on('change', function() {
            console.log($('#categoryColor').val());
        });
    </script>
@endpush
