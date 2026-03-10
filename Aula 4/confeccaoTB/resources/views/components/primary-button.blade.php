<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-indigo-600 dark:bg-indigo-500 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-indigo-500 dark:hover:bg-indigo-400 hover:shadow-md focus:bg-indigo-700 dark:focus:bg-indigo-600 active:bg-indigo-800 dark:active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:ring-offset-2 dark:focus:ring-offset-slate-900 transition-all duration-200 ease-in-out']) }}>
    {{ $slot }}
</button>
