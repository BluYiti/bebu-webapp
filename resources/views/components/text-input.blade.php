@props(['disabled' => false])

<input 
    @disabled($disabled) 
    {{ $attributes->merge([
        'class' => 'text-white
                    bg-yellow-900
                    border-yellow-300 
                    dark:border-yellow-700 
                    dark:bg-gray-900 
                    dark:text-white-300 
                    focus:border-indigo-500 
                    dark:focus:border-indigo-600 
                    focus:ring-indigo-500 
                    dark:focus:ring-indigo-600 
                    rounded-md 
                    shadow-sm'
    ]) }}
>
