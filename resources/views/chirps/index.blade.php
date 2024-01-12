<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chirps') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <form method="POST" action="{{ route('chirps.store') }}" >
                        @csrf

                        <textarea name="message"
                            class="block w-full rounded-md border-gray-300"
                            placeholder="{{ __('What\'s on your mind?') }}"
                        >{{ old('message') }}
                        </textarea>
                        <x-input-error :messages="$errors->get('message')"
                            class="mt-2"
                        />
                        <x-primary-button class="mt-4">
                             {{__('Chirp')}}
                        </x-primary-button>
                    </form>
                </div>
            </div>

            <div class="mt-6 bg-white dark:bg-white-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">
                @foreach($arr_chirps as $obj_chirp)

                <div class="p-6 flex space-x-2">
                    <svg class="h-6 w-6 text-gray-600 dark:text-gray-400 -scale-x-100" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"></path>
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800 dark:text-gray-200">
                                {{ $obj_chirp->user->name }}
                                </span>
                                <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                {{$obj_chirp->created_at->format('j M Y, g:i a')}}
                                </small>
                                @if ($obj_chirp->created_at != $obj_chirp->updated_at)
                                    <small class="text-sm text-gray-600 dark:text-gray-400">
                                        &middot; {{ __('Edited') }}
                                    </small>
                                @endif
                            </div>
                            <p class="mt-4 text-lg text-gray-900 dark:text-gray-100">{{ $obj_chirp->message}}</p>
                            @if (auth()->user()->id === $obj_chirp->user_id)
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-100" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                                    </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('chirps.edit',$obj_chirp)">
                                        {{ __('Edit chirp')}}
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('chirps.destroy',$obj_chirp) }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                        @csrf @method('DELETE')
                                        <x-dropdown-link :href="route('chirps.destroy',$obj_chirp)">
                                        {{ __('Delete chirp')}}
                                        </x-dropdown-link>

                                    </form>
                                </x-slot>
                            </x-dropdown>
                            @endif
                        </div>

                    </div>

                </div>
                @endforeach

            </div>

        </div>
    </div>


</x-app-layout>
