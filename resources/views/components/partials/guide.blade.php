@props(['title' => null])

<div class="mt-2 border-y xl:border xl:shadow-sm border-slate-200 dark:border-white/10 flex h-[75vh] xl:rounded-2xl guide-modal bg-white dark:bg-gray-900">
    <div class="flex gap-10 flex-col justify-between py-6 xl:p-6 flex-1 min-w-0 overflow-y-auto">
        <section class="prose dark:prose-invert max-w-3xl text-balance">
            @if(filled($title))
                <h2>{{ $title }}</h2>
            @endif

            {{ $slot }}
        </section>

        @if(filled(config('page-guide.footer')))
            <div class="italic flex-shrink-0">
                @foreach(config('page-guide.footer') as $line)
                    <p @class(['text-lg text-slate-900 dark:text-white' => $loop->first, 'text-slate-600 dark:text-gray-400' => ! $loop->first])>{{ $line }}</p>
                @endforeach
            </div>
        @endif
    </div>

    @if(filled(config('page-guide.decoration')))
        <div class="hidden xl:block overflow-hidden h-full flex-shrink-0 xl:rounded-tr-2xl xl:rounded-br-2xl">
            <x-dynamic-component :component="config('page-guide.decoration')" class="h-full w-full object-cover" />
        </div>
    @endif
</div>
