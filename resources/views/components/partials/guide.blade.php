@props(['title' => null])

<div
    class="guide-modal mt-2 flex h-[75vh] border-y border-slate-200 bg-white xl:rounded-2xl xl:border xl:shadow-sm dark:border-white/10 dark:bg-gray-900"
>
    <div class="flex min-w-0 flex-1 flex-col justify-between gap-10 overflow-y-auto py-6 xl:p-6">
        <section class="prose dark:prose-invert max-w-3xl text-balance">
            @if (filled($title))
                <h2>{{ $title }}</h2>
            @endif

            {{ $slot }}
        </section>

        @if (filled(config('page-guide.footer')))
            <div class="flex-shrink-0 italic">
                @foreach (config('page-guide.footer') as $line)
                    <p
                        @class(['text-lg text-slate-900 dark:text-white' => $loop->first, 'text-slate-600 dark:text-gray-400' => ! $loop->first])
                    >
                        {{ $line }}
                    </p>
                @endforeach
            </div>
        @endif
    </div>

    @if (filled(config('page-guide.decoration')))
        <div class="hidden h-full flex-shrink-0 overflow-hidden xl:block xl:rounded-br-2xl xl:rounded-tr-2xl">
            <x-dynamic-component :component="config('page-guide.decoration')" class="h-full w-full object-cover" />
        </div>
    @endif
</div>
